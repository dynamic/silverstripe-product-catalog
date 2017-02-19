<?php

class ProductDocTest extends SapphireTest
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
        $object = singleton('ProductDoc');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }


}