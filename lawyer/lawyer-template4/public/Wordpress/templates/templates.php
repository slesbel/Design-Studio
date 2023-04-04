<?php theme_register_template('Blog Template', 'blogTemplate', 'templates/blog.php'); ?>
<?php theme_register_template('Post Template', 'postTemplate', 'templates/post.php'); ?>
<?php theme_register_template('404 Template', 'page404Template', 'templates/page404.php'); ?>
<?php theme_register_template('Login Template', 'pageLoginTemplate', 'templates/pageLogin.php'); ?>
<?php if (theme_woocommerce_enabled()) theme_register_template('Product Template', 'productTemplate', 'templates/product.php'); ?>
<?php if (theme_woocommerce_enabled()) theme_register_template('Products Template', 'productsTemplate', 'templates/products.php'); ?>
<?php if (theme_woocommerce_enabled()) theme_register_template('Shopping Cart Template', 'shoppingCartTemplate', 'templates/cart.php'); ?>