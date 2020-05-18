<?php
use Dompdf\Dompdf; 

add_action( 'wp_ajax_db_element_form_Export', 'db_element_form_Export' );
add_action( 'wp_ajax_nopriv_db_element_form_Export', 'db_element_form_Export' );

function db_element_form_Export() {

 	 // $downloadLink = plugin_dir_url( __FILE__ ) . 'assets/file.csv';
	$CSVurl = plugin_dir_path( __FILE__ ). 'assets/dbform.csv'; 
	
	global $woocommerce;   
 // Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Style

$heading = array(
	'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '000000'),
			'size'  => 14,
			'name'  => 'Verdana'
	));
	$styleArray = array(
		'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FF0000'),
				'size'  => 9,
				'name'  => 'Verdana'
		));
		$totalSection = array(
			'font'  => array(
					'bold'  => true,
					'color' => array('rgb' => '000000'),
					'size'  => 8,
					'name'  => 'Verdana'
			));

	 $backgroundColor = 	array(
				'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'd5d5d5')
				));

	// $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($heading); 
	


 
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
 
//  $objPHPExcel->setActiveSheetIndex(0)
// 	->setCellValue('A1', 'Price Estimate');
// $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold( true );
// $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->applyFromArray(
// 	array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)

$rowNumber2 = 0;
$rowNumber = 1;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$rowNumber, 'Form ID')
            ->setCellValue('B'.$rowNumber, 'Name')
            ->setCellValue('C'.$rowNumber, 'Email')
            ->setCellValue('D'.$rowNumber,'Message')
            ->setCellValue('E'.$rowNumber,'Submited By')
			->setCellValue('F'.$rowNumber,'Submited Date');

						$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->applyFromArray($backgroundColor); 
						$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($backgroundColor); 
						$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($backgroundColor); 
						$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($backgroundColor); 
						$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($backgroundColor); 
						$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($backgroundColor); 
 
						$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(20); 
						$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(25); 
						$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(20); 
						$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(15); 
						$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(20); 
						$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(20); 
						$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$rowNumber)->getAlignment()->setWrapText(true);
						$objPHPExcel->setActiveSheetIndex(0)->getStyle('B'.$rowNumber)->getAlignment()->setWrapText(true);
						$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$rowNumber)->getAlignment()->setWrapText(true);
						$objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$rowNumber)->getAlignment()->setWrapText(true);
						$objPHPExcel->setActiveSheetIndex(0)->getStyle('E'.$rowNumber)->getAlignment()->setWrapText(true);
						$objPHPExcel->setActiveSheetIndex(0)->getStyle('F'.$rowNumber)->getAlignment()->setWrapText(true);
						$objPHPExcel->setActiveSheetIndex(0)->getStyle($rowNumber)->getAlignment()->applyFromArray(
							array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,)
						);

 $listForm = allGetDBform();
 // print_r($listForm);
  foreach($listForm as $value){ 
		$user = get_user_by( 'id', $value['submitedBy'] );
// Add some data
$rowNumber2 = $rowNumber + 1;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$rowNumber2, $value['formID'])
            ->setCellValue('B'.$rowNumber2, $value['name'])
            ->setCellValue('C'.$rowNumber2, $value['email'])
            ->setCellValue('D'.$rowNumber2, $value['message'])
			->setCellValue('E'.$rowNumber2, $user->user_login)
			->setCellValue('F'.$rowNumber2, $value['cdate']);
		
 	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$rowNumber2)->getNumberFormat()->setFormatCode('@');
 	$objPHPExcel->setActiveSheetIndex(0)->getStyle('B'.$rowNumber2)->getNumberFormat()->setFormatCode('#');
 	$objPHPExcel->setActiveSheetIndex(0)->getStyle('C'.$rowNumber2)->getNumberFormat()->setFormatCode('#');
 	$objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$rowNumber2)->getNumberFormat()->setFormatCode('#');
 	$objPHPExcel->setActiveSheetIndex(0)->getStyle('E'.$rowNumber2)->getNumberFormat()->setFormatCode('#');
 	$objPHPExcel->setActiveSheetIndex(0)->getStyle('F'.$rowNumber2)->getNumberFormat()->setFormatCode('#');

	 $rowNumber++;
						
	 }
  


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.csv',  $CSVurl));

echo 'success'; 			
   
	wp_die(); // this is required to terminate immediately and return a proper response
}





add_action( 'wp_ajax_db_element_form_Export_pdf', 'db_element_form_Export_pdf' );
add_action( 'wp_ajax_nopriv_db_element_form_Export_pdf', 'db_element_form_Export_pdf' );
function db_element_form_Export_pdf() {
//	echo $downloadLink = plugin_dir_url( __FILE__ ) . 'assets/file.csv';
     $PDFurl = plugin_dir_path( __FILE__ ). 'assets/dbform.pdf';
	  header('Content-type: text/csv');
	  header('Content-disposition: attachment;filename="'. $PDFurl .'"');
 
		$user = get_user_by( 'ID', $userId ); 
 	 
 	   ob_start();
 		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<title>Estimate</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		</head>
 <body>
   <div class="estimate" style="font-size: 14px;page-break-inside: auto"> 
  	 <h3 style="text-align:center">DB Form List</h3>
	 
	 
 <div class="products" style="width:100%;margin-top: 10px">
		<table border="1" style="width:100%;border-collapse: collapse"> 
		  <tr>
 				<th style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;width:20%">Form ID</th>
 				<th style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;width:45%">Name</th>
 				<th style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;text-align: right;width:10%">Email</th>
 				<th style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;;width:10%;text-align: center">Message</th>
 				<th style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;text-align: right;">Submited By</th>
 				<th style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;text-align: right;">Submited Date</th>
			 </tr>
			 <?php
			 $listForm = allGetDBform();
		 // print_r($listForm);
		  foreach($listForm as $value){  
			 ?>
		  <tr>
				<td style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;"><?php echo  $value['formID']; ?></td>
				<td style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;"><?php echo $value['name']; ?></td>
				<td style="padding: 5px;text-align: right;font-size:10px;font-family: Arial, Helvetica, sans-serif;"><?php echo $value['email']; ?></td>
				<td style="padding: 5px;font-size:10px;font-family: Arial, Helvetica, sans-serif;text-align: center"><?php echo $value['message']; ?></td>
				<td style="padding: 5px;text-align: right;font-size:10px;font-family: Arial, Helvetica, sans-serif;"><?php echo $value['submitedBy']; ?></td>
				<td style="padding: 5px;text-align: right;font-size:10px;font-family: Arial, Helvetica, sans-serif;"><?php echo $value['cdate']; ?></td>
			 </tr>
			 <?php } ?> 
		  
		</table>
		</div> 
 </div>
 </body>
 </html>

<?php
 $html = ob_get_clean();
 $html = stripslashes($html);

		if(isset($_POST["id"])){
 			// instantiate and use the dompdf class
			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);

			// (Optional) Setup the paper size and orientation
			$dompdf->set_paper('A4', 'portrait');
			// $dompdf->set_paper("A4", "portrait");

			// Render the HTML as PDF
			$dompdf->render();
			$output = $dompdf->output();
			file_put_contents($PDFurl, $output);
			// Output the generated PDF to Browser
	   //	$dompdf->stream("sample.pdf");
		}

		echo 'success';
 			
   
	wp_die(); // this is required to terminate immediately and return a proper response
}
// add_action('init', 'estimate_product_Export_as_Pdf');

add_action( 'wp_ajax_db_element_form_Email', 'db_element_form_Email' );
add_action( 'wp_ajax_nopriv_db_element_form_Email', 'db_element_form_Email' );
function db_element_form_Email() {
	$downloadLink = plugin_dir_url( __FILE__ ) . 'assets/dbform.csv';
	$CSVurl = plugin_dir_path( __FILE__ ). 'assets/dbform.csv'; 
	
	$attachments = array(WP_CONTENT_DIR . $downloadLink);
	$headers = 'From: My Name <myname@mydomain.com>' . "\r\n";
	wp_mail('hossaincse2@gmail.com', 'subject', 'message', $headers, $attachments);
			
			echo 'Success';
  
	wp_die(); // this is required to terminate immediately and return a proper response
}

 

function allGetDBform(){
	global $wpdb;
	$tablename = $wpdb->prefix . "db_element_form";
	$sql = "Select * from $tablename Order by id ASC";
	$values = $wpdb->get_results($sql,ARRAY_A);
	return $values;
}

add_action( 'wp_ajax_dismissed_notice_handler', 'ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
 function ajax_notice_handler() {
    // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
      $type = $_REQUEST['type'];
	// Store it in the options table
	$get_installation_time = strtotime("now");
	update_option('void_db_element_elementor_activation_time', $get_installation_time ); 
	update_option( 'dismissed-' . $type, TRUE );
}
