<?php $skip_min_height = false; ?><section class="u-align-center u-clearfix u-section-1" id="sec-243d">
  <div class="u-clearfix u-sheet u-valign-middle u-sheet-1"><?php
$productsJson = '{"type":"Recent","source":"","tags":"","count":""}';
global $wp_query; $all = count($wp_query->posts); echo getGridAutoRowsStyles($productsJson, $all);
?>

    <?php global $product; if (!$product) {
	global $post; $product = wc_get_product($post->ID);
} ?><div class="u-expanded-width u-products u-repeater u-repeater-1"><?php
                                    $countItems = 6;
                                    while (have_posts()) { the_post();
                                    $templateOrder = $wp_query->current_post % $countItems;
                                ?><?php if ($templateOrder == 0) { ?><!--product_item-->
      <?php $product = wc_get_product($post->ID); $product_prices = get_product_prices($product); $productItemInvisible = !wp_get_attachment_image_url($product->get_image_id()) ? true : false; ?><div class="u-align-center u-container-style u-products-item u-repeater-item u-white u-repeater-item-1">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1"><!--product_image-->
          <?php
                            $product_image = theme_get_post_image(array('class' => 'u-expanded-width u-image u-image-default u-product-control u-image-1', 'default' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0ibWFuIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjI1NnB4IiBoZWlnaHQ9IjI1NnB4IiB2aWV3Qm94PSIwIDAgMjU2IDI1NiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjU2IDI1NiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8cmVjdCBmaWxsPSIjQzZEOEUxIiB3aWR0aD0iMjU2IiBoZWlnaHQ9IjI1NiIvPg0KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGw9IiM3Rjk2QTYiIGQ9Ik0xOTIuNyw1NGMwLDAsNS4zLDAuMywxMy4yLDkuMmM3LjksOC45LDE0LjMsMTksMTUuOCwyNS44DQoJYzEuNSw2LjgsMiwxMy42LDAuMywxNy41Yy0xLjgsMy45LTExLjQsMzQuNC0xMS43LDQzLjljLTAuMyw5LjUtMi42LDUzLTIuNiw1M2gtMTAuNWwtMi4xLTU3LjdjMCwwLTAuMy0xMC43LTMuOC0xMC43DQoJYy0zLjUsMC0xNi43LDQuNC0yOC45LDI3QzE1MCwxODQuNSwxNDMsMTk3LjUsMTM2LDIwMC44Yy03LDMuMy01Ny4zLDQuMi03MSwyLjFjLTEzLjctMi4xLTMxLjMtOS41LTMxLjMtOS41cy0zLjgtNy4xLDctMTAuMQ0KCWMxMC44LTMsNDEuOC0xMyw0OC4yLTE2LjljMy43LTIuMiwyOSw2LjksMzguOS01LjFjOS4xLTExLjEsMzcuMy03MSw0NS42LTgyLjlDMTgzLjQsNjQuMSwxOTAuOCw1NCwxOTIuNyw1NHoiLz4NCjwvc3ZnPg0K'));
                            if ($product_image) echo $product_image; else { echo '<div class="hidden-image"></div>'; $skip_min_height = true; } ?><!--/product_image--><!--product_title-->
          <h4 class="u-product-control u-text u-text-1">
            <a class="u-product-title-link" href="<?php the_permalink(); ?>"><?php echo $product->get_title(); ?></a>
          </h4><!--/product_title--><!--product_price-->
          <div class="u-product-control u-product-price u-product-price-1">
            <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
              <div class="u-hide-price u-old-price"><?php if ($product->get_regular_price() !== '') { echo $product_prices['old_price']; } ?></div><!--/product_old_price--><!--product_regular_price-->
              <div class="u-price u-text-palette-2-base" style="font-size: 1.25rem; font-weight: 700;"><?php if ($product->get_price() !== '') { echo $product_prices['new_price']; } ?></div><!--/product_regular_price-->
            </div>
          </div><!--/product_price--><?php
$clickTypeProductbutton = 'add-to-cart';
$contentProductbutton = 'Add to Cart';
?>

          <?php $post->clickTypeProductbutton = $clickTypeProductbutton; $post->classProductButton = 'u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-1';
	          $post->contentProductbutton = $contentProductbutton; ob_start(); ?>
            <a href="<?php the_permalink(); ?>" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-1"><!--product_button_content-->%s<!--/product_button_content--></a>
            <?php $post->htmlProductbutton = trim(ob_get_clean()); do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
      </div><!--/product_item--><?php } ?><?php if ($templateOrder == 1) { ?><!--product_item-->
      <?php $product = wc_get_product($post->ID); $product_prices = get_product_prices($product); $productItemInvisible = !wp_get_attachment_image_url($product->get_image_id()) ? true : false; ?><div class="u-align-center u-container-style u-products-item u-repeater-item u-white u-repeater-item-2">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2"><!--product_image-->
          <?php
                            $product_image = theme_get_post_image(array('class' => 'u-expanded-width u-image u-image-default u-product-control u-image-2', 'default' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0ibWFuIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjI1NnB4IiBoZWlnaHQ9IjI1NnB4IiB2aWV3Qm94PSIwIDAgMjU2IDI1NiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjU2IDI1NiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8cmVjdCBmaWxsPSIjQzZEOEUxIiB3aWR0aD0iMjU2IiBoZWlnaHQ9IjI1NiIvPg0KPHBhdGggZmlsbD0iIzdGOTZBNiIgZD0iTTE4Ny43LDEyMS42Yy0xLjgtMS44LTIuMS0xMi42LTYtMTMuN2MtMy45LDYuNiwwLjksOTkuMy0wLjYsMTAzLjFjLTEuMSw4LjgtNTMuOCwxOS44LTEwMy40LDUuNw0KCWMtMi4yLTAuOC02LjItMS43LTcuMy0zLjdjMi4xLTgsNS4xLTgyLjMsMS4xLTEwMS42Yy0xLjksMi44LTMuMyw2LjEtNS42LDguNmMwLDAtMjAuNCwxLjctMzQuNS0xMy4yYzAsMCw5LjQtMjQuNSwxMi43LTMxLjQNCgljMS41LTUsMy44LTkuOSw2LjUtMTQuMmM1LTgsMTEuOS0xMS4yLDIwLjgtMTMuNEM5NS45LDQxLjUsOTguOCwzNiwxMDYuMSwzM2MyLjUsMy42LDExLjgsNiwxNy45LDYuNmMxNC4xLDEuNCwyNi4yLTcuMSwyNi41LTYuOQ0KCWMyLjIsMS43LDYuMSw0LjMsOC41LDUuNWMxMC40LDUsMjIuNCw1LjQsMzIuNiwxMC45YzAsMCwxMy43LDMuNCwyMS43LDMxLjhsMTEsMjguMUMyMjQuNSwxMDksMjEyLjUsMTI0LjUsMTg3LjcsMTIxLjZ6Ii8+DQo8cGF0aCBmaWxsPSIjQzZEOEUxIiBkPSJNNjEuMiw1MC42bC0zLjgsMS4zbDAuMywwLjljMC4xLDAuNCwxMS43LDM5LjksMTAuNSw2My4ybC0wLjEsMWw0LDAuMmwwLjEtMUM3My40LDkyLDYxLjYsNTIsNjEuNSw1MS42DQoJTDYxLjIsNTAuNnoiLz4NCjxwYXRoIGZpbGw9IiNDNkQ4RTEiIGQ9Ik0xOTgsNDguOGwtMy44LTEuNGwtMC4zLDFjLTAuNSwxLjctMTMuMSw0Mi41LTEyLjgsNjMuNnYxbDQtMC4xdi0xYy0wLjMtMjAuNSwxMi41LTYxLjksMTIuNi02Mi4zTDE5OCw0OC44DQoJeiIvPg0KPHBhdGggZmlsbD0iI0M2RDhFMSIgZD0iTTE1NC40LDM1LjNjLTAuMSwwLjItNi43LDE3LjYtMzEuOSwxNi43Yy0xNS0xLjItMjAuOS0xMC42LTIyLjEtMTZsLTAuMi0xbC00LDAuOGwwLjIsMQ0KCWMxLjQsNi41LDguMywxNy44LDI1LjgsMTkuMmMwLjQsMCwwLjksMCwxLjMsMGwwLDBjMC4yLDAsMC40LDAsMC42LDBjMjIuNywwLDMyLjQtMTQuNCwzNC0xOS41bDAuMy0xbC0zLjgtMS4yTDE1NC40LDM1LjN6Ii8+DQo8L3N2Zz4NCg=='));
                            if ($product_image) echo $product_image; else { echo '<div class="hidden-image"></div>'; $skip_min_height = true; } ?><!--/product_image--><!--product_title-->
          <h4 class="u-product-control u-text u-text-2">
            <a class="u-product-title-link" href="<?php the_permalink(); ?>"><?php echo $product->get_title(); ?></a>
          </h4><!--/product_title--><!--product_price-->
          <div class="u-product-control u-product-price u-product-price-2">
            <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
              <div class="u-hide-price u-old-price"><?php if ($product->get_regular_price() !== '') { echo $product_prices['old_price']; } ?></div><!--/product_old_price--><!--product_regular_price-->
              <div class="u-price u-text-palette-2-base" style="font-size: 1.25rem; font-weight: 700;"><?php if ($product->get_price() !== '') { echo $product_prices['new_price']; } ?></div><!--/product_regular_price-->
            </div>
          </div><!--/product_price--><?php
$clickTypeProductbutton = 'add-to-cart';
$contentProductbutton = 'Add to Cart';
?>

          <?php $post->clickTypeProductbutton = $clickTypeProductbutton; $post->classProductButton = 'u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-2';
	          $post->contentProductbutton = $contentProductbutton; ob_start(); ?>
            <a href="<?php the_permalink(); ?>" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-2"><!--product_button_content-->%s<!--/product_button_content--></a>
            <?php $post->htmlProductbutton = trim(ob_get_clean()); do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
      </div><!--/product_item--><?php } ?><?php if ($templateOrder == 2) { ?><!--product_item-->
      <?php $product = wc_get_product($post->ID); $product_prices = get_product_prices($product); $productItemInvisible = !wp_get_attachment_image_url($product->get_image_id()) ? true : false; ?><div class="u-align-center u-container-style u-products-item u-repeater-item u-white u-repeater-item-3">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3"><!--product_image-->
          <?php
                            $product_image = theme_get_post_image(array('class' => 'u-expanded-width u-image u-image-default u-product-control u-image-3', 'default' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0ibWFuIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjI1NnB4IiBoZWlnaHQ9IjI1NnB4IiB2aWV3Qm94PSIwIDAgMjU2IDI1NiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjU2IDI1NiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8cmVjdCBmaWxsPSIjQzZEOEUxIiB3aWR0aD0iMjU2IiBoZWlnaHQ9IjI1NiIvPg0KPHBhdGggZmlsbD0iIzdGOTZBNiIgZD0iTTIwOC42LDEzMWMwLjYsMC4yLDEuMiwwLjMsMS45LDAuM2MyLjUsMCw0LjctMS40LDUuNi0zLjZjMS0yLjgtMC42LTUuOC0zLjctNi43bC0yNi4yLTcuOGwxNi43LTE1LjENCgljMi4zLTIuMSwyLjMtNS40LDAtNy41cy02LTIuMS04LjMsMGwtMTMuNywxMi4zQzE3OS43LDgzLjUsMTYyLDY4LDE0MC4xLDY4aC0yNC4yYy0yMi42LDAtNDEsMTYuNi00MSwzNi45djE1LjhoOTkuNEwyMDguNiwxMzF6DQoJIE0yMzAsMTY0LjVsLTM2LjktMzMuMkg3MC4zbC0zNi45LDMzLjJjLTEuNywxLjUtMi4yLDMuOC0xLjMsNS43YzAuOSwyLDMsMy4zLDUuNCwzLjNoMzYuOGMxMy44LDAsMjcuMiwyLjMsMzkuOCw2LjkNCgljMTQuMSw1LjEsMjkuOCw3LjYsNDQuOCw3LjZjMTIuNywwLDI1LjUtMS44LDM3LjctNS41bDMxLjEtOS4zYzEuOS0wLjYsMy40LTIsMy45LTMuOEMyMzIsMTY3LjYsMjMxLjQsMTY1LjgsMjMwLDE2NC41eiIvPg0KPC9zdmc+DQo='));
                            if ($product_image) echo $product_image; else { echo '<div class="hidden-image"></div>'; $skip_min_height = true; } ?><!--/product_image--><!--product_title-->
          <h4 class="u-product-control u-text u-text-3">
            <a class="u-product-title-link" href="<?php the_permalink(); ?>"><?php echo $product->get_title(); ?></a>
          </h4><!--/product_title--><!--product_price-->
          <div class="u-product-control u-product-price u-product-price-3">
            <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
              <div class="u-hide-price u-old-price"><?php if ($product->get_regular_price() !== '') { echo $product_prices['old_price']; } ?></div><!--/product_old_price--><!--product_regular_price-->
              <div class="u-price u-text-palette-2-base" style="font-size: 1.25rem; font-weight: 700;"><?php if ($product->get_price() !== '') { echo $product_prices['new_price']; } ?></div><!--/product_regular_price-->
            </div>
          </div><!--/product_price--><?php
$clickTypeProductbutton = 'add-to-cart';
$contentProductbutton = 'Add to Cart';
?>

          <?php $post->clickTypeProductbutton = $clickTypeProductbutton; $post->classProductButton = 'u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-3';
	          $post->contentProductbutton = $contentProductbutton; ob_start(); ?>
            <a href="<?php the_permalink(); ?>" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-3"><!--product_button_content-->%s<!--/product_button_content--></a>
            <?php $post->htmlProductbutton = trim(ob_get_clean()); do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
      </div><!--/product_item--><?php } ?><?php if ($templateOrder == 3) { ?><!--product_item-->
      <?php $product = wc_get_product($post->ID); $product_prices = get_product_prices($product); $productItemInvisible = !wp_get_attachment_image_url($product->get_image_id()) ? true : false; ?><div class="u-align-center u-container-style u-products-item u-repeater-item u-white u-repeater-item-4">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-4"><!--product_image-->
          <?php
                            $product_image = theme_get_post_image(array('class' => 'u-expanded-width u-image u-image-default u-product-control u-image-4', 'default' => 'data:image/svg+xml;base64,DQoNCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0ibWFuIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjI1NnB4IiBoZWlnaHQ9IjI1NnB4IiB2aWV3Qm94PSIwIDAgMjU2IDI1NiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjU2IDI1NiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8cmVjdCBmaWxsPSIjQzZEOEUxIiB3aWR0aD0iMjU2IiBoZWlnaHQ9IjI1NiIvPg0KPGc+DQoJPHBhdGggZmlsbD0iIzdGOTZBNiIgZD0iTTIyNi4xLDEwMGMtMS4yLTEuMi0yLjktMS45LTQuNy0xLjljLTIuMSwwLTQuMSwwLjktNS43LDIuNWwtMjUuMSwyNS42Yy0wLjIsMC4yLTAuNiwwLjUtMC45LDAuNQ0KCQljLTAuMiwwLTAuNC0wLjEtMC40LTAuMWwtMi44LTIuOGMtMC40LTAuNC0wLjctMSwwLTEuN0wyMTgsOTBjMy0zLjEsMy4yLTcuOCwwLjUtMTAuNmMtMS4yLTEuMi0yLjktMS45LTQuNy0xLjkNCgkJYy0yLjEsMC00LjEsMC45LTUuNywyLjVsLTMxLjQsMzJjLTAuNiwwLjYtMC45LDAuNy0xLDAuN2wtMy42LTMuN2MtMC4xLTAuMiwwLTAuNiwwLjUtMS4xbDM3LTM3LjhjMy0zLjEsMy4yLTcuOCwwLjUtMTAuNg0KCQljLTEuMi0xLjItMi45LTEuOS00LjctMS45Yy0yLjEsMC00LjEsMC45LTUuNywyLjVsLTM3LDM3LjhjLTAuMywwLjQtMC43LDAuNS0wLjksMC41Yy0wLjEsMC0wLjIsMC0wLjItMC4xbC0zLjItMy4zDQoJCWMtMC4xLTAuMy0wLjMtMC44LDAuMy0xLjRsMzIuNi0zMy4zYzMtMy4xLDMuMi03LjgsMC41LTEwLjZjLTEuMi0xLjItMi45LTEuOS00LjctMS45Yy0yLjEsMC00LjEsMC45LTUuNywyLjVMMTQ2LDg2LjlsMC44LTEwLjMNCgkJYzAuMi0yLjgtMC40LTUuMy0xLjctNy4ybDAsMGMtMS41LTIuNC00LjEtMy43LTcuMy0zLjdsLTAuMSwwYy0yLjgsMC02LjksMi4zLTcuNCw2LjZjLTAuMSwwLjktMC4yLDEuOS0wLjQsMw0KCQljLTEuNiwxMy43LTQuMiwzNi43LTEwLjgsNDYuMmMtNC45LDcuMS0yNS45LDIyLjEtMjYuMSwyMi4zbC0wLjEsMC4xYy0wLjQsMC40LTAuNywwLjktMC43LDEuNGMwLDAuNiwwLjIsMS4xLDAuNiwxLjVsNDcuMiw0OC41DQoJCWMwLjQsMC40LDAuOSwwLjYsMS40LDAuNmwwLjEsMGMwLjUsMCwxLjEtMC4zLDEuNC0wLjdsMC4xLTAuMWMwLjEtMC4yLDE0LjMtMjAuOCwyMC4xLTI2LjljMi42LTIuNyw1LjctNC40LDktNi4yDQoJCWMzLjMtMS44LDYuOC0zLjYsOS44LTYuN2w0My43LTQ0LjZDMjI4LjYsMTA3LjUsMjI4LjgsMTAyLjgsMjI2LjEsMTAweiIvPg0KCTxwYXRoIGZpbGw9IiM3Rjk2QTYiIGQ9Ik0xMjEuNiwxODMuNGwtMzMtMzMuOWMtMS4yLTEuMi0xLjgtMi45LTEuNy00LjZjMC4xLTEuNywwLjktMy40LDIuMi00LjVsMC4zLTAuMw0KCQljNS43LTQuMSwyMS40LTE1LjksMjUuMS0yMS4zYzQtNS44LDUuOS0xNC40LDcuNS0yNS41YzAuNC0xLjgsMC40LTMtMC4yLTMuN2MtMC4zLTAuNC0wLjgtMC42LTEuMy0wLjZjLTAuMiwwLTAuNCwwLTAuNiwwLjENCgkJYy0wLjcsMC4zLTEuMiwwLjYtMS40LDAuOGwwLDBjLTEuOSwxLjItMy41LDMuMy00LjMsNmwtMy4yLDkuOEw5MS45LDU4LjFjLTEuMi0zLTQtNS4xLTYuOS01LjFjLTAuOCwwLTEuNiwwLjItMi40LDAuNQ0KCQljLTEuNywwLjctMywyLjItMy43LDQuMWMtMC42LDEuOS0wLjYsMy45LDAuMiw1LjlMOTYuNSwxMDdjMC4zLDAuNy0wLjEsMS4yLTAuMiwxLjRsLTQuMiwxLjdjMCwwLDAsMC0wLjEsMA0KCQljLTAuNCwwLTAuNy0wLjYtMC44LTAuOUw3MS40LDU5LjhjLTEuMi0zLTQtNS4xLTYuOS01LjFjLTAuOCwwLTEuNiwwLjItMi40LDAuNWMtMS43LDAuNy0zLDIuMi0zLjcsNC4xYy0wLjYsMS45LTAuNiwzLjksMC4yLDUuOQ0KCQlsMTkuOCw0OS40YzAuMywwLjcsMC4yLDEuMSwwLDEuM2wtNC43LDJsMCwwYy0wLjEtMC4xLTAuNC0wLjMtMC42LTFMNTYuMyw3NC45Yy0xLjItMy00LTUuMS02LjktNS4xYy0wLjgsMC0xLjYsMC4yLTIuNCwwLjUNCgkJYy0zLjUsMS41LTUuMSw1LjktMy41LDkuOWwxNi44LDQxLjljMC40LDAuOS0wLjEsMS4zLTAuNiwxLjVsLTMuNiwxLjVjMCwwLTAuMSwwLTAuMiwwYzAsMCwwLDAsMCwwYy0wLjEsMC0wLjUsMC0wLjktMC45DQoJCUw0MS41LDkwLjhjLTEuMi0zLTQtNS4xLTYuOS01LjFjLTAuOCwwLTEuNiwwLjItMi40LDAuNWMtMy41LDEuNS01LjEsNS45LTMuNSw5LjlMNTIsMTU0LjVjMS42LDQsNC4xLDcsNi41LDEwDQoJCWMyLjQsMi45LDQuNiw1LjcsNiw5LjJjMy4xLDcuOSw4LjMsMzIuNSw4LjMsMzIuN2wwLDAuMWMwLjIsMC41LDAuNSwxLDEsMS4yYzAuMywwLjEsMC41LDAuMiwwLjgsMC4yYzAuMywwLDAuNS0wLjEsMC43LTAuMg0KCQljMC4zLTAuMSwzNC40LTE0LjcsNDUuOC0xOS4yYzEuNC0wLjYsMS44LTEuNCwxLjktMi4xQzEyMy40LDE4NSwxMjIsMTgzLjcsMTIxLjYsMTgzLjR6Ii8+DQo8L2c+DQo8L3N2Zz4NCg=='));
                            if ($product_image) echo $product_image; else { echo '<div class="hidden-image"></div>'; $skip_min_height = true; } ?><!--/product_image--><!--product_title-->
          <h4 class="u-product-control u-text u-text-4">
            <a class="u-product-title-link" href="<?php the_permalink(); ?>"><?php echo $product->get_title(); ?></a>
          </h4><!--/product_title--><!--product_price-->
          <div class="u-product-control u-product-price u-product-price-4">
            <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
              <div class="u-hide-price u-old-price"><?php if ($product->get_regular_price() !== '') { echo $product_prices['old_price']; } ?></div><!--/product_old_price--><!--product_regular_price-->
              <div class="u-price u-text-palette-2-base" style="font-size: 1.25rem; font-weight: 700;"><?php if ($product->get_price() !== '') { echo $product_prices['new_price']; } ?></div><!--/product_regular_price-->
            </div>
          </div><!--/product_price--><?php
$clickTypeProductbutton = 'add-to-cart';
$contentProductbutton = 'Add to Cart';
?>

          <?php $post->clickTypeProductbutton = $clickTypeProductbutton; $post->classProductButton = 'u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-4';
	          $post->contentProductbutton = $contentProductbutton; ob_start(); ?>
            <a href="<?php the_permalink(); ?>" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-4"><!--product_button_content-->%s<!--/product_button_content--></a>
            <?php $post->htmlProductbutton = trim(ob_get_clean()); do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
      </div><!--/product_item--><?php } ?><?php if ($templateOrder == 4) { ?><!--product_item-->
      <?php $product = wc_get_product($post->ID); $product_prices = get_product_prices($product); $productItemInvisible = !wp_get_attachment_image_url($product->get_image_id()) ? true : false; ?><div class="u-align-center u-container-style u-products-item u-repeater-item u-white u-repeater-item-5">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-5"><!--product_image-->
          <?php
                            $product_image = theme_get_post_image(array('class' => 'u-expanded-width u-image u-image-default u-product-control u-image-5', 'default' => 'data:image/svg+xml;base64,DQoNCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0ibWFuIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjI1NnB4IiBoZWlnaHQ9IjI1NnB4IiB2aWV3Qm94PSIwIDAgMjU2IDI1NiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjU2IDI1NiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8cmVjdCBmaWxsPSIjQzZEOEUxIiB3aWR0aD0iMjU2IiBoZWlnaHQ9IjI1NiIvPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGZpbGw9IiM3Rjk2QTYiIGQ9Ik01MS44LDEyOC40YzMuNC0xMS41LDkuNC0yMS45LDE3LjUtMjkuOWwxMS40LTExLjN2LTQuN2MwLTIuOSwyLjEtNS4zLDQuNy01LjNjMi42LDAsNC43LDIuMyw0LjcsNS4zdjQuNw0KCQkJbDExLjQsMTEuM2M4LjIsOCwxNC4yLDE4LjQsMTcuNSwyOS45bDMuNC0yNy44YzEuNC0xMi4xLTEuOC0yNC4yLTguOS0zMy40Yy03LjEtOS4yLTE3LjQtMTQuNC0yOC4yLTE0LjRTNjQuNSw1OCw1Ny40LDY3LjINCgkJCWMtNy4xLDkuMi0xMC41LDIxLjMtOSwzMy40TDUxLjgsMTI4LjR6Ii8+DQoJCTxwYXRoIGZpbGw9IiM3Rjk2QTYiIGQ9Ik0xMTAuNSwxMzIuOWMtMi43LTEwLjMtNy45LTE5LjQtMTUuMS0yNi41bC05LjktOS44bC05LjksOS44Yy03LjIsNy0xMi40LDE2LjItMTUuMSwyNi41bC01LjgsMjEuOA0KCQkJYzAuNywxMCwxLjEsMjAsMS4xLDI5LjljMCwxOC40LDEzLjMsMzMuNCwyOS43LDMzLjRzMjkuNy0xNC45LDI5LjctMzMuNGMwLTEwLDAuNC0yMCwxLjEtMjkuOUwxMTAuNSwxMzIuOXoiLz4NCgk8L2c+DQoJPGc+DQoJCTxwYXRoIGZpbGw9IiM3Rjk2QTYiIGQ9Ik0yMDQuNCwxMjcuNmMtMy40LDExLjUtOS40LDIxLjktMTcuNSwyOS45bC0xMS40LDExLjN2NC43YzAsMi45LTIuMSw1LjMtNC43LDUuM2MtMi42LDAtNC43LTIuMy00LjctNS4zDQoJCQl2LTQuN2wtMTEuNC0xMS4zYy04LjItOC0xNC4yLTE4LjQtMTcuNS0yOS45bC0zLjQsMjcuOGMtMS40LDEyLjEsMS44LDI0LjIsOC45LDMzLjRjNy4xLDkuMiwxNy40LDE0LjQsMjguMiwxNC40DQoJCQlzMjEuMS01LjIsMjguMi0xNC40YzcuMS05LjIsMTAuMy0yMS4zLDguOS0zMy40TDIwNC40LDEyNy42eiIvPg0KCQk8cGF0aCBmaWxsPSIjN0Y5NkE2IiBkPSJNMTQ1LjcsMTIzLjFjMi43LDEwLjMsNy45LDE5LjQsMTUuMSwyNi41bDkuOSw5LjhsOS45LTkuOGM3LjItNywxMi40LTE2LjIsMTUuMS0yNi41bDUuOC0yMS44DQoJCQljLTAuNy0xMC0xLjEtMjAtMS4xLTI5LjljMC0xOC41LTEzLjMtMzMuNC0yOS43LTMzLjRTMTQxLDUyLjksMTQxLDcxLjRjMCwxMC0wLjQsMjAtMS4xLDI5LjlMMTQ1LjcsMTIzLjF6Ii8+DQoJPC9nPg0KPC9nPg0KPC9zdmc+DQo='));
                            if ($product_image) echo $product_image; else { echo '<div class="hidden-image"></div>'; $skip_min_height = true; } ?><!--/product_image--><!--product_title-->
          <h4 class="u-product-control u-text u-text-5">
            <a class="u-product-title-link" href="<?php the_permalink(); ?>"><?php echo $product->get_title(); ?></a>
          </h4><!--/product_title--><!--product_price-->
          <div class="u-product-control u-product-price u-product-price-5">
            <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
              <div class="u-hide-price u-old-price"><?php if ($product->get_regular_price() !== '') { echo $product_prices['old_price']; } ?></div><!--/product_old_price--><!--product_regular_price-->
              <div class="u-price u-text-palette-2-base" style="font-size: 1.25rem; font-weight: 700;"><?php if ($product->get_price() !== '') { echo $product_prices['new_price']; } ?></div><!--/product_regular_price-->
            </div>
          </div><!--/product_price--><?php
$clickTypeProductbutton = 'add-to-cart';
$contentProductbutton = 'Add to Cart';
?>

          <?php $post->clickTypeProductbutton = $clickTypeProductbutton; $post->classProductButton = 'u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-5';
	          $post->contentProductbutton = $contentProductbutton; ob_start(); ?>
            <a href="<?php the_permalink(); ?>" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-5"><!--product_button_content-->%s<!--/product_button_content--></a>
            <?php $post->htmlProductbutton = trim(ob_get_clean()); do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
      </div><!--/product_item--><?php } ?><?php if ($templateOrder == 5) { ?><!--product_item-->
      <?php $product = wc_get_product($post->ID); $product_prices = get_product_prices($product); $productItemInvisible = !wp_get_attachment_image_url($product->get_image_id()) ? true : false; ?><div class="u-align-center u-container-style u-products-item u-repeater-item u-white u-repeater-item-6">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-6"><!--product_image-->
          <?php
                            $product_image = theme_get_post_image(array('class' => 'u-expanded-width u-image u-image-default u-product-control u-image-6', 'default' => 'data:image/svg+xml;base64,DQoNCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0ibWFuIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjI1NnB4IiBoZWlnaHQ9IjI1NnB4IiB2aWV3Qm94PSIwIDAgMjU2IDI1NiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjU2IDI1NiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8cmVjdCBmaWxsPSIjQzZEOEUxIiB3aWR0aD0iMjU2IiBoZWlnaHQ9IjI1NiIvPg0KPGc+DQoJPHBhdGggZmlsbD0iIzdGOTZBNiIgZD0iTTIwNy45LDE5NS40TDE4Miw5Ni41Yy0wLjUtMS44LTEuNS00LjUtMi40LTYuMWwtNy40LTE0LjJjLTEtMS44LTMuNC0zLjQtNS41LTMuNEg4OS41DQoJCWMtMi4xLDAtNC42LDEuNC01LjUsMy40bC03LjYsMTQuNmMtMC44LDEuNi0xLjksNC4zLTIuNCw2LjFsLTI1LjksOTguNWMtMC4zLDEuMS0wLjEsMi4yLDAuNiwzYzAuNywwLjgsMS43LDEuMywyLjgsMS4zaDUuOA0KCQljMS42LDAsNC4xLDAuNiw1LjUsMS40bDExLjIsNi4yYzAuOSwwLjUsMiwwLjcsMy4zLDAuN3MyLjQtMC4yLDMuMy0wLjdsMTEuMi02LjJjMC42LTAuMywxLjUtMC41LDIuNC0wLjVjMC45LDAsMS43LDAuMiwyLjQsMC41DQoJCWwxMS4yLDYuMmMwLjksMC41LDIsMC43LDMuMywwLjdzMi40LTAuMiwzLjMtMC43bDExLjItNi4yYzAuNi0wLjMsMS41LTAuNSwyLjQtMC41YzAuOSwwLDEuNywwLjIsMi40LDAuNWwxMS4yLDYuMg0KCQljMC45LDAuNSwyLDAuNywzLjMsMC43YzEuMiwwLDIuNC0wLjIsMy4zLTAuN2wxMS4yLTYuMmMwLjYtMC4zLDEuNS0wLjUsMi40LTAuNXMxLjcsMC4yLDIuNCwwLjVsMTEuMiw2LjJjMC45LDAuNSwyLDAuNywzLjMsMC43DQoJCWMxLjIsMCwyLjQtMC4yLDMuMy0wLjdsMTEuMi02LjJjMS40LTAuOCwzLjktMS40LDUuNS0xLjRoNS44YzEuMSwwLDIuMi0wLjUsMi44LTEuM0MyMDgsMTk3LjUsMjA4LjEsMTk2LjQsMjA3LjksMTk1LjR6Ii8+DQoJPHBhdGggZmlsbD0iIzdGOTZBNiIgZD0iTTg4LjksNjYuN2g3OC4zYzEuNiwwLDMtMS40LDMtM1Y1MWMwLTEuNi0xLjQtMy0zLTNIODguOWMtMS42LDAtMywxLjQtMywzdjEyLjgNCgkJQzg1LjksNjUuNCw4Ny4zLDY2LjcsODguOSw2Ni43eiBNMTE4LjgsNTMuOGMwLTEuMywxLjEtMi40LDIuNC0yLjRoMTMuN2MxLjMsMCwyLjQsMSwyLjQsMi40djcuMWMwLDEuMy0xLjEsMi40LTIuNCwyLjRoLTEzLjcNCgkJYy0xLjMsMC0yLjQtMS0yLjQtMi40VjUzLjh6Ii8+DQoJPHJlY3QgeD0iMTIyLjgiIHk9IjU1LjQiIGZpbGw9IiM3Rjk2QTYiIHdpZHRoPSIxMC40IiBoZWlnaHQ9IjMuOSIvPg0KPC9nPg0KPC9zdmc+DQo='));
                            if ($product_image) echo $product_image; else { echo '<div class="hidden-image"></div>'; $skip_min_height = true; } ?><!--/product_image--><!--product_title-->
          <h4 class="u-product-control u-text u-text-6">
            <a class="u-product-title-link" href="<?php the_permalink(); ?>"><?php echo $product->get_title(); ?></a>
          </h4><!--/product_title--><!--product_price-->
          <div class="u-product-control u-product-price u-product-price-6">
            <div class="u-price-wrapper u-spacing-10"><!--product_old_price-->
              <div class="u-hide-price u-old-price"><?php if ($product->get_regular_price() !== '') { echo $product_prices['old_price']; } ?></div><!--/product_old_price--><!--product_regular_price-->
              <div class="u-price u-text-palette-2-base" style="font-size: 1.25rem; font-weight: 700;"><?php if ($product->get_price() !== '') { echo $product_prices['new_price']; } ?></div><!--/product_regular_price-->
            </div>
          </div><!--/product_price--><?php
$clickTypeProductbutton = 'add-to-cart';
$contentProductbutton = 'Add to Cart';
?>

          <?php $post->clickTypeProductbutton = $clickTypeProductbutton; $post->classProductButton = 'u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-6';
	          $post->contentProductbutton = $contentProductbutton; ob_start(); ?>
            <a href="<?php the_permalink(); ?>" class="u-border-2 u-border-grey-25 u-btn u-btn-rectangle u-button-style u-none u-product-control u-text-body-color u-btn-6"><!--product_button_content-->%s<!--/product_button_content--></a>
            <?php $post->htmlProductbutton = trim(ob_get_clean()); do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
      </div><!--/product_item--><?php } ?><?php } ?>
    </div>
  </div>
</section><?php if ($skip_min_height) { echo "<style> .u-section-1, .u-section-1 .u-sheet {min-height: auto;}</style>"; } ?>