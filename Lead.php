<?php
//get the fields available to a lead
https://b24-tdwgxe.bitrix24.fr/rest/26/9y8wbzkhnzpq13cp/crm.contact.userfield.get.json

/**
 * Get lead
*/
$queryUrl = 'https://b24-tdwgxe.bitrix24.fr/rest/26/9y8wbzkhnzpq13cp/crm.contact.userfield.get.json';
$queryData = http_build_query(array(  //send post data
 'id' => 2
));

/**
 * delete lead
 */
curl -s https://b24-tdwgxe.bitrix24.fr/rest/26/9y8wbzkhnzpq13cp/crm.contact.userfield.get.json \
  -H "Content-Type: application/json" -d '{"id": 2}'

/**
 * add lead
 */
$queryUrl = 'https://b24-tdwgxe.bitrix24.fr/rest/26/9y8wbzkhnzpq13cp/crm.contact.userfield.get.json';
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
if (array_key_exists('error', $result)) echo "Error saving lead: ".$result['error_description']."<br/>";

//list leads
crm.lead.list.json

# send data
array(
 	'order'=> ["STATUS_ID"=> "ASC" ],
	'filter'=> [
	  ">OPPORTUNITY"=> 0, 
	  "!STATUS_ID"=> "CONVERTED" ,
	  //Find lead by phone number
	  "PHONE": ""
	],
	'select'=> [ "ID", "TITLE", "STATUS_ID", "OPPORTUNITY", "CURRENCY_ID" ]
)
