<?php

namespace Dynamic\ProductCatalog\Test;

use Dynamic\ProductCatalog\Docs\CareCleaningDoc;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class ProductDocDataExtensionTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'fixtures.yml';

    /**
     *
     */
    public function testGetProductsCt()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');
        $this->assertEquals($object->getProductsCt(), 1);
    }

    /**
     *
     */
    public function testGetProductsList()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');
        $this->assertEquals($object->getProductsList(), 'Product One');
    }

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }

    /**
     *
     */
    public function testLink()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');
        $this->assertEquals($object->Link(), $object->Download()->URL);
    }

    /**
     *
     */
    public function testGetIsProductDoc()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');
        $this->assertEquals($object->getIsProductDoc(), true);
    }
}
