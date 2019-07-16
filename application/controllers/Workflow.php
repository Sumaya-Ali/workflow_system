<?php
//http://localhost/codeigniter/workflow_system/index.php/workflow/

class Workflow extends CI_Controller {
	
	 public function __construct()
        {
                parent::__construct();
                $this->load->helper('url');
				$this->load->library('form_validation');
				$this->load->model("main_model");
				//$config['encryption_key'] = 'd41d8cd98f00b204e9800998ecf8427e'; in config.php (16 byte or 128 bit key generator)
				$this->load->library('encryption');
        }
	
	public function index(){
		$data['title']='Login Page';
		$this->load->view("login",$data);
	}
	public function login(){
		//http://localhost/codeigniter/workflow_system/index.php/workflow/login
		$data['title']='Login Page';
		$this->load->view("login",$data);
	}
	function login_validation(){
		$this->form_validation->set_rules('user_name','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		
		if($this->form_validation->run() ){
			$username= $this->input->post('user_name');
			$password= $this->input->post('password');
			
			// $autoload['libraries'] = array('database','session'); in config/autoload.php
			
			if($this->main_model->can_login($username,$password)){
					$session_data = array (
					'username' => $username,
					'password' => $password
					);
				$this->session->set_userdata($session_data);
				redirect(base_url().'workflow/enter');
			}
			else{
				$this->session->set_flashdata('error','Invalid Username and Password');
				redirect(base_url().'workflow/login');
			}
		}
		else {
			$this->login();
		}	
	}
	function enter(){
		if($this->session->userdata('username') != ''){
			
			if($this->session->userdata('username') == 'admin' && $this->session->userdata('password')=='admin'){
				$data['title'] = "Admin Panel";
				$data['name'] = "Admin Panel";
				$data['icone']="fas fa-user-tie fa-lg";
				
				$this->load->view("header",$data);
				$this->load->view("admin_panel",$data);
				$this->load->view("footer",$data);
			}
			else{
				$data['name'] = $this->session->userdata('username')."&nbsp;Home";
				$data['title'] = "Home Page";
				$data['icone'] = "fas fa-home fa-lg";
		//		$data['username'] = $this->session->userdata('username');
		//		$data['password'] = $this->session->userdata('password');
				
				
				$this->load->view("header",$data);
				$this->load->view("user_page",$data);
				$this->load->view("footer",$data);
			}
		}
		else{
			redirect(base_url().'workflow/login');
		}
	}
	function logout(){
		$this->session->unset_userdata('username');
		redirect(base_url().'workflow/login');
	}
	function workflow_validation(){
		
	}
	function user_validation () {
		
	}
	public function show_all_users(){
		$result = $this->main_model->show_all_users();
		echo json_encode($result);
	}
	public function add_new_user(){
		$result = $this->main_model->add_new_user();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true; 
		}
		echo json_encode($msg);
	}
	public function delete_user(){
		$result = $this->main_model->delete_user();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function create_workflow(){
		$result = $this->main_model->create_workflow();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true; 
		}
		echo json_encode($msg);
	}
	public function show_all_workflows(){
		$result = $this->main_model->show_all_workflows();
		echo json_encode($result);
	}
	public function show_all_steps(){
		$result = $this->main_model->show_all_steps();
		echo json_encode($result);
	}
	public function approve_step(){
		$result = $this->main_model->approve_step();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function details($workflow_id){
		$data['workflow_id']=$workflow_id;
		$data['title']='Details Page';
		$data['name'] = "Admin Panel";
		$data['icone']="fas fa-user-tie fa-lg";
		$this->load->view("header",$data);
		$this->load->view("details",$data);
		$this->load->view("footer",$data);
	}
	public function show_workflow_details($workflow_id){
		$result = $this->main_model->show_workflow_details($workflow_id);
		echo json_encode($result);
	}
	public function show_steps_details($workflow_id){
		$result = $this->main_model->show_steps_details($workflow_id);
		echo json_encode($result);
	}
}