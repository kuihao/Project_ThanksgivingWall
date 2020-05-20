<?php
/**
 * DB_Element_Form_Helper use for all helping tools.
 *
 *  This class all function are static.its use only common section whice is create at a time but we use this all static method
 * many different place by :: sytex. This class all function are public. it has no property
 * use.this all classes name:  ,
 *
 * @since 1.0.0
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class DB_Element_Form_Helper {

	static private $table;
	static private $user_email;
	static private $wpdb;


	/**
	 * DB_Element_Form_Helper constructor.
	 * All notification count here. when show any place just call this function by statically.
	 *
	 * @since 1.0.0
	 *
	 * @see Function/page_url_set/Pure_Notification_Main relied on
	 *
	 */
	public function __construct() {
		// $DataBase         = new Pure_Notification_Main();
		// self::$wpdb       = $DataBase->wpdb;
		// self::$table      = $DataBase->table;
		// self::$user_email = $DataBase->user_email;
	}

	/**
	 * notification url set.
	 *
	 * All page url here. when show  any page for redirect just call this method statically.
	 *
	 * @since 1.0.0
	 *
	 * @see Function/page_url_set/Pure_Notification_Main relied on
	 *
	 *
	 * @return array
	 */

	public static function void_page_url_set() {

    	$pages = array(
			"show-element-form"   => 'view_db_element_form', 
			"admin-url" => 'admin.php?page=db_element_form',
		);

		return $pages;
	}

	/**
	 * All element count.
	 *
	 * All element count here. when show any place just call this function by statically.
	 *
	 * @since 1.0.0
	 *
	 * @see Function/element_count/Pure_Element_Main relied on
	 *
	 * @param string $status all.
	 *
	 * @return string
	 */

	public static function void_db_elementor_form_count( $status = 'all' ) {

		$user_email = esc_sql(self::$user_email);
		$table      = esc_sql(self::$table);
		if ( $status == 'all' ) {
			$query = "SELECT COUNT(*) FROM {$table} WHERE to_email='$user_email' AND  status != 'archive'";
		} else {
			$query = "SELECT COUNT(*) FROM {$table} WHERE to_email='$user_email' AND status='$status'";
		}

		return self::$wpdb->get_var( $query );

	}

	/**
	 * All element count for admin.
	 *
	 * All element count here. when show any place just call this function by statically.
	 *
	 * @since 1.0.0
	 *
	 * @see Function/db_element_form_admin/Pure_Element_Main relied on
	 *
	 * @param string $status all.
	 * @param string $date Default.
	 *
	 * @return string
	 */

	public static function void_db_elementor_form_admin( $status = 'all', $date = '' ) {

		$user_email = esc_sql(self::$user_email);
		$table      = esc_sql(self::$table);
		if ( $date == '' ) {
			if ( $status == 'all' ) {
				$query = "SELECT COUNT(*) FROM {$table} WHERE  status != 'archive'";
			} else {
				$query = "SELECT COUNT(*) FROM {$table} WHERE  status='$status'";
			}
		} else {
			if ( $status == 'all' ) {
				$query = "SELECT COUNT(*) FROM {$table} WHERE  status != 'archive' AND DATE (sent_date) LIKE '$date'";
			} else {
				$query = "SELECT COUNT(*) FROM {$table} WHERE  status='$status' AND DATE (sent_date) LIKE '$date'";
			}
		}


		return self::$wpdb->get_var( $query );

	}

	/**
	 * load_include_template
	 *
	 * All element count here. when show any place just call this function by statically.
	 *
	 * @since 1.0.0
	 *
	 * @see Function/load_include_template/DB_Element_Main relied on
	 *
	 * @param string $arr Description.
	 * @param string $template page template.
	 *
	 * @return string
	 */

	public static function void_load_include_template( $arr, $template ) {
		extract( $arr );
		ob_start();
		include $template;

		return ob_get_clean();
	}


	/**
	 * checking validation data
	 *
	 *
	 * @since 1.0.0
	 *
	 * @see Function/test_input/DB_Element_Main relied on
	 *
	 * @param string $data data.
	 *
	 * @return string
	 */

	public static function void_test_input( $data ) {
		$data = trim( $data );
		$data = stripslashes( $data );
		$data = htmlspecialchars( $data );

		return $data;
	}

}

new DB_Element_Form_Helper();

