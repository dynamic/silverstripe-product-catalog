<?php

class Warranty extends ProductDoc implements PermissionProvider
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

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Warranty_EDIT' => 'Edit Warranty Docs',
            'Warranty_DELETE' => 'Delete Warranty Docs',
            'Warranty_CREATE' => 'Create Warranty Docs',
        );
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('Warranty_CREATE', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canEdit($member = null)
    {
        return Permission::check('Warranty_EDIT', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('Warranty_DELETE', 'any', $member);
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
