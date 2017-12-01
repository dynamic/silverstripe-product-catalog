<?php

namespace Dynamic\ProductCatalog\Page;

use Dynamic\ProductCatalog\ORM\CatalogProduct;
use SilverStripe\Control\HTTPRequest;

class CatalogCategoryController extends \PageController
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'view',
    );

    /**
     * @var
     */
    private $product;

    /**
     * @param HTTPRequest|null $request
     * @return mixed
     */
    public function getProduct(HTTPRequest $request = null)
    {
        if (!$this->product) {
            $this->setProduct($this->getProductFromRequest($request));
        }
        return $this->product;
    }

    /**
     * @param null $request
     * @return bool|\SilverStripe\ORM\DataObject
     */
    public function getProductFromRequest($request = null)
    {
        if (!$request) {
            $request = $this->getRequest();
        }

        $productID = $request->param('ID');
        if ($productID) {
            $product = CatalogProduct::get()->filter('URLSegment', $productID)->first();
            return $product;
        }
        return false;
    }

    /**
     * @param $product
     * @return $this
     */
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @param HTTPRequest $request
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function view(HTTPRequest $request)
    {
        $product = $this->getProduct();
        if (!$product) {
            return $this->httpError(404, 'The product you\'re looking for isn\'t available.');
        }

        return $this->customise(array(
            'Title' => $product->getTitle(),
            'Product' => $product,
            'MetaTags' => $product->MetaTags(),
            'Breadcrumbs' => $product->Breadcrumbs(),
        ))->renderWith(array('Dynamic\ProductCatalog\Page\Product', 'Page'));
    }
}