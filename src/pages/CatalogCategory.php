<?php

namespace Dynamic\ProductCatalog\Page;

use Dynamic\ProductCatalog\ORM\CatalogProduct;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldPageCount;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class CatalogCategory extends \Page
{
    /**
     * @var array
     */
    private static $belongs_many_many = array(
        'Products' => CatalogProduct::class,
    );

    /**
     * @var string
     */
    private static $table_name = 'CatalogCategory';

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($this->ID) {
            // Products
            $config = GridFieldConfig_RelationEditor::create();
            $config->addComponent(new GridFieldOrderableRows('SortOrder'));
            $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
            $config->addComponent(new GridFieldAddExistingSearchButton());
            $config->removeComponentsByType(GridFieldPaginator::class);
            $config->removeComponentsByType(GridFieldPageCount::class);

            $products = $this->Products()->sort('SortOrder');
            $productsField = GridField::create('Products', 'Products', $products, $config);

            $fields->addFieldsToTab('Root.Products', array(
                $productsField,
            ));
        }

        return $fields;
    }

    /**
     * @return DataList
     */
    public function getProductList()
    {
        return $this->Products()->sort('SortOrder');
    }
}