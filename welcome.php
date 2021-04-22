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
				<!-- <h4 class="d-flex justify-content-center"	>Car Parking Lot Management System</h4> -->
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
				<li class="active">
					
					<a href="#"> <i class="fa fa-history" aria-hidden="true"></i> Activity Log</a>
				</li>
				
				<li>
					<a href="recharge.php"> <i class="fa fa-credit-card" aria-hidden="true"></i> Recharge Card</a>
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

			<?php
			$userID = $_SESSION['userID'];
			$sql = "SELECT * FROM parking_activity where userID = $userID ";
			$result = mysqli_query($db, $sql);
			$sql1 = "SELECT * FROM users where userID = $userID ";
			$result1 = mysqli_query($db,$sql1);
			$row1= mysqli_fetch_array($result1, MYSQLI_ASSOC);
			$sql2 = "SELECT * FROM parking_activity where userID = $userID ";
			$result2 = mysqli_query($db, $sql2);
			?>
			<div class="content">
				<button type="button" id="sidebarCollapse" class="btn btn-info">
					<i class="fa fa-align-justify"></i> <span>toggle sidebar</span>
				</button>

				<form>
					<fieldset disabled>
						<div class="form-group">
						<label for="disabledTextInput" style="font-weight:bold;letter-spacing: 2px">User Name</label>
						<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $_SESSION['login_user']; ?>">
						</div>
						<div class="form-group">
						<label for="disabledTextInput" style="font-weight:bold;letter-spacing: 2px">Card Balance</label>
						<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $row1['card_balance']; ?>">
						</div>
						<div class="form-group">
						<label for="disabledTextInput" style="font-weight:bold;letter-spacing: 2px">Car Number</label>
						<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $row1['car_no']; ?>">
						</div>

						<?php
							$parkingStatus = 0;
							while( $row2 = mysqli_fetch_assoc( $result2 ) )
							{
								$unix_timestamp = $row2['OUT_time'];
						
								$dt = new DateTime();
								$dt->setTimestamp($unix_timestamp);
	
								// Display GMT datetime
								//echo $dt->format('d-m-Y H:i:s');
								$date_time_format = $dt->format('Y-m-d H:i:s');
								$time_zone_from="UTC";
								$time_zone_to='Asia/Kolkata';
								$display_date = new DateTime($date_time_format, new DateTimeZone($time_zone_from));
								// Date time with specific timezone
								$display_date->setTimezone(new DateTimeZone($time_zone_to));
								$check = $display_date->format('d-m-Y H:i:s A');
								if(empty($check)){
									$parkingStatus = 1;
								}
								else{
									$parkingStatus = 0;
								}
							}

						?>
						<div class="form-group">
						<label for="disabledTextInput" style="font-weight:bold;letter-spacing: 2px">Parking Status</label>
						<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php 
							if($parkingStatus == 1){
								echo "Car is parked inside parking lot.";
							}
							else{
								echo "Car is not currently parked inside parking lot. ";
							}
						?>
						  
						
						
						">
						</div>




					</fieldset>

					<div class="form-group" style="margin-top: 10px; font-weight:bold;letter-spacing: 2px">
                        <label for="exampleInputPassword1">Activity Log</label>
					</div>
				</form>
				<table class="table">
					<thead>
						<tr>
						<th scope="col">User ID</th>
						<th scope="col">In Time</th>
						<th scope="col">Out Time</th>
						</tr>
					</thead>
					<tbody>
						<?php
							while( $row = mysqli_fetch_assoc( $result ) )
							{
						?>
						<tr>
						<td><?php echo $row['userID'];?></td>

						<td>
						
						<?php 

							$unix_timestamp = $row['IN_time'];
						
							$dt = new DateTime();
    						$dt->setTimestamp($unix_timestamp);

							// Display GMT datetime
							//echo $dt->format('d-m-Y H:i:s');
							$date_time_format = $dt->format('Y-m-d H:i:s');
							$time_zone_from="UTC";
							$time_zone_to='Asia/Kolkata';
							$display_date = new DateTime($date_time_format, new DateTimeZone($time_zone_from));
							// Date time with specific timezone
							$display_date->setTimezone(new DateTimeZone($time_zone_to));
							echo $display_date->format('d-m-Y H:i:s A');
						
						?></td>

						<td>
						<?php 
							$unix_timestamp = $row['OUT_time'];
						
							$dt = new DateTime();
							$dt->setTimestamp($unix_timestamp);
						
							// Display GMT datetime
							//echo $dt->format('d-m-Y H:i:s');
							$date_time_format = $dt->format('Y-m-d H:i:s');
							$time_zone_from="UTC";
							$time_zone_to='Asia/Kolkata';
							$display_date = new DateTime($date_time_format, new DateTimeZone($time_zone_from));
							// Date time with specific timezone
							$display_date->setTimezone(new DateTimeZone($time_zone_to));
							echo $display_date->format('d-m-Y H:i:s A');
						?></td>
						</tr>
						<?php
               			 }
             			?>
					</tbody>
				</table>
			</div>
		</div>
		

   	
   	
   	
   	
   	
   	</div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    

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