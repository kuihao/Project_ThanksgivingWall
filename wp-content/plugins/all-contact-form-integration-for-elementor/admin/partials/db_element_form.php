<?php
 global $current_user;
 wp_get_current_user();
  $userId =  $current_user->ID;
  // $estimate = new product_estimate_Public();
  $formDatas = DB_Elementor_Form_Admin::getAllDBFromData();

  if (isset($_GET['id'])) {
      DB_Elementor_Form_Admin::deleteData($_GET['id']);
       echo '<script> window.location="'. admin_url('admin.php?page=db_element_form') .'" </script>';
  }
  
  $pages = DB_Element_Form_Helper::void_page_url_set();
  $singlePage = $pages['show-element-form'];
  $admin_url = 'admin.php?page=db_element_form';
  //$pdf_url = 'admin.php?page=db_element_form&&download_csv=1';
  $singlePage_url = 'admin.php?page='.$singlePage;
  
?>

<div class="container" style="margin-top:30px">
  <div class="row"> 
  <div class="col-md-12 estimate_section"> 
  <h3>Form Submissions</h3> 
  <div class="mb-1 float-right" >
  <a href="<?php echo admin_url(); ?>?page=download_report" class="btn btn-success">Export as CSV</a>
  <!-- <button id="btn_export_pdf" class="btn btn-primary">Export as PDF</button> -->
  </div>
    <!-- <div class="cart-pakage">
        <?php //echo do_shortcode('[woocommerce_cart] '); ?>
    </div> -->
         
         <div class="table-responsive">   

        <table id="dbForm" class="table table-striped table-bordered" >
        <thead>
             <tr>
                <th>#</th>
                <th>View</th> 
                <th>Form ID</th>
                <th>Email</th>
                <!-- <th>Message</th> -->
                <th>Read/Unread</th>
                <th>Read By</th>
                <th>Submission On</th>
                <th>Submitted Date</th>
                <th>Action</th>
              </tr>
        </thead>
        <tbody>
        <?php $i = 1; 
        if(!empty($formDatas)){ 
          foreach ($formDatas as $key => $value) {
            //$var1 = unserialize($value);
            //print_r($value); die;
            
            $user = get_user_by( 'id', $value->submitedBy );
           
            // $data = unserialize($value->formData);
            // foreach($data as $da);
            // print_r($da);
            // //echo $data['formData']['message']; die;
            // echo '<pre>';
            // print_r($data); 
            // echo '</pre>';
            // die();
          ?>           
              <tr>
                <td> <?php echo $i++; ?> </td>
                <td> <a href="<?php echo esc_url($singlePage_url.'&id='. $value->id); ?>"><?php echo 'View Submission'; ?></a></td> 
                <td><?php echo $value->formID; ?></td>
                <td><?php echo $value->email; ?></td>
                <!-- <td><?php //if(isset($value->message)){ echo $value->message; } ?></td> -->
                <td><?php echo $value->status; ?></td> 
                <td><?php echo isset($user->user_login) ? $user->user_login : ''; ?></td>
                <td><?php echo $value->submitedOn; ?></td>
                <td><?php echo $value->cdate; ?></td> 
                <td>
                  <!-- <a target=_blank href="<?php echo home_url(); ?>/estimate_edit?estimate-id=<?php echo $value->id; ?>">Edit</a>  -->
                  <a class="estimateDelete btn btn-danger" data-nonce="<?php echo wp_create_nonce( 'estimateDelete' ); ?>" data-id="<?php echo $value->id; ?>" href="<?php echo esc_url($admin_url.'&id='. $value->id); ?>">Delete</a>
                </td>
              </tr>
              <?php   } 
             } ?>
        </tbody>
        <tfoot>
              <tr>
                <th>#</th>
                <th><?php printf( __('View','db-for-elementor-form')); ?></th> 
                <th><?php printf( __('Form ID','db-for-elementor-form')); ?></th>
                <th><?php printf( __('Email','db-for-elementor-form')); ?></th>
                <!-- <th><?php //printf( __('Message','db-for-elementor-form')); ?></th> -->
                <th><?php printf( __('Read/Unread','db-for-elementor-form')); ?></th>
                <th><?php printf( __('Read By','db-for-elementor-form')); ?></th>
                <th><?php printf( __('Submission On','db-for-elementor-form')); ?></th>
                <th><?php printf( __('Submitted Date','db-for-elementor-form')); ?></th>
                <th><?php printf( __('Action','db-for-elementor-form')); ?></th>
              </tr>
             
        </tfoot>
    </table> 
     



    <!-- <div class="bundle-pakage">
         <?php echo do_shortcode(' [products limit="4" columns="4" category="bundle-product" cat_operator="AND"]
'); ?>
    </div> -->
  </div>
  </div>
</div> 