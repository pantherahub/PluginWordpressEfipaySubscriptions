<?php
/**
 * Plugin Name:       Efipay Suscriptions
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0.0.1
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       efipay-suscriptions
 *
 * @package           create-block
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function efipay_suscriptions_efipay_suscriptions_block_init() {
   register_block_type( __DIR__ . '/build' );

   // Enqueue your script
   wp_enqueue_script( 'edit-js-handle', plugin_dir_url( __FILE__ ) . 'assets/js/edit.js', array( 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor' ), '1.0', true );

   // Obtener las opciones de Efipay
   $plans = get_option('efipay_plans');

   // Pasar las opciones al script de JavaScript
   wp_localize_script( 'edit-js-handle', 'efipayPlans', $plans );
}
add_action( 'init', 'efipay_suscriptions_efipay_suscriptions_block_init' );




 // Registrar secciones en el sidebar
 add_action('admin_menu', 'efipay_suscripciones_admin_menu');
 
 function efipay_suscripciones_admin_menu() {
     add_menu_page('Efipay Suscripciones', 'Efipay Suscripciones', 'manage_options', 'efipay-dashboard', 'efipay_dashboard_page', 'dashicons-money-alt');
     add_submenu_page('efipay-dashboard', 'Ajustes', 'Ajustes', 'manage_options', 'efipay-ajustes', 'efipay_ajustes_page');
     add_submenu_page('efipay-dashboard', 'Planes', 'Planes', 'manage_options', 'efipay-planes', 'efipay_planes_page');
     add_submenu_page('efipay-dashboard', 'Suscripciones', 'Suscripciones', 'manage_options', 'efipay-suscriptores', 'efipay_suscriptores_page');     
 }
 
 // Páginas de contenido de las secciones
 function efipay_dashboard_page() {
    include_once(plugin_dir_path(__FILE__) . './views/landing-page.php');
 }
 
 function efipay_ajustes_page() {
    include_once(plugin_dir_path(__FILE__) . './views/ajustes-page.php');
 }
 
 function efipay_planes_page() {
    include_once(plugin_dir_path(__FILE__) . './views/planes-table.php');
 }
 
 function efipay_suscriptores_page() {
    include_once(plugin_dir_path(__FILE__) . './views/subscriptions-table.php');
 }
 