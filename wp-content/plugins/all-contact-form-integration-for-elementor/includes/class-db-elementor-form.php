<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class DB_Elementor_Form {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	public $wpdb;
	public $table;
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		global $wpdb;
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'db-for-elementor-form';

		$this->void_load_dependencies();
		$this->void_set_locale();
		$this->void_define_admin_hooks();
		$this->void_define_public_hooks();
		$this->wpdb  = $wpdb;
		$this->table = $this->wpdb->prefix . 'db_element_form';
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Name_i18n. Defines internationalization functionality.
	 * - Plugin_Name_Admin. Defines all hooks for the admin area.
	 * - Plugin_Name_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function void_load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-db-elementor-form-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-db-elementor-form-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-db-elementor-form-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-db-elementor-form-public.php';
	
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-db-elementor-form_helper.php';	
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/wp-ajax.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/export_csv.php';
		/**
		 * The class responsible for Pdf
		 * of the plugin.
		 */
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/lib/dompdf/vendor/autoload.php'; 

		

		$this->loader = new DB_Elementor_Form_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function void_set_locale() {

		$plugin_i18n = new DB_Elementor_Form_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function void_define_admin_hooks() {

		$plugin_admin = new DB_Elementor_Form_Admin( $this->void_get_plugin_name(), $this->void_get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'void_db_element_form_enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'void_db_element_form_enqueue_scripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'void_db_element_form_baseUrl' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'void_db_element_form_pluginUrl' );
		//$this->loader->add_action( 'init', $plugin_admin, 'db_elementor_form_init' );
		 $this->loader->add_action( 'admin_menu', $plugin_admin, 'element_form_register_my_custom_menu_page' );
		 $this->loader->add_action( 'admin_notices', $plugin_admin, 'void_db_elemetor_form_admin_notice' );
		 $this->loader->add_action( 'elementor_pro/forms/new_record', $plugin_admin, 'db_elementor_form_new_record', 10, 10 );
		 $this->loader->add_action( 'wpcf7_before_send_mail', $plugin_admin, 'void_db_elemetor_call_after_for_submit' );
		 $this->loader->add_action( 'gform_after_submission', $plugin_admin, 'void_db_elemetor_call_after_for_submit_gravity_form', 10, 2 );
		 $this->loader->add_filter( 'ninja_forms_submit_data', $plugin_admin, 'void_db_elemetor_call_after_for_submit_ninja_form' );
		// wpcf7_before_send_mail
		// $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'db_elementor_form_register_meta_box' );
		// $this->loader->add_action( 'admin_notices', $plugin_admin, 'db_elementor_form_admin_notice' );
		//$this->loader->add_action( 'admin_head', $plugin_admin, 'db_elementor_form_admin_head' );
		// $this->loader->add_action( 'admin_init', $plugin_admin, 'db_elementor_form_download_csv', 1, 1  );
		// $this->loader->add_filter( 'manage_elementor_cf_db_posts_custom_column', $plugin_admin, 'db_elementor_form_columns_head', 100  );
		// $this->loader->add_action( 'manage_elementor_cf_db_posts_custom_column', $plugin_admin, 'db_elementor_form_columns_content', 100, 2  );
		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function void_define_public_hooks() {

		$plugin_public = new DB_Elementor_Form_Public( $this->void_get_plugin_name(), $this->void_get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'void_db_element_form_enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'void_db_element_form_enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function void_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function void_get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function void_get_version() {
		return $this->version;
	}

}
