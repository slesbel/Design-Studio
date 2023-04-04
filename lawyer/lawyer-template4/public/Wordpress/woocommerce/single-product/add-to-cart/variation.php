<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */
global $product_custom_template;
$product_custom_template = $product_custom_template ? $product_custom_template : 'productTemplate';
if (file_exists(get_template_directory() . '/woocommerce/template-parts/' . $product_custom_template . '/single-product/add-to-cart/variation.php')) {
    include_once get_template_directory() . '/woocommerce/template-parts/' . $product_custom_template . '/single-product/add-to-cart/variation.php';
}
?>