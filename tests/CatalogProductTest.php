<?php

namespace Dynamic\ProductCatalog\Test;

use Dynamic\ProductCatalog\ORM\CatalogProduct;
use Dynamic\ProductCatalog\Page\CatalogCategory;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\Search\SearchContext;
use SilverStripe\Security\Member;

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
        $object = $this->objFromFixture(CatalogProduct::class, 'one');
        $expected = $this->objFromFixture(CatalogCategory::class, 'default')->Title;
        $this->assertEquals($expected, $object->CategoryList());
    }

    /**
     *
     */
    public function testGetImage()
    {
        $object = $this->objFromFixture(CatalogProduct::class, 'one');
        $this->assertEquals($object->getImage(), $object->Slides()->first());
    }

    public function testGetCMSFields()
    {
        $object = new CatalogProduct();
        $fieldset = $object->getCMSFields();
        $this->assertTrue(is_a($fieldset, FieldList::class));
        //$this->assertNull($fieldset->dataFieldByName('TechDocs'));

        $object = $this->objFromFixture(CatalogProduct::class, 'one');
        $fieldset = $object->getCMSFields();
        $this->assertTrue(is_a($fieldset, FieldList::class));
    }

    public function testGetPrimaryCategory()
    {
        $object = $this->objFromFixture(CatalogProduct::class, 'one');
        $this->assertEquals($object->getPrimaryCategory(), $object->Categories()->sort('SortOrder')->first());
    }

    public function testGetDefaultSearchContext()
    {
        $object = $this->objFromFixture(CatalogProduct::class, 'one');
        $this->assertInstanceOf(SearchContext::class, $object->getDefaultSearchContext());
    }

    public function testCanView()
    {
        $object = $this->objFromFixture(CatalogProduct::class, 'one');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canView($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertTrue($object->canView($member));
    }

    public function testCanEdit()
    {
        $object = $this->objFromFixture(CatalogProduct::class, 'one');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canEdit($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canEdit($member));
    }

    public function testCanDelete()
    {
        $object = $this->objFromFixture(CatalogProduct::class, 'one');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canDelete($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canDelete($member));
    }

    public function testCanCreate()
    {
        $object = $this->objFromFixture(CatalogProduct::class, 'one');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canCreate($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canCreate($member));
    }

    public function testProvidePermissions()
    {
        $object = $this->objFromFixture(CatalogProduct::class, 'one');
        $expected = array(
            'Product_EDIT' => 'Edit a Product',
            'Product_DELETE' => 'Delete a Product',
            'Product_CREATE' => 'Create a Product',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
