<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmSController extends Controller
{
    public function quickMessage()
    {
        // dynamic message
        $message = 'This is a test message';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://smsportal.hostpinnacle.co.ke/SMSApi/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "userid=Pafid&password=xxxxx&sendMethod=quick&mobile=254796458762&msg=".$message."&senderid=HPKSMS&msgType=text&duplicatecheck=true&output=json",
            CURLOPT_HTTPHEADER => array(
                "apikey: 14e9d08f986cdac9422769a9047d591e43313c43",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
