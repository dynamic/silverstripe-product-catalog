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

    /**
     * @var array
     */
    protected $extraDataObjects = [
        'TestCatalogCategory',
    ];

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
     *
     */
    public function testProductInquiryForm()
    {
        $controller = CatalogCategory_Controller::create($this->objFromFixture('CatalogCategory', 'default'));
        $form = $controller->ProductInquiryForm();
        $this->assertInstanceOf('CatalogProductInquiryForm', $form);
    }

    public function testDoProductInquiry()
    {
        $controller = TestCatalogCategory_Controller::create($this->objFromFixture('CatalogCategory', 'default'));
        $product = $this->objFromFixture('CatalogProduct', 'one');

        $form = $controller->Form();
        $controller->setProduct($product);

        $response = $this->get('/TestCatalogCategory_Controller');
        $this->assertEquals(200, $response->getStatusCode());

        $data = [
            'Name' => 'Foo',
            'Phone' => '555-555-5555',
            'Email' => 'foo@barbaz.com',
            'Comment' => 'Lorem Ipsum',
            'ProductID' => $product->ID,
        ];
        $responseSubmission = $this->submitForm('CatalogProductInquiryForm_Form', 'action_doProductInquiry', $data);

        $record = CatalogProductInquiry::get()->filter($data)->first();
        $this->assertInstanceOf('CatalogProductInquiry', $record);
        $this->assertTrue($record->exists());
    }

}