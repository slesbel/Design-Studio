<?php
defined( 'ABSPATH' ) || exit;
global $products_custom_template;
$products_custom_template = 'productsTemplate';
$language = isset($_GET['lang']) ? $_GET['lang'] : '';

if (is_shop() || is_product_category()) {
    add_action(
        'theme_content_styles',
        function () use ($products_custom_template) {
            theme_products_content_styles($products_custom_template);
        }
    );
    function products_index_body_class_filter($classes) {
        $classes[] = 'u-body u-xl-mode';
        return $classes;
    }
    add_filter('body_class', 'products_index_body_class_filter');

    function products_index_body_style_attribute() {
        return "";
    }
    add_filter('add_body_style_attribute', 'products_index_body_style_attribute');

    function products_index_body_back_to_top() {
        ob_start(); ?>
        
        <?php
        return ob_get_clean();
    }
    add_filter('add_back_to_top', 'products_index_body_back_to_top');

    function products_index_get_local_fonts() {
        return '';
    }
    add_filter('get_local_fonts', 'products_index_get_local_fonts');

    get_header();

    theme_layout_before('products', '', $products_custom_template);

    $first_repeatable = 0;
    $last_repeatable = 0;

    $template_used = array();
    $templates_count = 1;

    $products_sections_count = $last_repeatable + 1;

    if (have_posts() && $products_sections_count) {
        ob_start();
        for ($template_idx = 0; $template_idx < $templates_count; $template_idx++) {
            $translations = '';
            if ($language) {
                if (file_exists(get_stylesheet_directory() . '/woocommerce/' . 'template-parts/'. $products_custom_template . '/translations/' . $language . '/product-content-' . ($template_idx + 1) . '.php')) {
                    $translations = '/translations/' . $language;
                }
            }
            get_template_part('/woocommerce/template-parts/'. $products_custom_template . $translations . '/product-content-' . ($template_idx + 1));
        }
        $content = ob_get_clean();
        if (function_exists('renderTemplate')) {
            renderTemplate($content, '', 'echo', 'custom');
        } else {
            echo $content;
        }
    }

    theme_layout_after('products');
    get_footer();
    remove_filter('body_class', 'products_index_body_class_filter');
    remove_action('theme_content_styles', 'theme_products_content_styles');
} else {
    get_header( 'shop' );

    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    do_action( 'woocommerce_before_main_content' );

    ?>
    <header class="woocommerce-products-header">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php
        /**
         * Hook: woocommerce_archive_description.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action( 'woocommerce_archive_description' );
        ?>
    </header>
    <?php
    if ( woocommerce_product_loop() ) {

        /**
         * Hook: woocommerce_before_shop_loop.
         *
         * @hooked woocommerce_output_all_notices - 10
         * @hooked woocommerce_result_count - 20
         * @hooked woocommerce_catalog_ordering - 30
         */
        do_action( 'woocommerce_before_shop_loop' );

        woocommerce_product_loop_start();

        if ( wc_get_loop_prop( 'total' ) ) {
            while ( have_posts() ) {
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action( 'woocommerce_shop_loop' );

                wc_get_template_part( 'content', 'product' );
            }
        }

        woocommerce_product_loop_end();

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action( 'woocommerce_after_shop_loop' );
    } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action( 'woocommerce_no_products_found' );
    }

    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );

    /**
     * Hook: woocommerce_sidebar.
     *
     * @hooked woocommerce_get_sidebar - 10
     */
    do_action( 'woocommerce_sidebar' );

    get_footer( 'shop' );
}
