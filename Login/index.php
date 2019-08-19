<?php 
	include('function/db.php');
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top ">
			<div class="container">
			  <a class="navbar-brand" href="#">BTEC FPT</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
					
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<form class="form-inline my-2 my-lg-0 w-100">
						<input class="form-control ml-sm-3 w-75" type="search" placeholder="Search form" aria-label="Search">
					</form>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="product.html">Product</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Contact</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  <?php 
								if (isset($_SESSION['username']))
								{
									echo $_SESSION['username'];
								}
								else
								{
									echo "GUEST";
								}
							?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						  <a class="dropdown-item" href="#">Profile</a>
						  <a class="dropdown-item" href="#">Setting Account</a>
						  <div class="dropdown-divider">
						  </div>
						  <?php
						  	if (isset($_SESSION['role']))
						  	{
						  		if ($_SESSION['role'] == 1)
						  		{
						  			echo '<a class = "dropdown-item" href = "admin/adminpage.php">Login as admin</a>';
						  		}
						  		echo '
						  		<a class = "dropdown-item" href = "#"data-toggle = "modal" data-target = "#logoutForm">Log out</a>
						  		';
						  	}
						  	else
						  	{
						  		echo '
						  		<a class = "dropdown-item" href = "#" data-toggle = "modal" data-target = "#loginForm">Sign in</a>
						  		<a class = "dropdown-item" href = "#" data-toggle = "modal" data-target = "#signupForm">Sign up</a>';
						  	}
						  ?>
						</div>
					</li>					
				</ul>				
				</div>
			</div>		  
		</nav>

		<!-- Modal form login -->
		<!-- Modal -->
		<div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form action="" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="username">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
				  </div>
				  <div class="form-group form-check">
				    <input type="checkbox" class="form-check-input" id="exampleCheck1">
				    <label class="form-check-label mb-2" for="exampleCheck1">Remember Me</label>
				  </div>
				  <hr>
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  <button type="submit" class="btn btn-primary">Login</button>
				</form>
		      </div>
		    </div>
		  </div>
		 <?php 
					if (isset($_POST['username']))
					{
						$_username = stripslashes($_REQUEST['username']);
						$_username = mysqli_real_escape_string($connection, $_username);
						$_password = stripslashes($_REQUEST['password']);
						$_password = mysqli_real_escape_string($connection, $_password);
						$query = "SELECT * FROM `demo` WHERE _username = '$_username' and _password = '".md5($_password)."'";
						$result = mysqli_query($connection, $query) or die(mysql_error());
						$account = mysqli_fetch_array($result);
						$_SESSION['role'] = $account['role'];
						$row = mysqli_num_rows($result);
						if ($row == 1)
						{
							$_SESSION['username'] = $_username;
							echo "<script type='text/javascript'>alert('Success')
							location.assign('http://localhost:80/Login/index.php');</script>";
						// 	if ($account['role'] == 2)
						// 	{
						// 		echo '
						// 		<script>
						// 			window.location.href ="http://localhost:80/SatanBookstore/index.php";
						// 		</script>';
						// 	}
						// 	else
						// 	{
						// 		echo '
						// 		<script>
						// 			window.location.href ="http://localhost:80/SatanBookstore/index.php";
						// 		</script>';	
						// 	}
						}
						else
						{
							echo '
							<script type="text/javascript">alert("Wrong username or password");
							</script>';	
						}
					}
				?>
		</div>

		<!-- end login -->
		<!-- LogOut -->
		<!-- Button trigger modal -->
		<!-- Modal -->
		<div class="modal fade" id="logoutForm" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">LogOut</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <h6>Do you want to logout ?</h6>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		        <a href="function/logout.php"><button type="button" class="btn btn-primary">Yes</button></a>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- end logout -->
		<!-- Sigup -->
		<!-- Modal -->
		<div class="modal fade" id="signupForm" tabindex="-1" role="dialog" aria-labelledby="sigupModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Sign up</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form action="" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="_username">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="_password">
				    <label for="exampleInputPassword1">Password Again</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="_repassword">
				  </div>				 
				  <hr>
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  <button type="submit" class="btn btn-primary">Sign up</button>
				</form>
		      </div>
		    </div>
		  </div>
		  				<?php
					if (isset($_POST['_username']))
					{
						if ($_REQUEST['_password'] != $_REQUEST['_repassword'])
						{
							echo
							"
								<script>alert('The re-password and password is different');
								header('Location : index.php')</script>;
							";
						}
						else
						{
							$_username = stripslashes($_REQUEST['_username']);
							$_username = mysqli_real_escape_string($connection, $_username);
							$_password = stripslashes($_REQUEST['_password']);
							$_password = mysqli_real_escape_string($connection, $_password);
							$query = "INSERT into `demo` (_username, _password, role)
							VALUES ('$_username', '".md5($_password)."', 2)";
							$result = mysqli_query($connection, $query);
							if ($result)
							{
								echo '
								<script type="text/javascript">alert("Successful registration");
								location.assign("http://localhost:80/Login/index.php");
								</script>';
							}
						}
					}
				?>	 
		</div>
		<!-- end sigup -->	

	</div>
	<!-- __________________________________________________________________________________ -->
		<script src="js/jquery-3.3.1.slim.min.js" type="text/javascript"></script>
		<script src="js/popper.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>