<?php
	include("config.php");
	session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <title>Car Parking Lot Management System</title>
  </head>
  <body>
   
   	<div class="wrapper">
		<nav id="sidebar">
			<button type="button" id="sidebarCollapse1" class="btn btn-info">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
			<div class="sidebar-header">
				<!-- <h4 class="d-flex justify-content-center">Car Parking Lot Management System</h4> -->
				<img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" width="100px" alt="..." class="mx-auto d-block rounded-circle">
				<h3 class="d-flex justify-content-center">
				<?php  if (isset($_SESSION['login_user'])) : ?>
						<strong>
							<?php echo $_SESSION['login_user']; ?>
						</strong>
				<?php endif ?>
				</h3>
			</div>

			<ul class="list-unstyled components">
				<li>
					<a href="welcome.php">  <i class="fa fa-history" aria-hidden="true"></i> Activity Log</a>
				</li>
				
				<li class="active">
					<a href="#"> <i class="fa fa-credit-card" aria-hidden="true"></i> Recharge Card</a>
				</li>
				<!-- <li>
					<a href="#pageSubmenu">Page</a>
				</li>
				<li>
					<a href="#">Services</a>
				</li>
				<li>
					<a href="#">Contact Us</a>
				</li> -->
			</ul>
			
			<ul class="list-unstyled CTAs">
				<li>
					<a href="logout.php" class="download">Logout</a>
				</li>
			</ul>
		</nav>
   	
		<div class="container">
			<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
			
				<button type="button" id="sidebarCollapse" class="btn btn-info">
					<i class="fa fa-align-justify"></i> <span>toggle sidebar</span>
				</button>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</nav> -->
		
			<?php
			$userID = $_SESSION['userID'];
			$sql = "SELECT * FROM parking_activity where userID = $userID ";
			$result = mysqli_query($db, $sql);

			$sql1 = "SELECT * FROM users where userID = $userID ";
			$result1 = mysqli_query($db, $sql1);
			$row1= mysqli_fetch_array($result1, MYSQLI_ASSOC);
			?>
			<div class="content">
				<button type="button" id="sidebarCollapse" class="btn btn-info">
					<i class="fa fa-align-justify"></i> <span>toggle sidebar</span>
				</button>

				<form>
					<fieldset disabled>
						<div class="form-group">
						<label for="disabledTextInput" style="font-weight:bold;letter-spacing: 2px">Available Balance</label>
						<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $row1['card_balance']?>">
						</div>
					</fieldset>
					<div class="form-group" style="margin-top: 10px; font-weight:bold; letter-spacing: 2px">
                        <label for="exampleInputPassword1">Recharge RFID Card</label>
					</div>
				</form>
                <form action="update.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Your Name</label>
                        <input name="name" class="form-control" id="exampleInputEmail1" >
                        <span style="color:red;">
                            <?php 
                            if (isset($_SESSION['errorMess']))
                            {  
                                echo $_SESSION['errorMess'];
                                unset($_SESSION['errorMess']);
                            }
                            ?>
                        </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Enter Amount Here</label>
                        <input name="amount" class="form-control" id="exampleInputPassword1" >
                        <span style="color:red;">
                            <?php 
                            if (isset($_SESSION['ErrorMess']))
                            {  
                                echo $_SESSION['ErrorMess'];
                                unset($_SESSION['ErrorMess']);
                            }
                            ?>
                        </span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Recharge</button>
                </form>
			</div>
		</div>
		

   	
   	
   	
   	
   	
   	</div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
	<script>
  	    $(document).ready(function(){
  			$('#sidebarCollapse').on('click',function(){
  				$('#sidebar').toggleClass('active');
  			     });
  		    });
          $(document).ready(function(){
  			$('#sidebarCollapse1').on('click',function(){
  				$('#sidebar').toggleClass('active');
  			     });
  		    });
    </script>
    
    
    
    
    
  </body>
</html>