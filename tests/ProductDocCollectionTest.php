<?php

namespace Dynamic\ProductCatalog\Test;

use Dynamic\ProductCatalog\Page\ProductDocCollection;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class ProductDocCollectionTest extends SapphireTest
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
        $object = singleton(ProductDocCollection::class);
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
        $this->assertNotNull($fields->dataFieldByName('ManagedClass'));
    }
}