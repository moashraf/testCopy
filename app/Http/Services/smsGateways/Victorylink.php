<?php

namespace App\Http\Services\smsGateways;
use SoapClient;

class Victorylink{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *0 The SMS is sent successfully.
     *-1 User is not subscribed
     *-5 out of credit.
     *-10 Queued Message, no need to send it again.
     *-11 Invalid language.
     *-12 SMS is empty.
     *-13 Invalid fake sender exceeded 12 chars or empty.
     *-25 Sending rate greater than receiving rate (only for send/receive accounts).
     *-100 other error
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    //to change the object of error to array
    public function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(array($this, 'objectToArray'), $d);
        //$this->d = get_object_vars($d);
        }
        else {
            // Return array
            return $d;
        }
    }


    public function sendSms($phone, $message, $language = 'en'){

        $client = new SoapClient("https://smsvas.vlserv.com/KannelSending/service.asmx?wsdl");
        
        $userName =  config('sms.victorylink.userName');
        $Password =  config('sms.victorylink.password');
        $SMSText = $message;
        $SMSLang = $language == 'ar' ? 'A' : 'E';
        $SMSSender = config('sms.victorylink.sms_sender');
        $SMSReceiver = $phone;
        
        $result = $client->SendSMSWithDLR(array(
        "UserName" => $userName,
        "Password" => $Password,
        "SMSText" => $SMSText,
        "SMSLang" => $SMSLang,
        "SMSSender" => $SMSSender,
        "SMSReceiver" => $SMSReceiver));

        //to fetch the error 
        $response_arr = $this->objectToArray($result);
        return $response_arr;
        //echo implode(' ', $response_arr);
        //$imp = $imp[1];
        //echo "return_code= " . str_replace(";", "", $response_arr);
        //dd($response_arr);
        

        //another method
        /* 
        $params = [
            'UserName' => config('sms.victorylink.userName'),
            'Password' => config('sms.victorylink.password'),
            'smsText' => $message,
            'SMSLang' => $language == 'ar' ? 'A' : 'E',
            'SMSSender' => config('sms.victorylink.sms_sender'),
            'SMSReceiver' => $phone,
        ];
        try {
            $smsURL = "https://smsvas.vlserv.com/KannelSending/service.asmx?wsdl";
            $response = $this->client->post($smsURL, ['form_params' => $params]);
            $content = $response->getBody();

            $xml = (array) simplexml_load_string($content);
            
            if($xml[0] == '0'){
                return true;
            }else {
                info("Victorylink error status!"); //in log
                return false;
            }
        } 
        catch (\Exception $e) {
            info("VictoryLink has been trying to send sms to $phone but operation failed!");
            return false;
        }
        */


    }


}