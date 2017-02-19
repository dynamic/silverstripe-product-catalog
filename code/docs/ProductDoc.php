<?php

class ProductDoc extends FileObject
{
    /**
     * @var array
     */
    private static $summary_fields = array(
        'Name' => 'Name',
        'Title' => 'Title',
    );

    /**
     * @var array
     */
    private static $searchable_fields = array(
        'Name',
        'Title',
    );

    private static $default_sort = 'Title';

    /**
     * if SetClass dropdown is set, create a new instance of the new class.
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();
        if (isset($_REQUEST['SetClass'])) {
            $object = $this->newClassInstance($_REQUEST['SetClass']);
            $object->write();
        }
    }
}