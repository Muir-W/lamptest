<?php
require 'db-fl.php';
$transID = $_GET['transid']; //get id from http form
$query = "DELETE FROM transaction WHERE transaction_id = '$transID'"; //build sql statement
$delquery = mysqli_query($sqlconnection, $query);      //run query      
if($delquery){                                         //check for errors
	header("Location:piggyhistory-fl.php");
}else{
	echo "Error: Unable to Delete Transaction Record";
}

?>