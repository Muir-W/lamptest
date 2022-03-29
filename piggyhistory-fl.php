<!DOCTYPE html>
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

    <div id="topHeader" class="container-fluid">
		
		<header role="banner">
			<div class="row">
				<div class="col-md-12 col-border-padding-2">
					<h3>Finish-Line: Transaction History</h3>
				</div>
			</div>
		</header>


        <div class="row" role="main">
                
            <div class="col-md-12 col-border-padding-2 col-border-topBottom">
                
                <div class="col-border-padding-1">

                    <main>
                        <section>
                            <!--build table for outputting transaction records-->
                            <!--table headings-->
                            <div class="table-responsive-sm">
                                <table class="table table-hover" >
                                    <thead class="thead">
                                        <tr>
                                            <th scope="col">ID#</th>
                                            <th scope="col">User#</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Modify</th>
                                        </tr>
                                    </thead>

                                    <!--query database to return all records for display-->
                                    <?php  
                                    require_once 'db-fl.php';
                                    $count= 1;
                                    $query = "SELECT * FROM transaction ORDER BY transaction_id";
                                        $result = mysqli_query($sqlconnection, $query);                   
                                        while($row = @mysqli_fetch_assoc($result)){?>              
                                    
                                    <!--table for outputting transaction records-->
                                    <tr>
                                        <td id="od"><?php echo $row["transaction_id"];?></td>
                                        <td class="od"><?php echo $row["user_id"];?></td>
                                        <td class="od"><?php echo $row["trans_date"];?></td>
                                        <td class="od"><?php echo $row["trans_desc"];?></td>
                                        <td class="od"><?php echo $row["trans_value"];?></td>
                                        <td class="ev">

                                        <!--Modify the Record-->
                                        <a href="delrec-fl.php?transid=<?php echo $row["transaction_id"]; ?> "id="delete" Onclick="return DeleteRecord()">Delete</a>
                                        <a href="updaterec-fl.php?transid=<?php echo $row["transaction_id"]; ?>"id="edit" >Update</a>
                                        </td>
                                    </tr>
                                    <?php $count++;}?>
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
