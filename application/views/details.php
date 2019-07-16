<!DOCTYPE>
<html>
	<head>
		<title>Workflow |<?php echo $title; ?></title>
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
					<h3>|Workflow Details</h3>
				</div>
				<div id="workflow_details"></div>
				<div id="steps_details"></div>
				<div id="workflow_details"></div>
					<br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>
		<script>
			$(function(){
				setInterval( function(){
						show_workflow_details();
						show_steps_details();
					},2000);
			
				function show_steps_details(){
					$.ajax({
						type: 'ajax',
						url: '<?php echo base_url(); ?>workflow/show_steps_details/<?php echo $workflow_id; ?>',
						async: false,
						dataType: 'json',
						success: function(data){
							//console.log(data);
							var step_state ='';
							var step_state_color= '';

							var html = '<table class="table table-bordered table-striped table-responsive"style="border-left:hidden; border-right:hidden;">'+
					'<thead style="border-top:hidden; border-bottom: silver solid 3px;">'+
					'<tr>'+
							'<th width="10%" class="text-center" style="border-right: silver solid 2px;">Order</th>'+
							'<th width="30%" class="text-center" style="border-right: silver solid 2px;">Step Title</th>'+
							'<th width="30%" class="text-center" style="border-right: silver solid 2px;">User Name</th>'+
							'<th width="10%" class="text-center" style="border-right: silver solid 2px;">State</th>'+
							'<th width="20%" class="text-center" colspan="2">Finished Date</th>'+
						'</tr>'+
					'</thead>'+
					'<tbody>';
									
							var i;
							var counter=1; 
							for(i=0; i<data.length; i++){
								if(data[i].step_state == true){
									step_state = "Finished";
									step_state_color="color:green;"
								}else if(data[i].step_flag == true){
									step_state = "in progress"
									step_state_color="color:orange;";
									}
									else{
										step_state = "waiting.."
										step_state_color="color:red;";
									}
									html += '<tr style="border-bottom: silver solid 2px;">'+
							'<td class="text-center">'+counter+'</td>'+
							'<td class="text-center">'+data[i].step_title+'</td>'+
							'<td class="text-center">'+data[i].user_name+'</td>'+
							'<td class="text-center" style="'+step_state_color+'"><b><i>'+step_state+'</i></b></td>'+
							'<td style="border-right:hidden;" class="text-center">'+data[i].step_finished_date+'</td>'+
						'</tr>';
									counter++;
							}
							html += '</tbody>'+
								'</table>';
					
								$('#steps_details').html(html);
						},
						error: function(){
							alert('Could not get steps details from database.');
						}
					})
				
				}
				function show_workflow_details(){
					$.ajax({
						type: 'ajax',
						url: '<?php echo base_url(); ?>workflow/show_workflow_details/<?php echo $workflow_id; ?>',
						async: false,
						dataType: 'json',
						success: function(data){
							//console.log(data);
							var workflow_state ='';
							var workflow_state_color= '';
							if(data[0].workflow_state == true){
								workflow_state = "Finished";
								workflow_state_color="color:green;"
							}else{
								workflow_state = "in progress"
								workflow_state_color="color:orange;";
							}
							var html = '<table class="table table-bordered table-striped table-responsive" style="margin-bottom:0">'+
						'<thead style="border-top:hidden; border-left:hidden; border-right:hidden; border-bottom: silver solid 3px;">'+
							'<tr style="border-top: silver solid 3px;">'+
								'<th class="text-center" colspan="6" style="font-size:30px;">'+data[0].workflow_title+'</th>'+
							'</tr>'+
						'</thead>'+
						'<tbody>'+
							'<tr>'+
								'<td width="20%" class="text-center"><b>Creation Date</b></td>'+
								'<td width="20%" class="text-center">'+data[0].workflow_creation_date+'</td>'+
								'<td width="10%" style="border-left: silver solid 3px;" class="text-center"><b>Priority</b></td>'+
								'<td width="10%" class="text-center">'+data[0].workflow_priority+'</td>'+
								'<td width="10%" style="border-left: silver solid 3px;" class="text-center"><b>Steps Count</b></td>'+
								'<td width="30%" class="text-center">'+data[0].workflow_steps+'</td>'+
							'</tr>'+
							'<tr style="border-top: silver solid 3px; border-bottom: silver solid 3px;">'+
								'<td width="25%" class="text-center"><b>State</b></td>'+
								'<td width="25%" colspan="2" class="text-center" style="'+workflow_state_color+'"><b><i>'+workflow_state+'</i></b></td>'+
								'<td width="25%" style="border-left: silver solid 3px;" class="text-center"><b>Finish Date</b></td>'+
								'<td width="25%" colspan="2" class="text-center">'+data[0].workflow_finished_date+'</td>'+
							'</tr>'+
							'<tr>'+
								'<td colspan="6" style="border-left:hidden; border-right:hidden;"><br></td>'+
							'</tr>'+
							'<tr style="border-bottom: silver solid 3px; border-top:hidden; border-left:hidden; border-right:hidden;">'+
								'<td colspan="6" class="text-center" style="font-size:20px;"><b><i>Steps Details &#9876;</i></b></td>'+
							'</tr>'+
							'</tbody>'+
						'</table>';
					
							$('#workflow_details').html(html);
						},
						error: function(){
							alert('Could not get workflow details from database.');
						}
					});
				}
			
			
			
			
			
			
			
			
			
			})
		</script>
	</body>
</html>