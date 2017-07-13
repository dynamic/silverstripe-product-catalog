<?php

namespace Dynamic\ProductCatalog\Page;

use Dynamic\ProductCatalog\Docs\ProductDoc;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\DropdownField;

class ProductDocCollection extends \Page
{
    /**
     * @var array
     */
    private static $db = array(
        'ManagedClass' => 'Varchar(255)',
    );

    /**
     * @var string
     */
    private static $table_name = 'ProductDocCollection';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($relations = ClassInfo::subclassesFor(ProductDoc::class)) {
            unset($relations[ProductDoc::class]);
            foreach ($relations as $key => $value) {
                $relations[$key] = singleton($value)->i18n_singular_name();
            }

            $fields->addFieldToTab(
                'Root.Main',
                DropdownField::create('ManagedClass', 'Files to display', $relations)
                    ->setEmptyString(''),
                'Content'
            );
        }

        return $fields;
    }
}