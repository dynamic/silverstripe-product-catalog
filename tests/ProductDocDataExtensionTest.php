<?php

class ProductDocDataExtensionTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    /**
     *
     */
    public function testGetProductsCt()
    {
        $object = $this->objFromFixture('CareCleaningDoc', 'one');
        $this->assertEquals($object->getProductsCt(), 1);
    }

    /**
     *
     */
    public function testGetProductsList()
    {
        $object = $this->objFromFixture('CareCleaningDoc', 'one');
        $this->assertEquals($object->getProductsList(), 'Product One');
    }

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture('CareCleaningDoc', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }

    /**
     *
     */
    public function testLink()
    {
        $object = $this->objFromFixture('CareCleaningDoc', 'one');
        $this->assertEquals($object->Link(), $object->Download()->URL);
    }

    /**
     *
     */
    public function testGetIsProductDoc()
    {
        $object = $this->objFromFixture('CareCleaningDoc', 'one');
        $this->assertEquals($object->getIsProductDoc(), true);
    }
}
