<!DOCTYPE html>

<?php
require_once 'session-fl.php';
require_once 'db-fl.php';
if(isset($_POST['submit'])){
	$firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
    $acctType = $_POST['accttype'];

    /*test data
      echo "the form was submitted :";
      echo "transID: <b> $firstName </b>";
      echo "userID: <b> $lastName </b>";
      echo "transID: <b> $username </b>";
      echo "transDesc: <b> $password </b>";
      echo "transValue: <b> $accttype </b>";*/
	
    //check if all fields have been entered
    if($firstName == '' || $lastName == '' || $username == ''  || $password == '' || $password2 == '' || $acctType == ''){
		echo '<p class="errorMsg">Fields marked with * are required</p>';
	
    //check if passwords do not match
    } else if( $password != $password2){
		echo '<p class="errorMsg" style= "text-align: center;">Passwords do not match..</p>';
	} else {  
		
        //Check if duplicate username
        $qresult = mysqli_query($sqlconnection, "SELECT * FROM user WHERE username = '$username' ");
        if(mysqli_num_rows($qresult)==1){
		    echo 'username already exists';

	//add user to Users table
	    } else {
            $encyptedPassword = password_hash($password, PASSWORD_BCRYPT);
		    $query = "INSERT INTO user(first_name, last_name, username, password, acct_type) VALUES ('$firstName','$lastName','$username','$encyptedPassword','$acctType')";

            $result= mysqli_query($sqlconnection, $query);
	            if($result){
                echo '<script language="javascript">';
                echo 'alert("message successfully sent")';
                echo '</script>';
                //echo '<p class="userAdded">Registration Successful</p>';
                //header("Location:login-fl.php");
   		        } else {
	 	        echo '<p class="errorMsg">There was error during registration, please try again</p>';  
    	}
	    }   
    }
	
}
?>
<html>
<head>
<title>Finish-Line</title>
<meta name="keywords" content="contact, point venture, inventory, tracker, database, retail"/>
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
    <script>
        function goBack() {
          window.history.back();
        }
    </script>


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
                <h3>Finish-Line: Registration</h3>
            </div>
        </div>
    </header>

    <div class="row" role="main">
                
        <div class="col-md-12 col-border-padding-2 col-border-topBottom">
                    
            <div class="col-border-padding-1">
                
                <!-- Form to capture User Details -->
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <div class="form-group">
                            <label for="userDetails" class="font-weight-bold">Enter User Information</label>
                            <input type="firstName" class="form-control" name="fname" aria-describedby="firstNameHelp" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="lastName" class="form-control" name="lname" placeholder="Last Name">
                        </div>

                        <div class="form-group">
                            <label for="createUsername" class="font-weight-bold">Create Username and Password</label>
                            <input type="username" class="form-control" name="username" aria-describedby="usernameHelp" placeholder="Enter New Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                            <label for="passwordrules" class="font-weight-bold">(Only numbers and letters allowed)</label>
                        </div> 
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
                            <label for="passwordrules" class="font-weight-bold"></label>
                        </div>                     

                        
                        <label for="accounttype" class="font-weight-bold">Account Type:</label>

                        
                        <!-- Radio Buttons to Select Account Type -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="accttype" id="typeChildRadio" value="0" checked>
                            <label class="form-check-label" for="typeChildRadio">
                                Child
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="accttype" id="typeParentRadio" value="1">
                            <label class="form-check-label" for="typeParentRadio">
                                Parent
                            </label>
                        </div>

                        <!-- Submit Form Button -->
                        <div class="col text-center">
                            <button onclick="goBack()" type="cancel" aria-label="Cancel Button" class="btn btn-primary">Cancel</button>
                            <!-- Submit Changes to Update Transaction Record -->
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                        </div>     



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