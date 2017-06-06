<?php

class SpecSheetTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    public function testGetCMSFields()
    {
        $object = new SpecSheet();
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);

        $object = $this->objFromFixture('SpecSheet', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }

    public function testCanView()
    {
        $object = $this->objFromFixture('SpecSheet', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canView($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertTrue($object->canView($member));
    }

    public function testCanEdit()
    {
        $object = $this->objFromFixture('SpecSheet', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canEdit($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canEdit($member));
    }

    public function testCanDelete()
    {
        $object = $this->objFromFixture('SpecSheet', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canDelete($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canDelete($member));
    }

    public function testCanCreate()
    {
        $object = $this->objFromFixture('SpecSheet', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canCreate($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canCreate($member));
    }

    public function testProvidePermissions()
    {
        $object = $this->objFromFixture('SpecSheet', 'one');
        $expected = array(
            'Spec_EDIT' => 'Edit Spec Sheets',
            'Spec_DELETE' => 'Delete Spec Sheets',
            'Spec_CREATE' => 'Create Spec Sheets',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
