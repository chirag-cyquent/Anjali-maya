<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		// Load form helper library
		$this->smarty->setTemplate_dir("views/templates/admin");
		$this->authenticate();

	}

	public function index()
	{
		$this->smarty->view('index.html',array("session_id"=>$this->session->userdata('session_id'),"user"=>$this->session->userdata('user')));
	}

	private function authenticate()
	{
		if(!$this->session->userdata('loggedIn')){
			header('location: /login');
		}
	}
}
