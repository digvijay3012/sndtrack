<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form','custom_helper'));
		$this->load->library(array('ion_auth','form_validation','session'));
		
		$this->ion_auth->logged_in();
    }
	public function index()
	{
		$this->load->view('pages/home_view');
	}
}				
