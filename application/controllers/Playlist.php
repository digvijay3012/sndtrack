<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {


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
	public function index($playListId=null)
	{
		if($playListId==''){
			redirect('dashboard');
		}
		$this->load->view('customer/header_view');
		$this->load->view('customer/playlist_list_view', array('playListId'=>$playListId));
		
	}
	public function view($playListId=null, $customerId=null)
	{
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		if($customerId !=null && $ID	!=	$customerId){
			$this->session->set_flashdata('message', 'You are not autorize to see this Playlist.');
            redirect("browse", 'refresh');
		}
	
		if($playListId==''){
			redirect('dashboard');
		}
		$this->load->view('customer/header_view');
		$this->load->view('customer/playlist_list_view', array('playListId'=>$playListId));
		
	}
	public function filter_by_playlist_orderby($playlist_id=null, $short_type=null){
		
		return $this->load->view('search/logged_in_playlist_orderby_filter', array('playlist_id'=>$playlist_id,'short_type'=>$short_type));
	}
		public function create_playlist(){
		$playlist_name		=	$this->input->post('playlist_name');
		$redirectParameter	=	$this->input->post('redirectparamtr');
		if($playlist_name!=''){
			$customerId		=	$this->ion_auth->user()->row()->user_id; 
			$data			=	$this->dashboard_model->create_playlist($customerId,$playlist_name);
			$this->session->set_flashdata('item', 'Playlist has been created sucessfully.'); 
			$setRediection	=	'playlist/view/'.$redirectParameter.'';
			redirect($setRediection);
		}else{
			$this->session->set_flashdata('item', 'Please fill Playlist name properly..'); 
			redirect($setRediection);
		}
		
	}
	public function create_playlist_from_wishlist(){
		$playlist_name		=	$this->input->post('playlist_name');
		$redirectParameter	=	$this->input->post('redirectparamtr');
		if($playlist_name!=''){
			$customerId		=	$this->ion_auth->user()->row()->user_id; 
			$data			=	$this->dashboard_model->create_playlist($customerId,$playlist_name);
			$this->session->set_flashdata('item', 'Playlist has been created sucessfully.'); 
			$setRediection	=	''.$redirectParameter.'';
			redirect($setRediection);
		}else{
			$this->session->set_flashdata('item', 'Please fill Playlist name properly..'); 
			redirect($setRediection);
		}
		
	}
	
}