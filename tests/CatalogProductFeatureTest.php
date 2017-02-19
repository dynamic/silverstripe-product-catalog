<?php

class CatalogProductFeatureTest extends SapphireTest
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
        $object = new CatalogProductFeature();
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }
}
