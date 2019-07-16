<!DOCTYPE html>
<html>
	<head>
		<title>Workflow | <?php echo $title; ?></title>
		<link rel="stylesheet" href= "http://localhost/codeigniter/workflow_system/css/bootstrap.css" ></link>
		<script src="http://localhost/codeigniter/workflow_system/js/jquery.js"></script>
		<script src="http://localhost/codeigniter/workflow_system/js/bootstrap.js"></script>
		<link rel="stylesheet" href= "http://localhost/codeigniter/workflow_system/css/all.css" ></link>
		<script src="http://localhost/codeigniter/workflow_system/js/all.js"></script>
		<style>
			.container {
				margin-top:5px;
				background : white;
			}
			.btn {
				border-radius:0;
			} 
			.form-control {
				border-radius:0;
			}
		</style>
	</head>
	<body>
		<div class="jumbotron" style="margin:0;">
			<div class="container">
				<div class="page-header">
					<h3 class="pull-left">|The Workflows</h3>
					<button class="btn btn-success pull-right" data-toggle="modal" data-target="#workflow_modal" data-backdrop="static" data-keyboard="false">Create New Workflow</button>
					<div class="clearfix"></div>
				</div>
				<div id="alert_workflow" class="alert alert-success" style="display: none;"></div>
				<div id="workflow_modal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Create New Workflow</h4>
							</div>
							<div class="modal-body">
								<form id="workflow_form" method="post" action="<?php echo base_url(); ?>/workflow/create_workflow">
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label for="workflow_title" class="label-control">Workflow Title</label>
											</div>
											<div class="col-md-9">
												<input name="workflow_title" id="workflow_title" class="form-control" type="text" placeholder="Workflow Title">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label for="priority">Priority Degree</label>
											</div>
											<div class="col-md-9">
												<input type="number" min="1" max="5" id="priority" name="priority" class="form-control" placeholder="Choose a degree from 1 to 5">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label for="steps">Workflow Steps</label>
											</div>
											<div class="col-md-9">
												<input name="steps" id="steps" type="number" min="1" class="form-control" placeholder="Workflow Steps">
											</div>
										</div>
									</div>
									<div id="step"></div>
								</form>
							</div>
							<div class="modal-footer">
								<button class="btn btn-default" data-dismiss="modal">close</button>
								<button class="btn btn-primary" id="save_workflow_btn">Save changes</button>
							</div>
						</div>
					</div>
				</div>
					<table id="workflow_data" class="table table-bordered table-striped table-responsive">
						<thead style="background: #c3c3c3;">
							<tr>
								<th class="text-center" width = '10px'>S.no</th>
								<th class="text-center">Workflow Title</th>
								<th class="text-center">Creation Date</th>
								<th class="text-center">Steps</th>
								<th class="text-center">Priority</th>
							<!--	<th>Current Step/User</th> -->
								<th class="text-center">State</th>
								<th class="text-center">Finished Date</th>
								<th class="text-center">Details</th>
							</tr>
						</thead>
						<tbody id="show_workflows_data"></tbody>
					</table>
					<br><br>
					<div class="page-header">
						<h3 class="pull-left">|The Users</h3>
						<!--data-toggle="modal" data-target="#user_modal"-->
						<button id="add_user_btn" class="btn btn-success pull-right" data-toggle="modal" data-target="#user_modal" data-backdrop="static" data-keyboard="false">Add New User</button>
						<div class="clearfix"></div>
					</div>
					<div id="alert_user" class="alert alert-success" style="display: none;"></div>
					<div id="user_modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"></h4>
								</div>
								<div class="modal-body">
								<!-- action="<?php echo base_url(); ?>/workflow/user_validation" -->
									<form id="user_form" method="post">
										<div class="form-group">
											<label for="username">User Name</label>
											<input name="username" id="username" class="form-control" type="text" placeholder="User Name">
										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" class="form-control" name="password" id="password" placeholder="Password">
										</div>
										<div class="form-group">
											<label for="confirm_password">Confirm Password</label>
											<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button class="btn btn-default" data-dismiss="modal">close</button>
									<button id="save_user_btn" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>
					</div>
					<div id="delete_modal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Confirm Delete</h4>
								</div>
								<div class="modal-body">
									Do you want to delete this user?
								</div>
								<div class="modal-footer">
									<button class="btn btn-default" data-dismiss="modal">close</button>
									<button id="delete_user_btn" class="btn btn-danger">Delete</button>
								</div>
							</div>
						</div>
					</div>
				<table id="user_data" class="table table-striped table-responsive">
						<thead style="background:#c3c3c3;">
							<tr>
								<th class="text-center" width = '10px'>S.no</th>
								<th class="text-center">User Name</th>
								<th class="text-center">Password</th>
								<th class="text-right text-center">Creation Date</th>
								<th class="text-right text-center">Delete</th>
							</tr>
						</thead>
						<tbody id="show_users_data"></tbody>
					</table>
					<br><br><br><br><br><br><br><br><br>
			</div>	
		</div>
		<script>
			$(function(){
				
				all_users = '';
				setInterval( function(){
					show_all_workflows();
					show_all_users();
					},2000);
					get_all_users();
			
				/* ============ Users Operations ============ */
				// Add New User
				$('#add_user_btn').click(function(){
					
				 //	$('#user_modal').modal('show'); this way show modal but you need to delete data-toggle & data-target & without them both data-backdrop ='static' won't work!!
		
				 $('#user_modal').find('.modal-title').text('Add New User');
				 $('#user_form').attr('action','<?php echo base_url(); ?>workflow/add_new_user');
				} );
				
				$('#save_user_btn').click(function(){
					var url = $('#user_form').attr('action');
					var data = $('#user_form').serialize();
					
					//validate form
					var user_name = $('input[name=username]');
					var password = $('input[name=password]');
					var confirm_password = $('input[name=confirm_password]');
					var result = '';
					if(user_name.val()==''){
						user_name.parent().parent().addClass('has-error');
					}
					else{
						user_name.parent().parent().removeClass('has-error');
						result +='1';
					}
					
					if(password.val()==''){
						password.parent().parent().addClass('has-error');
					}
					else{
						password.parent().parent().removeClass('has-error');
						result +='2';
					}
					
					if(confirm_password.val()=='' || (confirm_password.val()!='' && confirm_password.val() != password.val()) ){
						confirm_password.parent().parent().addClass('has-error');
					}
					else{
						confirm_password.parent().parent().removeClass('has-error');
						result +='3';
					}
					
					// validation ok
					if(result == '123'){
						$.ajax({
							type: 'ajax',
							method: 'post',
							url: url,
							data: data,
							async: false,
							dataType: 'json',
							success: function(response){
								if(response.success){
									$('#user_modal').modal('hide');
									$('#user_form')[0].reset();
									$('#alert_user').html('User added successfully').fadeIn().delay(4000).fadeOut('slow');
									show_all_users();
								}else{
									alert('Error');
								}
							},
							error: function(){
								alert('Could not add data');
							}
						});
					}
				} );
				
				//Delete user
				$('#show_users_data').on('click','.item-delete',function(){
					var id = $(this).attr('data');
					$('#delete_modal').modal('show');
					//prevent previous handler - unbind()
					$('#delete_user_btn').unbind().click(function(){
						$.ajax({
							type: 'ajax',
							method: 'get',
							async: false,
							url: '<?php echo base_url(); ?>workflow/delete_user',
							data:{delete_id:id},
							dataType: 'json',
							success: function(response){
								if(response.success){
									$('#delete_modal').modal('hide');
									$('#alert_user').html('User deleted successfully').fadeIn().delay(4000).fadeOut('slow');
									show_all_users();
								}else{
									alert('Error');
								}
								},
							error: function(){
								alert('Error Deleting');
							}
						});
					} );
				} );
				// Show All Users
				function show_all_users(){
					$.ajax({
						type: 'ajax',
						url: '<?php echo base_url(); ?>workflow/show_all_users',
						async: false,
						dataType: 'json',
						success: function(data){
							//console.log(data);
							var html = '';
							var i;
							var counter=1;
							for(i=0; i<data.length; i++){
								if(data[i].user_name != 'admin' && data[i].password != 'admin'){
									html += '<tr>'+
											'<td class="text-center" style="color:silver;"><b>'+counter+'</b></td>'+
											'<td class="text-center">'+data[i].user_name+'</td>'+
											'<td class="text-center">'+data[i].user_password+'</td>'+
											'<td class="text-right text-center">'+data[i].creation_date+'</td>'+
											'<td class="text-right text-center"><a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].user_id+'">Delete</a></td>'+
										'</tr>';
									counter++;
								}
							}
							$('#show_users_data').html(html);
						},
						error: function(){
							alert('Could not get Data from database.');
						}
					});
				}
				// get all users
				function get_all_users(){
					$.ajax({
						type: 'ajax',
						url: '<?php echo base_url(); ?>workflow/show_all_users',
						async: false,
						dataType: 'json',
						success: function(data){
							//console.log(data);
							var i;
							for(i=0; i<data.length; i++){
								if(data[i].user_name != 'admin' && data[i].password != 'admin'){
									all_users += '<option value="'+data[i].user_id+'">'+data[i].user_name+'</option>';
								}
							}
						},
						error: function(){
							alert('Could not get users from database.');
						}
					});
				}
				
				/* ============ Workflow Operations ============ */
				
				$('#steps').change(function(){
					var steps = $('input[name=steps]').val();
					var html = '';
					var i;
					var counter=1;
					for(i=0; i<steps; i++){
						html+= '<div class="form-group">'+
									'<div class="row">'+
										'<div class="col-md-1">'+
											'<label for="step_title'+counter+'">'+counter+':</label>'+
										'</div>'+
										'<div class="col-md-5">'+
											'<input type="text" placeholder="Insert Step Title" class="form-control" id="step_title'+counter+'" name="step_title'+counter+'">'+
										'</div>'+
										'<div class="col-md-1">'+
											'<label for="step_user'+counter+'">For:</label>'+
										'</div>'+
										'<div class="col-md-5">'+
											'<select class="form-control" id="step_user'+counter+'" name="step_user'+counter+'">'+
											all_users +
											'</select>'+
										'</div>'+
									'</div>'+
								'</div>';	
						counter++;
								
					}
					$('#step').html(html);
				} );
				
				// create new Workflow 
				$('#save_workflow_btn').click(function(){
					var url = $('#workflow_form').attr('action');
					var data = $('#workflow_form').serialize();
					
					//validate form
					var workflow_title = $('input[name=workflow_title]');
					var priority = $('input[name=priority]');
					var steps = $('input[name=steps]');
					
					var result = '';
					if(workflow_title.val()==''){
						workflow_title.parent().parent().addClass('has-error');
					}
					else{
						workflow_title.parent().parent().removeClass('has-error');
						result +='1';
					}
					
					if(priority.val()=='' || priority.val()<1 || priority.val()>5 ){
						priority.parent().parent().addClass('has-error');
					}
					else{
						priority.parent().parent().removeClass('has-error');
						result +='2';
					}
					
					if(steps.val()=='' || steps.val()<1 ){
						steps.parent().parent().addClass('has-error');
					}
					else{
						steps.parent().parent().removeClass('has-error');
						result +='3';
					}
					// validate all step_title
					var i;
					var check = true;
					for(i=1; i<=steps.val(); i++){
						var step_title = $('input[name=step_title'+i+']');
						if(step_title.val() == ''){
							step_title.parent().parent().addClass('has-error');
							check = false;
						}else{
							step_title.parent().parent().removeClass('has-error');
						}
					}
					if(check == true){
						result +='4';
					}
					// validation ok
					if(result == '1234'){
						$.ajax({
							type: 'ajax',
							method: 'post',
							url: url,
							data: data,
							async: false,
							dataType: 'json',
							success: function(response){
								if(response.success){
									$('#workflow_modal').modal('hide');
									$('#workflow_form')[0].reset();
									$('#alert_workflow').html('Workflow added successfully').fadeIn().delay(4000).fadeOut('slow');
									show_all_users();
								}else{
									alert('Error');
								}
							},
							error: function(){
								alert('Could not add Workflow data');
							}
						});
					}
				} );
				
				function show_all_workflows(){
					$.ajax({
						type: 'ajax',
						url: '<?php echo base_url(); ?>workflow/show_all_workflows',
						async: false,
						dataType: 'json',
						success: function(data){
							//console.log(data);
							var html = '';
							var i,state,color;
							var counter=1;
							for(i=0; i<data.length; i++){
								if(data[i].workflow_state == true){
									state= "Finished";
									color="green";
								}else{
									state= "in progress";
									color="orange";
								}
									html += '<tr>'+
											'<td class="text-center" style="color:silver;"><b>'+counter+'</b></td>'+
											'<td class="text-center">'+data[i].workflow_title+'</td>'+
											'<td class="text-center">'+data[i].workflow_creation_date+'</td>'+
											'<td class="text-right text-center">'+data[i].workflow_steps+'</td>'+
											'<td class="text-right text-center"><b>'+data[i].workflow_priority+'</b></td>'+
											'<td class="text-right text-center" style="color:'+color+'; font-style:italic;"><b>'+state+'</b></td>'+
											'<td class="text-right text-center">'+data[i].workflow_finished_date+'</td>'+
											'<td class="text-right text-center"><a class="item-details" href="<?php echo base_url(); ?>workflow/details/'+data[i].workflow_id+'" data="'+data[i].workflow_id+'"><i><u>more details..<u></i></a></td>'+
										'</tr>';
									counter++;
							}
							$('#show_workflows_data').html(html);
						},
						error: function(){
							alert('Could not get Workflow Data from database.');
						}
					});
				}
			})
		</script>
	</body>
</html>