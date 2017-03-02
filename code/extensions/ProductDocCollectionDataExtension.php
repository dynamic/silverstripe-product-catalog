<?php

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
            SelectboxDropdownField::create('CategoryID', 'Category', CatalogCategory::get()->map())
                ->setEmptyString('All categories'),
            'Products__ID'
        );

        $fields->removeByName([
            'Name',
            'Title',
            'Products__ID',
        ]);
    }

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