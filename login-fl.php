<!DOCTYPE html>

<?php 
require_once 'session-fl.php';   //create new session
require_once 'db-fl.php';  //connect to inventory database (flmasterdb)


$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // validate if email is empty
    if (empty($username)) {
        $error .= '<p class="error">Please enter username.</p>';
    }

    // validate if password is empty
    if (empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }

    if (empty($error)) {
        /*if($query = $sqlconnection->prepare("SELECT * FROM useraccounts WHERE username = ?")) {
            $query->bind_param('s', $username);
            $query->execute();
            $row = $query->fetch();
            if (is_array($row)) {*/

        $query = ("SELECT * FROM user WHERE username='$username'");
        $result = mysqli_query($sqlconnection, $query);              
        if ($row = @mysqli_fetch_assoc($result)) {
                
                $passwordhash = $row['password'];
                $testdata2 = password_hash($password, PASSWORD_BCRYPT);
                /*test data
                echo "the form was submitted :";
                echo "username: <b> $username </b>";
                echo "cleartext password: <b> $password </b>";
                echo "password: <b> $testdata </b>";
                echo "password: <b> $testdata2 </b>";*/

                if (password_verify($password, $passwordhash)) {

                    $_SESSION["userid"] = $row['user_id'];       //SET SESSION userid
                    $_SESSION["user"] = $row;                    //SET SESSION user

                    // Redirect the user to welcome page
                    header("location: dashboard-fl.php");
                    exit;
                } else {
                    $error .= '<p class="error">The password is not valid.</p>';
                }
            } else {
                $error .= '<p class="error">No User exist with that email address.</p>';
        }
        //$query->close();
    }
    // Close connection
    mysqli_close($sqlconnection);
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
					<h3>Finish-Line: Login</h3>
				</div>
			</div>
		</header>
  

        <div class="row" role="main">
                
            <div class="col-md-12 col-border-padding-2 col-border-topBottom">
                
                <div class="col-border-padding-1">

                    <br>
                    <!-- Username/Password Form -->
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <div class="form-group">
                            <input type="username" class="form-control" id="InputUsername" aria-describedby="usernameHelp" name="username" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Enter Password" required>
                        </div>
                        
                        <!-- Cancel/Login Buttons -->
                        <div class="col-border-padding-1">
                            <div class="col text-center">
                                <button onclick="goBack()" type="cancel" class="btn btn-primary">Cancel</button>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>    
                                <br><br>
                                <a class="btn btn-primary" href="signup-fl.php" role="register">Not a Customer? Sign Up Today</a>
                            </div> 
                        </div>
                        <br>
                        
                    </form>
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