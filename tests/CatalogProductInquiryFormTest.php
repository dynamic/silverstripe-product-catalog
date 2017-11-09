<?php

/**
 * Class CatalogProductInquiryFormTest
 */
class CatalogProductInquiryFormTest extends SapphireTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    /**
     *
     */
    public function testCatalogProductInquiryFormFields()
    {
        $form = CatalogProductInquiryForm::create(CatalogCategory_Controller::create($this->objFromFixture('CatalogCategory',
            'default')), 'ProductInquiryForm');
        $fields = $form->Fields();

        $this->assertInstanceOf('FieldList', $fields);

        foreach ($fields as $field) {
            $this->assertInstanceOf('FormField', $field, "field {$field->getName()} isn't a FormField instance");
        }
    }

    /**
     *
     */
    public function testCatalogProductInquiryFormActions()
    {
        $form = CatalogProductInquiryForm::create(CatalogCategory_Controller::create($this->objFromFixture('CatalogCategory',
            'default')), 'ProductInquiryForm');
        $actions = $form->Actions();

        $this->assertInstanceOf('FieldList', $actions);

        foreach ($actions as $action) {
            $this->assertInstanceOf('FormAction', $action, "action {$action->getName()} isn't a FormAction instance");
        }
    }

}
