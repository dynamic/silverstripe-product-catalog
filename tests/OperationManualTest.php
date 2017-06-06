<?php

class OperationManualTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    public function testGetCMSFields()
    {
        $object = singleton('OperationManual');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);

        $object = $this->objFromFixture('OperationManual', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }

    public function testCanView()
    {
        $object = $this->objFromFixture('OperationManual', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canView($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertTrue($object->canView($member));
    }

    public function testCanEdit()
    {
        $object = $this->objFromFixture('OperationManual', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canEdit($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canEdit($member));
    }

    public function testCanDelete()
    {
        $object = $this->objFromFixture('OperationManual', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canDelete($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canDelete($member));
    }

    public function testCanCreate()
    {
        $object = $this->objFromFixture('OperationManual', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canCreate($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canCreate($member));
    }

    public function testProvidePermissions()
    {
        $object = $this->objFromFixture('OperationManual', 'one');
        $expected = array(
            'Operation_EDIT' => 'Edit Operation Manuals',
            'Operation_DELETE' => 'Delete Operation Manuals',
            'Operation_CREATE' => 'Create Operation Manuals',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
