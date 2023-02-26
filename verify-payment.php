



<?php

$merchant_key =  "------------------------";  // your api key from naweri.com (only business accounts have)
$merchant_account = "----------------------"; //your business email for naweri.com
$txid = strip_tags($_GET['reference']);
$txn_status=strip_tags($_GET['status']);
$payee_account = strip_tags($_GET['payee']);
$item_id=strip_tags($_GET['itemid']);
$item_name = strip_tags($_GET['itemname']);
$itemprice= strip_tags($_GET['amount']);
$item_description=strip_tags($_GET['itemdescription']);
$item_currency = strip_tags($_GET['currency']);
$payment_date=strip_tags($_GET['date_paid']);

//start verifying transaction. remember! the transaction can only be verified if the API and Email pair that initiated the account are from the same account.
//i.e you cannot verify a transaction that was initiated by a different merchant.

$verification_link ="https://naweri.com/api_request/verify/?api_key=$merchant_key&merchant=$merchant_account&txnid=$txid";
$main_url=$verification_link;
$str = file_get_contents($main_url);

if(strlen($str)>0)
{
$str = trim(preg_replace('/\s+/', ' ', $str));
preg_match("/\(.*)\<\/div\>/i",$str,$data);
$data=$data[1];
}
if($data=="success")
{
 
$data=$data[1];
}
if($data=="success")
{
 
//this point only fetches the original amount you posted to the Naweri Wallet for payment 
  /* it's not manadatory, i.e ignore if you don't need it */
  //start fetch original amount
$currency_convert_api_link ="https://wallet.naweri.com/api_request/convert/?api_key=$merchant_key&merchant=$merchant_account&txnid=$txid";
$sitr = file_get_contents($currency_convert_api_link);

if(strlen($str)>0)
{
$sitr = trim(preg_replace('/\s+/', ' ', $sitr));
preg_match("/\(.*)\<\/div\>/i",$sitr,$converted_currencies);
$original_posted_currency=$converted_currencies[1];

 
}
  
  //end fetch original amount

 
 
 echo($data);
}
elseif($data=="failed")
{
// transaction failed
 echo($data);
  
}
elseif($data=="unpaid")
{
//client did not complete the transaction

echo($data);
      
}
elseif($data=="error") {

echo($data);
  
  //an unknown erro occured, please check your code for bugs or your submission for correct information
      
}

  ?>
 
