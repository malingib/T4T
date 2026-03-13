<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customsms {

    private $_CI;
    var $AUTH_KEY = "29e2ef765947957f615747c87fd59906"; //your AUTH_KEY here
    var $senderId = "8432"; //your senderId here
    var $routeId = "T4T-KILIFI"; //your routeId here
    var $smsContentType = "plain"; //your smsContentType here

    function __construct($params) { 
        $this->_CI = & get_instance();
        $this->session_name = $this->_CI->setting_model->getCurrentSessionName();
    } 

    function sendSMS($to, $message) {
       
        $content = 'apikey=' . rawurlencode($this->AUTH_KEY) .
                '&message=' . rawurlencode($message) .
                '&partnerID=' . rawurlencode($this->senderId) .
                '&shortcode=' . rawurlencode($this->routeId) .
                '&mobile=' . rawurlencode($to) .
                '&smsContentType=' . rawurlencode($this->smsContentType);
        $ch = curl_init('https://sms.textsms.co.ke/api/services/sendsms/?' . $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}

?>