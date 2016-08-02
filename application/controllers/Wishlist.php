<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller {


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
		$customerId		=	$this->ion_auth->user()->row()->user_id; 
		$this->load->view('customer/header_view');
		$this->load->view('customer/wishlist_view');
		
	}
	public function create_playlist(){
		$playlist_name		=	$this->input->post('playlist_name');
		$redirectParameter	=	$this->input->post('redirectparamtr');
		if($playlist_name!=''){
			$customerId		=	$this->ion_auth->user()->row()->user_id; 
			$data			=	$this->dashboard_model->create_playlist($customerId,$playlist_name);
			$this->session->set_flashdata('item', 'Playlist has been created sucessfully.'); 
			$setRediection	=	'wishlist';
			redirect($setRediection);
		}else{
			$this->session->set_flashdata('item', 'Please fill Playlist name properly..'); 
			redirect($setRediection);
		}
		
	}
}