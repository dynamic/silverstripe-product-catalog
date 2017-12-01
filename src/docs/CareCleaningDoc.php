<?php

namespace Dynamic\ProductCatalog\Docs;

use SilverStripe\Forms\FieldList;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

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
     * @var string
     */
    private static $table_name = 'CareCleaningDoc';

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
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('Care_CREATE', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        return Permission::check('Care_EDIT', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('Care_DELETE', 'any', $member);
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
