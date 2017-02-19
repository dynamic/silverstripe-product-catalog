<?php

class Warranty extends ProductDoc
{
    /**
     * @var string
     */
    private static $singular_name = 'Warranty';

    /**
     * @var string
     */
    private static $plural_name = 'Warranties';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->dataFieldByName('Download')->setFolderName('Uploads/Products/Warranties');

        return $fields;
    }
}
