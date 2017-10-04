<?php

use Heyday\VersionedDataObjects\VersionedDataObjectDetailsForm;

class CatalogCategory extends Page
{
    /**
     * @var array
     */
    private static $belongs_many_many = array(
        'Products' => 'CatalogProduct',
    );

    /**
     * @var
     */
    private $related_categories;

    /**
     * @var
     */
    private $sibling_categories;

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($this->ID) {
            // Products
            $config = GridFieldConfig_RelationEditor::create();
            if (class_exists('GridFieldSortableRows')) {
                $config->addComponent(new GridFieldSortableRows('SortOrder'));
            }
            if (class_exists('GridFieldAddExistingSearchButton')) {
                $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
                $config->addComponent(new GridFieldAddExistingSearchButton());
            }
            $config->removeComponentsByType('GridFieldDetailForm');
            $config->addComponent(new VersionedDataObjectDetailsForm());

            $config->removeComponentsByType('GridFieldPaginator');
            $config->removeComponentsByType('GridFieldPageCount');

            $products = $this->Products()->sort('SortOrder');
            $productsField = GridField::create('Products', 'Products', $products, $config);

            $fields->addFieldsToTab('Root.Products', array(
                $productsField,
            ));
        }

        return $fields;
    }

    /**
     * @return DataList
     */
    public function getProductList()
    {
        return $this->Products()->sort('SortOrder');
    }

    /**
     * @param null $categories
     *
     * @return $this
     */
    public function setRelatedCategories($categories = null)
    {
        if ($categories === null) {
            $categories = $this->Products()->relation('Categories')->exclude('CatalogCategoryID', $this->ID);
        }
        $this->related_categories = $categories;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelatedCategories()
    {
        if (!$this->related_categories) {
            $this->setRelatedCategories();
        }

        return $this->related_categories;
    }

    /**
     * @return $this
     */
    public function setSiblingCategories()
    {
        $this->sibling_categories = self::get()->filter('ParentID', $this->ParentID)->exclude('ID', $this->ID);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiblingCategories()
    {
        if (!$this->sibling_categories) {
            $this->setSiblingCategories();
        }

        return $this->sibling_categories;
    }

}

class CatalogCategory_Controller extends Page_Controller
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'view',
        'ProductInquiryForm',
        'success',
    );

    /**
     * @var
     */
    private $product;

    /**
     * @param SS_HTTPRequest $request
     *
     * @return mixed
     */
    public function getProduct(SS_HTTPRequest $request = null)
    {
        if (!$this->product) {
            $this->setProduct($this->getProductFromRequest($request));
        }

        return $this->product;
    }

    /**
     * @param null $request
     *
     * @return DataObject|CatalogProduct|bool
     * @throws SS_HTTPResponse_Exception
     */
    public function getProductFromRequest($request = null)
    {
        if (!$request) {
            $request = $this->getRequest();
        }

        $productID = $request->param('ID');
        if ($productID) {
            $product = CatalogProduct::get()->filter('URLSegment', $productID)->first();

            return $product;
        }

        return false;
    }

    /**
     * @param $product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @param SS_HTTPRequest $request
     *
     * @return HTMLText
     */
    public function view(SS_HTTPRequest $request)
    {

        $product = $this->getProduct();
        if (!$product) {
            return $this->httpError(404, 'The product you\'re looking for isn\'t available.');
        }

        return $this->customise(array(
            'Title' => $product->getTitle(),
            'Product' => $product,
            'MetaTags' => $product->MetaTags(),
            'Breadcrumbs' => $product->Breadcrumbs(),
            'AllowInquiries' => $product->AllowInquiry,
            'ProductInquiryForm' => $this->ProductInquiryForm(),
        ))->renderWith(array('Product', 'Page'));
    }

    /**
     * @return Form
     */
    public function ProductInquiryForm()
    {
        $form = CatalogProductInquiryForm::create($this, 'ProductInquiryForm');

        if (class_exists('BootstrapForm')) {
            $form->Fields()->bootstrapify();
            $form->Actions()->bootstrapify();
        }

        $this->extend('updateProductInquiryForm', $form);

        return $form;
    }

    /**
     * @param $data
     * @param Form $form
     *
     * @return SS_HTTPResponse
     */
    public function doProductInquiry($data, Form $form)
    {
        $submission = CatalogProductInquiry::create();
        $form->saveInto($submission);
        $submission->write();

        Session::set('InquiryProductID', $submission->ProductID);

        $template = 'ProductInquirySubmission';

        // hook to allow for allowing email logic
        $this->extend('sendInquiryEmail', $submission, $template);

        return $this->redirect('success');
    }

    /**
     * @return HTMLText
     */
    public function success()
    {

        $product = CatalogProduct::get()->byID(Session::get('InquiryProductID'));

        $thanks = "Thank you for inquiring";

        if ($product) {
            $thanks .= " about {$product->Title}";
        }

        $this->extend('updateSuccessMessage', $thanks);

        return $this->customise(ArrayData::create([
            'Title' => 'Contact Us',
            'Content' => $thanks,
            'ProductLink' => ($product) ? $product->Link() : false,
            'Form' => false,
        ]))->renderWith(['Product_success', 'Page', 'Page']);
    }
}