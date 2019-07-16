<?php
class Main_model extends CI_Model{

	function can_login($username, $password){
		$this->db->where('user_name',$username);
		$this->db->where('user_password',$password);
		$query= $this->db->get('users');
		
		if($query->num_rows() >0){
			return true;
		}
		else{
			return false;
		}
	}
	public function show_all_users(){
		$this->db->order_by('creation_date','desc');
		$query = $this->db->get('users');
		if($query->num_rows() >0 ){
			return $query->result();
		}
		else {
			return false;
		}
	}
	public function add_new_user(){
		$field = array(
			'user_name' => $this->input->post('username'),
			'user_password' => $this->input->post('password'),
			'creation_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('users',$field);
		if($this->db->affected_rows()>0 ){
			return true;
		}else {
			return false;
		}
	}
	function delete_user(){
		$id = $this->input->get('delete_id');
		$this->db->where('user_id',$id);
		$this->db->delete('users');
		if($this->db->affected_rows() >0){
			return true;
		}else{
			return false;
		}
	}
	function create_workflow(){
		$workflow_field = array(
			'workflow_title' => $this->input->post('workflow_title'),
			'workflow_steps' => $this->input->post('steps'),
			'workflow_priority' => $this->input->post('priority'),
			'workflow_state' => false, // false == waiting (not finished)
			'workflow_creation_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('workflow',$workflow_field);
		
		$workflow_id =$this->db->insert_id();
		$_steps =$this->input->post('steps');
		
		for($i=1; $i<=$_steps; $i++ ){
			$step_field = array(
				'step_title' => $this->input->post("step_title$i"),
				'workflow_id' => $workflow_id,
				'user_id' => $this->input->post("step_user$i"),
				'step_order' => $i,
				'step_state' =>false,
				'step_flag' => false
			);
			if($i == 1){
				$step_field['step_flag'] = true;
			}
			$this->db->insert('step',$step_field);
		}
		if($this->db->affected_rows()>0 ){
			return true;
		}else{
			return false;
		}
	}
	public function show_all_workflows(){
		$this->db->order_by('workflow_creation_date','desc');
		$query = $this->db->get('workflow');
		
		if($query->num_rows() >0 ){
			return $query->result();
		}
		else {
			return false;
		}
	}
	public function show_all_steps(){

		//get user id
		$this->db->where('user_name',$this->session->userdata('username'));
		$this->db->where('user_password',$this->session->userdata('password'));
		$users = $this->db->get('users');
		$user_id = '';
		foreach ($users->result() as $user)
			{
				$user_id = $user->user_id;
			}
		
		//get step join worflow data
		$this->db->where('user_id',$user_id);
		$this->db->where('step_flag',true);
		$this->db->select('*');
		$this->db->from('step');
		$this->db->join('workflow', 'workflow.workflow_id = step.workflow_id');
		$this->db->order_by('workflow_priority','desc');
		$query = $this->db->get();
		
		if($query->num_rows() >0 ){
			return $query->result();
		}
		else {
			return false;
		}
	}
	public function approve_step(){
		$id = $this->input->get('approve_id');
		//change current step flag to false
		$update_current_step = array(
			'step_state' => true,
			'step_flag' => false,
			'step_finished_date' => date('Y-m-d H:i:s')
		);
		$this->db->where('step_id',$id);
		$this->db->update('step',$update_current_step);
		//step join workflow to get steps
		$this->db->where('step_id',$id);
		$this->db->select('*');
		$this->db->from('step');
		$this->db->join('workflow', 'workflow.workflow_id = step.workflow_id');
		$query = $this->db->get();
		$steps = '';
		$current_order='';
		$workflow_id ='';
		foreach ($query->result() as $row)
			{
				$current_order = $row->step_order;
				$steps = $row->workflow_steps;
				$workflow_id = $row->workflow_id;
			}
		if($current_order < $steps){
			// get the next step
			$next_order = $current_order + 1;
			$this->db->set('step_flag',true);
			$this->db->where('workflow_id',$workflow_id);
			$this->db->where('step_order',$next_order);
			$this->db->update('step');
		}else{
			// finished workflow
			$update_workflow = array(
				'workflow_state' => true,
				'workflow_finished_date' => date('Y-m-d H:i:s')
			);
			$this->db->where('workflow_id',$workflow_id);
			$this->db->update('workflow',$update_workflow);
		}
		
		if($this->db->affected_rows() >0){
			return true;
		}else{
			return false;
		}
	}
	public function show_workflow_details($workflow_id){
		//get workflows details
		$this->db->where('workflow_id',$workflow_id);
		$query = $this->db->get('workflow');
		
		if($query->num_rows() >0 ){
			return $query->result();
		}
		else {
			return false;
		}
	}
	public function show_steps_details($workflow_id){
		//get steps details join user
		$this->db->where('workflow_id',$workflow_id);
		$this->db->select('*');
		$this->db->from('step');
		$this->db->join('users', 'step.user_id = users.user_id');
		$this->db->order_by('step_order','asc');
		$query = $this->db->get();
		
		if($query->num_rows() >0 ){
			return $query->result();
		}
		else {
			return false;
		}
	}
} 