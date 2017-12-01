<?php

namespace Dynamic\ProductCatalog\Docs;

use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class OperationManual extends ProductDoc implements PermissionProvider
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
     * @var string
     */
    private static $table_name = 'OperationManual';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->dataFieldByName('Download')->setFolderName('Uploads/Products/OperationManuals');

        return $fields;
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Operation_EDIT' => 'Edit Operation Manuals',
            'Operation_DELETE' => 'Delete Operation Manuals',
            'Operation_CREATE' => 'Create Operation Manuals',
        );
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('Operation_CREATE', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        return Permission::check('Operation_EDIT', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('Operation_DELETE', 'any', $member);
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
