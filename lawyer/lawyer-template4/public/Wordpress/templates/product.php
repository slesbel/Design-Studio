<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product_custom_template;
$product_custom_template = 'productTemplate';
$language = isset($_GET['lang']) ? $_GET['lang'] : '';

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
global $product;
if (!$product) {
	global $post;
	$product = wc_get_product($post->ID);
}
add_action(
    'theme_content_styles',
    function () use ($product_custom_template) {
        theme_product_content_styles($product_custom_template);
    }
);

function product_single_body_class_filter($classes) {
	$classes[] = 'u-body u-xl-mode';
	return $classes;
}
add_filter('body_class', 'product_single_body_class_filter');

function product_single_body_style_attribute() {
	return "";
}
add_filter('add_body_style_attribute', 'product_single_body_style_attribute');

function product_single_body_back_to_top() {
    ob_start(); ?>
    
    <?php
    return ob_get_clean();
}
add_filter('add_back_to_top', 'product_single_body_back_to_top');


function product_single_get_local_fonts() {
	return '';
}
add_filter('get_local_fonts', 'product_single_get_local_fonts');

get_header();

theme_layout_before('product', '', $product_custom_template); ?>

<?php
$translations = '';
if ($language) {
    if (file_exists(get_stylesheet_directory() . '/woocommerce/' . 'template-parts/'. $product_custom_template . '/translations/' . $language .'/content-single-product' . '.php')) {
        $translations = '/translations/' . $language;
    }
}
ob_start();
while ( have_posts() ) : the_post();
    wc_get_template_part( 'template-parts/' . $product_custom_template . $translations . '/content', 'single-product' );
endwhile; // end of the loop.
$content = ob_get_clean();
if (function_exists('renderTemplate')) {
    renderTemplate($content, '', 'echo', 'custom');
} else {
    echo $content;
}

theme_layout_after('product'); ?>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>

<?php get_footer();
remove_action('theme_content_styles', 'theme_product_content_styles');
remove_filter('body_class', 'theme_single_body_class_filter');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
