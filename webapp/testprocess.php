<?php
/**
 * Created by PhpStorm.
 * User: pradeep.ck
 * Date: 6/1/2015
 * Time: 5:24 PM
 */

execInBackground("php JobMatchNotifier.php 35 >err.txt");

function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        echo "in windows\n";
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
}
?>