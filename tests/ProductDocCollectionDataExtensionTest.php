<?php

class ProductDocCollectionDataExtensionTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    /**
     *
     */
    public function testUpdateCollectionObject()
    {
        $object = $this->objFromFixture('ProductDocCollection', 'default');
        $controller = ProductDocCollection_Controller::create($object);
        $this->assertEquals($controller->getCollectionObject(), 'SpecSheet');
    }

    /**
     *
     */
    public function testUpdateCollectionForm()
    {
        $object = $this->objFromFixture('ProductDocCollection', 'default');
        $controller = ProductDocCollection_Controller::create($object);
        $form = $controller->CollectionSearchForm();
        $this->assertNotNull($form->Fields()->dataFieldByName('CategoryID'));
        $this->assertNull($form->Fields()->dataFieldByName('Title'));
    }

    /**
     *
     */
    public function testUpdateCollectionItems()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}