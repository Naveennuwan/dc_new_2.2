<?php

namespace App\Services;

use App\Models\Patient;

class SmsService
{
    protected $user;
    protected $password;
    protected $baseurl;

    public function __construct()
    {
        $this->user = "94705742090";
        $this->password = "5713";
        $this->baseurl = "http://www.textit.biz/sendmsg";
    }

    public function sendSms($patientId, $message)
    {
        $patient = Patient::find($patientId);

        // dd($patientId, $message);

        if (!$patient) {
            return false;
        }

        $sendTo = "94705742090";
        // $to = "94711649932";

        if (empty($sendTo)) {
            return false;
        }
        
        $text = urlencode($message);
        $url = "{$this->baseurl}/?id={$this->user}&pw={$this->password}&to={$sendTo}&text={$text}";
        // dd($url, $message);
        $response = @file($url);

        if (!$response || count($response) == 0) {
            return false;
        }


        $result = explode(":", $response[0]);
        return trim($result[0]) == "OK";
    }
}