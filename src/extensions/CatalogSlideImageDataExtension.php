<?php

namespace Dynamic\ProductCatalog\ORM;

use SilverStripe\ORM\DataExtension;

/**
 * Class CatalogSlideImageDataExtension
 *
 * @property int $ProductID
 * @method CatalogProduct $Product
 */
class CatalogSlideImageDataExtension extends DataExtension
{

    /**
     * @var array
     */
    private static $has_one = [
        'Product' => CatalogProduct::class,
    ];

}