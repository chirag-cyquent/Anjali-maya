<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	*/
	public function index()
	{
		$this->load->model('admin_pages');	
		$this->load->model('admin_reviews');	
		$this->load->model('admin_demo');	
		$this->load->model('admin_biography');	

		$this->smarty->publish_to_tpl(["pages"=>	$this->admin_pages->get_page(false)]);
		$this->smarty->publish_to_tpl(["reviews"=>	array_chunk($this->admin_reviews->get_review(false),3)]);
		$this->smarty->publish_to_tpl(["demo"=>	array_chunk($this->admin_demo->get_demo(false),3)]);
		$this->smarty->publish_to_tpl(["bio"=>	$this->admin_biography->get_bio()]);
		$this->smarty->view('home.html');
	}

	public function feedback(){
		$this->load->library('email');

		$this->email->initialize($GLOBALS['EmailConfig']);
		$this->email->from(_CONTACT_EMAIL, 'thecrm.expert');
		$this->email->to(_CONTACT_EMAIL);
		$this->email->subject('thecrm.expert feedback');
		$this->email->message('
		Name: '.$this->input->post('fname').'<br>
		Phone: '.$this->input->post('phone').'<br>
		Email: '.$this->input->post('email').'<br>
		Message: '.$this->input->post('message').'<br>
		<br>
		');
		$this->email->send();

		header('location: /');
	}
	
}
