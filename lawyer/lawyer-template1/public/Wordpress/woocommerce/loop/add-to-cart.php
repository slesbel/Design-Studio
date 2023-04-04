<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;
global $post;

$clickTypeProductbutton = isset($post->clickTypeProductbutton) ? $post->clickTypeProductbutton : 'add-to-cart';
$contentProductbutton = isset($post->contentProductbutton) ? $post->contentProductbutton : '';
$htmlProductbutton = isset($post->htmlProductbutton) ? $post->htmlProductbutton : '<a>%s</a>';

$product_id  = $product->get_id();
$button_text = sprintf(
    __('%s', 'woocommerce'),
    $product->add_to_cart_text()
);
$url = get_permalink($product_id);
$ajaxClasses = '';
if ($clickTypeProductbutton === 'add-to-cart') {
    $url = $product->add_to_cart_url();
    $ajaxClasses = $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '';
}
if ($contentProductbutton !== '') {
    $button_text = $contentProductbutton;
}
echo $button_html = apply_filters(
    'woocommerce_loop_add_to_cart_link',
    sprintf(
        str_replace('<a', '<a data-quantity="1" data-product_id="%s" data-product_sku="%s" href="%s" class="%s"', $htmlProductbutton),
        esc_attr($product_id),
        esc_attr($product->get_sku()),
        esc_url($url),
        implode(
            ' ',
            array_filter(
                array(
                    '',
                    'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    $ajaxClasses,
                    esc_attr(isset($args['class']) ? $args['class'] : ''),
                )
            )
        ),
        $button_text
    ),
    $product
);