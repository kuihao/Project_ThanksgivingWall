<?php
/**
 * Get Contact Form 7 [ if exists ]
 */

function eaiocf_select_contact_form_7(){
    $wpcf7_form_list = get_posts(array(
        'post_type' => 'wpcf7_contact_form',
        'showposts' => 999,
      ));
        $posts = array();

    if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ){
    foreach ( $wpcf7_form_list as $post ) {
        $options[ $post->ID ] = $post->post_title;
    }
        return $options;
    }
}


/**
 * Get Gravity Form [ if exists ]
 */

function eaiocf_select_gravity_form() {

    $forms = RGFormsModel::get_forms( null, 'title' );
    foreach( $forms as $form ) {
      $optionsss[ $form->id ] = $form->title;
    }
    return $optionsss;

}

/**
 * Get Ninja Form List
 * @return array
 */
function eaiocf_select_ninja_form() {
    global $wpdb;
    $acfe_nf_table_name = $wpdb->prefix.'nf3_forms';
    $forms = $wpdb->get_results( "SELECT id, title FROM $acfe_nf_table_name" );
    foreach( $forms as $form ) {
        $optionss[$form->id] = $form->title;
    }
    return $optionss;
}