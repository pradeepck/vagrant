<?php
/**
 * Created by PhpStorm.
 * User: pradeep.ck
 * Date: 5/29/2015
 * Time: 12:05 PM
 */
require "WebRequest.php";

class UserUpload
{
    public function upload()
    {
		$cfile =  new CURLFile('useruploaddata.xls','application/vnd.ms-excel','useruploaddata.xls');
        $webRequest = new WebRequest();
        $params = array(
            "action" => 'login',
            "username" => "admin",
            "password" =>  "admin",
        );
        $result = $webRequest->post( "http://localhost/rozgarmela/admin/",$params);
        //echo "tried to login, result is " . $result . "\n";
        $params = array(
            "user_group_id" => 'JobSeeker',
            "import_file" => $cfile,
            "file_type" =>  'xls',
            "csv_delimiter" => 'semicolon',
            "encodingFromCharset" => 'UTF-8',
            "action" =>'Import'
        );
        $result = $webRequest->post( "http://localhost/rozgarmela/admin/import-users/",$params);
        echo "sent data, result is " . $result . "\n";
        return $result;
    }
}
$userUpload = new UserUpload();
echo $userUpload->upload();
?>