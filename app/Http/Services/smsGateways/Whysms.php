<?php

namespace App\Http\Services\smsGateways;

use SoapClient;

class Whysms
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function sendSms($phone, $message)
    {
        // Make Post Fields Array
        $requried_data = [
            "recipient" => '2' . $phone,
            "sender_id" => 'Reachy Mart',
            "type" => 'plain',
            "message" => $message,
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 33|PbcLXd8wvpvkGfHX7GWts3Jl4H2sA64NFX7iyEyV',
        ];

        $apiURL = 'https://bulk.whysms.com/api/v3/sms/send';

        // $client = new \GuzzleHttp\Client([
        //     'headers' => $headers]
        // );

        $client = new \GuzzleHttp\Client();

        $res = $client->request('POST', $apiURL, [
            'headers' => $headers,
            'json' => $requried_data,
        ]);

        $statusCode = $res->getStatusCode();
        $responseBody = json_decode($res->getBody(), true);

        //dd($responseBody);
        return $responseBody;
    }
}