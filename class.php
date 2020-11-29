<?php

$token = "YOUR_TELEGRAM_BOT_TOKEN"; //add your telgram bot token

class AmazonShorter{

private $url;

public function __construct($url){
$this->url = $url;
}

public function UrlTag(){
  $pre = "&tag=";
  $tag = "$pre"."PARTNET_ID_AMAZON"; //add your amazon partner id
  $urlg = "$this->url$tag";
 $this->url = $urlg;
}

public function UrlShortner(){
$apiurl = "https://api-ssl.bitly.com/v4/shorten";

  $postdata = '{"long_url": "'.$this->url.'"}';


  $pdata = array(
  'http'=>array(
    'method'=>"POST",
    'header'=>"Content-Type: application/json\r\n".
    "Authorization: Bearer TOKEN\n", //add bit.ly token
    'content' => $postdata
  )
);
$context  = stream_context_create($pdata);
$request = file_get_contents($apiurl, false, $context);
$response = json_decode($request, true);
$urlshort = $response["link"];
return $urlshort;
  }
} 

function sendMessage($chat_id, $text){
 global $token;
 $api = "https://api.telegram.org/bot".$token."/sendMessage";;
  $sendMessage = $api."?chat_id=".$chat_id."&text=".$text;
  file_get_contents($sendMessage);
}


