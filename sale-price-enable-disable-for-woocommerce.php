<?php
/**
 * Plugin Name: Sale Price Enable/Disable for WooCommerce
 * Description: A plugin to enable or disable sale prices for all WooCommerce products
 * Version: 1.0
 * Author: Arik Diament
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('DES_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Admin page
function des_admin_menu() {
    add_submenu_page('woocommerce', 'Disable/Enable Sale Prices', 'Disable/Enable Sale Prices', 'manage_options', 'des-admin', 'des_admin_page');
}
add_action('admin_menu', 'des_admin_menu');

function des_admin_page() {
    include(DES_PLUGIN_PATH . 'includes/admin-page.php');
}

// AJAX handlers
require_once DES_PLUGIN_PATH . 'includes/disable-sale-prices.php';
require_once DES_PLUGIN_PATH . 'includes/restore-sale-prices.php';
