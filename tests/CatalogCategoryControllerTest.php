<?php

/**
 * Class CatalogCategoryControllerTest
 */
class CatalogCategoryControllerTest extends FunctionalTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'product-catalog/tests/fixtures.yml';

    protected static $use_draft_site = true;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        // Suppress themes
        //Config::inst()->remove('SSViewer', 'theme');
    }//*/

    /**
     * Tests view()
     */
    public function testView()
    {
        $controller = CatalogCategory_Controller::create($this->objFromFixture(CatalogCategory::class, 'default'));
        $response = $this->get($controller->Link('view'));
        $this->assertEquals(404, $response->getStatusCode());

        $product = $this->objFromFixture(CatalogProduct::class, 'one');
        $controller->setProduct($product);

        $response = $this->get(Controller::join_links($controller->Link('view'), $product->URLSegment));
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     *
     */
    public function testProductInquiryForm()
    {
        $controller = CatalogCategory_Controller::create($this->objFromFixture(CatalogCategory::class, 'default'));
        $form = $controller->ProductInquiryForm();
        $this->assertInstanceOf(CatalogProductInquiryForm::class, $form);
    }

    public function testDoProductInquiry()
    {
        $controller = CatalogCategory_Controller::create($this->objFromFixture(CatalogCategory::class, 'default'));
        $product = $this->objFromFixture(CatalogProduct::class, 'one');

        $controller->setProduct($product);

        $response = $this->get(Controller::join_links($controller->Link('view'), $product->URLSegment));
        $this->assertEquals(200, $response->getStatusCode());

        $data = [
            'Name' => 'Foo',
            'Phone' => '555-555-5555',
            'Email' => 'foo@barbaz.com',
            'Comment' => 'Lorem Ipsum',
            'ProductID' => $product->ID,
        ];
        $responseSubmission = $this->submitForm('CatalogProductInquiryForm_ProductInquiryForm',
            'action_doProductInquiry', $data);

        $record = CatalogProductInquiry::get()->filter($data)->first();
        $this->assertInstanceOf(CatalogProductInquiry::class, $record);
        $this->assertTrue($record->exists());
    }

    /**
     * Test success()
     */
    public function testSuccess()
    {
        $controller = CatalogCategory_Controller::create($this->objFromFixture(CatalogCategory::class, 'default'));
        $product = $this->objFromFixture(CatalogProduct::class, 'one');

        Session::set('InquiryProductID', $product->ID);

        $page = $this->get($controller->Link('success'));

        $this->assertEquals(200, $page->getStatusCode());
    }

}
