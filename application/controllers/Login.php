<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 
	public function index()
	{
		$this->load->view('welcome_message');
	}

	*/
	function __construct(){
		parent::__construct();
		
	
		$this->load->helper('url');

		// Load form validation library
		$this->load->library('form_validation');
		
		$this->smarty->setTemplate_dir("views/templates/admin");
		$this->load->model('login_model');
		if(!$this->session->userdata('session_id')){
			$this->session->set_userdata('session_id',sha1(date("YMDHIS").rand(1,100000)));
		}

		
	}

	public function index()
	{
		if($this->session->userdata('loggedIn'))
		{
			header('location: /admin');
		}
		$smartydata = array("session_id"=>$this->session->userdata('session_id'),"msg"=>$this->session->userdata('login_msg'));
		$this->session->set_userdata('login_msg',"");
		$this->smarty->view('login.html',$smartydata);
	}

	public function process()
	{
		$session_id = $this->session->userdata('session_id');
		$hash = $this->input->post("hash");
		if($this->session->userdata('loggedIn'))
		{
			header('location: /admin');
		}
		$this->session->set_userdata('login_msg',"");
		if($session_id === $hash)
		{
			$password = $this->input->post($session_id."password");
			$username = $this->input->post($session_id."username");
			if($this->login_model->validate($username,$password,$session_id))
			{
				$this->session->set_userdata('loggedIn', true);
				$UserData[$session_id]['username'] = $username;
				$this->session->set_userdata('user', $UserData);
				if($this->session->userdata('loggedIn'))
				{
					header('location: /admin');
				}
			}
		}
		// On failure
	
		$this->session->set_userdata('login_msg',"Invalid Username/Password ");
		header('location: /login');
	}

	function signout($param){
		if($param == $this->session->userdata('session_id'))
		{
			$this->session->set_userdata('session_id',sha1(date("YMDHIS").rand(1,100000)));
			$this->session->set_userdata('user',null);
			$this->session->set_userdata('loggedIn', false);
		}
		header('location: /admin');
	}
}
