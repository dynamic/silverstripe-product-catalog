<?php

class CatalogProductFeature extends DataObject
{
    /**
     * @var string
     */
    private static $singular_name = 'Product Feature';

    /**
     * @var string
     */
    private static $plural_name = 'Product Features';

    /**
     * @var array
     */
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'SortOrder' => 'Int',
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'Product' => 'CatalogProduct',
        'ContentLink' => 'Link',
        'Image' => 'Image',
    );

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(array(
            'ProductID',
            'SortOrder',
            'Link',
        ));

        $fields->insertBefore(LinkField::create('ContentLinkID', 'Link'), 'Content');

        // override folder name
        $fields->dataFieldByName('Image')->setFolderName('Uploads/ProductFeatures');

        return $fields;
    }
}
