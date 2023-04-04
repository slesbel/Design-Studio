<?php
defined( 'ABSPATH' ) || exit;
global $cart_custom_template;
$cart_custom_template = 'shoppingCartTemplate';
$language = isset($_GET['lang']) ? $_GET['lang'] : '';
global $product;

function cart_body_class_filter($classes) {
    $classes[] = 'u-body u-xl-mode';
    return $classes;
}
add_filter('body_class', 'cart_body_class_filter');

function cart_body_style_attribute() {
    return "";
}
add_filter('add_body_style_attribute', 'cart_body_style_attribute');

function cart_body_back_to_top() {
    ob_start(); ?>
    
    <?php
    return ob_get_clean();
}
add_filter('add_back_to_top', 'cart_body_back_to_top');

function cart_get_local_fonts() {
    return '';
}

add_filter('get_local_fonts', 'cart_get_local_fonts');

theme_layout_before('cart', '', $cart_custom_template);

$translations = '';
if ($language) {
    if (file_exists(get_stylesheet_directory() . '/woocommerce/' . 'template-parts/'. $cart_custom_template . '/translations/' . $language . '/cart-content' . '.php')) {
        $translations = '/translations/' . $language;
    }
}
ob_start();
get_template_part('/woocommerce/template-parts/'. $cart_custom_template . $translations . '/cart-content');
$content = ob_get_clean();
if (function_exists('renderTemplate')) {
    renderTemplate($content, '', 'echo', 'custom');
} else {
    echo $content;
}

theme_layout_after('cart'); ?>

