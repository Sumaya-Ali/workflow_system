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
				background : white;
				margin-top:5px;
			}
			.btn {
				border-radius:0;
			}
		</style>
	</head>
	<body>
		<div class="jumbotron" style="margin:0;">
			<div class="container">
				<div class="page-header">
					<h3>|My Tasks</h3>
				</div>
				<div id="alert_step" class="alert alert-success" style="display: none;"></div>
				<table id="steps_data" class="table table-striped table-responsive">
					<thead style="background: #c3c3c3;">
						<tr>
							<th class="text-center" width = '10px'>S.no</th>
							<th class="text-center">Step Title</th>
							<th class="text-center">Workflow Title</th>
							<th class="text-center text-right">Priority</th>
							<th class="text-center text-right">Approve</th>
						</tr>
					</thead>
					<tbody id="show_steps_data"></tbody>
				</table>
				<div id="approve_modal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Confirm Approvement</h4>
							</div>
							<div class="modal-body">
								Do you want to approve this step?
							</div>
							<div class="modal-footer">
								<button class="btn btn-default" data-dismiss="modal">close</button>
								<button id="approve_step_btn" class="btn btn-success">Approve</button>
							</div>
						</div>
					</div>
				</div>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>
		<script>
			$(function(){
				setInterval( function(){
					show_all_steps();
					},2000);
				//get current steps (tasks)
				function show_all_steps(){
					$.ajax({
						type: 'ajax',
						url: '<?php echo base_url(); ?>workflow/show_all_steps',
						async: false,
						dataType: 'json',
						success: function(data){
							//console.log(data);
							var html = '';
							var i;
							var counter=1; 
							for(i=0; i<data.length; i++){
								
									html += '<tr>'+
											'<td class="text-center" style="background:#b97a56;">'+counter+'</td>'+
											'<td class="text-center">'+data[i].step_title+'</td>'+
											'<td class="text-center">'+data[i].workflow_title+'</td>'+
											'<td class="text-right text-center">'+data[i].workflow_priority+'</td>'+
											'<td class="text-right text-center"><a href="javascript:;" class="btn btn-success approve-step" data="'+data[i].step_id+'">Approve</a></td>'+
										'</tr>';
									counter++;
							}
							
							$('#show_steps_data').html(html);
						},
						error: function(){
							alert('Could not get steps Data from database.');
						}
					});
				}
				//next step
				$('#show_steps_data').on('click','.approve-step',function(){
					var id = $(this).attr('data');
					$('#approve_modal').modal('show');
					//prevent previous handler - unbind()
					$('#approve_step_btn').unbind().click(function(){
						$.ajax({
							type: 'ajax',
							method: 'get',
							async: false,
							url: '<?php echo base_url(); ?>workflow/approve_step',
							data:{approve_id:id},
							dataType: 'json',
							success: function(response){
								if(response.success){
									$('#approve_modal').modal('hide');
									$('#alert_step').html('Step Approved successfully').fadeIn().delay(4000).fadeOut('slow');
									show_all_steps();
								}else{
									alert('Error');
								}
								},
							error: function(){
								alert('Error Approving');
							}
						});
					} );
				});
				
			
			
			
			
			} );
		</script>
	</body>
</html>