<?php
// $show_not_id = get_option( 'show-notifications' );
// $view_not_id = get_option( 'single-notification' );


// $show_notifications_post = $view_notifications_post = false;
// if($show_not_id){
// 	$show_notifications_post = get_post( $show_not_id, OBJECT );
// }
// if($view_not_id){
// 	$view_notifications_post = get_post( $view_not_id, OBJECT );
// }
?>
<h1>Estimate Settings</h1>
<div class="wrap">
    <h1>Settings</h1>
    <form method="post" action="options.php">
		<?php settings_fields( 'get_estimate_settings_group' ); ?>
		<?php do_settings_sections( 'get_estimate_settings_group' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Primary Color :</th>
                <td>
                    <div class="chose-color " style="width:130px;">
                        <input id="barColor" name="primary_color"
                               value="<?php echo esc_attr( get_option( 'primary_color' ) ); ?>"/>
                    </div>
                </td>
                <th scope="row">Button Color :</th>
                <td>
                    <div class="chose-color " style="width:130px;">
                        <input id="button_color" name="button_color"
                               value="<?php echo esc_attr( get_option( 'button_color' ) ); ?>"/>
                    </div>
                </td> 
            </tr>
 
            <tr valign="top">
            <th scope="row">Secondary Color :</th>
                <td>
                    <div class="chose-color " style="width:130px;">
                        <input id="font_color" name="seccondary_color"
                               value="<?php echo esc_attr( get_option( 'seccondary_color' ) ); ?>"/>
                    </div>
                </td>
                <th scope="row">Hover Color :</th>
                <td>
                    <div class="chose-color " style="width:130px;">
                        <input id="hover_color" name="hover_color"
                               value="<?php echo esc_attr( get_option( 'hover_color' ) ); ?>"/>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Company Name</th>
                <td><input type="text" name="company_name"
                           value="<?php echo esc_attr( get_option( 'company_name' ) ); ?>"/>
                </td>
            </tr>
            

            <tr valign="top">
                <th scope="row">List Show Per Page</th>
                <td>
                    <select name="per_page" id="">
                        <option value="10" <?php echo selected( get_option( 'per_page' ), 10 ); ?>>10</option>
                        <option value="25" <?php echo selected( get_option( 'per_page' ), 25 ); ?>>25</option>
                        <option value="50" <?php echo selected( get_option( 'per_page' ), 50 ); ?>>50</option>
                        <option value="100" <?php echo selected( get_option( 'per_page' ), 100 ); ?>>100</option>
                    </select>
            </tr> 
        </table>
		<?php submit_button(); ?>
    </form>
    <div class="others">
        <!-- <h2>Short Documentation</h2>
        <h4>Create new page and add those ShortCode: </h4> -->
        <!-- <p><b>All Estimates ShortCode :</b> [estimateList] </p> -->
        <!-- <p><b>View Notifications ShortCode :</b> [pwn_view_notification] </p> -->
        <!-- <p><b>Notification Counter bar ShortCode :</b> [pwn_notification_counter] </p> -->
    </div>
</div>
