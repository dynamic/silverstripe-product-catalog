<?php

class CatalogCategoryTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    /**
     * @var array
     */
    protected $extraDataObjects = [
        'TestCatalogCategory',
    ];

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture('CatalogCategory', 'default');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }

    /**
     *
     */
    public function testGetProductList()
    {
        $object = $this->objFromFixture('CatalogCategory', 'default');
        $this->assertInstanceOf('DataList', $object->getProductList());
    }

    /**
     *
     */
    public function testGetRelatedCategories()
    {
        $productCategoryOne = $this->objFromFixture('CatalogCategory', 'default');
        $this->assertEquals(2, $productCategoryOne->getRelatedCategories()->count());
        $productCategoryTwo = $this->objFromFixture('CatalogCategory', 'two');
        $this->assertEquals(1, $productCategoryTwo->getRelatedCategories()->count());
        $productCategoryThree = $this->objFromFixture('CatalogCategory', 'three');
        $this->assertEquals(1, $productCategoryThree->getRelatedCategories()->count());
        $productCategoryFour = $this->objFromFixture('CatalogCategory', 'four');
        $this->assertEquals(0, $productCategoryFour->getRelatedCategories()->count());
    }

    /**
     *
     */
    public function testGetSiblingCategories()
    {
        $category = $this->objFromFixture('CatalogCategory', 'two');
        $this->assertEquals(2, $category->getSiblingCategories()->count());
        $this->assertNull($category->getSiblingCategories()->find('ID', $category->ID));
    }

}