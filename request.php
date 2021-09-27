<?php
// We connect to the database	
include("includes/db.php");

//We start the session
session_start();

//Initialization to variables
$order_id_for_zarinpal=$_SESSION["order_id"];
$Amount=$_SESSION["order_total_price"]; //Amount will be based on Toman - Required
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
$Description = " تست درگاه زرین پال توسط جهانگیر پچکم"; // Required
$Email = "jahangirpachkam@gmail.com"; // Optional
$Mobile = '09123456789'; // Optional
$CallbackURL = "آدرسی که از برنامه ngrok دریافت می کنید/ecommerce/verify.php?Amount=$Amount&order_id_for_verify=$order_id_for_zarinpal"; // Required

$client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentRequest(
[
'MerchantID' => $MerchantID,
'Amount' => $Amount,
'Description' => $Description,
'Email' => $Email,
'Mobile' => $Mobile,
'CallbackURL' => $CallbackURL,
]
);

//Enter the Authority field value in the order table
$au=$result->Authority;	
$sql="UPDATE `order` SET `authority`='zarinpal_$au' WHERE `order_id`=$order_id_for_zarinpal";
mysqli_query($con,$sql);

//Redirect to URL You can do it also by creating a form
if ($result->Status == 100) {
Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
} else {
echo'ERR: '.$result->Status;
}?>