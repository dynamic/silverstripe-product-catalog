<?php

class CatalogProduct extends DataObject implements PermissionProvider, Dynamic\ViewableDataObject\VDOInterfaces\ViewableDataObjectInterface
{
    /**
     * @var string
     */
    private static $singular_name = 'Product';

    /**
     * @var string
     */
    private static $plural_name = 'Products';

    /**
     * @var array
     */
    private static $db = array(
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'QuickFeatures' => 'HTMLText',
        'Dimensions' => 'Varchar(255)',
        'SKU' => 'Varchar(50)',
    );

    /**
     * @var array
     */
    private static $has_many = array(
        'Features' => 'CatalogProductFeature',
    );

    /**
     * @var array
     */
    private static $many_many = array(
        'Categories' => 'CatalogCategory',
        'CareCleaningDocs' => 'CareCleaningDoc',
        'OperationManuals' => 'OperationManual',
        'SpecSheets' => 'SpecSheet',
        'Warranties' => 'Warranty',
    );

    /**
     * @var array
     */
    private static $many_many_extraFields = array(
        'Categories' => array(
            'SortOrder' => 'Int',
        ),
        'CareCleaningDocs' => array(
            'Sort' => 'Int',
        ),
        'OperationManuals' => array(
            'Sort' => 'Int',
        ),
        'SpecSheets' => array(
            'Sort' => 'Int',
        ),
        'Warranties' => array(
            'Sort' => 'Int',
        ),
    );

    /**
     * @var array
     */
    private static $summary_fields = array(
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
        'Type' => 'Type',
        'CategoryList' => 'Categories',
    );

    /**
     * @var array
     */
    private static $searchable_fields = array(
        'Title' => array(
            'title' => 'Product Name',
        ),
        'Categories.ID' => array(
            'title' => 'Category',
        ),
    );

    /**
     * @var array
     */
    private static $extensions = [
        'VersionedDataObject',
    ];

    /**
     * @param bool $includerelations
     * @return array|string
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);

        $labels['Title'] = 'Product Name';
        $labels['Categories.ID'] = 'Category';

        return $labels;
    }

    /**
     * @return string
     */
    public function CategoryList()
    {
        $list = '';

        if ($this->Categories()) {
            $i = 0;
            foreach ($this->Categories()->sort('SortOrder') as $category) {
                $list .= $category->Title;
                if(++$i !== $this->Categories()->Count()) {
                    $list .= ", ";
                }
            }
        }
        return $list;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        if ($this->Slides()->exists()) {
            return $this->Slides()->first();
        }
    }

    /**
     * @return mixed
     */
    public function Image()
    {
        return $this->getImage();
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $remove = [
            'Categories',
            'CareCleaningDocs',
            'OperationManuals',
            'SpecSheets',
            'Warranties',
            'DisabledBlocks',
        ];

        if (!$this->ID) {
            $remove[] = 'Blocks';
        }

        $fields->removeByName($remove);

        $fields->insertBefore(
            $fields->dataFieldByName('SKU'),
            'Content'
        );

        $fields->addFieldsToTab('Root.Info', array(
            TextField::create('Dimensions'),
            HTMLEditorField::create('QuickFeatures'),
        ));

        if ($this->ID) {
            // Categories
            $config = GridFieldConfig_RelationEditor::create();
            $config->addComponent(new GridFieldOrderableRows('SortOrder'));
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingSearchButton());
            $config->removeComponentsByType('GridFieldAddNewBUtton');
            $categories = $this->Categories()->sort('SortOrder');
            $categoryField = GridField::create('Categories', 'Categories', $categories, $config);

            $fields->addFieldsToTab('Root.Categories.Categories', array(
                $categoryField,
            ));

            // Features
            $config = GridFieldConfig_RecordEditor::create();
            $config->addComponent(new GridFieldOrderableRows('SortOrder'));
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->removeComponentsByType('GridFieldDeleteAction');
            $config->addComponent(new GridFieldDeleteAction(false));
            $featuresField = GridField::create('Features', 'Features', $this->Features()->sort('SortOrder'), $config);
            $fields->addFieldsToTab('Root.Features', array(
                $featuresField,
            ));

            // Care and Cleaning
            $config = GridFieldConfig_RecordEditor::create();
            $config->addComponent(new GridFieldOrderableRows('Sort'));
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingSearchButton());
            $operation = GridField::create('CareCleaningDocs', 'Care and Cleaning', $this->CareCleaningDocs()->sort('Sort'), $config);
            $fields->addFieldsToTab('Root.Files.Care', array(
                $operation,
            ));

            // Operation Manuals
            $config = GridFieldConfig_RecordEditor::create();
            $config->addComponent(new GridFieldOrderableRows('Sort'));
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingSearchButton());
            $operation = GridField::create('OperationManuals', 'Operation Manuals', $this->OperationManuals()->sort('Sort'), $config);
            $fields->addFieldsToTab('Root.Files.Operation', array(
                $operation,
            ));

            // Spec Sheets
            $config = GridFieldConfig_RecordEditor::create();
            $config->addComponent(new GridFieldOrderableRows('Sort'));
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingSearchButton());
            $specsheets = GridField::create('SpecSheets', 'Spec Sheets', $this->SpecSheets()->sort('Sort'), $config);
            $fields->addFieldsToTab('Root.Files.SpecSheets', array(
                $specsheets,
            ));

            // Warranties
            $config = GridFieldConfig_RecordEditor::create();
            $config->addComponent(new GridFieldOrderableRows('Sort'));
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingSearchButton());
            $warranties = GridField::create('Warranties', 'Warranties', $this->Warranties()->sort('Sort'), $config);
            $fields->addFieldsToTab('Root.Files.Warranty', array(
                $warranties,
            ));
        }

        return $fields;
    }

    /**
     * @return CatalogCategory
     */
    public function getPrimaryCategory()
    {
        if ($this->Categories()->exists()) {
            $category = $this->Categories()->sort('SortOrder')->first();
        } else {
            $category = CatalogCategory::get()->first();
        }
        return $category;
    }

    /**
     * @return string
     */
    public function getParentPage()
    {
        return $this->getPrimaryCategory();
    }

    /**
     * @return string
     */
    public function getViewAction()
    {
        return 'view';
    }

    /**
     * needed for Blocks
     *
     * @return DataList
     */
    public function getAncestors()
    {
        return CatalogCategory::get();
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Product_EDIT' => 'Edit a Product',
            'Product_DELETE' => 'Delete a Product',
            'Product_CREATE' => 'Create a Product',
        );
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canEdit($member = null)
    {
        return Permission::check('Product_EDIT', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('Product_DELETE', 'any', $member);
    }

    /**
     * @param null $member
     *
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('Product_CREATE', 'any', $member);
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