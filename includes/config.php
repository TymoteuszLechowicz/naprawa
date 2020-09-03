<?php
ob_start();
session_start();

$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("localhost", "root", "", "naprawasprzetu");


try{
    $con = new PDO("mysql:dbname=naprawasprzetu;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}catch (PDOException $e){
    exit("Connection failed: " . $e->getMessage());
}
?>