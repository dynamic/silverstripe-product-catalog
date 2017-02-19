<?php

class ProductDoc extends DataObject
{
    /**
     * @var array
     */
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'FileLink' => 'Varchar(255)',
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'Image' => 'Image',
        'Download' => 'File',
    );

    /**
     * @var array
     */
    private static $summary_fields = array(
        'Name' => 'Name',
        'Title' => 'Title',
    );

    /**
     * @var array
     */
    private static $searchable_fields = array(
        'Name',
        'Title',
    );

    /**
     * @var string
     */
    private static $default_sort = 'Title';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $file = UploadField::create('Download')
            ->setFolderName('Uploads/FileDownloads')
            ->setConfig('allowedMaxFileNumber', 1)
            ->setAllowedFileCategories('doc')
            ->setAllowedMaxFileNumber(1);

        $fields->addFieldsToTab('Root.Download', array(
            $file,
            TextField::create('FileLink')
                ->setDescription('URL of external file. will display on page if no Download is specified above.')
                ->setAttribute('placeholder', 'http://'),
        ));

        $ImageField = UploadField::create('Image', 'Image')
            ->setFolderName('Uploads/ProductDocs/Images')
            ->setConfig('allowedMaxFileNumber', 1)
            ->setAllowedFileCategories('image')
            ->setAllowedMaxFileNumber(1)
            ->setDescription('Preview image of file')
        ;

        $fields->insertBefore($ImageField, 'Content');

        return $fields;
    }

    /**
     * if SetClass dropdown is set, create a new instance of the new class.
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();
        if (isset($_REQUEST['SetClass'])) {
            $object = $this->newClassInstance($_REQUEST['SetClass']);
            $object->write();
        }
    }
}