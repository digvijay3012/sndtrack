<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist_dashboard extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library(array('ion_auth','form_validation'));
		$this->ion_auth->logged_in();
		if (! $this->ion_auth->logged_in()){
				redirect('artist/login');
			}
    }
	public function index()
	{
		$this->load->view('artist/header_view');
		$this->load->view('artist/artist_dashboard_view');
		$this->load->view('artist/footer_view');
	}
}