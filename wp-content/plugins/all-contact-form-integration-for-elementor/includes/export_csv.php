<?php
class CSVExport
{
/**
* Constructor
*/
public function __construct()
{
	global $wpdb;                                               //We gonna work with database aren't we?
    $this->db = $wpdb;                                          //Can't use global on it's own within a class so lets assign it to local object.
    $this->table_name = 'db_element_form';                               
    $this->separator = ',';

if(isset($_GET['page']) && $_GET['page'] == 'download_report')
{ 
	$filename = 'db_element_form';
    $generatedDate = date('d-m-Y His');                         //Date will be part of file name. I dont like to see ...(23).csv downloaded

    $csvFile = $this->generate_csv();                           //Getting the text generated to download
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);                    //Forces the browser to download
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"" . $filename . " " . $generatedDate . ".csv\";" );
    header("Content-Transfer-Encoding: binary");

    echo $csvFile;                                              //Whatever is echoed here will be in the csv file
    exit;
}


}

 
/**
* Allow for custom query variables
*/
public function query_vars($query_vars)
{
$query_vars[] = 'download_report';
return $query_vars;
}

/**
* Parse the request
*/
public function parse_request(&$wp)
{
if(array_key_exists('download_report', $wp->query_vars))
{
$this->download_report();
exit;
}
}

/**
* Download report
*/
public function download_report()
{
echo '<div class="wrap">';
echo '<div id="icon-tools" class="icon32">
</div>';
echo '<h2>Download Report</h2>';
//$url = site_url();

echo '<p>Export the Subscribers';
}

/**
* Converting data to CSV
*/
function generate_csv(){

    $csv_output = '';                                           //Assigning the variable to store all future CSV file's data
    $table = $this->db->prefix . $this->table_name;             //For flexibility of the plugin and convenience, lets get the prefix

    $result = $this->db->get_results("SHOW COLUMNS FROM " . $table . "");   //Displays all COLUMN NAMES under 'Field' column in records returned

    if (count($result) > 0) {

        foreach($result as $row) {
            $csv_output = $csv_output . $row->Field . $this->separator;
        }
        $csv_output = substr($csv_output, 0, -1);               //Removing the last separator, because thats how CSVs work

    }
    $csv_output .= "\n";

    $values = $this->db->get_results("SELECT * FROM " . $table . "");       //This here

    foreach ($values as $rowr) {
        $fields = array_values((array) $rowr);                  //Getting rid of the keys and using numeric array to get values
        $csv_output .= implode($this->separator, $fields);      //Generating string with field separator
        $csv_output .= "\n";    //Yeah...
    }

    return $csv_output; //Back to constructor

  }
}

// Instantiate a singleton of this plugin
$csvExport = new CSVExport();