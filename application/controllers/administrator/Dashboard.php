<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library(array('ion_auth','form_validation'));
		$this->ion_auth->logged_in();
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
			redirect('administrator/login');
        }
    }
	public function index()
	{
		$this->load->view('administrator/header_view');
		$this->load->view('administrator/dashboard_view');
		$this->load->view('administrator/footer_view');
	}
}