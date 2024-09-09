<?php

namespace App;
use DB;

class SMS
{
    
    public function __construct(){}

    public static function send($to,$message)
    {
        $apiKey = "MzQ2MTU4Nzc2OTU2Mzc2YzRkNmQ2MjRiMzM2NjM2MzM=";
        $numbers = array($to);
        $sender = "GSALEI";
        $numbers = implode(',', $numbers);
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}