<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "applicant";
$con = new mysqli($host,$username,$password,$db);

if($con->connect_error){
    echo ("Connection Failed: ".$con->connect_error);
    $sql = "CREATE DATABASE applicant";
    $con = new mysqli($host,$username,$password);
    $result = $con->query($sql);
    if($result){
        echo "<br>Database Created successfully";
        $con = new mysqli($host,$username,$password,$db);
    }
    else {
        echo "<br> Error in databse creating";
    }
}
else {
    echo "Successful";
}


?>