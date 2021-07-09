<?
/**
 * Write data to log file.
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = '') {
 $log = "\n------------------------\n";
 $log .= date("Y.m.d G:i:s") . "\n";
 $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
 $log .= print_r($data, 1);
 $log .= "\n------------------------\n";
 file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
 return true;
}

$defaults = array('first_name' => '', 'last_name' => '', 'phone' => '', 'email' => '');

if (array_key_exists('saved', $_REQUEST)) {
 $defaults = $_REQUEST;
 writeToLog($_REQUEST, 'webform');

 $queryUrl = 'https://b24-tdwgxe.bitrix24.fr/rest/26/u2n2x176xred0jya/upload.json';
 $queryData = http_build_query(array(
 'fields' => array(
 "TITLE" => $_REQUEST['first_name'].' '.$_REQUEST['last_name'],
 "NAME" => $_REQUEST['first_name'],
 "LAST_NAME" => $_REQUEST['last_name'],
 "STATUS_ID" => "NEW",
 "OPENED" => "Y",
 "ASSIGNED_BY_ID" => 1,

 "PHONE" => array(array("VALUE" => $_REQUEST['phone'], "VALUE_TYPE" => "WORK" )),
 "EMAIL" => array(array("VALUE" => $_REQUEST['email'], "VALUE_TYPE" => "WORK" )),
 ),
 'params' => array("REGISTER_SONET_EVENT" => "Y")
 ));

 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_SSL_VERIFYPEER => 0,
 CURLOPT_POST => 1,
 CURLOPT_HEADER => 0,
 CURLOPT_RETURNTRANSFER => 1,
 CURLOPT_URL => $queryUrl,
 CURLOPT_POSTFIELDS => $queryData,
 ));

 $result = curl_exec($curl);
 curl_close($curl);

 $result = json_decode($result, 1);
 writeToLog($result, 'webform result');

 if (array_key_exists('error', $result)) echo "Error saving Lead: ".$result['error_description']."
";
}
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST");
     header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
   $folderPath = "upload/";
  $file_tmp = $_FILES['file']['tmp_name'];
  $file_ext = strtolower(end(explode('.',$_FILES['file']['name'])));
   $file = $folderPath . uniqid() . '.'.$file_ext;
   move_uploaded_file($file_tmp, $file);
?>
