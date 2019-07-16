<!DOCTYPE html>
<html>
	<head>
		<title>Workflow | <?php echo $title; ?></title>
		<link rel="stylesheet" href= "http://localhost/codeigniter/workflow_system/css/bootstrap.css" ></link>
		<script src="http://localhost/codeigniter/workflow_system/js/jquery.js"></script>
		<script src="http://localhost/codeigniter/workflow_system/js/bootstrap.js"></script>
		<style>
			.btn {
				border-raduis:0;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<br><br><br>
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="jumbotron">
				<form method="post" action="<?php echo base_url(); ?>workflow/login_validation">
					<div class="form-group">
						<label for="user_name">User Name</label>
						<input name="user_name" class="form-control" placeholder="User Name" type="text">
						<span class="text-danger"><?php echo form_error("user_name"); ?></span>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input name="password" class="form-control" placeholder="Password" type="password">
						<span class="text-danger"><?php echo form_error("password"); ?></span>
					</div>
					<div class="form-group">
						<input name="submit" class="form-control btn btn-info" type="submit" value="Login">
						<span class="text-danger"><?php echo $this->session->flashdata("error");?></span>
					</div>
				</form>
			</div>
			</div>
		</div>
		
	</body>
</html>
<!-- 
convert view tp pdf
https://itsolutionstuff.com/post/codeigniter-3-generate-pdf-from-view-using-dompdf-library-with-exampleexample.html
-->