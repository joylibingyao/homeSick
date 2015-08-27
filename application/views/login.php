<!DOCTYPE html>
<html>
<head>
	<title>Login/Registration</title>
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
	$(document).ready(function(){
		$(document).on('click', '.login', function(){
			$("#animate").animate({
				opacity: '1'}, 2000);
			// jQuery("#animate").css("opacity", 1);
		})
		// , margin: '500px'


	})
	</script>
</head>
<style>
	body{
		margin: 0 auto;
		margin-top: 10px;
		text-align: center;
	}
	h3{
		margin-top: 0px;
	}
	#login {
		display: inline-block;
		vertical-align: top;
		margin-right: 50px;
		color:black;
	}
	#register {
		display: inline-block;
		margin-bottom: 50px;
		margin-left: 50px;
		color:black;
	}

	#errors {
		color: red;
		margin: 0px;
	}
	.btn-danger{
		margin-top: 10px;
	}
	input{
		display: block;
	}
	.modal-title h4 {
		color: black;
	}
	.modal-dialog {
		opacity: 0.7;
	}

</style>
<body>
	<div id="errors">
<?php
			if($this->session->flashdata('success')){
				echo $this->session->flashdata('success');
			}
			if($this->session->flashdata("errors")){
				echo $this->session->flashdata("errors");
			}
			if($this->session->flashdata("logerrors")){
				echo $this->session->flashdata("logerrors");
			}
			if($this->session->flashdata('loginfail')){
				echo $this->session->flashdata('loginfail');
			}
			if($this->session->flashdata('citycheck')){
				echo $this->session->flashdata('citycheck');
			}
?>
</div>

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Login / Registration</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login / Registration</h4>
      </div>
      <div class="modal-body">
 	</div>
	<div id="login">
		<h3>Log In</h3>
		<form action="/maps/login" method="post">
			<p>Email:</p><input type="text" name="email"> 
			<p>Password:</p><input type="password" name="password">
			<input class="btn btn-danger" type="submit" value="Login">
		</form>
	</div>
	<div id="register">
		<h3>Register</h3>
		<form action="/maps/register" method="post">
			<p>Name:</p><input type="text" name="name" >
			<p>Email Address:</p><input type="text" name="email" >
			<p>Password:</p><input type="password" name="password">
			<p>Confirm Password:</p><input type="password" name="confirmpassword">
			<p>City:</p><input type="text" name="city">
			<input class="btn btn-danger" type="submit" value="Register">
		</form>
	</div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

 
</div>
</body>
</html>