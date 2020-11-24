<?php

header("Content-Type:application/json");

if (!isset($_GET["token"])) {
    echo "Technical error";
    exit();
}




if (!$request = file_get_contents('php://input')) {
    echo "Invalid input";
    exit();
}






$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}



//Put the json string that we received from Safaricom to an array
$array = json_decode($request, true);
$transactiontype = mysqli_real_escape_string($con, $array['TransactionType']);
$transid = mysqli_real_escape_string($con, $array['TransID']);
$transtime = mysqli_real_escape_string($con, $array['TransTime']);
$transamount = mysqli_real_escape_string($con, $array['TransAmount']);
$businessshortcode =  mysqli_real_escape_string($con, $array['BusinessShortCode']);
$billrefno =  mysqli_real_escape_string($con, $array['BillRefNumber']);
$invoiceno =  mysqli_real_escape_string($con, $array['InvoiceNumber']);
$msisdn =  mysqli_real_escape_string($con, $array['MSISDN']);
$orgaccountbalance =   mysqli_real_escape_string($con, $array['OrgAccountBalance']);
$firstname = mysqli_real_escape_string($con, $array['FirstName']);
$middlename = mysqli_real_escape_string($con, $array['MiddleName']);
$lastname = mysqli_real_escape_string($con, $array['LastName']);



$sql = "INSERT INTO mpesa_payments
( 
TransactionType,
TransID,
TransTime,
TransAmount,
BusinessShortCode,
BillRefNumber,
InvoiceNumber,
MSISDN,
FirstName,
MiddleName,
LastName,
OrgAccountBalance
)  
VALUES  
( 
'$transactiontype', 
'$transid', 
'$transtime', 
'$transamount', 
'$businessshortcode', 
'$billrefno', 
'$invoiceno', 
'$msisdn',
'$firstname', 
'$middlename', 
'$lastname', 
'$orgaccountbalance' 
)";


if (!mysqli_query($con, $sql)) {
    echo mysqli_error($con);
} else {
    echo '{"ResultCode":0,"ResultDesc":"Confirmation received successfully"}';
}

mysqli_close($con);
