<?php

class CareCleaningDoc extends ProductDoc
{
    /**
     * @var string
     */
    private static $singular_name = 'Care & Cleaning Doc';

    /**
     * @var string
     */
    private static $plural_name = 'Care & Cleaning Docs';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->dataFieldByName('Download')->setFolderName('Uploads/Products/CareCleaningDocs');

        return $fields;
    }
}
