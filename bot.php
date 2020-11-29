<?php
include "class.php";

$content = file_get_contents("php://input");
$result = json_decode($content, true);

$msg = $result['message']['text'];
$chat_id = $result['message']['chat']['id'];

if ($msg == "/start")
{
    sendMessage($chat_id, "Hi, send me the Amazon link preceded by /link");
}

if (strpos($msg, "/link") === 0)
{
    $a = explode(" ", $msg, 2);
    $link = $a[1];
    $short = new AmazonShorter($link);
    $short->UrlTag();
    sendMessage($chat_id, "Amazon Ref Link: " . $short->UrlShortner());
}

