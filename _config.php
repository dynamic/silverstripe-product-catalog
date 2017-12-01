<?php

use Dynamic\ProductCatalog\ORM\CatalogProduct;

define('SILVERSTRIPE_PRODUCT-CATALOG_PATH', __DIR__);
define('SILVERSTRIPE_PRODUCT-CATALOG_DIR', basename(__DIR__));

if (method_exists('GoogleSitemap', 'register_dataobject')) {
    GoogleSitemap::register_dataobject(CatalogProduct::class, 'daily', 1);
}