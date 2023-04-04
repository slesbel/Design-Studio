<?php global $product; global $cart_custom_template; ?><?php $skip_min_height = false; ?><section class="u-clearfix u-section-1" id="sec-f2a6">
  <div class="u-clearfix u-sheet u-sheet-1">
    <div class="u-cart u-cart-1">
      <div class="u-cart-products-table u-table u-table-responsive">
        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post"><table class="u-table-entity woocommerce-cart-form__contents">
          <colgroup>
            <col width="65%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
          </colgroup>
          <thead class="u-table-header">
            <tr>
              <th class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php esc_html_e('Product', 'woocommerce'); ?></th>
              <th class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php esc_html_e('Price', 'woocommerce'); ?></th>
              <th class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
              <th class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
            </tr>
          </thead>
          <tbody class="u-table-body">
            <?php
		                static $i = 0;
		                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
			                $i++;
			                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
				                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				                if ($i % 2 === 0): ?><tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php
						                $originalRemove = apply_filters(
							                'woocommerce_cart_item_remove_link',
							                sprintf(
								                '<div class="product-remove" style="display:none"><a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a></div>',
								                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								                esc_html__( 'Remove this item', 'woocommerce' ),
								                esc_attr( $product_id ),
								                esc_attr( $_product->get_sku() )
							                ),
							                $cart_item_key
						                );
						                echo $originalRemove; ?><span class="u-cart-remove-item u-icon u-icon-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 52 52" x="0px" y="0px" style="width: 1em; height: 1em;"><g><path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26
		S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"></path><path d="M35.707,16.293c-0.391-0.391-1.023-0.391-1.414,0L26,24.586l-8.293-8.293c-0.391-0.391-1.023-0.391-1.414,0
		s-0.391,1.023,0,1.414L24.586,26l-8.293,8.293c-0.391,0.391-0.391,1.023,0,1.414C16.488,35.902,16.744,36,17,36
		s0.512-0.098,0.707-0.293L26,27.414l8.293,8.293C34.488,35.902,34.744,36,35,36s0.512-0.098,0.707-0.293
		c0.391-0.391,0.391-1.023,0-1.414L27.414,26l8.293-8.293C36.098,17.316,36.098,16.684,35.707,16.293z"></path>
</g></svg><img></span>
                <?php
	                                    $image = preg_replace('/class="/', 'class="u-cart-product-image u-image u-image-default u-product-control ', $_product->get_image());
	                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $image, $cart_item, $cart_item_key );
	                                    if ( ! $product_permalink ) {
		                                    echo $thumbnail; // PHPCS: XSS ok.
	                                    } else {
		                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
	                                    }
	                                    ?>
                <h2 class="u-cart-product-title u-product-control u-text u-text-1">
                  <?php
                                            if ( ! $product_permalink ) {
	                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                            } else {
	                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="u-product-title-link" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }
                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key ); ?>
                </h2>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-price u-product-control u-product-price">
                  <div class="u-price-wrapper">
                    <div class="u-hide-price u-old-price"></div>
                    <div class="u-price"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?></div>
                  </div>
                </div>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-quantity u-product-control u-product-quantity u-product-quantity-1">
                  <div class="u-hidden u-quantity-label"></div>
                  <div class="u-border-1 u-border-grey-25 u-quantity-input">
                    <a class="disabled minus u-button-style u-hidden u-quantity-button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m 4 8 h 8" fill="none" stroke="currentColor" stroke-width="1" fill-rule="evenodd"></path></svg>
                    </a>
                    <?php
	                                            if ( is_null( $product ) ) {
		                                            $product = $GLOBALS['product'];
	                                            }
	                                            if ( $_product->is_sold_individually() ) {
		                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
	                                            } else {
		                                            $product_quantity = woocommerce_quantity_input(
			                                            array(
				                                            'input_name'   => "cart[{$cart_item_key}][qty]",
				                                            'input_value'  => $cart_item['quantity'],
				                                            'max_value'    => $_product->get_max_purchase_quantity(),
				                                            'min_value'    => '0',
				                                            'product_name' => $_product->get_name(),
				                                            'classes' => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text', 'u-input' ), $product ),
			                                            ),
			                                            $_product,
			                                            false
		                                            );
	                                            }
	                                            $product_quantity = str_replace('class="quantity"', '', $product_quantity);
	                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
	                                            ?>
                    <a class="plus u-button-style u-hidden u-quantity-button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m 4 8 h 8 M 8 4 v 8" fill="none" stroke="currentColor" stroke-width="1" fill-rule="evenodd"></path></svg>
                    </a>
                  </div>
                </div>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-subtotal u-product-control u-product-price">
                  <div class="u-price-wrapper">
                    <div class="u-hide-price u-old-price"></div>
                    <div class="u-price u-subtotal-price" style="font-weight: 700;"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?></div>
                  </div>
                </div>
              </td>
            </tr><?php else: ?>
            
            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell"><?php
						                $originalRemove = apply_filters(
							                'woocommerce_cart_item_remove_link',
							                sprintf(
								                '<div class="product-remove" style="display:none"><a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a></div>',
								                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								                esc_html__( 'Remove this item', 'woocommerce' ),
								                esc_attr( $product_id ),
								                esc_attr( $_product->get_sku() )
							                ),
							                $cart_item_key
						                );
						                echo $originalRemove; ?><span class="u-cart-remove-item u-icon u-icon-3"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 52 52" x="0px" y="0px" style="width: 1em; height: 1em;"><g><path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26
		S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"></path><path d="M35.707,16.293c-0.391-0.391-1.023-0.391-1.414,0L26,24.586l-8.293-8.293c-0.391-0.391-1.023-0.391-1.414,0
		s-0.391,1.023,0,1.414L24.586,26l-8.293,8.293c-0.391,0.391-0.391,1.023,0,1.414C16.488,35.902,16.744,36,17,36
		s0.512-0.098,0.707-0.293L26,27.414l8.293,8.293C34.488,35.902,34.744,36,35,36s0.512-0.098,0.707-0.293
		c0.391-0.391,0.391-1.023,0-1.414L27.414,26l8.293-8.293C36.098,17.316,36.098,16.684,35.707,16.293z"></path>
</g></svg><img></span>
                <?php
	                                    $image = preg_replace('/class="/', 'class="u-cart-product-image u-image u-image-default u-product-control ', $_product->get_image());
	                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $image, $cart_item, $cart_item_key );
	                                    if ( ! $product_permalink ) {
		                                    echo $thumbnail; // PHPCS: XSS ok.
	                                    } else {
		                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
	                                    }
	                                    ?>
                <h2 class="u-cart-product-title u-product-control u-text u-text-3">
                  <?php
                                            if ( ! $product_permalink ) {
	                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                            } else {
	                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="u-product-title-link" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }
                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key ); ?>
                </h2>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-price u-product-control u-product-price">
                  <div class="u-price-wrapper">
                    <div class="u-hide-price u-old-price"></div>
                    <div class="u-price"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?></div>
                  </div>
                </div>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-quantity u-product-control u-product-quantity u-product-quantity-3">
                  <div class="u-hidden u-quantity-label"></div>
                  <div class="u-border-1 u-border-grey-25 u-quantity-input">
                    <a class="disabled minus u-button-style u-hidden u-quantity-button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m 4 8 h 8" fill="none" stroke="currentColor" stroke-width="1" fill-rule="evenodd"></path></svg>
                    </a>
                    <?php
	                                            if ( is_null( $product ) ) {
		                                            $product = $GLOBALS['product'];
	                                            }
	                                            if ( $_product->is_sold_individually() ) {
		                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
	                                            } else {
		                                            $product_quantity = woocommerce_quantity_input(
			                                            array(
				                                            'input_name'   => "cart[{$cart_item_key}][qty]",
				                                            'input_value'  => $cart_item['quantity'],
				                                            'max_value'    => $_product->get_max_purchase_quantity(),
				                                            'min_value'    => '0',
				                                            'product_name' => $_product->get_name(),
				                                            'classes' => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text', 'u-input' ), $product ),
			                                            ),
			                                            $_product,
			                                            false
		                                            );
	                                            }
	                                            $product_quantity = str_replace('class="quantity"', '', $product_quantity);
	                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
	                                            ?>
                    <a class="plus u-button-style u-hidden u-quantity-button">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m 4 8 h 8 M 8 4 v 8" fill="none" stroke="currentColor" stroke-width="1" fill-rule="evenodd"></path></svg>
                    </a>
                  </div>
                </div>
              </td>
              <td class="u-border-1 u-border-grey-dark-1 u-table-cell">
                <div class="u-cart-product-subtotal u-product-control u-product-price">
                  <div class="u-price-wrapper">
                    <div class="u-hide-price u-old-price"></div>
                    <div class="u-price u-subtotal-price" style="font-weight: 700;"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?></div>
                  </div>
                </div>
              </td>
            </tr><?php endif; endif; endforeach; ?>
          <?php do_action( 'woocommerce_cart_contents' ); ?>
                        <tr style="display: none">
                            <td colspan="6" class="actions">
				                <?php if ( wc_coupons_enabled() ) { ?>
                                    <div class="coupon">
                                        <label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
						                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                    </div>
				                <?php } ?>
                                <button type="submit" class="button np-cart-update" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
				                <?php do_action( 'woocommerce_cart_actions' ); ?>
				                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            </td>
                        </tr></tbody>
        </table></form>
      </div>
      <div class="u-cart-button-container">
        <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="u-active-none u-btn u-button-style u-cart-continue-shopping u-hover-none u-none u-text-body-color u-btn-1"><span class="u-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 443.52 443.52" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M143.492,221.863L336.226,29.129c6.663-6.664,6.663-17.468,0-24.132c-6.665-6.662-17.468-6.662-24.132,0l-204.8,204.8    c-6.662,6.664-6.662,17.468,0,24.132l204.8,204.8c6.78,6.548,17.584,6.36,24.132-0.42c6.387-6.614,6.387-17.099,0-23.712    L143.492,221.863z"></path>
</g>
</g></svg><img src=""></span>&nbsp;<?php esc_html_e( 'Continue shopping', 'woocommerce' ); ?> 
        </a>
        <a href="#" class="u-btn u-button-style u-cart-update u-grey-5"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></a>
      </div>
      <div class="u-cart-blocks-container">
        <div class="u-cart-block u-indent-30">
          <div class="u-cart-block-container u-clearfix">
            <h5 class="u-cart-block-header u-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></h5>
            <div class="u-cart-block-content u-text">
              <div class="u-cart-form u-form">
                <form action="#" method="POST" class="u-clearfix u-form-horizontal u-form-spacing-10 u-inner-form" source="custom" name="form">
                  <div class="u-form-group">
                    <label for="name-5861" class="u-form-control-hidden u-label">Coupon code</label>
                    <input type="text" placeholder="<?php echo __( 'Coupon code.', 'woocommerce' ); ?>" id="name-5861" name="coupon" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="">
                  </div>
                  <div class="u-align-left u-form-group u-form-submit">
                    <a href="#" class="u-btn u-btn-submit u-button-style"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></a>
                    
                  </div>
                  <div class="u-form-send-message u-form-send-success">Thank you! Your message has been sent.</div>
                  <div class="u-form-send-error u-form-send-message">Unable to send your message. Please fix errors then try again.</div>
                  <input type="hidden" value="" name="recaptchaResponse">
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php
		/**
		 * Cart collaterals hook.
		 *
		 * woocommerce_cross_sell_display
		 * woocommerce_cart_totals - 10
		 */
		wc_get_template( 'template-parts/' . $cart_custom_template . '/cart/cart-totals.php' );
	?>
      </div>
    </div>
  </div>
</section><?php if ($skip_min_height) { echo "<style> .u-section-1, .u-section-1 .u-sheet {min-height: auto;}</style>"; } ?>
