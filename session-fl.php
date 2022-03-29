<?php

//start session
session_start();

//redirect already logged in users
if (isset($_SESSION["userid"]) && $_SESSION["userid"] === true) {
    header("location: piggyhistory-fl.php");
}
?>
