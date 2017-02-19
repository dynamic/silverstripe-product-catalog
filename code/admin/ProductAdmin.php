<?php

class ProductAdmin extends ModelAdmin
{
    /**
     * @var array
     */
    private static $managed_models = array(
        'CatalogProduct',
        'CareCleaningDoc',
        'OperationManual',
        'SpecSheet',
        'Warranty',
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