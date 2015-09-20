<?php
/**
 * Created by PhpStorm.
 * User: pradeep.ck
 * Date: 5/29/2015
 * Time: 10:19 AM
 */
require "WebRequest.php";

$smsSender = new SMSSender();
$result = $smsSender->send("Testing with classes", array("7588529619","7775928628"));
echo $result;

class SMSSender
{
    private $profileId  = "20070311";
    private $user       = "20070311";
    private $pwd        = "Ui4gzn";
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
            "msgtext" =>"this is a test message"
        );
        $result = $webRequest->get( "http://bulksmsindia.mobi/sendurlcomma.aspx?",$params);
        return $result;
    }
}

?>