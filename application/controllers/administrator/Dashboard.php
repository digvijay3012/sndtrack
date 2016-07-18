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
	public function index(){
		$groupID	=	'';
		if ($this->ion_auth->logged_in() ) {
			$ID			=	$this->ion_auth->user()->row()->user_id; 
			$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id;
        }
		$this->load->view('administrator/header_view');
		if($groupID==1){
			$this->load->view('administrator/super_admin_dashboard_view');
		}if($groupID==2){
			$this->load->view('administrator/admin_dashboard_view');
		}
		$this->load->view('administrator/footer_view');
		
		
	}
}