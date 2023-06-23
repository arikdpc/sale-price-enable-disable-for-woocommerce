# Sale Price Enable/Disable for WooCommerce Plugin Documentation

## Introduction
The Sale Price Enable/Disable for WooCommerce plugin is a WordPress tool that allows the site administrator to globally disable and enable the sale prices of WooCommerce products, without affecting the regular prices. The plugin also works with variable products and will handle each variation individually. It employs AJAX technology to prevent server timeouts for large product catalogs.

## Installation
1. Download the plugin from the provided link.
2. Log into your WordPress website.
3. Go to 'Plugins' -> 'Add New'.
4. Click on 'Upload Plugin'.
5. Choose the downloaded plugin file and click 'Install Now'.
6. After installation, click 'Activate Plugin'.

## Usage
Once activated, the plugin will add a new menu item 'Sale Price Settings' under the 'WooCommerce' menu in your WordPress admin panel. Click on it to access the plugin settings.

There are two main actions you can perform:

1. Disable Sale Prices: This action will remove all sale prices from your WooCommerce products, but retain them in the database for future restoration. During this process, the regular price of each product is displayed on the front end.

2. Restore Sale Prices: This action will restore all sale prices that were previously disabled.

The plugin also provides an input field to specify the number of products to process per request. This can be adjusted according to the server's capabilities.

## How It Works
- Disabling Sale Prices: When you click the 'Disable Sale Prices' button, the plugin retrieves a certain number of products (as specified in the 'Products per request' field) and removes their sale prices, storing these prices in a custom meta field '_original_sale_price'. The AJAX approach is used to prevent server timeouts.

- Restoring Sale Prices: When you click the 'Restore Sale Prices' button, the plugin retrieves the products and restores their original sale prices from the '_original_sale_price' meta field, and then removes this field from the database.

## Variable Products
For variable products, each variation is treated as a separate product. The sale prices of individual variations are also disabled and restored.

## Considerations
- The server’s PHP max_execution_time and memory limits should be considered when setting the 'Products per request' field value. A high number might cause a server timeout or memory exhaustion, especially for stores with a large number of products.

- The plugin interacts directly with the database. It's highly recommended to take a full backup of your WordPress site before using the plugin.

- Test the plugin on a staging environment before using it on a live site.

## Support
For support and issues, please contact the plugin developer through the provided contact details.
