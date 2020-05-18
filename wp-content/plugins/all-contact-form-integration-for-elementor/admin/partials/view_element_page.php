<?php 

$data = DB_Elementor_Form_Admin::getSingleData($_GET['id']) ;
$dataRead = DB_Elementor_Form_Admin::redData($_GET['id']) ;
$user = get_user_by( 'id', $data->submitedBy );
// print_r($user);
if(isset($_POST['submitForm'])){
    $formID = $_POST['formID'];
    $dataRead = DB_Elementor_Form_Admin::UpdatedViewData($_GET['id'],$formID) ;
    // wp_redirect( admin_url('admin.php?page=db_element_form&&id='.$_GET['id']) ); 
}

$ID = $_GET['id'];
if(isset($_POST['delete'])) {
    DB_Elementor_Form_Admin::deleteViewSubData($ID);
}

if(isset($_POST['back'])){
    echo '<script> window.location="'. admin_url('admin.php?page=db_element_form') .'" </script>';
}

?>

<div class="container mt-3">
<form action="" method="POST">
    <div class="row"> 
        <div class="col-md-8">
            <p><?php printf( __('First read by TheInnovs at  %s','db-for-elementor-form'), isset($data->cdate) ? $data->cdate : '' ) ?></p>
        <input type="text" name="formID" style=" min-width: 300px;" value="<?php echo $data->formID; ?>" class="from-control">

         <div class="mt-5">
            <table class="table">
                <tr>
                    <th> <?php printf( __('Label','db-for-elementor-form')); ?></th>
                    <th> <?php printf( __('Value','db-for-elementor-form')); ?></th>
                </tr>

                <?php $arrayData = unserialize($data->formData);  foreach ($arrayData as $key => $value) { ?> 
                    <tr>
                        <td> <?php printf( __($value['label'],'db-for-elementor-form')) ?> </td>
                        <td><?php echo $value['value']; ?></td>
                    </tr>
                <?php } ?> 
            </table>
            </div>
            </div>
            
        
        <div class="col-md-4">  
         <div class="mt-5">
         <h5><?php printf( __('Extra Information','db-for-elementor-form')); ?></h5>
            <table class="table">
                <tr>
                    <th><?php printf( __('Submitted On','db-for-elementor-form')); ?></th>
                    <td><?php echo  isset($data->submitedOn) ? $data->submitedOn : ''; ?></td>
                </tr>
                <tr>
                    <th><?php printf( __('First Read By','db-for-elementor-form')); ?></th>
                    <td><?php echo isset($user->user_login) ? $user->user_login : ''; ?></td>
                </tr>  
            </table>
            </div>
            </div>
        <div class="col-md-4">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            <input type="submit" name="back" value="Back" class="btn btn-info">
            <!-- <input type="button" value="Send Email" class="btn btn-primary"> -->
        </div>
        </form>
          
 </div>