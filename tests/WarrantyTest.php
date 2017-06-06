<?php

class WarrantyTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = new Warranty();
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
        $this->assertNull($fields->dataFieldByName('Products'));

        $object = $this->objFromFixture('Warranty', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
        $this->assertNotNull($fields->dataFieldByName('Products'));
    }

    public function testCanView()
    {
        $object = $this->objFromFixture('Warranty', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canView($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertTrue($object->canView($member));
    }

    public function testCanEdit()
    {
        $object = $this->objFromFixture('Warranty', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canEdit($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canEdit($member));
    }

    public function testCanDelete()
    {
        $object = $this->objFromFixture('Warranty', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canDelete($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canDelete($member));
    }

    public function testCanCreate()
    {
        $object = $this->objFromFixture('Warranty', 'one');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canCreate($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canCreate($member));
    }

    public function testProvidePermissions()
    {
        $object = $this->objFromFixture('Warranty', 'one');
        $expected = array(
            'Warranty_EDIT' => 'Edit Warranty Docs',
            'Warranty_DELETE' => 'Delete Warranty Docs',
            'Warranty_CREATE' => 'Create Warranty Docs',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
