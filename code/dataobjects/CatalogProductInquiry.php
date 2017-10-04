<?php

/**
 * Class CatalogProductInquiry
 */
class CatalogProductInquiry extends DataObject implements PermissionProvider
{

    /**
     * @var string
     */
    private static $singular_name = 'Product Inquiry';

    /**
     * @var string
     */
    private static $plural_name = 'Product Inquiries';

    /**
     * @var array
     */
    private static $db = [
        'Name' => 'Varchar(255)',
        'Phone' => 'Varchar',
        'Email' => 'Varchar(255)',
        'Comment' => 'Text',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Product' => 'CatalogProduct',
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Created.Nice' => 'Inquiry Date',
        'Name' => 'Name',
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->transform(new ReadonlyTransformation());

        return $fields;
    }

    /**
     * @param null $params
     *
     * @return FieldList
     */
    public function getFrontEndFields($params = null)
    {
        $fields = parent::getFrontEndFields($params);

        $value = (Controller::curr()->hasMethod('getProduct'))
            ? Controller::curr()->getProduct()->ID
            : 0;

        $fields->replaceField(
            'ProductID',
            HiddenField::create('ProductID')
                ->setValue($value)
        );

        return $fields;
    }

    /**
     * @return FieldList
     */
    public function getFrontEndActions()
    {
        $actions = FieldList::create(
            FormAction::create('doProductInquiry')
                ->setTitle('Send Inquiry')
        );

        $this->extend('updateFrontEndActions', $actions);

        return $actions;
    }

    public function getFrontEndRequiredFields()
    {
        $required = RequiredFields::create(
            'Name',
            'Email'
        );

        $this->extend('updateFrontEndRequiredFields', $required);

        return $required;
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return [
            'CatalogProductInquiry_delete' => [
                'name' => 'Delete a Product Inquiry',
                'category' => 'Product InquiryPermissions',
            ],
            'CatalogProductInquiry_view' => [
                'name' => 'View a Product Inquiry',
                'category' => 'Product InquiryPermissions',
            ],
        ];
    }

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
    public function canEdit($member = null)
    {
        return false;
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        $member = $member === null ? Member::currentUser() : $member;

        return Permission::checkMember($member, 'CatalogProductInquiry_delete');
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canView($member = null)
    {
        $member = $member === null ? Member::currentUser() : $member;

        return Permission::checkMember($member, 'CatalogProductInquiry_view');
    }

}