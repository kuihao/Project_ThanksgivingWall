(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$('#btn_export').click(function (e) {
		e.preventDefault(); 
		  var data = {
			'action': 'db_element_form_Export'
 		  };
		  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		  jQuery.post(ajax_object.ajax_url, data, function (response) {
			// alert('Got this from the server: ' + response);
			if (response) {
			   // window.location.reload();
				window.location = plugin_url +'/includes/assets/dbform.csv';
 			 }
	
		  }); 
	  }); 
	$('#btn_export_pdf').click(function (e) {
		e.preventDefault(); 
		  var data = {
			'action': 'db_element_form_Export_pdf'
 		  };
		  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		  jQuery.post(ajax_object.ajax_url, data, function (response) {
			// alert('Got this from the server: ' + response);
			if (response) {
			   // window.location.reload();
				window.location = plugin_url +'/includes/assets/dbform.pdf';
 			 }
	
		  }); 
		}); 
		
		$(document).ready(function() {
			$('#dbForm').DataTable();
	} );

	  // shorthand no-conflict safe document-ready function
	  jQuery(function($) {
		// Hook into the "notice-my-class" class we added to the notice, so
		// Only listen to YOUR notices being dismissed
		$( document ).on( 'click', '.notice-my-class .notice-dismiss', function () {
			// Read the "data-notice" information to track which notice
			// is being dismissed and send it via AJAX
			var type = $( this ).closest( '.notice-my-class' ).data( 'notice' );
			// Make an AJAX call
			// Since WP 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			$.ajax( ajaxurl,
			  {
				type: 'POST',
				data: {
				  action: 'dismissed_notice_handler',
				  type: type,
				}
			  } );
		  } );
	  });

})( jQuery );
