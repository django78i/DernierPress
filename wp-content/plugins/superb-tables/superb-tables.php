<?php
/*
Plugin Name: Superb Tables
Plugin URI: https://superbthemes.com/plugins/superb-tables/
Description: Create responsive tables easily & insert them with a shortcode. Lots of different designs, functions and light weight code.
Version: 1.0.1
Author: SuPlugins
Author URI: http://superbthemes.com
License: GPL2 or later
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'inc/spbtbl-plugin.php';

function spbtbl_run_table_plugin() {
	$plugin_instance = new spbtbl_Plugin('1.0.1');
	register_activation_hook( __FILE__, array($plugin_instance, 'spbtbl_initialize') );
	//register_uninstall_hook( __FILE__, array('spbtbl_Plugin', 'spbtbl_rollback') );
}

spbtbl_run_table_plugin();

function spbtbl_add_plugin_meta_links($meta_fields, $file){

  if(plugin_basename(__FILE__) == $file) {

    $meta_fields[] = "<a href='https://superbthemes.com/plugins/superb-tables/' target='_blank' style='color:#18752c;font-weight:bold;'>View Premium Version</a>";
    $meta_fields[] = "<a href='".wp_nonce_url(admin_url('admin.php?page=spbtbl_plugin'))."'>Create Table</a>";
  }

  return $meta_fields;
}
add_filter("plugin_row_meta", 'spbtbl_add_plugin_meta_links', 10, 2);


?>