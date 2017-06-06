<?php

class CareCleaningDoc extends ProductDoc implements PermissionProvider
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

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Care_EDIT' => 'Edit Care and Cleaning Docs',
            'Care_DELETE' => 'Delete Care and Cleaning Docs',
            'Care_CREATE' => 'Create Care and Cleaning Docs',
        );
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('Care_CREATE', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canEdit($member = null)
    {
        return Permission::check('Care_EDIT', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('Care_DELETE', 'any', $member);
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
}
