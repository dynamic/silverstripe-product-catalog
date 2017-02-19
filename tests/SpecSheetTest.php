<?php

class SpecSheetTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    public function testGetCMSFields()
    {
        $object = new SpecSheet();
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);

        $object = $this->objFromFixture('SpecSheet', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }

    /**
     *
     */
    public function testGetProductsCt()
    {
        $object = $this->objFromFixture('SpecSheet', 'one');
        $this->assertEquals($object->getProductsCt(), 1);
    }
}
