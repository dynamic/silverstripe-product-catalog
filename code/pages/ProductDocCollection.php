<?php

class ProductDocCollection extends Page
{
    /**
     * @var array
     */
    private static $db = array(
        'ManagedClass' => 'Varchar(255)',
    );

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($relations = ClassInfo::subclassesFor('ProductDoc')) {
            unset($relations['ProductDoc']);
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

class ProductDocCollection_Controller extends Page_Controller
{

}