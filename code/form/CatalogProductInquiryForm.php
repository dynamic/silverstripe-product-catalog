<?php

/**
 * Class CatalogProductInquiryForm
 */
class CatalogProductInquiryForm extends Form
{

    /**
     * CatalogProductInquiryForm constructor.
     *
     * @param Controller $controller
     * @param string $name
     */
    public function __construct(Controller $controller, $name)
    {
        $fields = Injector::inst()->get('CatalogProductInquiry')->getFrontEndFields();
        $actions = Injector::inst()->get('CatalogProductInquiry')->getFrontEndActions();
        $validator = Injector::inst()->get('CatalogProductInquiry')->getFrontEndRequiredFields();

        parent::__construct($controller, $name, $fields, $actions, $validator);
    }

}