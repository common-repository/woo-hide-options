<?php

/**
 * Plugin Name: Woocommerce hide options
 * Plugin URI:
 * Description: Plugin for hide woocommerce options like: Category, Tags, comments, Price, Star Review, Cart Button and other many thinks from Single product page.
 * Author: Husain Ahmed
 * Version: 2.0
 * WC requires at least: 4.7
 * WC tested up to: 6.0.1
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
 * Author URI: https://husain25.wordpress.com/
 * Domain Path:       /languages
 **/

// If this file is called directly, abort.
// Exit if accessed directly
defined('ABSPATH') || die('Wordpress Error! Opening plugin file directly');
define('PLUGIN_PATH', plugins_url(__FILE__));

/**
 * Check if WooCommerce is active
 **/

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    
    function register_hide_options_menu() {
        add_submenu_page( 'woocommerce', 'Hide Options', 'Hide Options', 'manage_options', 'wc-settings&tab=hide_options_settings', 'hide_options_settings' ); 
    }
    
    add_action('admin_menu', 'register_hide_options_menu',99);
    

    class WC_Hide_Options_Settings_Tab {

        /**
         * Bootstraps the class and hooks required actions & filters.
         *
         **/
        public static function init() {
            add_filter('woocommerce_settings_tabs_array',                   __CLASS__ . '::add_hide_options_setting_tab', 50);
            add_action('woocommerce_settings_tabs_hide_options_settings',   __CLASS__ . '::hide_options_settings_tab');
            add_action('woocommerce_update_options_hide_options_settings',  __CLASS__ . '::hide_options_update_settings_tab');
        }   

        /**
         * Add a new settings tab to the WooCommerce settings tabs array.
         *
         * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
         * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
         **/
        
        public static function add_hide_options_setting_tab($settings_tabs) {
            $settings_tabs['hide_options_settings'] = __('Hide Options', 'woocommerce-hide-options-settings');
            return $settings_tabs;
        }

        /**
         * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
         *
         * @uses woocommerce_admin_fields()
         * @uses self::get_hide_options_settings()
         **/
        public static function hide_options_settings_tab() {
            woocommerce_admin_fields(self::get_hide_options_settings());
        }

        /**
         * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
         *
         * @uses woocommerce_update_options()
         * @uses self::get_hide_options_settings()
         **/
        public static function hide_options_update_settings_tab() {
            woocommerce_update_options(self::get_hide_options_settings());
        }

        /**
         * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
         *
         * @return array Array of settings for @see woocommerce_admin_fields() function.
         **/
        public static function get_hide_options_settings() {
            $settings = array(
                'section_title' => array(
                    'name' => __('Woocommerce Hide Options Settings', 'woocommerce-hide-options-settings'),
                    'type' => 'title',
                    'desc' => '',
                    'id' => 'wc_hide_options_settings_section_title'
                ),
                
                'hide_title' => array(
                    'name' => __('Hide Title', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide Product title on Product details page.', 'woocommerce-settings-tab-demo'),
                    'id' => 'wc_hide_options_settings_hide_title'
                ),

                'hide_category' => array(
                    'name' => __('Hide Category', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide Product Category on Product details page.', 'woocommerce-settings-tab-demo'),
                    'id' => 'wc_hide_options_settings_hide_category'
                ),

                'hide_add_to_cart' => array(
                    'name' => __('Hide Add to cart Button', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide Add to Cart Button on Product details page.', 'woocommerce-settings-tab-demo'),
                    'id' => 'wc_hide_options_settings_hide_add_to_cart_button'
                ),
                'hide_sku' => array(
                    'name' => __('Hide SKU', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide SKU from Frontend Product details page only.', 'woocommerce-settings-tab-demo'),
                    'id' => 'wc_hide_options_settings_hide_sku'
                ),
                'hide_sku_front_back_end' => array(
                    'name' => __('Hide SKU From Frontend & Backend Both Side', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide SKU from Backend and Frontend on product details page.', 'woocommerce-settings-tab-demo'),
                    'id' => 'wc_hide_options_settings_hide_sku_front_back'
                ),
                'hide_meta' => array(
                    'name' => __('Hida Meta', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide Meta from product details page.', 'woocommerce-hide-options-settings'),
                    'id' => 'wc_hide_options_settings_hide_meta'
                ),
                'hide_product_data_tabs' => array(
                    'name' => __('Hide Product Data Tab', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide Additional Information from Product details page at bottom.', 'woocommerce-settings-tab-demo'),
                    'id' => 'wc_hide_options_settings_hide_product_data_tabs'
                ),

                'hide_coupon_code_field_cart' => array(
                    'name' => __('Hide Coupon code field from Cart page', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide Coupon code field only from Cart page.', 'woocommerce-settings-tab-demo'),
                    'id' => 'wc_hide_options_settings_hide_coupon_code_cart_page'
                ),

                'hide_coupon_code_field_checkout' => array(
                    'name' => __('Hide Coupon code field from Checkout page', 'woocommerce-hide-options-settings'),
                    'type' => 'checkbox',
                    'desc' => __('Hide Coupon code field only from checkout page.', 'woocommerce-settings-tab-demo'),
                    'id' => 'wc_hide_options_settings_hide_coupon_code_checkout_page'
                ),


                'section_end' => array(
                    'type' => 'sectionend',
                    'id' => 'wc_hide_options_settings_section_end'
                )
            );
            return apply_filters('wc_hide_options_settings_filters', $settings);
        }

    }

    WC_Hide_Options_Settings_Tab::init();
    
    /**
    * Include a file for hide/show functions
    **/
    include( plugin_dir_path( __FILE__ ) . 'wchos-functions.php');
    
} else {

    echo "<div class='error'><p>WooCommerce plugin is not activated. Please install and activate it to use Woocommerce Hide Option Plugin</p> </div>";
}

