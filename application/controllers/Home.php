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
		require APPPATH."third_party/PHPMailer/Exception.php";
        require APPPATH."third_party/PHPMailer/PHPMailer.php";
        require APPPATH."third_party/PHPMailer/SMTP.php";
		$mail = new PHPMailer\PHPMailer\PHPMailer(true);
		$mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = __SMTP_HOST;                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = __SMTP_USER;                     // SMTP username
		$mail->Password   = __SMTP_PASS;                               // SMTP password
		$mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = __SMTP_PORT;                                    // TCP port to connect to
		      
		//Recipients
		$mail->setFrom(__SMTP_USER, 'TheCRM.Expert');
		$mail->addReplyTo($this->input->post('email'), $this->input->post('email'));
		$mail->addAddress(_CONTACT_EMAIL, _CONTACT_EMAIL);
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'thecrm.expert feedback';
		$mail->Body    ='Name: '.$this->input->post('fname').'<br>Phone: '.$this->input->post('phone').'<br>Email: '.$this->input->post('email').'<br>Message: '.$this->input->post('message').'<br><br>';
		$resp = $mail->send();

		if($resp){
			header('location: /');
		}
		else{

			echo $mail->ErrorInfo; exit;
		}
	}
	
}
