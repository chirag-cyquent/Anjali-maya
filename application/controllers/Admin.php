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
		
		$this->smarty->setTemplate_dir("views/templates/admin");
		$this->authenticate();
		$this->smarty->publish_to_tpl(array("session_id"=>$this->session->userdata('session_id'),"user"=>$this->session->userdata('user')));
	}

	public function index()
	{
		$this->smarty->view('index.html');
	}

	public function pages($action = null ,$id = null )
	{
		$this->load->model('admin_pages');	
		if($action == "save" )
		{
			$this->admin_pages->save_entry(["heading"=>$this->input->post("heading"),
			"content"=>$this->input->post("content"),
			"order_no"=>$this->input->post("order_no"),
			"hash_id"=>$this->input->post("pageID")],
			$this->input->post("pageID") ?$this->input->post("pageID"):null);
			header('location: /admin/pages/');

		}else if($action == "edit")
		{
			$this->smarty->publish_to_tpl(array("page"=>$this->admin_pages->get_pege($id)));
		}
		elseif($action == "delete" )
		{
			$this->admin_pages->delete_entry($id ? $id : false);
			header('location: /admin/pages/');
		}

		$this->smarty->publish_to_tpl(array("allpages"=>$this->admin_pages->get_pege(false)));
		$this->smarty->view('pages.html');
	}

	private function authenticate()
	{
		if(!$this->session->userdata('loggedIn')){
			header('location: /login');
		}
	}
}