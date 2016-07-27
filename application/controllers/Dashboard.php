<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form','custom_helper'));
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model('customer/dashboard_model');
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
	public function artist($artistId=null){
		if($artistId==''){
			redirect('dashboard');
		}
		$data	=	$this->dashboard_model->get_artist_profile($artistId);
		$this->load->view('customer/header_view');
		$this->load->view('customer/artist_profile_view', array('artist_data'=>$data));
	}
	public function artist_music($track_id=null){
		if($track_id==''){
			redirect('dashboard');
		}
		$data	=	$this->dashboard_model->get_artist_profile_by_trackId($track_id);
		$this->load->view('customer/header_view');
		$this->load->view('customer/artist_music_view', array('artist_data'=>$data));
	}
	public function follow_artist($artistId=null, $customerId=null){
		if($artistId=='' || $customerId==''){
			return 2;
		}
		return $data	=	$this->dashboard_model->follow_artist($artistId, $customerId);
		
	}
}