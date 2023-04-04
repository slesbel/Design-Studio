<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.6
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h5 class="u-cart-block-header u-text"><?php esc_html_e( 'Cart totals', 'woocommerce' ); ?></h5>

    <div class="u-align-right u-cart-block-content u-text">
              <div class="u-cart-totals-table u-table u-table-responsive">
                <table class="u-table-entity">
                  <colgroup>
                    <col width="50%">
                    <col width="50%">
                  </colgroup>
                  <tbody class="u-align-right u-table-body">
                    <tr>
                      <td class="u-align-left u-border-1 u-border-grey-dark-1 u-first-column u-table-cell u-table-cell-17"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></td>
                      <td class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php wc_cart_totals_subtotal_html(); ?></td>
                    </tr><?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                        <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                            <th class="u-align-left u-border-1 u-border-grey-dark-1 u-first-column u-table-cell u-table-cell-17"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                            <td class="u-align-left u-border-1 u-border-grey-dark-1 u-first-column u-table-cell u-table-cell-17" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td class="u-align-left u-border-1 u-border-grey-dark-1 u-first-column u-table-cell u-table-cell-19"><?php esc_attr_e( 'Total', 'woocommerce' ); ?></td>
                      <td class="u-border-1 u-border-grey-dark-1 u-table-cell u-table-cell-20"><?php wc_cart_totals_order_total_html(); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="u-btn u-button-style u-cart-checkout-btn u-btn-4"><?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?></a>
            </div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
