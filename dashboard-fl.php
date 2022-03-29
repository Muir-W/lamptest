<!DOCTYPE html>

<?php
ob_start();
require_once 'session-fl.php';
require_once 'db-fl.php';
$currentuser = $_SESSION['userid'];

    //data from http form's post
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePW'])){
        $currentPW = $_POST['cpassword'];
        $newPW = $_POST['npassword'];

        $query = ("SELECT * FROM user WHERE user_id='$currentuser'");
        $result = mysqli_query($sqlconnection, $query);

        if ($row = @mysqli_fetch_assoc($result)) {
            
            $passwordhash = $row['password'];

            if (password_verify($currentPW, $passwordhash)){
        
                $password = trim($_POST['npassword']);
                $password2 = trim($_POST['npassword2']);
                $encyptedPassword = password_hash($password, PASSWORD_BCRYPT);

                //update sql statement
                $updatequery = "UPDATE user SET password = '$encyptedPassword' WHERE user_id = '$currentuser'"; //'$_SESSION['userid']
                $query =@mysqli_query($sqlconnection, $updatequery); 
                //check if errors occur
                if($query){

                    //Success Message
                    echo "<script>";
                    echo "alert('Password Update Was Successful');";
                    echo "</script>";
                    }else  {
                        die("Connection failed ".$sqlconnection->connect_error);
                    }
            }
        }else  {
            die("Connection failed First Try".$sqlconnection->connect_error);
        }
    }

    //data from http form's post
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['associateChild'])){
        $childID = $_POST['childacctID'];
        $childquery = ("SELECT * FROM user WHERE user_id='$childID'");
        $query =@mysqli_query($sqlconnection, $childquery);
        if ($query){
            $updatequery = "UPDATE user SET associated_userID1 = '$childID' WHERE user_id = '$currentuser'"; //'$_SESSION['userid']
                $query =@mysqli_query($sqlconnection, $updatequery); 
                //check if errors occur
                if($query){

                    //Success Message
                    echo "<script>";
                    echo "alert('Child Association has been Updated Successful');";
                    echo "</script>";
                    }else  {
                        die("Connection failed ".$sqlconnection->connect_error);
                    }


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

    <!--require confirmation before deleting a record-->
    <script>
    function DeleteRecord() {
    return confirm("Click OK to Permanently Delete Transaction.");
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

    <!-- TOP HEADLINE -->
    <div id="topHeader" class="container-fluid">
		
		<header role="banner">
			<div class="row">
				<div class="col-md-12 col-border-padding-2">
					<h3>Finish-Line: User Profile</h3>
				</div>
			</div>
		</header>

        <!-- CREATE 1 ROW CONTAINER -->
        <div class="row" role="main">
            <!-- CREATE 1 FULL LENGTH COLUMN CONTAINER -->
            <div class="col-md-12 col-border-padding-2 col-border-topBottom">
                <!-- PADDING -->
                <div class="col-border-padding-1">
                    <?php
                        $query = "SELECT username, first_name, last_name FROM user WHERE user_id= $currentuser";
                            $result = mysqli_query($sqlconnection, $query);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<br> <h4> <b>Account Information:</b></h4> <b>Username: </b>". $row["username"]. "<br> <b>First Name: </b>". $row["first_name"]. "<br> <b>Last Name: </b>" . $row["last_name"] . "<br>";
                            }
                        } else {
                            echo "0 results";
                        }
                        
                        //$sqlconnection->close();
                    ?>
                    <br>
                    <div style="text-align: center;">
                        <b>Update Password</b>
                    </div>
                    <br>
                    <!-- Password Update Form -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <div class="form-group">
                            <input type="password" class="form-control" name="cpassword" placeholder="Enter Current Password" required>

                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control"  name="npassword" placeholder="Enter New Password" required>

                        </div>
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <input type="password" class="form-control" name="npassword2" placeholder="Confirm New Password" required>

                        </div>  
                        
                        <!-- Update Button -->
                        <div class="col-border-padding-1">
                            <div class="col text-center">
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary" name="updatePW" value="submit">Update Password</button>    
                            </div> 

                        </div>
                        <br>
                        
                    </form>

                    <div style="text-align: center;">
                        <b>Associate Child Account</b>
                    </div>
                    <br>

                    <!-- Associate Child Form -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <div class="form-group">
                            <input type="childassoc" class="form-control" name="childacctID" placeholder="Enter Child Account ID#" required>

                        </div>

                        <!-- Add Child Association Button -->
                        <div class="col-border-padding-1">
                            <div class="col text-center">
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary" name="associateChild" value="submit">Update Child Association</button>    
                            </div> 

                        </div>
                        <br>
                    </form>

                        <main>
                        <section>
                            <!--build table for associated child account-->
                            <!--table headings-->
                            <div class="table-responsive-sm">
                                <table class="table table-hover" >
                                    <thead class="thead">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">ID#</th>
                                        </tr>
                                    </thead>

                                    <!--query database to return all records for display-->
                                    <?php  
                                    $query = ("SELECT associated_userID1 FROM user WHERE user_id='$currentuser'");
                                        $result = mysqli_query($sqlconnection, $query);
                                        if ($row = @mysqli_fetch_assoc($result)) {
                                            $buildrow['associated_userID1'] = $row['associated_userID1'];
                                            $assocID = $buildrow['associated_userID1'];

                                            $query = ("SELECT first_name, last_name FROM user WHERE user_id='$assocID'");
                                                $result = mysqli_query($sqlconnection, $query);
                                                    if ($row = @mysqli_fetch_assoc($result)) {
                                                        $buildrow['first_name'] = $row['first_name'];
                                                        $buildrow['last_name'] = $row['last_name'];
                                                    }}?>              
                                                
                                            <!--table for outputting transaction records-->
                                            <tr>
                                                <td id="od"><?php echo ($buildrow["first_name"] . " " . $buildrow["last_name"]);?></td>
                                                <td class="od"><?php echo $buildrow["associated_userID1"];?></td>
                                                <td class="ev"></td>
                                            </tr>
                                            <!-- <?php}?> -->
                                </table>
                            </div>
                        </section>
                    </main>


                </div>
            </div>
        </div>
    </div>

</body>

    <!-- Footer -->
    <div id="bottomFooter" class="container-fluid col-border-padding-3">
        <footer style="text-align: center;" role="contentinfo">
            <h7>Copyright 2022 Finish-Line.</h7>
        </footer>
    </div>	
</html>
