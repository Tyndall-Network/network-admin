<?php


$shortcode="*****"; //YOUR_SHORT_CODE_HERE
$initiatorname="******"; //The initiator law
$initiatorpassword="**************";


$consumerkey    ="******************";//YOUR_CONSUMER_SECRET_HERE
$consumersecret ="*******************"; //YOUR_CONSUMER_SECRET_HERE


$commandid='BusinessPayment';
$mobilenumber="*****************"; //client mobile number
$amount="10"; //amount to be paid by client
$remarks='TEST BUSINESS DISBURSAL';
$occassion='JANUARY 2020';
$lipa_time = date('YmdHis');
$LipaNaMpesaOnlinePassKey = "****************************************************************************"; //input your 


$QueueTimeOutURL="http://lagaster.com"; // in put your queue time out url here
$ResultURL="http://lagaster.com"; // input your response url here




$url1 = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$headers = array(  
    'Content-Type: application/json; charset=utf-8'
  );
  // Request
  $ch = curl_init($url1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  //curl_setopt($ch, CURLOPT_HEADER, TRUE); // Includes the header in the output
  curl_setopt($ch, CURLOPT_HEADER, FALSE); // excludes the header in the output
  curl_setopt($ch, CURLOPT_USERPWD, $consumerkey . ":" . $consumersecret); // HTTP Basic Authentication
  $result = curl_exec($ch);  
if(curl_errno($ch)){
    echo 'Request Error:' . curl_error($ch);
    exit();
}
$result = json_decode($result);
$access_token=$result->access_token;

curl_close($ch);

$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token )); //setting custom header


  $SecurityCredential  = base64_encode($shortcode . $LipaNaMpesaOnlinePassKey . $lipa_time);
  
  
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    "BusinessShortCode"=> $shortcode,
    "Password"=> $SecurityCredential,
    "Timestamp"=> $lipa_time,
    "TransactionType"=> "CustomerPayBillOnline",
    "Amount"=> $amount,
    "PartyA"=> $mobilenumber,
    "PartyB"=> $shortcode,
    "PhoneNumber"=> $mobilenumber,
    "CallBackURL"=> "http://lagaster.com",
    "AccountReference"=> "Payment request",
    "TransactionDesc"=> "Payment request"
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
 

  $curl_response = json_decode($curl_response);
print_r($curl_response) ;
