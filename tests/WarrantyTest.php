<?php

class WarrantyTest extends SapphireTest
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
        $object = new Warranty();
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
        $this->assertNull($fields->dataFieldByName('Products'));

        $object = $this->objFromFixture('Warranty', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
        $this->assertNotNull($fields->dataFieldByName('Products'));
    }

    /**
     *
     */
    public function testGetProductsCt()
    {
        $object = $this->objFromFixture('Warranty', 'one');
        $this->assertEquals($object->getProductsCt(), 1);
    }
}
