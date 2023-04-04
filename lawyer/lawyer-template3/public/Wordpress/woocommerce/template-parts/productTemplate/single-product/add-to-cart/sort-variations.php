<?php
global $post;
global $product;
global $product_custom_template;
$product_custom_template = $product_custom_template ? $product_custom_template : 'productTemplate';

$addVariations = isset($post->addVariations) ? $post->addVariations : false;