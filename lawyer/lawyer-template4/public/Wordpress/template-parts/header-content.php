<header class="u-clearfix u-header u-header" id="sec-d12e">
  <div class="u-clearfix u-sheet u-sheet-1">
    <?php
            ob_start();
            ?><nav class="u-align-left u-menu u-menu-hamburger u-offcanvas u-menu-1" data-responsive-from="XL">
      <div class="menu-collapse">
        <a class="u-button-style u-nav-link" href="#" style="padding: 4px 0px; font-size: calc(1em + 8px);">
          <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 302 302" style=""><use xlink:href="#svg-5c50"></use></svg>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-5c50" x="0px" y="0px" viewBox="0 0 302 302" style="enable-background:new 0 0 302 302;" xml:space="preserve" class="u-svg-content"><g><rect y="36" width="302" height="30"></rect><rect y="236" width="302" height="30"></rect><rect y="136" width="302" height="30"></rect>
</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
        </a>
      </div>
      <div class="u-custom-menu u-nav-container">
        {menu}
      </div>
      <div class="u-custom-menu u-nav-container-collapse">
        <div class="u-align-center u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
          <div class="u-inner-container-layout u-sidenav-overflow">
            <div class="u-menu-close"></div>
            {responsive_menu}
          </div>
        </div>
        <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
      </div>
    </nav><?php
            $megaMenuOptionsPath = get_theme_file_path('/template-parts/menu/mega-menu-primary-navigation-1.json');
            $megaMenu = file_exists($megaMenuOptionsPath) ? file_get_contents($megaMenuOptionsPath) : '{}';
            $menu_template = ob_get_clean();
            echo Theme_NavMenu::getMenuHtml(array(
                'container_class' => 'u-align-left u-menu u-menu-hamburger u-offcanvas u-menu-1',
                'menu' => array(
                    'is_mega_menu' => false,
                    'menu_class' => 'u-nav u-unstyled u-nav-1',
                    'item_class' => 'u-nav-item',
                    'link_class' => 'u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base',
                    'link_style' => 'padding: 10px 20px;',
                    'submenu_class' => 'u-h-spacing-20 u-nav u-unstyled u-v-spacing-10 u-block-ac67-19',
                    'submenu_item_class' => 'u-nav-item',
                    'submenu_link_class' => 'u-button-style u-nav-link u-white',
                    'submenu_link_style' => '',
                ),
                'responsive_menu' => array(
                    'is_mega_menu' => false,
                    'menu_class' => 'u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2',
                    'item_class' => 'u-nav-item',
                    'link_class' => 'u-button-style u-nav-link',
                    'link_style' => '',
                    'submenu_class' => 'u-h-spacing-20 u-nav u-unstyled u-v-spacing-10 u-block-ac67-17',
                    'submenu_item_class' => 'u-nav-item',
                    'submenu_link_class' => 'u-button-style u-nav-link u-white',
                    'submenu_link_style' => '',
                ),
                'theme_location' => 'primary-navigation-1',
                'template' => $menu_template,
                'mega_menu' => $megaMenu,
            )); ?>
  </div>
</header>