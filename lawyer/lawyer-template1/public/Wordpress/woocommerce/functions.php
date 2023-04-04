<?php
if ( ! function_exists( 'np_review_ratings_enabled' )) {
    /**
     * @return bool
     */
    function np_review_ratings_enabled() {
        return 'yes' === get_option('woocommerce_enable_reviews') && 'yes' === get_option('woocommerce_enable_review_rating');
    }
}
if ( ! function_exists( 'np_review_ratings_required' )) {
    /**
     * @return bool
     */
    function np_review_ratings_required() {
        return 'yes' === get_option('woocommerce_review_rating_required');
    }
}
// Checkout template functions
if ( ! function_exists( 'np_woocommerce_form_field' ) ) {
    /**
     * Outputs a checkout/address form field.
     *
     * @param string $key Key.
     * @param mixed  $args Arguments.
     * @param string $value (default: null).
     * @return string
     */
    function np_woocommerce_form_field( $key, $args, $value = null ) {
        $defaults = array(
            'type'              => 'text',
            'label'             => '',
            'description'       => '',
            'placeholder'       => '',
            'maxlength'         => false,
            'required'          => false,
            'autocomplete'      => false,
            'id'                => $key,
            'class'             => array(),
            'label_class'       => array(),
            'input_class'       => array(),
            'return'            => false,
            'options'           => array(),
            'custom_attributes' => array(),
            'validate'          => array(),
            'default'           => '',
            'autofocus'         => '',
            'priority'          => '',
        );

        $args = wp_parse_args( $args, $defaults );
        $args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

        if ( $args['required'] ) {
            $args['class'][] = 'validate-required';
            $required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
        } else {
            $required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
        }

        if ( is_string( $args['label_class'] ) ) {
            $args['label_class'] = array( $args['label_class'] );
        }

        if ( is_null( $value ) ) {
            $value = $args['default'];
        }

        // Custom attribute handling.
        $custom_attributes         = array();
        $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );

        if ( $args['maxlength'] ) {
            $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
        }

        if ( ! empty( $args['autocomplete'] ) ) {
            $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
        }

        if ( true === $args['autofocus'] ) {
            $args['custom_attributes']['autofocus'] = 'autofocus';
        }

        if ( $args['description'] ) {
            $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
        }

        if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
            foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
                $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
            }
        }

        if ( ! empty( $args['validate'] ) ) {
            foreach ( $args['validate'] as $validate ) {
                $args['class'][] = 'validate-' . $validate;
            }
        }

        $field           = '';
        $label_id        = $args['id'];
        $sort            = $args['priority'] ? $args['priority'] : '';
        $field_container = '<div class="form-row %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</div>';

        switch ( $args['type'] ) {
            case 'country':
                $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

                if ( 1 === count( $countries ) ) {

                    $field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

                    $field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" readonly="readonly" />';

                } else {
                    $data_label = ! empty( $args['label'] ) ? 'data-label="' . esc_attr( $args['label'] ) . '"' : '';

                    $field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_attr__( 'Select a country / region&hellip;', 'woocommerce' ) ) . '" ' . $data_label . '><option value="">' . esc_html__( 'Select a country / region&hellip;', 'woocommerce' ) . '</option>';

                    foreach ( $countries as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
                    }

                    $field .= '</select>';

                    $field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country / region', 'woocommerce' ) . '">' . esc_html__( 'Update country / region', 'woocommerce' ) . '</button></noscript>';
                }

                break;
            case 'state':
                /* Get country this state field is representing */
                $for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
                $states      = WC()->countries->get_states( $for_country );

                if ( is_array( $states ) && empty( $states ) ) {

                    $field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

                    $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/>';

                } elseif ( ! is_null( $for_country ) && is_array( $states ) ) {
                    $data_label = ! empty( $args['label'] ) ? 'data-label="' . esc_attr( $args['label'] ) . '"' : '';

                    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_html__( 'Select an option&hellip;', 'woocommerce' ) ) . '"  data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . $data_label . '>
						<option value="">' . esc_html__( 'Select an option&hellip;', 'woocommerce' ) . '</option>';

                    foreach ( $states as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
                    }

                    $field .= '</select>';

                } else {

                    $field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/>';

                }

                break;
            case 'textarea':
                $field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

                break;
            case 'checkbox':
                $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', str_replace('u-input ', '', $args['input_class']) ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> ' . $args['label'] . $required . '</label>';

                break;
            case 'text':
            case 'password':
            case 'datetime':
            case 'datetime-local':
            case 'date':
            case 'month':
            case 'time':
            case 'week':
            case 'number':
            case 'email':
            case 'url':
            case 'tel':
                $field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                break;
            case 'hidden':
                $field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-hidden ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                break;
            case 'select':
                $field   = '';
                $options = '';

                if ( ! empty( $args['options'] ) ) {
                    foreach ( $args['options'] as $option_key => $option_text ) {
                        if ( '' === $option_key ) {
                            // If we have a blank option, select2 needs a placeholder.
                            if ( empty( $args['placeholder'] ) ) {
                                $args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
                            }
                            $custom_attributes[] = 'data-allow_clear="true"';
                        }
                        $options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_html( $option_text ) . '</option>';
                    }

                    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
                }

                break;
            case 'radio':
                $label_id .= '_' . current( array_keys( $args['options'] ) );

                if ( ! empty( $args['options'] ) ) {
                    foreach ( $args['options'] as $option_key => $option_text ) {
                        $field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
                        $field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . esc_html( $option_text ) . '</label>';
                    }
                }

                break;
        }

        if ( ! empty( $field ) ) {
            $field_html = '';

            if ( $args['label'] && 'checkbox' !== $args['type'] ) {
                $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . wp_kses_post( $args['label'] ) . $required . '</label>';
            }

            $field_html .= '<span class="woocommerce-input-wrapper">' . $field;

            if ( $args['description'] ) {
                $field_html .= '<span class="description" id="' . esc_attr( $args['id'] ) . '-description" aria-hidden="true">' . wp_kses_post( $args['description'] ) . '</span>';
            }

            $field_html .= '</span>';

            $container_class = esc_attr( implode( ' ', $args['class'] ) );
            $container_id    = esc_attr( $args['id'] ) . '_field';
            $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
        }

        /**
         * Filter by type.
         */
        $field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

        /**
         * General filter on form fields.
         *
         * @since 3.4.0
         */
        $field = apply_filters( 'woocommerce_form_field', $field, $key, $args, $value );

        if ( $args['return'] ) {
            return $field;
        } else {
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo $field;
        }
    }
}
if ( ! function_exists( 'render_checkout_fields' )) {
    function render_checkout_fields($checkout, $name) {
        if ($name === 'billing') {
            $fields = array_merge($checkout->get_checkout_fields( 'billing' ), $checkout->get_checkout_fields( 'order' ));
        } else {
            $fields = array_merge($checkout->get_checkout_fields( 'shipping' ));
        }

        global $checkout_custom_template;
        $checkout_custom_template = isset($checkout_custom_template) ? $checkout_custom_template : get_option('checkout_template');
        include get_template_directory() . '/woocommerce/template-parts/' . $checkout_custom_template . '/checkout-fields.php';
        $checkout_field_class = isset($checkout_fields_styles['checkout_field_class']) ? $checkout_fields_styles['checkout_field_class'] : '';
        $checkout_label_class = isset($checkout_fields_styles['checkout_label_class']) ? $checkout_fields_styles['checkout_label_class'] : '';
        $checkout_input_class = isset($checkout_fields_styles['checkout_input_class']) ? $checkout_fields_styles['checkout_input_class'] : '';

        foreach ( $fields as $key => $field ) {
            $label = isset($field['label']) ? $field['label'] : '';
            $placeholder = isset($field['placeholder']) ? $field['placeholder'] : $label;
            $class = [ $checkout_field_class ];
            if (isset($field['class'])) {
                $index = array_search('update_totals_on_change', $field['class']);
                if ($index !== false) {
                    $class[] = isset($field['class'][$index]) ? $field['class'][$index] : '';
                }
            }
            $label_class = [ $checkout_label_class ];
            $input_class = [ $checkout_input_class ];
            $required = isset($field['required']) ? $field['required'] : false;
            np_woocommerce_form_field(
                $key,
                [
                    'type'        => isset($field['type']) ? $field['type'] : 'text',
                    'label'       => $label,
                    'placeholder' => $placeholder,
                    'class'       => $class,
                    'label_class' => $label_class,
                    'input_class' => $input_class,
                    'required'    => $required,
                ],
                $checkout->get_value( $key )
            );
        }
    }
}
if ( ! function_exists( 'get_product_prices' )) {
    function get_product_prices($product) {
        // old price
        $regularPrice = $product->get_sale_price() === '' ? '' : wc_price($product->get_regular_price());
        //new price
        if ($product->is_type('variable')) {
            if ($product->get_variation_sale_price( 'min', true ) && $product->get_variation_sale_price( 'max', true )) {
                if ($product->get_variation_sale_price( 'min', true ) === $product->get_variation_sale_price( 'max', true )) {
                    $new_price = wc_price($product->get_variation_sale_price( 'min', true ));
                } else {
                    $new_price = wc_price($product->get_variation_sale_price( 'min', true )) . ' - ' . wc_price($product->get_variation_sale_price( 'max', true ));
                }
            } else {
                $new_price = '';
            }
        } else {
            $new_price = wc_price($product->get_price()) . '<span style="color:rgb(0, 0, 0);margin-left: 6px;font-size: 94%;">' . $product->get_price_suffix() . '</span>';
        }
        return array(
            'new_price' => $new_price,
            'old_price' => $regularPrice
        );
    }
}
if ( ! function_exists( 'render_checkout_products' )) {
    function render_checkout_products() {
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                global $checkout_custom_template;
                $checkout_custom_template = isset($checkout_custom_template) ? $checkout_custom_template : get_option('checkout_template');
                include get_template_directory() . '/woocommerce/template-parts/' . $checkout_custom_template . '/products-table.php';
                $trStyle = isset($products_styles['trStyle']) ? $products_styles['trStyle'] : '';
                $trClass = isset($products_styles['trClass']) ? $products_styles['trClass'] : '';
                $td1Style = isset($products_styles['td1Style']) ? $products_styles['td1Style'] : '';
                $td1Class = isset($products_styles['td1Class']) ? $products_styles['td1Class'] : '';
                $td2Style = isset($products_styles['td2Style']) ? $products_styles['td2Style'] : '';
                $td2Class = isset($products_styles['td2Class']) ? $products_styles['td2Class'] : ''; ?>
                <tr style="<?php echo $trStyle; ?>" class="<?php echo $trClass; ?> <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <td style="<?php echo $td1Style; ?>" class="<?php echo $td1Class; ?>">
                        <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
                        <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                    </td>
                    <td style="<?php echo $td2Style; ?>" class="<?php echo $td2Class; ?>">
                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </td>
                </tr>
                <?php
            }
        }
        if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

        <?php endif;
    }
}

if ( ! function_exists( 'render_checkout_additional_options' )) {
    function render_checkout_additional_options() {
        global $checkout_custom_template;
        $checkout_custom_template = isset($checkout_custom_template) ? $checkout_custom_template : get_option('checkout_template');
        include get_template_directory() . '/woocommerce/template-parts/' . $checkout_custom_template . '/products-table.php';
        $trStyle = isset($products_styles['trStyle']) ? $products_styles['trStyle'] : '';
        $trClass = isset($products_styles['trClass']) ? $products_styles['trClass'] : '';
        $td1Style = isset($products_styles['td1Style']) ? $products_styles['td1Style'] : '';
        $td1Class = isset($products_styles['td1Class']) ? $products_styles['td1Class'] : '';
        $td2Style = isset($products_styles['td2Style']) ? $products_styles['td2Style'] : '';
        $td2Class = isset($products_styles['td2Class']) ? $products_styles['td2Class'] : '';
        if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                    <tr style="<?php echo $trStyle; ?>" class="<?php echo $trClass; ?> tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <td style="<?php echo $td1Style; ?>" class="<?php echo $td1Class; ?>"><?php echo esc_html( $tax->label ); ?></td>
                        <td style="<?php echo $td2Style; ?>" class="<?php echo $td2Class; ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr style="<?php echo $trStyle; ?>" class="<?php echo $trClass; ?> tax-total">
                    <td style="<?php echo $td1Style; ?>" class="<?php echo $td1Class; ?>"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></td>
                    <td style="<?php echo $td2Style; ?>" class="<?php echo $td2Class; ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif;
    }
}
if ( ! function_exists( 'is_product_in_cart' )) {
    function is_product_in_cart() {
        foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
            $cart_product = $values['data'];
            if(get_the_ID() == $cart_product->id) {
                return true;
            }
        }
        return false;
    }
}
if (function_exists('wc_gzd_get_cart_total_taxes')) {
    // for plugin "Germanized for WooCommerce"
    add_action( 'woocommerce_review_order_before_order_total', 'woocommerce_np_template_cart_total_tax', 2 );
    function woocommerce_np_template_cart_total_tax() {
        global $checkout_custom_template;
        $checkout_custom_template = isset($checkout_custom_template) ? $checkout_custom_template : get_option('checkout_template');
        include get_template_directory() . '/woocommerce/template-parts/' . $checkout_custom_template . '/products-table.php';
        $trStyle = isset($products_styles['trStyle']) ? $products_styles['trStyle'] : '';
        $trClass = isset($products_styles['trClass']) ? $products_styles['trClass'] : '';
        $td1Style = isset($products_styles['td1Style']) ? $products_styles['td1Style'] : '';
        $td1Class = isset($products_styles['td1Class']) ? $products_styles['td1Class'] : '';
        $td2Style = isset($products_styles['td2Style']) ? $products_styles['td2Style'] : '';
        $td2Class = isset($products_styles['td2Class']) ? $products_styles['td2Class'] : '';
        foreach ( wc_gzd_get_cart_total_taxes() as $tax ) :
            $label = wc_gzd_get_tax_rate_label( $tax['tax']->rate );
            ?>
            <tr style="<?php echo $trStyle; ?>" class="<?php echo $trClass; ?> order-tax">
                <td style="<?php echo $td1Style; ?>" class="<?php echo $td1Class; ?>"><?php echo wp_kses_post( $label ); ?></td>
                <td style="<?php echo $td2Style; ?>" class="<?php echo $td2Class; ?>" data-title="<?php echo esc_attr( $label ); ?>"><?php echo wc_price( $tax['amount'] ); ?></td>
            </tr>
        <?php
        endforeach;
    }
}