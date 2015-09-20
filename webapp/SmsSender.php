<?php
/**
 * Created by PhpStorm.
 * User: pradeep.ck
 * Date: 5/29/2015
 * Time: 12:05 PM
 */
require "WebRequest.php";

class SMSSender
{
    private $profileId  = "20070311";
    private $user       = "20070311";
    private $pwd        = "20070311";
    private $senderId   = "Anant Innovation";

    public function send($message, $list)
    {
        $webRequest = new WebRequest();
        $params = array(
            "profileId" => $this->profileId,
            "user" => $this->user,
            "pwd" =>  $this->pwd,
            "senderId" => $this->senderId,
            "mobileno" => implode(",",$list),
            "msgtext" =>$message
        );
        $result = $webRequest->get( "http://bulksmsindia.mobi/sendurlcomma.aspx?",$params);
        return $result;
    }
}

?>