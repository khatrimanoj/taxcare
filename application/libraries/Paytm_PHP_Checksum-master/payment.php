<?php

require_once("./PaytmChecksum.php");

/* initialize an array */
$paytmParams = array();

/* add parameters in Array */
$paytmParams["MID"] = "dWrYei40584390335003";
$paytmParams["ORDERID"] = "ORDER_82";

/**
* Generate checksum by parameters we have
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$paytmChecksum = PaytmChecksum::generateSignature($paytmParams, '2btz&NtNJgGlkQYG');
$verifySignature = PaytmChecksum::verifySignature($paytmParams, '2btz&NtNJgGlkQYG', $paytmChecksum);
echo sprintf("generateSignature Returns: %s\n", $paytmChecksum);
echo sprintf("verifySignature Returns: %b\n\n", $verifySignature);


/* initialize JSON String */  
$body = "{\"mid\":\"YOUR_MID_HERE\",\"orderId\":\"YOUR_ORDER_ID_HERE\"}";

/**
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$paytmChecksum = PaytmChecksum::generateSignature($body, '2btz&NtNJgGlkQYG');
$verifySignature = PaytmChecksum::verifySignature($body, '2btz&NtNJgGlkQYG', $paytmChecksum);
echo sprintf("generateSignature Returns: %s\n", $paytmChecksum);
echo sprintf("verifySignature Returns: %b\n\n", $verifySignature);