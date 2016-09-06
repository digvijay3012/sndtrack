<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Earning extends CI_Controller {


	function __construct() {
        parent::__construct();
		
		$this->load->model('artists/Earnings_model');
		$this->load->helper(array('url','form'));
		//load custom helper 
		$this->load->helper('custom_helper');
		$this->load->library(array('ion_auth','form_validation'));
		if (! $this->ion_auth->logged_in()){
				redirect('login');
			}
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		if($groupID!=3){
			$logout = $this->ion_auth->logout();
			redirect('login');
		}
	}
	public function index()
	{
				$ArtistID	=	$this->ion_auth->user()->row()->user_id;
				$data		=	$this->Earnings_model->get_sale($ArtistID);
				
				$this->load->view('artist/header_view');
				$this->load->view('artist/earning_view.php', array('data' => $data));
				$this->load->view('artist/footer_view');
		
	}
	
	
}