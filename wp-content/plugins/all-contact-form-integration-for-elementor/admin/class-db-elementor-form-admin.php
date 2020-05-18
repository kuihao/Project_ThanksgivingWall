<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class DB_Elementor_Form_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function void_db_element_form_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'dataTables', plugin_dir_url( __FILE__ ) . 'css/dataTables.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/db-elementor-form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function void_db_element_form_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name.'dataTables', plugin_dir_url( __FILE__ ) . 'js/dataTables.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name.'bootstrap4', plugin_dir_url( __FILE__ ) . 'js/bootstrap4.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name.'elemetor', plugin_dir_url( __FILE__ ) . 'js/db-elementor-form-admin.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( $this->plugin_name, 'ajax_object',
		array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
	}

/**
 * Register a custom menu page.
 */
public function element_form_register_my_custom_menu_page(){
    add_menu_page( 
        __( 'DB Element From', 'db_element_form' ),
        'Form Submissions',
        'manage_options',
        'db_element_form',
		 array($this,'db_element_form_menu_page'),
		'dashicons-admin-generic',
        // plugins_url( 'myplugin/images/icon.png' ),
        6
	); 
	
	// add_submenu_page('db_element_form', 'Settings', 'Settings',
	// 'manage_options', 'settings', array($this,'db_element_form_settings_menu_page')); 

	// add_submenu_page( null, 'Edit Element', 'Edit Element',
	// 		'manage_options', '', array( $this, 'db_element_form_edit' ) );
    add_submenu_page(null, 'View Element', 'View Element',
			'manage_options', 'view_db_element_form', array( $this, 'view_db_element_form' ) );
}

/**
 * Display a custom menu page
 */
 public function db_element_form_menu_page(){
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/db_element_form.php';
}

// public function db_element_form_settings_menu_page(){
//    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/settings.php';
// }
 

public function view_db_element_form() {
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/view_element_page.php';
}
// public function db_element_form_edit() {
// 	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/view_element_page.php';
// }

// Elementor form data insert
public function  db_elementor_form_new_record( $record, $form_class ) {
	
	if ( $fields = $record->get_formatted_data() ) {
		$data  = array();
		$email = false;

		//print_r($fields);

		foreach ( $fields as $label => $value ) {

			if ( stripos( $label, 'email' ) !== false ) {
				$email = $value;
			}

			$data[] = array( 'label' => $label, 'value' => $value );
		}

		 

		$serialized_data = serialize(($data));
		$this_page    = get_post( sanitize_text_field($_POST['post_id']) );
		$this_user    = false;
		$current_user = get_current_user_id();

		$form_id = $record->get_form_settings( 'form_name' );
		$datas = array(
			'submitedOn' => $this_page->post_title,
			'formID' => $form_id,
			'postID' => $this_page->ID,
			'email' => $email,
			'submitedBy' => $current_user,
			'formData' => $serialized_data
		   );
		 $this->void_db_insertData($datas);
	}
}

// Contact from 7 data insert

function void_db_elemetor_call_after_for_submit( $contact_data ){
 
	$wpcf7 = WPCF7_ContactForm :: get_current() ;
	$submission = WPCF7_Submission :: get_instance() ;
	if ($submission)
{
	$posted_data = $submission->get_posted_data() ;
 	
	$this_page = get_post( sanitize_text_field($_POST['_wpcf7_container_post']) );
	
	$subject = sanitize_text_field($_POST['your-subject']);
	$email = sanitize_text_field($_POST['your-email']);
	$message = sanitize_text_field($_POST['your-message']);

	 unset($posted_data['_wpcf7']);
	 unset($posted_data['_wpcf7_version']);
	 unset($posted_data['_wpcf7_locale']);
	 unset($posted_data['_wpcf7_unit_tag']);
	 unset($posted_data['_wpcf7_container_post']);
	 
	 $data = [];
	 $i = 0;
	 foreach ($posted_data as $key => $value) {
		   $data[$i]['label'] = $key;
		   $data[$i]['value'] = $value;
		   $i++;
	 }
 
  
    $serialized_data = serialize(($data));

	$current_user = get_current_user_id();
	
	$datas = array(
		'submitedOn' => $this_page->post_title,
		'formID' => $contact_data->id,
		'postID' => $this_page->ID,
		'email' => $email,
		'message' => $message,
		'submitedBy' => $current_user,
		'formData' => $serialized_data
	   ); 
	 $this->void_db_insertData($datas);
	}
 }


 // gravity form

 public function void_db_elemetor_call_after_for_submit_gravity_form($entry, $form){
	 $gravity=[];
	 $email = '';
	 $i = 0;
	 
	foreach ( $form['fields'] as $field ) { 
	  if($field['type'] == 'email'){
		 $email = rgar( $entry, (string) $field['id'] );
	}
	 $gravity[$i]['label'] = $field['label'];
	 $gravity[$i]['value'] = rgar( $entry, (string) $field['id'] );
	 $i++;
	}
	$gravity=[];
	$message = '';
	$i = 0;
	
   foreach ( $form['fields'] as $field ) { 
	 if($field['type'] == 'message'){
		$message = rgar( $entry, (string) $field['id'] );
   }
	$gravity[$i]['label'] = $field['label'];
	$gravity[$i]['value'] = rgar( $entry, (string) $field['id'] );
	$i++;
   }
 	
 	$this_page = get_post( sanitize_text_field($_POST['post_id']) );

	$serialized_data = serialize($gravity);

	$current_user = get_current_user_id();
	
	$datas = array(
		'submitedOn' => $this_page->post_title,
		'formID' => $form['title'],
		'postID' => $this_page->ID,
		'email' => $email,
		'message' => $message,
		'submitedBy' => $current_user,
		'formData' => $serialized_data
	   ); 
 	 $this->void_db_insertData($datas);
	}
 // Ninja form

 public function void_db_elemetor_call_after_for_submit_ninja_form($data){
	
	 $ninja = [];
	 $email = '';
	 $i = 0;
   foreach ( $data['fields'] as $field ) {
	   if($field['key'] == 'submit'){
		   continue;
	   }
	 if($field['key'] == 'email'){
		$email = $field['value'];
	}
	$ninja[$i]['label'] = $field['key'];
	$ninja[$i]['value'] = $field['value'];
	$i++;
   }
   $ninja = [];
   $message = '';
   $i = 0;
 foreach ( $data['fields'] as $field ) {
	 if($field['key'] == 'submit'){
		 continue;
	 }
   if($field['key'] == 'message'){
	  $message = $field['value'];
  }
  $ninja[$i]['label'] = $field['key'];
  $ninja[$i]['value'] = $field['value'];
  $i++;
 }
   //$this_page = get_post( sanitize_text_field($_POST['_wpcf7_container_post']) );

   $serialized_data = serialize($ninja);

   $current_user = get_current_user_id();
   
   $datas = array(
	   'submitedOn' => $data['settings']['title'],
	   'formID' => $data['id'],
	   'postID' => '',
	   'email' => $email,
	   'message' => $message,
	   'submitedBy' => $current_user,
	   'formData' => $serialized_data
	  ); 
	 
	$this->void_db_insertData($datas);
   }

public function void_db_insertData($data){
	global $wpdb;
	$table = $wpdb->prefix.'db_element_form'; 
	$format = array('%s','%s','%s','%s','%s','%s','%s');
	$wpdb->insert($table,$data,$format);
}
public function void_db_elemetor_form_admin_notice(){
	if ( ! current_user_can( 'administrator' ) ) {
		return;
	}

  
	if ( $other_contacts = self::countUnreadData() ) {
		//Use notice-warning for a yellow/orange, and notice-info for a blue left border.
		$class   = 'notice notice-error is-dismissible';
		$message = __( 'You have ' . count( $other_contacts ) . ' unread contact form submissions. Click <a href="' . admin_url( 'admin.php?page=db_element_form' ) . '">here</a> to visit them or click <a href="' . admin_url( 'admin.php?page=db_element_form&status=unread' ) . '">here</a> to mark all as read', 'sb_elem_cfd' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
	}
}

public static  function getAllDBFromData (){
	global $wpdb;
	$status = isset($_GET['status']) ? esc_sql($_GET['status']) : '';
	$table = $wpdb->prefix.'db_element_form';
	if($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table) {
		if($status){
			$datas = $wpdb->get_results("SELECT * FROM $table WHERE status = '$status' ORDER BY id"); 
		}else{
			$datas = $wpdb->get_results("SELECT * FROM $table ORDER BY id"); 
		}
		return $datas;
	}
	 
 	 
}
public static  function countUnreadData (){
	global $wpdb;
	$table = $wpdb->prefix.'db_element_form';
	if($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table) {
		$datas = $wpdb->get_results("SELECT * FROM $table WHERE status = 'unread'"); 
		return $datas;
  }
	
}
public static  function getSingleData ($id){
	global $wpdb;
	$id   = esc_sql( $id ); 
	$table = $wpdb->prefix.'db_element_form';
	if($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table) {
		$datas = $wpdb->get_results("SELECT * FROM $table WHERE id = $id");  
	  	return $datas[0];
	}
}
public static  function deleteData ($id){
	global $wpdb;
	$id   = esc_sql( $id ); 
	$table = $wpdb->prefix.'db_element_form';
		$datas = $wpdb->query("DELETE FROM $table WHERE id = $id");
 }
public static  function redData ($id){
	global $wpdb; 
	$id   = esc_sql( $id ); 
	$current_user = get_current_user_id(); 
	$table = $wpdb->prefix.'db_element_form';
	$data = array(  
 		 'status' => 'read',
		 'submitedBy' => $current_user
		);
  $condition = array('id' => $id);
	$format = array('%s','%s');
	$conditionFormat = array('%d','%d');
	$wpdb->update($table,$data,$condition,$format,$conditionFormat);
}

public static  function UpdatedViewData ($id,$formID){
	global $wpdb; 
	$id   = esc_sql( $id ); 
	$formID   = esc_sql( $formID ); 
	$current_user = get_current_user_id(); 
	$table = $wpdb->prefix.'db_element_form';
	$data = array( 
		 'formID' => $formID,
 		 'status' => 'read',
		 'submitedBy' => $current_user
		);
  $condition = array('id' => $id);
	$format = array('%s','%s');
	$conditionFormat = array('%d','%d');
	$wpdb->update($table,$data,$condition,$format,$conditionFormat);
 }

public function void_db_element_form_baseUrl (){
		?>
	 <script type="text/javascript">
		var base_url = '<?php echo home_url(); ?>';
	  </script>
		<?php
	}
	public function void_db_element_form_pluginUrl (){
		?>
	 <script type="text/javascript">
		var plugin_url = '<?php echo plugin_dir_url('').'/' .$this->plugin_name; ?>';
	  </script>
		<?php
	}

	public static  function deleteViewSubData($ID){
		global $wpdb;
		$ID   = esc_sql( $ID ); 
		$table = $wpdb->prefix.'db_element_form';
		$datas = $wpdb->query("DELETE FROM $table WHERE id = $ID");
		echo '<script> window.location="'. admin_url('admin.php?page=db_element_form') .'" </script>';
	 }

}
