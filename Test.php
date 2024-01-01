<?php
require_once ('vendor/autoload.php'); // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php

$ultramsg_token="2ru1zn0jkzecckl8"; // Ultramsg.com token
$instance_id="instance60652"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

$to="+919512891404"; 
$body="Hello world"; 


$caption="image Caption"; 
$priority=10;
$referenceId="SDK";
$nocache=false; 
$api=$client->sendImageMessage($to,$image,$caption,$priority,$referenceId,$nocache);


$video="https://file-example.s3-accelerate.amazonaws.com/video/test.mp4";
$caption="video Caption"; 
$api=$client->sendVideoMessage($to,$video,$caption);

$api=$client->sendChatMessage($to,$body);
print_r($api);  