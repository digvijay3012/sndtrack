<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library(array('ion_auth','form_validation','session'));
		
		$this->ion_auth->logged_in();
    }
	public function index()
	{
		$this->load->view('home_view');
	}
}				
