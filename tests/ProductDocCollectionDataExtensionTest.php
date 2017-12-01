<?php

namespace Dynamic\ProductCatalog\Test;

use Dynamic\ProductCatalog\Page\ProductDocCollectionController;
use Dynamic\ProductCatalog\Docs\SpecSheet;
use Dynamic\ProductCatalog\Page\ProductDocCollection;
use SilverStripe\Dev\SapphireTest;

class ProductDocCollectionDataExtensionTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'fixtures.yml';

    /**
     *
     */
    public function testUpdateCollectionObject()
    {
        $object = $this->objFromFixture(ProductDocCollection::class, 'default');
        $controller = ProductDocCollectionController::create($object);
        $this->assertEquals($controller->getCollectionObject(), SpecSheet::class);
    }

    /**
     *
     */
    public function testUpdateCollectionForm()
    {
        $object = $this->objFromFixture(ProductDocCollection::class, 'default');
        $controller = ProductDocCollectionController::create($object);
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
