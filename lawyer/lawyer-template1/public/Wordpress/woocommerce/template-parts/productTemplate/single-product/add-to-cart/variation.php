<?php
defined( 'ABSPATH' ) || exit;
?>
<script type="text/template" id="tmpl-variation-template">
    <div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
    <div class="woocommerce-variation-price">
        <div class="u-product-control u-product-price u-product-price-1">
          <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
            <div class="u-hide-price u-old-price" style="text-decoration: line-through !important;">{{{ data.variation.display_regular_price_html }}}</div><!--/product_old_price--><!--product_regular_price-->
            <div class="u-price u-text-palette-2-base" style="font-size: 1.875rem; font-weight: 700;">{{{ data.variation.display_price_html }}}</div><!--/product_regular_price-->
          </div>
        </div>
    </div>
    <div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p><?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
</script>
