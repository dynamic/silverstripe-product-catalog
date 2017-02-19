<?php

class OperationManualTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    public function testGetCMSFields()
    {
        $object = singleton('OperationManual');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);

        $object = $this->objFromFixture('OperationManual', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }

    /**
     *
     */
    public function testGetProductsCt()
    {
        $object = $this->objFromFixture('OperationManual', 'one');
        $this->assertEquals($object->getProductsCt(), 1);
    }
}
