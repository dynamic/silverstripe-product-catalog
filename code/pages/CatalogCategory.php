<?php

class CatalogCategory extends Page
{
    /**
     * @var array
     */
    private static $belongs_many_many = array(
        'Products' => 'CatalogProduct',
    );

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
}

class CatalogCategory_Controller extends Page_Controller
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'view',
        'ContactForm',
        'success',
    );

    /**
     * @var
     */
    private $product;

    /**
     * @param SS_HTTPRequest $request
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
            $product = ChardProduct::get()->filter('URLSegment', $productID)->first();
            return $product;
        }
        return false;
    }
    /**
     * @param $event
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

    /**
     * @return Form
     */
    public function ContactForm()
    {
        $request = ($this->request) ? $this->request : $this->parentController->getRequest();
        $fields = new FieldList(
            TextField::create('Name'),
            EmailField::create('Email'),
            TextField::create('Phone', 'Phone (Optional)'),
            TextareaField::create('Comment', 'Questions or Comments'),
            HiddenField::create('Created', 'Date', date('Y-m-d H:i:s'))
        );
        if ($this->getProduct($request)) {
            $fields->push(HiddenField::create('ProductID', 'ProductID', $this->getProduct()->ID));
        }

        $actions = new FieldList(
            FormAction::create('doContactForm', 'Submit')
        );

        $required = new RequiredFields('Name', 'Email', 'Comment');

        $form = BootstrapForm::create($this, 'ContactForm', $fields, $actions, $required)
            ->enableSpamProtection()
            ->disableSecurityToken()
            //->loadDataFrom($request->postVars())
        ;

        return $form;
    }

    /**
     * @param $data
     * @param Form $form
     * @return SS_HTTPResponse
     */
    public function doContactForm($data, Form $form)
    {
        $submission = new ContactFormSubmission();
        $form->saveInto($submission);
        $submission->write();

        $config = SiteConfig::current_site_config();
        $recipients = $config->Recipients();
        $subject = $config->EmailSubject;
        $template = 'ContactFormSubmission';

        // send emails
        $this->extend('sendFormEmail', $submission, $template, $recipients, $subject);

        return $this->redirect('success');
    }

    /**
     * @return HTMLText
     */
    public function success()
    {
        $config = SiteConfig::current_site_config();
        $thanks = $config->ThankYouMessage;
        if ($thanks == null) {
            $thanks = '';
        }

        return $this->customise(new ArrayData(array(
            'Title' => 'Contact Us',
            'Content' => $thanks,
            'Form' => false,
        )))->renderWith('Page', 'Page');
    }
}