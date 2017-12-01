<?php

namespace Dynamic\ProductCatalog\Test;

use Dynamic\ProductCatalog\Page\CatalogCategory;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataList;

class CatalogCategoryTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'fixtures.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture(CatalogCategory::class, 'default');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }

    /**
     *
     */
    public function testGetProductList()
    {
        $object = $this->objFromFixture(CatalogCategory::class, 'default');
        $this->assertInstanceOf(DataList::class, $object->getProductList());
    }
}