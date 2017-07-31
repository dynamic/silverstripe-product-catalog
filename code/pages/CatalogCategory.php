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

}

class CatalogCategory_Controller extends Page_Controller
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'view',
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
     * @return DataObject|void
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
     * @param $event
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
        ))->renderWith(array('Product', 'Page'));
    }
}