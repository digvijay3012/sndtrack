<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form','custom_helper'));
		$this->load->library(array('ion_auth','form_validation'));
		
		if (! $this->ion_auth->logged_in()){
				redirect('login');
			}
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		if($groupID!=4){
			$logout = $this->ion_auth->logout();
			redirect('login');
		}
    }
	public function index()
	{
		$this->load->view('customer/header_view');
		$this->load->view('customer/dashboard_view');
		
	}
}