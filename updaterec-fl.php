 <!DOCTYPE html>

<?php
ob_start();
require_once 'session-fl.php';
require_once 'db-fl.php';
    //data from http form's post
    if(isset($_POST['updateRec'])){
	  $transID = $_POST['transid'];
	  $userID = $_POST['user_id'];
	  $transDate = $_POST['trans_date'];
	  $transDesc = $_POST['trans_desc'];
	  $transValue = $_POST['trans_value'];

      /*test data
      echo "the form was submitted :";
      echo "transID: <b> $transID </b>";
      echo "userID: <b> $userID </b>";
      echo "transID: <b> $transID </b>";
      echo "transDesc: <b> $transDesc </b>";
      echo "transValue: <b> $transValue </b>";*/


    //update sql statement
    $updatequery = ("UPDATE transaction SET user_id='$userID', trans_date= '$transDate', trans_desc= '$transDesc', trans_value='$transValue'
    WHERE transaction_id ='$transID'");
    $query =@mysqli_query($sqlconnection, $updatequery); 
	//check if errors occur
    if($query){
        //if successful redirect to the following url 
	    header("Location:piggyhistory-fl.php");	
        }else  {
            die("Connection failed ".$sqlconnection->connect_error);
   
	    }
    }
    //prefill table with transaction data
    $transID = $_GET['transid'];
    $query = "SELECT * FROM transaction WHERE transaction_id ='$transID' ";
    $result = mysqli_query($sqlconnection, $query);    
    $row = @mysqli_fetch_assoc($result);   
    $userID = $row["user_id"];
    $transDate = $row["trans_date"];
    $transDesc = $row["trans_desc"];
    $transValue= $row["trans_value"];

?>
<html>
<head>
  <title>Finish-Line</title>
	<meta name="keywords" content="edit record, point venture, inventory, tracker, database, retail"/>
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

 
  
    <!-- Navbar Container -->
        <div class="container-fluid" style="background-color:white">

    <!-- Navbar toggle to hamburger menu -->
    <nav class="navbar navbar-expand-xl bg-white navbar-light">
        <a class="navbar-brand" href="#">
            <img src="logo2.JPG" width="70" height="45" alt="brand logo">
        </a>

        <!-- Navbar Hamburger Icon -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Link List -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar" role="navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="index-fl.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login-fl.php">Account Login</a>
                </li>    
            </ul>
        </div>  
    </nav>
    </div>
        
    <div id="topHeader" class="container-fluid">
        
        <header role="banner">
            <div class="row">
                <div class="col-md-12 col-border-padding-2">
                    <h3>Finish-Line: Update transaction Record</h3>
                </div>
            </div>
        </header>


        <div class="row" role="main">
                
            <div class="col-md-12 col-border-padding-2 col-border-topBottom">
                
                <div class="col-border-padding-1">

                    <!--build table for updating record; return input in http post-->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        
                        
                    
                        <div class="form-group">

                            <input type="text" name="transid" value= "<?php echo $transID;?>">

                            <label for="formGroupUserID">User ID#</label>
                            <input type="text" class="form-control" name="user_id" value= "<?php echo $userID;?>">

                            <label for="formGroupTransDate">Date</label>
                            <input type="text" class="form-control" name="trans_date" value="<?php echo $transDate;?>">

                            <label for="formGroupTransDesc">Description</label>
                            <input type="text" class="form-control" name="trans_desc" value= "<?php echo $transDesc;?>">

                            <label for="formGroupTransValue">Value</label>
                            <input type="text" class="form-control" name="trans_value" value="<?php echo $transValue;?>">
                        </div>

                        <!-- Submit Changes to Update Transaction Record -->
                        <button type="submit" class="btn btn-primary" name="updateRec" value="UPDATE">Update</button>

                    </form>

                    <br>
                </div>
            </div>
        </div>
    </div>   

    
   <!-- Footer -->
   <div id="bottomFooter" class="container-fluid col-border-padding-3">
        <footer style="text-align: center;" role="contentinfo">
            <h7>Copyright 2022 Finish-Line.</h7>
        </footer>
    </div>	
</body>
</html>
  