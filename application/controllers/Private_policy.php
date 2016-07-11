<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Private_policy extends CI_Controller {


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
				
				$this->load->view('pages/header_view');
				$this->load->view('pages/private_policy_view');
				$this->load->view('artist/footer_view');
		
	}
	
}