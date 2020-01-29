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
			$this->smarty->publish_to_tpl(array("page"=>$this->admin_pages->get_page($id)));
		}
		elseif($action == "delete" )
		{
			$this->admin_pages->delete_entry($id ? $id : false);
			header('location: /admin/pages/');
		}

		$this->smarty->publish_to_tpl(array("allpages"=>$this->admin_pages->get_page(false)));
		$this->smarty->view('pages.html');
	}

	public function reviews($action = null ,$id = null )
	{
		$this->load->model('admin_reviews');	
		if($action == "save" )
		{
			$this->admin_reviews->save_entry(["author"=>$this->input->post("author"),
			"content"=>$this->input->post("content"),
			"date"=>$this->input->post("date"),
			"order_no"=>$this->input->post("order_no"),
			"hash_id"=>$this->input->post("reviewID")],
			$this->input->post("reviewID") ?$this->input->post("reviewID"):null);
			header('location: /admin/reviews/');

		}else if($action == "edit")
		{
			$this->smarty->publish_to_tpl(array("review"=>$this->admin_reviews->get_review($id)));
		}
		elseif($action == "delete" )
		{
			$this->admin_reviews->delete_entry($id ? $id : false);
			header('location: /admin/reviews/');
		}

		$this->smarty->publish_to_tpl(array("allreviews"=>$this->admin_reviews->get_review(false)));
		$this->smarty->view('reviews.html');
	}

	public function demo($action = null ,$id = null )
	{
		$this->load->model('admin_demo');	
		if($action == "save" )
		{
			$this->admin_demo->save_entry(["embeded"=>$this->input->post("embededContent"),
			"order_no"=>$this->input->post("order_no"),
			"title"=>$this->input->post("title"),
			"hash_id"=>$this->input->post("embededID")],
			$this->input->post("embededID") ?$this->input->post("embededID"):null);
			header('location: /admin/demo/');

		}else if($action == "edit")
		{
			$this->smarty->publish_to_tpl(array("demo"=>$this->admin_demo->get_demo($id)));
		}
		elseif($action == "delete" )
		{
			$this->admin_demo->delete_entry($id ? $id : false);
			header('location: /admin/demo/');
		}

		$this->smarty->publish_to_tpl(array("demos"=>$this->admin_demo->get_demo(false)));
		$this->smarty->view('demo.html');
	}

	public function biography($action = null){

		$this->load->model('admin_biography');	
		if($action == "save" )
		{
			$this->admin_biography->save_entry(["story"=>$this->input->post("biograpyContent"),
			"name"=>$this->input->post("name")], sha1("1"._SALT));
			header('location: /admin/biography/');
		}

		if($action == "upload" )
		{
			$config['upload_path']          = __UPLOAD_PATH;
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image_file'))
			{
				echo $this->upload->display_errors();
				exit;
			}
			else
			{
					$data =  $this->upload->data();
					$this->admin_biography->save_entry(["url"=>$data['file_name']], sha1("1"._SALT));
					echo "Uploaded!";exit;
			}
			
		}

		$this->smarty->publish_to_tpl(array("bio"=>$this->admin_biography->get_bio()));
		$this->smarty->view('bio.html');
	}

	private function authenticate()
	{
		if(!$this->session->userdata('loggedIn')){
			header('location: /login');
		}
	}
}
