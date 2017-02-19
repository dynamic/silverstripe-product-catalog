<?php

class SpecSheet extends ProductDoc
{
    /**
     * @var string
     */
    private static $singular_name = 'Spec Sheet';

    /**
     * @var string
     */
    private static $plural_name = 'Spec Sheets';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->dataFieldByName('Download')->setFolderName('Uploads/Products/SpecSheets');

        return $fields;
    }
}
