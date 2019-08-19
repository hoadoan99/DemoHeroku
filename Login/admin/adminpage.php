<?php
	include('../function/db.php');
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Administrator page</title>
	<link rel = "stylesheet" href = "../css/bootstrap.css">
	<style type = "text/css" media = "screen">
		body
		{
			padding-top: 56px;
		}
		h4{
			text-align: center;
		}
	</style>
</head>
<body>
	<nav class = "navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
		<div class = "container">
			<div id = "title">
				<div class = "form-inline my-2 my-lg-0 w-100">
					<a href = "adminpage.php" text-decoration = "none"><h4>Administrator page</h4></a>
					<ul class = "navbar-nav ml-auto">
						<li class = "nav-item dropdown">
						<a class = "nav-link dropdown-toggle" href = "" id = "navbarDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">
							<?php 
								if (isset($_SESSION['username'])&& $_SESSION['role']==1)
								{
									echo $_SESSION['username'];
								}
								else 
								{
									echo '
										<script type="text/javascript">alert("You must login first");
										location.assign("http://localhost:80/Login/index.php");
										</script>';
								}
							?>
						</a>
						<div class = "dropdown-menu" aria-labelledby = "navbarDropdown">
						  <a class = "dropdown-item" href = "#">Profile</a>
						  <a class = "dropdown-item" href = "#">Account setting</a>
						  <a class = "dropdown-item" href = "../index.php">Go to index page</a>
						  <div class = "dropdown-divider"></div>
						  <a class = "dropdown-item" href = "#"data-toggle = "modal" data-target = "#logoutForm">Log out</a>
						</div>
					</li>	
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div class = "employeeManagementForm">
					<h4>USER MANAGEMENT</h4>
					<div class = "formSearch">
						<form class = "form-inline" method = "POST" action = "../function/adminUserSearchResult.php">
							<input class = "form-control ml-sm-3 w-75" type = "search" placeholder = "Type to search an user..." aria-label = "Search" name = "txtuSearch" size = "auto">
							<input type = "submit" class = "btn btn-primary" value = "Search" name = "btn2Search">
						</form>
					</div>
					<br>
					<table width = "100%" border = "1" style = "border-collapse: collapse;">
						<thead>
							<tr>
								<th><strong>Account No.</strong></th>
								<th><strong>Username</strong></th>
								<th><strong>Password</strong></th>
								<th><strong>Role</strong></th>
								<th><strong>Update</strong></th>
								<th><strong>Delete</strong></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								$query = "Select * from demo where role > 1";
								$result = mysqli_query($connection,$query);
								while ($row = mysqli_fetch_assoc($result)) {?>
								<tr>
									<td align = "center"><?php echo $count ?></td>
									<td align = "center"><?php echo $row["_username"] ?></td>
									<td align = "center"><?php echo $row["_password"] ?></td>
									<td align = "center"><?php echo $row["role"] ?></td>
									<td align = "center">
										<a href = "../function/updateUser.php?username=<?php echo $row["_username"]; ?>">Update</a>
									</td>
									<td>
										<a href = "../function/deleteUser.php?username=<?php echo $row["_username"]; ?>" onclick="return confirm('Are you  certain that you want to DELETE user: <?php echo $row["_username"]; ?>?')">Delete</a>
									</td>
								</tr>
							<?php	    
								}
							?>
						</tbody>
					</table>
				</div>