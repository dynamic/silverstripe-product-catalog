<?php

class CatalogProductTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    /**
     *
     */
    public function testCategoryList()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');
        $expected = $this->objFromFixture('CatalogCategory', 'default')->Title;
        $this->assertEquals($expected, $object->CategoryList());
    }

    /**
     *
     */
    public function testGetImage()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');
        $this->assertEquals($object->getImage(), $object->Slides()->first());
    }

    public function testGetCMSFields()
    {
        $object = new CatalogProduct();
        $fieldset = $object->getCMSFields();
        $this->assertTrue(is_a($fieldset, 'FieldList'));
        //$this->assertNull($fieldset->dataFieldByName('TechDocs'));

        $object = $this->objFromFixture('CatalogProduct', 'one');
        $fieldset = $object->getCMSFields();
        $this->assertTrue(is_a($fieldset, 'FieldList'));
    }

    public function testGetPrimaryCategory()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');
        $this->assertEquals($object->getPrimaryCategory(), $object->Categories()->sort('SortOrder')->first());
    }

    public function testGetDefaultSearchContext()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');
        $this->assertInstanceOf('SearchContext', $object->getDefaultSearchContext());
    }

    public function testCanView()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canView($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertTrue($object->canView($member));
    }

    public function testCanEdit()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canEdit($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canEdit($member));
    }

    public function testCanDelete()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canDelete($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canDelete($member));
    }

    public function testCanCreate()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canCreate($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canCreate($member));
    }

    public function testProvidePermissions()
    {
        $object = $this->objFromFixture('CatalogProduct', 'one');
        $expected = array(
            'Product_EDIT' => 'Edit a Product',
            'Product_DELETE' => 'Delete a Product',
            'Product_CREATE' => 'Create a Product',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}