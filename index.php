<?php

$token = '1742529942:AAHBsIsqvF9IdoLk0E3-lAi32ok1jVFxzko';
//$link = 'https://api.telegram.org:443/bot'.$token.'';
$link = 'https://api.telegram.org/bot'.$token.'';
$update = json_decode(file_get_contents("php://input"), TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$Welcom_message="Welcome you";
$getparameter="";
switch ($message) {
case '/start':
    $Welcom_message = 'Welcom This Bot Get Your Location and Share XXX Information';
	$getparameter=contentBuilder($chatId,$Welcom_message,KeyboardMenu());
    break;
case $Location:
    $lat = $Location['latitude'];
    $lon = $Location['longitude'];
    if (isset($Location['longitude']['latitude']))
        {
            $Welcom_message = "This is your Current Location." .$lat. $lon;
        }
   else
       {
            $Welcom_message ="error";
       }
break;
case $Contact:
	$Welcom_message = $Contact['phone_number'];
break;
default:
    $Welcom_message='Welcome To My Bot.';
}
		//$yoniKeboard='{ "keyboard": [["verify me"]],"request_location":true,"request_contact":true, "one_time_keyboard": true,"remove_keyboard":true}';
	

$request_url = $link.'/sendMessage?'.http_build_query($getparameter); 
 
file_get_contents($request_url);	
function contentBuilder($chatid,$Welcomnote,$yoniPressBoard)
{
$parameter = array(
 'chat_id' => $chatid, 
 'text' => $Welcomnote,
 'reply_markup' => $yoniPressBoard
 );
return  $parameter;
}
function KeyboardMenu(){
    $buttons = [[['text'=>"Get My Location", 
'request_location'=>true]],[['text'=>"Get My Phone Number",'request_contact'=>true]],[['text'=>"Just Have Fun"]]];
     $keyboard =json_encode($keyboard=['keyboard' => $buttons,
                                        'resize_keyboard' => true,
                                        'one_time_keyboard'=> false,
                                        'selective' => true]);
   //$reply_markup ='&reply_markup='.$keyboard.'';
   return $keyboard;
}
?>