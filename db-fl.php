<?php
$servername = 'localhost'; //default MySQL crednetials
$username ='finishline';
$password = 'swdv691';
$dbase = 'flmasterdb'; //dbase specific to this project

$sqlconnection = @mysqli_connect($servername, $username, $password, $dbase); //establish connection to MySQL db
if(!$sqlconnection){
    die('MySQL Connection Failed; Verify Connection Credentials.');
}

$dbconnection = @mysqli_select_db($sqlconnection, $dbase); //check connection to database
if(!$dbconnection){
	die("Database Connection Failed; Verify Database ". $dbase ." actually exists.");
}

?>