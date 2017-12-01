<?php

namespace Dynamic\ProductCatalog\ORM;

use Dynamic\ProductCatalog\Page\CatalogCategory;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;

class ProductDocCollectionDataExtension extends DataExtension
{
    /**
     * @param $object
     */
    public function updateCollectionObject(&$object)
    {
        if ($class = $this->owner->data()->ManagedClass) {
            $object = (string) $class;
        }
    }

    /**
     * @param $form
     */
    public function updateCollectionForm(&$form)
    {
        $fields = $form->Fields();

        $fields->insertAfter(
            DropdownField::create('CategoryID', 'Category', CatalogCategory::get()->map())
                ->setEmptyString('All categories'),
            'Title'
        );

        $fields->insertAfter(
            DropdownField::create('Products__ID', 'Product', CatalogProduct::get()->map())
                ->setEmptyString('All products'),
            'CategoryID'
        );

        $fields->removeByName([
            'Name',
            'Title',
        ]);
    }

    /**
     * @param $collection
     * @param $searchCriteria
     */
    public function updateCollectionItems(&$collection, &$searchCriteria)
    {
        $class = $this->owner->data()->ManagedClass;

        if (isset($searchCriteria['CategoryID']) && $searchCriteria['CategoryID'] != '') {
            $category = CatalogCategory::get()->byID($searchCriteria['CategoryID']);
            $products = $category->Products();
            $docs = new ArrayList();

            foreach($products as $product) {
                $records = $class::get()->filter(['Products.ID' => $product->ID]);
                foreach ($records as $record) {
                    $docs->push($record);
                }
            }

            $collection = $docs;
        }
    }
}