<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form'));
		//load custom helper 
		$this->load->helper('custom_helper');
		$this->load->library(array('ion_auth','form_validation','session'));
		$this->ion_auth->logged_in();
		
	}
	public function index()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[1]|max_length[1000]');   
		$this->form_validation->set_rules('last_name', 'last Name', 'trim|required|min_length[1]|max_length[1000]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[1000]');
		$this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[1]|max_length[1000]');		
					if ($this->form_validation->run() == FALSE) {
						$this->load->view('pages/contact_view');
					 }else{
						$email		=	$this->input->post('email');
						$firstname	=	$this->input->post('first_name');
						$lastname	=	$this->input->post('last_name');
						$fullName	=	$firstname." ".$lastname;
						$message	=	$this->input->post('message');
						$this->email->from($email, $fullName);
						$this->email->to('digvijay.daga@imarkinfotech.com');
						$this->email->subject('Visitor Message');
						$this->email->message($message);
						$this->email->send();
						$this->session->set_flashdata('item', 'Your message has been sent.'); 
						redirect("contact");
				}
					
				
				
		
	}
	
}