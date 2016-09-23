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
		 //echo "<pre>";	print_r($_POST);	echo "</pre>"; die;
		 $track_id					=	$this->input->post('track_id');
		 $popup_playlist_name		=	$this->input->post('popup_playlist_name');
		if($popup_playlist_name=='' || $track_id	==''){
			echo "3";
		}
		$customerId		=	$this->ion_auth->user()->row()->user_id; 
		 $data			=	$this->dashboard_model->create_playlist_inpopup($track_id, $popup_playlist_name, $customerId);
		echo '<div class="added_pop"><div class="rt_playlist-nam">'.$popup_playlist_name.'</div><div class="lst_data lft_playlst a"><button type="button" class="added">Added</button></div></div>';
		
	}
		public function get_popup_playlistId_from_dahboard($popup_playlist_name=null){
		 
		$customerId		=	$this->ion_auth->user()->row()->user_id; 
		 $data			=	$this->dashboard_model->get_popup_playlistId_from_dahboard($customerId);
		echo '<li playlist_id="'.$data.'" class="trash"><a href="'.base_url().'playlist/view/'.$data.'">'.$popup_playlist_name.'</a></li>';
		
	}
	public function filter_by_category($catid=null){
		
		return $this->load->view('search/category_search_view', array('catId'=>$catid));
	}
	public function filter_by_orderby($short_type=null){
		
		return $this->load->view('search/logged_in_wishlist_orderby_filter', array('short_type'=>$short_type));
	}
}