<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<style>
    @media (max-width: 768px) {
        .main-navigation .menu > li > .sub-menu,
        .secondary-navigation .menu > li > .sub-menu,
        .site-header-cart .widget_shopping_cart,
        .account .sub-menu {
            display: none;
        }
        
        .dropdown-open > .sub-menu,
        .dropdown-open > .children,
        .site-header-cart.dropdown-open .widget_shopping_cart {
            display: block !important;
        }
    }
</style>
<script>
jQuery(document).ready(function($) {
    // Function to check if device is mobile or tablet
    function isMobileOrTablet() {
        return window.innerWidth <= 768; // Adjust this value as needed
    }

    // Function to handle dropdown toggle
    function toggleDropdown(e) {
        if (isMobileOrTablet()) {
            var $this = $(this);
            var $dropdown = $this.find('.sub-menu, .children');

            if ($dropdown.length) {
                if (!$this.hasClass('dropdown-open')) {
                    e.preventDefault();
                    $this.addClass('dropdown-open');
                    $dropdown.slideDown(200);
                } else {
                    // If dropdown is already open, allow default link behavior
                    $this.removeClass('dropdown-open');
                    $dropdown.slideUp(200);
                }
            }
        }
    }

    // Apply to main navigation items
    $('.main-navigation .menu > li > a, .secondary-navigation .menu > li > a').on('click', toggleDropdown);

    // Apply to cart and account links (adjust selectors as needed)
    $('.site-header-cart > li > a, .account > a').on('click', toggleDropdown);

    // Close dropdowns when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.main-navigation, .secondary-navigation, .site-header-cart, .account').length) {
            $('.dropdown-open').removeClass('dropdown-open').find('.sub-menu, .children').slideUp(200);
        }
    });

    // Handle window resize
    $(window).on('resize', function() {
        if (!isMobileOrTablet()) {
            $('.dropdown-open').removeClass('dropdown-open').find('.sub-menu, .children').removeAttr('style');
        }
    });
});
</script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'storefront_before_site' ); ?>
<div id="page" class="hfeed site">
    <?php do_action( 'storefront_before_header' ); ?>
    <header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
        <?php
        /**
         * Functions hooked into storefront_header action
         *
         * @hooked storefront_header_container                 - 0
         * @hooked storefront_skip_links                       - 5
         * @hooked storefront_social_icons                     - 10
         * @hooked storefront_site_branding                    - 20
         * @hooked storefront_secondary_navigation             - 30
         * @hooked storefront_product_search                   - 40
         * @hooked storefront_header_container_close           - 41
         * @hooked storefront_primary_navigation_wrapper       - 42
         * @hooked storefront_primary_navigation               - 50
         * @hooked storefront_header_cart                      - 60
         * @hooked storefront_primary_navigation_wrapper_close - 68
         */
        do_action( 'storefront_header' );
        ?>
    </header><!-- #masthead -->
    <?php
    /**
     * Functions hooked in to storefront_before_content
     *
     * @hooked storefront_header_widget_region - 10
     * @hooked woocommerce_breadcrumb - 10
     */
    do_action( 'storefront_before_content' );
    ?>
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
        <?php
        do_action( 'storefront_content_top' );