<?php
/**
 * Created by PhpStorm.
 * User: pradeep.ck
 * Date: 6/1/2015
 * Time: 5:18 PM
 */

/*
This file takes a command line argument of a job id, looks for all candidates matching the job criteria, and sends sms message to each of them.



*/
require "SMSSender.php";

echo "in sendnotifications\n" . $argv[1];
$servername = "localhost";
$username = "root";
$password = "m@n@9e";
$dbname = "smartjobdb";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql1 = <<< EOT
select distinct u.phonenumber, u.username, matchingresumes.Title from users u,
 ( SELECT resumes.user_sid , jobs.Title, resumes.TotalYearsExperience as resumes_tye, resumes.Location_State as resumes_state, resumes.Location_District as resumes_district,
 resumes.JobCategory as resumes_jobcategory,
 jobs.sid, jobs.TotalYearsExperience as jobs_tye, jobs.Location_State jobs_state, jobs.Location_District as jobs_district,
jobs.JobCategory as jobs_category FROM smartjobdb.listings as jobs,
 smartjobdb.listings as resumes  where jobs.sid =
EOT;
$sql2 =  $argv[1] ." and" ;
$sql3 = <<<EOT
 resumes.listing_type_sid=7 and
( jobs.TotalYearsExperience  is NULL or jobs.TotalYearsExperience = 0 or resumes.totalYearsExperience between jobs.TotalYearsExperience - 2 and jobs.TotalYearsExperience + 2)
and ( jobs.Location_State is NULL or jobs.Location_State = "" or resumes.Location_State = jobs.Location_State )
and (jobs.Location_District is NULL or jobs.Location_District = "" or resumes.Location_District = jobs.Location_District )
and (jobs.JobCategory is NULL  or jobs.JobCategory = "" or stringSetIntersect(jobs.JobCategory, resumes.JobCategory) = TRUE)
and (jobs.Occupations is NULL  or jobs.Occupations = "" or stringSetIntersect(jobs.Occupations, resumes.Occupations) = TRUE)
 ) as matchingresumes
where u.sid = matchingresumes.user_sid
EOT;
$sql = $sql1.$sql2.$sql3;echo $sql;
$result = $conn->query($sql);
$conn->close();
if ($result->num_rows > 0) {
    $phoneNumbers = array();
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "phonenumber: " . $row["phonenumber"]. " - Name: " . $row["username"] . "\n";
        $phoneNumbers[]= $row["phonenumber"];

    }
    var_dump($phoneNumbers);
    $smsSender = new SMSSender();
    $result = $smsSender->send("You have been selected for the job of Welder ",$phoneNumbers);
    echo $result;

} else {
    echo "\n no matching results found";
}


// connect to the database
?>