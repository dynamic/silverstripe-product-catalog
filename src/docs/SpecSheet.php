<?php

namespace Dynamic\ProductCatalog\docs;

use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class SpecSheet extends ProductDoc implements PermissionProvider
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
     * @var string
     */
    private static $table_name = 'SpecSheet';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->dataFieldByName('Download')->setFolderName('Uploads/Products/SpecSheets');

        return $fields;
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Spec_EDIT' => 'Edit Spec Sheets',
            'Spec_DELETE' => 'Delete Spec Sheets',
            'Spec_CREATE' => 'Create Spec Sheets',
        );
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('Spec_CREATE', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        return Permission::check('Spec_EDIT', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('Spec_DELETE', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool
     */
    public function canView($member = null, $context = [])
    {
        return true;
    }
}
