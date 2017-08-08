<?php

/**
 * Class CatalogProductInquiry
 */
class CatalogProductInquiry extends DataObject
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

        $fields->replaceField(
            'ProductID',
            HiddenField::create('ProductID')
                ->setValue(Controller::curr()->getProduct()->ID)
        );

        return $fields;
    }

    /**
     * @param $params
     *
     * @return bool|int
     */
    protected function getProductIDForInquiry($params)
    {
        if (isset($params['ProductID'])) {
            $product = CatalogProduct::get()->byID($params['ProductID']);
        } else {
            $product = CatalogProduct::get()->byURLSegment(Controller::curr()->getRequest()->param('ID'));
        }

        return (isset($product) && $product->ID) ? $product->ID : false;
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

}