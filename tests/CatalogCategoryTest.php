<?php

class CatalogCategoryTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

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
}