<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form'));
		//load custom helper 
		$this->load->helper('custom_helper');
		$this->load->library(array('ion_auth','form_validation','session'));
		$this->ion_auth->logged_in();
		/* if (! $this->ion_auth->logged_in()){
				redirect('artist/login');
			} */
	}
	public function index()
	{
				
				$this->load->view('artist/header_view');
				$this->load->view('pages/browse_view');
				//$this->load->view('artist/footer_view');
		
	}
	
}