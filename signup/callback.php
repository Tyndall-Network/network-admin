<?php

header("Content-Type:application/json");


$callbackJSONData = file_get_contents('php://input');

$callbackData = json_decode($callbackJSONData,true);


$resultCode =$callbackData['Body']['stkCallback']['ResultCode'];
$resultDesc  =$callbackData['Body']['stkCallback']['ResultDesc'];
$MerchantRequestID  =$callbackData['Body']['stkCallback']['MerchantRequestID'];
$CheckoutRequestID  =$callbackData['Body']['stkCallback']['CheckoutRequestID'];

// $lastname = mysqli_real_escape_string($con, $array['LastName']);
$servername = "127.0.0.1";
$username = "Bram";
$password = "Bram1!";
$dbname = "radius_users";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($resultCode == 0) {
	# code...
	//Metadata
$amount =  $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
$mpesaReceiptNumber =  $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
$balance =  $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][2]['Value'];
$transactionDate =  $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
$phoneNumber =  $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];

$sql = "INSERT INTO MPesa
( 
MerchantRequestID,
CheckoutRequestID ,
ResultCode,
ResultDesc,
Amount,
MpesaReceiptNumber,
TransactionDate,
PhoneNumber
)
VALUES  

( 
'$MerchantRequestID ', 
'$CheckoutRequestID ', 
'$resultCode', 
'$resultDesc', 
'$amount', 
'$mpesaReceiptNumber', 
'$transactionDate', 
'$phoneNumber'
) ";

if (!mysqli_query($con, $sql)) {
    echo mysqli_error($con);
} else {
    echo '{"ResultCode":0,"ResultDesc":"Confirmation received successfully"}';
}

}else{
	
$sql = "INSERT INTO mpesaFailed
( 
MerchantRequestID,
CheckoutRequestID ,
ResultCode,
ResultDesc
)
VALUES  

( 
'$MerchantRequestID ', 
'$CheckoutRequestID ', 
'$resultCode', 
'$resultDesc'
) ";

if (!mysqli_query($con, $sql)) {
    echo mysqli_error($con);
} else {
    echo '{"Transaction Failed"}';
	}

}

 mysqli_close($con);

if($resultCode == 0)
  {

			include('library/opendb.php');
			//include('index.php');

			// the payment is valid, we activate the user by adding him to freeradius's set of tables (radcheck etc)
			// get transaction id from paypal ipn POST
			$txnId = $dbSocket->escapeSimple($_POST['txnId']);

			/*$Password = $_POST['password'];
			$phoNumber = $_POST['phoneNumber'];*/


			// find the pin code to activate using the pin
			$sql = "SELECT username,password,planId FROM ".$configValues['CONFIG_DB_TBL_DALOBILLINGPAYPAL']." WHERE txnId='$txnId'";
			$res = $dbSocket->query($sql);
			$row = $res->fetchRow();
			$phoneNumber = $row[0];
			$password = $row[1];
			$planId = $row[2];

			echo "$password" ;
			// firstly, we add the user to the radcheck table and authorize him
			$sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADCHECK']." (id,username,attribute,op,value) ".
				" VALUES (0,'$phoneNumber','Cleartext-Password', ':=', '$password')";
			$res = $dbSocket->query($sql);


			// we then search the plans to see if the user should belong to a specific
			// usergroup or shall we just add the appropriate attribute to radcheck
			$sql = "SELECT planTimeBank,planGroup,planTimeType,planRecurring,planRecurringPeriod FROM ".
				$configValues['CONFIG_DB_TBL_DALOBILLINGPLANS']." WHERE planId='$planId'";
			$res = $dbSocket->query($sql);
			$row = $res->fetchRow();
			$planTimeBank = $row[0];
			$planGroup = $row[1];
			$planTimeType = $row[2];
			$planRecurring = $row[3];
			$planRecurringPeriod = $row[4];
			
			// the group is set, so we simply add the user to this group
			if ($planGroup != "") {

				$sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADUSERGROUP']." (UserName,GroupName,priority) ".
					" VALUES ('$phoneNumber','$planGroup','0') ON DUPLICATE KEY UPDATE groupname = '$planGroup'";
				$res = $dbSocket->query($sql);
			
			} else {
	
				switch ($planTimeType) {

					case "Time-To-Finish":
						// time to finish means that the time credit for the user starts at first login and then the counter
						// starts running, even if he disconnects, his time is running down, until it's 0 and then he used it all up

						$sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADCHECK']." (id,UserName,Attribute,op,Value) ".
							" VALUES (0,'$phoneNumber','Access-Period', ':=', '$planTimeBank')";
						$res = $dbSocket->query($sql);

						break;

					case "Accumulative":
						// accumulate means that the user was given a time credit of N minutes and he can use them whenever he wants,
						// and spreads it towards hours, days, weeks or months.

						if ((isset($planRecurring)) && ($planRecurring == "Yes")) {

							switch ($planRecurringPeriod) {

								case "Never":
									$sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADCHECK']." (id,UserName,Attribute,op,Value) ".
										" VALUES (0,'$phoneNumber','Max-All-Session', ':=', '$planTimeBank')";
									$res = $dbSocket->query($sql);
									break;

								case "Monthly":
									$sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADCHECK']." (id,UserName,Attribute,op,Value) ".
										" VALUES (0,'$phoneNumber','Max-Monthly-Session', ':=', '$planTimeBank')";
									$res = $dbSocket->query($sql);
									break;

								case "Weekly":
									$sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADCHECK']." (id,UserName,Attribute,op,Value) ".
										" VALUES (0,'$phoneNumber','Max-Weekly-Session', ':=', '$planTimeBank')";
									$res = $dbSocket->query($sql);
									break;

								case "Daily":
									$sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADCHECK']." (id,UserName,Attribute,op,Value) ".
										" VALUES (0,'$phoneNumber','Max-Daily-Session', ':=', '$planTimeBank')";
									$res = $dbSocket->query($sql);
									break;
							}
						}						
						break;
				}

			}

			include('library/closedb.php');


  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.location.href='mpesa-ipn.php';
 </SCRIPT>");
}

?>