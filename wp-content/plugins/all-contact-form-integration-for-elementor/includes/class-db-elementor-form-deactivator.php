<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class DB_Elementor_Form_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	 public static function void_db_element_form_deactivate() {
		global $wpdb;
		$db_element_form =  $wpdb->prefix. 'db_element_form'; 

		 $wpdb->query( "DROP TABLE IF EXISTS $db_element_form" );
		// $wpdb->query( "DROP TABLE IF EXISTS $estimate_products" );
		// delete_option("product_estimate_db_version");
		self::void_db_element_form_user_remove_role();
	}

	private static function	void_db_element_form_user_remove_role(){
		remove_role( 'element-admin' );
	}

}
