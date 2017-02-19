<?php

class ContactFormSubmission extends DataObject
{
    /**
     * @var array
     */
    private static $db = array(
        'Name' => 'Varchar(100)',
        'Email' => 'Varchar(255)',
        'Phone' => 'Varchar(20)',
        'Comment' => 'Text',
        'Created' => 'SS_DateTime',
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'Product' => 'ChardProduct',
    );

    /**
     * @var string
     */
    private static $default_sort = 'Created DESC';

    /**
     * @var array
     */
    private static $summary_fields = array(
        'Name' => 'Name',
        'Email' => 'Email',
        'Phone' => 'Phone',
        'Product.Title' => 'Product',
        'Created.NiceUS' => 'Date',
    );

    /**
     * @var array
     */
    private static $searchable_fields = array(
        'Name',
        'Email',
        'Phone',
        'Comment',
        'Product.ID' => array(
            'title' => 'Product',
        ),
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(array(
            'ProductID'
        ));

        $fields->addFieldToTab(
            'Root.Main',
            DropdownField::create('ProductID', 'Product', ChardProduct::get()->map()),
            'Created'
        );

        return $fields;
    }

    /**
     * Set permissions, allow all users to access by default.
     * Override in descendant classes, or use PermissionProvider.
     */

    /**
     * @param null $member
     *
     * @return bool
     */
    public function canCreate($member = null)
    {
        return true;
    }

    /**
     * @param null $member
     *
     * @return bool
     */
    public function canView($member = null)
    {
        return true;
    }

    /**
     * @param null $member
     *
     * @return bool
     */
    public function canEdit($member = null)
    {
        return false;
    }

    /**
     * @param null $member
     *
     * @return bool
     */
    public function canDelete($member = null)
    {
        return true;
    }
}