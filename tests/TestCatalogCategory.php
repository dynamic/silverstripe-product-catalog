<?php

/**
 * Class TestCatalogCategory
 */
class TestCatalogCategory extends CatalogCategory implements TestOnly
{

}

/**
 * Class TestCatalogCategory_Controller
 */
class TestCatalogCategory_Controller extends CatalogCategory_Controller implements TestOnly
{

    private static $allowed_actions = [
        'Form',
    ];

    /**
     *
     */
    public function init()
    {
        parent::init();
        Requirements::clear();
    }

    /**
     * @return CatalogProductInquiryForm
     */
    public function Form()
    {
        return CatalogProductInquiryForm::create($this, 'Form');
    }

}