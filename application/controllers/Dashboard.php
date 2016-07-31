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
	public function create_playlist(){
		$playlist_name		=	$this->input->post('playlist_name');
		$redirectParameter	=	$this->input->post('redirectparamtr');
		if($playlist_name!=''){
			$customerId		=	$this->ion_auth->user()->row()->user_id; 
			$data			=	$this->dashboard_model->create_playlist($customerId,$playlist_name);
			$this->session->set_flashdata('item', 'Playlist has been created sucessfully.'); 
			$setRediection	=	'dashboard/'.$redirectParameter.'';
			redirect($setRediection);
		}else{
			$this->session->set_flashdata('item', 'Please fill Playlist name properly..'); 
			redirect($setRediection);
		}
		
	}
	public function add_to_wishlist($track_id=null){
		$customerId		=	$this->ion_auth->user()->row()->user_id; 
		echo $data			=	$this->dashboard_model->add_to_wishlist($track_id, $customerId);
		
	}
	public function add_to_playlist($playlist_id=null,$track_id=null){
		if($playlist_id=='' || $track_id==''){
			echo "3";
		}
		$customerId		=	$this->ion_auth->user()->row()->user_id; 
		echo $data			=	$this->dashboard_model->add_to_playlist($playlist_id, $track_id, $customerId);
		
	}

	public function create_playlist_inpopup($track_id=null,$popup_playlist_name=null){
		 
		if($popup_playlist_name=='' || $track_id	==''){
			echo "3";
		}
		$customerId		=	$this->ion_auth->user()->row()->user_id; 
		echo $data			=	$this->dashboard_model->create_playlist_inpopup($track_id, $popup_playlist_name, $customerId);
		
	}
}