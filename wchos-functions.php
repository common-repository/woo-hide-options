<?php
/**
 *  Hide condition for Product title Product details page
 **/

    $hideSkuFrontBack = get_option( 'wc_hide_options_settings_hide_title' );
    if($hideSkuFrontBack == 'yes'){
        
        add_action('init','wcHideProductTitleOnDetailsPage');
        function wcHideProductTitleOnDetailsPage(){
           remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); 
        }
        
    }
    
/**
 *  Hide condition for Add To Cart Button Product details page
 **/

    $hideAddToCatrButton = get_option( 'wc_hide_options_settings_hide_add_to_cart_button' );
    if($hideAddToCatrButton == 'yes'){
        
        add_action('init','wcHideAddToCartButton');
        function wcHideAddToCartButton(){
           remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        }
        
    }
    

/**
 *  Hide condition for SKU on single product page
 **/

    $hideSKU = get_option( 'wc_hide_options_settings_hide_sku' );
    if($hideSKU == 'yes'){
        //add_filter( 'wc_product_sku_enabled', '__return_false' );
        
        
        function wc_hide_options_remove_product_page_skus( $enabled ) {
            if ( ! is_admin() && is_product() ) {
                return false;
            }

            return $enabled;
        }
        add_filter( 'wc_product_sku_enabled', 'wc_hide_options_remove_product_page_skus' );  
    }
    
/**
 *  Hide condition for SKU on Frontend and Backend on both side
 **/

    $hideSkuFrontBack = get_option( 'wc_hide_options_settings_hide_sku_front_back' );
    if($hideSkuFrontBack == 'yes'){
        
        add_filter( 'wc_product_sku_enabled', '__return_false' );
        
    }
    
      
/**
 *  Hide condition for Product Meta on Product details page
 **/

    $hideProductMeta = get_option( 'wc_hide_options_settings_hide_meta' );
    if($hideProductMeta == 'yes'){
        
        add_action('init','wcHideProductMeta');
        function wcHideProductMeta(){
           remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        }
        
    }
/**
 *  Hide condition for Product Data Tab on Product details page
 **/

    $hideProductDataTab = get_option( 'wc_hide_options_settings_hide_product_data_tabs' );
    if($hideProductDataTab == 'yes'){
        
        add_action('init','wcHideProductDataTab');
        function wcHideProductDataTab(){
           remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
        }
        
    }


/**
 *  Hide coupon code field from cart page
 **/

    $hideCoupouCodeCartPage     = get_option( 'wc_hide_options_settings_hide_coupon_code_cart_page' );
    if($hideCoupouCodeCartPage  == 'yes'){
        
        function disable_coupon_field_on_cart( $enabled ) {
            if ( is_cart() ) {
                $enabled = false;
            }
            return $enabled;
        }
        add_filter( 'woocommerce_coupons_enabled', 'disable_coupon_field_on_cart' );
        
    }
    
    /**
 *  Hide coupon code field from Checkout page
 **/

    $hideCoupouCodeCheckoutPage     = get_option( 'wc_hide_options_settings_hide_coupon_code_checkout_page' );
    if($hideCoupouCodeCheckoutPage  == 'yes'){
        
        function disable_coupon_field_on_checkout( $enabled ) {
            if ( is_checkout() ) {
                $enabled = false;
            }
            return $enabled;
        }
        add_filter( 'woocommerce_coupons_enabled', 'disable_coupon_field_on_checkout' );
        
    }
    
