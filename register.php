<?php
	include_once("./database/constants.php");
	if(isset($_SESSION["userid"])) {
		header("location:".DOMAIN."/dashboard.php");
	}
?>
<?php include_once("./templates/top.php"); ?>
<div class="overlay"><div class="loader"></div></div>
<?php include_once("./templates/header.php"); ?>
<br/><br/>
<div class="container">
	<div class="card mx-auto" style="width: 30rem;">
		<div class="card-header">Register</div>
			<div class="card-body">
			<form id="register_form" onsubmit="return false" autocomplete="off">
				<div class="form-group">
					<label for="username">Full Name</label>
					<input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
					<small id="u_error" class="form-text text-muted"></small>
				</div>
				<div class="form-group">
					<label for="email">Email address</label>
					<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
					<small id="e_error" class="form-text text-muted"></small>
				</div>
				<div class="form-group">
					<label for="password1">Password</label>
					<input type="password" name="password1" class="form-control"  id="password1" placeholder="Password">
					<small id="p1_error" class="form-text text-muted"></small>
				</div>
				<div class="form-group">
					<label for="password2">Re-enter Password</label>
					<input type="password" name="password2" class="form-control"  id="password2" placeholder="Password">
					<small id="p2_error" class="form-text text-muted"></small>
				</div>
				<div class="form-group">
					<label for="usertype">Usertype</label>
					<select name="usertype" class="form-control" id="usertype">
						<option value="">Choose User Type</option>
						<option value="Businessman">Businessman</option>
						<option value="Seller">Seller</option>
						<option value="Other">Other</option>
					</select>
					<small id="t_error" class="form-text text-muted"></small>
				</div>
				<button type="submit" name="user_register" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Register</button>
				<span><a href="index.php">Login</a></span>
			</form>
		</div>
	</div>
</div>
<?php include_once("./templates/bottom.php"); ?>