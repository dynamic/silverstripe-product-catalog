<?php

class OperationManual extends ProductDoc
{
    /**
     * @var string
     */
    private static $singular_name = 'Operation Manual';

    /**
     * @var string
     */
    private static $plural_name = 'OperationManuals';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->dataFieldByName('Download')->setFolderName('Uploads/Products/OperationManuals');

        return $fields;
    }
}
