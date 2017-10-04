<?php

/**
 * Class CatalogProductInquiryTest
 */
class CatalogProductInquiryTest extends SapphireTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    /**
     * Ensure any current member is logged out
     */
    public function logOut()
    {
        if ($member = Member::currentUser()) {
            $member->logOut();
        }
    }

    /**
     *
     */
    public function testGetCMSFields()
    {
        $this->assertInstanceOf('FieldList', Injector::inst()->get('CatalogProductInquiry')->getCMSFields());
    }

    /**
     *
     */
    public function testGetFrontEndFields()
    {
        $fields = Injector::inst()->get('CatalogProductInquiry')->getFrontEndFields();
        $this->assertInstanceOf('FieldList', $fields);
        if ($fields->dataFieldByName('ProductID')) {
            $fields->dataFieldByName('ProductID')->setValue(2);
        }
        $this->assertInstanceOf('HiddenField', $fields->dataFieldByName('ProductID'));
    }

    /**
     *
     */
    public function testGetFrontEndActions()
    {
        $actions = Injector::inst()->get('CatalogProductInquiry')->getFrontEndActions();
        $this->assertInstanceOf('FieldList', $actions);
        $this->assertInstanceOf('FormAction', $actions->fieldByName('action_doProductInquiry'));
    }

    /**
     *
     */
    public function testGetFrontEndRequiredFields()
    {
        $requiredFields = Injector::inst()->get('CatalogProductInquiry')->getFrontEndRequiredFields();
        $this->assertInstanceOf('RequiredFields', $requiredFields);
        $this->assertTrue($requiredFields->fieldIsRequired('Name'));
        $this->assertTrue($requiredFields->fieldIsRequired('Email'));
    }

    /**
     *
     */
    public function testProvidePermissions()
    {
        $expected = [
            'CatalogProductInquiry_delete' => [
                'name' => 'Delete a Product Inquiry',
                'category' => 'Product InquiryPermissions',
            ],
            'CatalogProductInquiry_view' => [
                'name' => 'View a Product Inquiry',
                'category' => 'Product InquiryPermissions',
            ],
        ];

        $this->assertEquals($expected, Injector::inst()->get('CatalogProductInquiry')->providePermissions());
    }

    /**
     *
     */
    public function testCanCreate()
    {
        $this->assertTrue(Injector::inst()->get('CatalogProductInquiry')->canCreate());
    }

    /**
     *
     */
    public function testCanEdit()
    {
        $this->assertFalse(Injector::inst()->get('CatalogProductInquiry')->canEdit());
    }

    public function testCanView()
    {
        if ($member = Member::currentUser()) {
            $this->logOut();
        }

        $inquiry = Injector::inst()->get('CatalogProductInquiry');
        $this->assertFalse($inquiry->canView());

        $this->logInWithPermission('CatalogProductInquiry_view');
        $this->assertTrue($inquiry->canView());

        $this->logOut();
    }

    public function testCanDelete()
    {
        if ($member = Member::currentUser()) {
            $this->logOut();
        }

        $inquiry = Injector::inst()->get('CatalogProductInquiry');
        $this->assertFalse($inquiry->canDelete());

        $this->logInWithPermission('CatalogProductInquiry_delete');
        $this->assertTrue($inquiry->canDelete());

        $this->logOut();
    }

}