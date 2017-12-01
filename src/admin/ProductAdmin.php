<?php

namespace Dynamic\ProductCatalog\admin;

use Dynamic\ProductCatalog\Docs\CareCleaningDoc;
use Dynamic\ProductCatalog\Docs\OperationManual;
use Dynamic\ProductCatalog\Docs\SpecSheet;
use Dynamic\ProductCatalog\Docs\Warranty;
use Dynamic\ProductCatalog\ORM\CatalogProduct;
use SilverStripe\Admin\ModelAdmin;

class ProductAdmin extends ModelAdmin
{
    /**
     * @var array
     */
    private static $managed_models = array(
        CatalogProduct::class,
        CareCleaningDoc::class,
        OperationManual::class,
        SpecSheet::class,
        Warranty::class,
    );

    /**
     * @var string
     */
    private static $url_segment = 'products';

    /**
     * @var string
     */
    private static $menu_title = 'Products';
}
