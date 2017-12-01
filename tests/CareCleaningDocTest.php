<?php

namespace Dynamic\ProductCatalog\Test;

use Dynamic\ProductCatalog\Docs\CareCleaningDoc;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Security\Member;

class CareCleaningDocTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'fixtures.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = new CareCleaningDoc();
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
        $this->assertNull($fields->dataFieldByName('Products'));

        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
        //$this->assertNotNull($fields->dataFieldByName('Products'));
    }

    public function testCanView()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canView($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertTrue($object->canView($member));
    }

    public function testCanEdit()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canEdit($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canEdit($member));
    }

    public function testCanDelete()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canDelete($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canDelete($member));
    }

    public function testCanCreate()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canCreate($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canCreate($member));
    }

    public function testProvidePermissions()
    {
        $object = $this->objFromFixture(CareCleaningDoc::class, 'one');
        $expected = array(
            'Care_EDIT' => 'Edit Care and Cleaning Docs',
            'Care_DELETE' => 'Delete Care and Cleaning Docs',
            'Care_CREATE' => 'Create Care and Cleaning Docs',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
