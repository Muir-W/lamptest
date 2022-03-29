<!DOCTYPE html>
<?php
require_once 'db-fl.php'; //connect to inventory database (invdb)

if(isset($_POST['addRec'])){        //assign variables
    $partnum = $_POST['partnum'];
    $brand = $_POST['brand'];
    $partdesc = $_POST['partdesc'];
    $qtyonhand = $_POST['qtyonhand'];
    $rop = $_POST['rop'];
    $minro = $_POST['minro'];
    $wscost = $_POST['wscost'];
    $markup = $_POST['markup'];

    //check data is present
	if(isset($partnum, $brand, $partdesc, $qtyonhand, $rop, $minro, $wscost, $markup)){
        //build sql statement
        $insertRec = "INSERT INTO invdb(partnum, brand, partdesc, qtyonhand, rop, minro, wscost, markup) VALUES ('$partnum','$brand','$partdesc', '$qtyonhand', '$rop', '$minro', '$wscost', '$markup')";
    } else {
		echo "Error: All Fields Are Required";
    }
    //run query
    $query= mysqli_query($sqlconnection, $insertRec);
	//check for errors
    if($query){
        header("Location:piggyhistory-fl.php");
    }else {
	    echo "There was a problem adding the transaction record";  
	}	
}
?>
<html>
<head>

	<title>Finish-Line</title>
	<meta name="keywords" content="add record, point venture, inventory, tracker, database, retail"/>
	<meta type="description" content="Point Venture Retail Inventory Tracking Database"/>
	<meta name="robots" contents="nofollow">
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="main7less.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>

</head>
<body>
	
	<div id="main-container">	
	<header>
    <h1> Inventory Tracker: Add Inventory Record </h1>
    </header>
		
    <div id="left-side-bar"> 
    <nav>
    <?php include_once 'lsbmenu.php';?> <!--left side bar menu-->
    </nav>
    
    </div>

    <div id="right-side-bar">
    </div>

    <main>
    <section>
        <!--build table for adding record; return input in http post-->
        <form class="optable" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <h1> Add Inventory Record</h1>    

            <label>Part Number</label> <input type="text" name ="partnum" ><br>
            <label>Brand</label> <input type="text" name ="brand"><br>
            <label>Description</label> <input type="text" name="partdesc" ><br>
            <label>On Hand</label> <input type="text" name="qtyonhand" ><br>
            <label>Reorder Point</label> <input type="text" name ="rop" ><br>
            <label>Minimum Reorder</label> <input type="text" name ="minro" ><br>
            <label>Wholesale Cost</label> <input type="text" name="wscost" ><br>
            <label>Markup %</label> <input type="text" name="markup" ><br>

            <input type="submit" value ="ADD" name="addRec">
        
        </form>

</section>
</main>
 
<footer>
    Copyright 2021 PV Inventory Authority.
</footer>


</div>
</div>
</body>
</html>
