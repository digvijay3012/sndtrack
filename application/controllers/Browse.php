<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form'));
		//load custom helper 
		$this->load->helper('custom_helper');
		$this->load->library(array('ion_auth','form_validation','session'));
		$this->load->model('browse_model');
		$this->lang->load('auth');
		if ($this->ion_auth->logged_in()){
				 $adminID			=	$this->ion_auth->user()->row()->user_id; 
				$groupID 			= 	$this->ion_auth->get_users_groups($adminID)->row()->id; 
				 //if the login is successful
				 if($groupID==1){
					$logout = $this->ion_auth->logout();
					redirect('login');
				}if($groupID==2){
					$logout = $this->ion_auth->logout();
					redirect('login');
				}if($groupID==3){
					$logout = $this->ion_auth->logout();
					redirect('login');
				}
			}
	}
	public function index()		
	{
				$data	=	$this->browse_model->get_all_music();
				//print_r($data); die;
				$this->load->view('customer/browse_header_view');
				$this->load->view('customer/browse_view',array('data'=>$data));
				//$this->load->view('artist/footer_view');
		
	}
	public function filter_by_browse()
	{
				$artist_id					=	'';
				$short_type					=	$this->input->post('short_type');
				$short_cat_id				=	$this->input->post('short_cat_id');
				$artist_id					=	$this->input->post('artist_id');
				$wishlist_userId			=	$this->input->post('wishlist_userId');
				$playlist_id				=	$this->input->post('playlist_id'); 
				$energy_level				=	$this->input->post('energy_level'); 
				if($wishlist_userId !=""){
					$data	=	$this->browse_model->filter_by_browse_wishlist($short_type, $wishlist_userId);
					return $this->load->view('search/wishlist_browse_orderby_filter',array('data'=>$data));
				}elseif($playlist_id !=''){
					$data	=	$this->browse_model->filter_by_browse_playlist($short_type, $playlist_id);
					return $this->load->view('search/playlist_browse_orderby_filter',array('data'=>$data));
				}elseif($energy_level !=''){
					$data	=	$this->browse_model->filter_by_browse_energy($short_type, $energy_level);
					return $this->load->view('search/energy_browse_orderby_filter',array('data'=>$data));
				}else{
					$data	=	$this->browse_model->filter_by_browse($short_type, $short_cat_id,$artist_id);
					return $this->load->view('search/browse_orderby_filter',array('data'=>$data));
				}		
	}
	public function filter_by_category($catid=null, $artistsId=null){
		
		return $this->load->view('search/category_search_view', array('catId'=>$catid, 'artistsId'=>$artistsId));
	}
	public function filter_by_energy($energy_level=null, $artistsId=null){
		return $this->load->view('search/energy_search_view', array('energy_level'=>$energy_level, 'artistsId'=>$artistsId));
	}
	public function store_temp_license_type()
	{
		$session_id					=	$this->input->post('session_id');
		$license_type				=	$this->input->post('license_type');
		$customer_id				=	$this->input->post('customer_id');
		$amount						=	$this->input->post('amount');
		$license_type_value			=	$this->input->post('license_type_value');
		$track_id					=	$this->input->post('track_id');	
		$this->session->set_userdata(array('track_id' => $track_id ));		
		$data						=	$this->browse_model->store_temp_license_type($session_id, $license_type, $customer_id, $amount, $license_type_value, $track_id);
				
	}
	public function get_cart_view_by_customer($customerId=null,$track_id=null){
		
		return $this->load->view('cart/cart_view', array('customer_id'=>$customerId, 'track_id'=>$track_id));
	}
	public function get_back_popup_stage_3($customerId=null){
		$track_id  =   $this->session->userdata('track_id'); 
		return $this->load->view('cart/cart_view', array('customer_id'=>$customerId, 'track_id'=>$track_id));
	}
	public function save_cart(){
		$data 					= 	json_decode(file_get_contents('php://input'), true);
		$full_name				=	$data['full_name'];
		$stage4_track_id		=	$data['stage4_track_id'];
		$stage4_customer_id		=	$data['stage4_customer_id'];
		$stage4_music_amount	=	$data['stage4_music_amount'];
		$address_line1			=	$data['address_line1'];
		$city					=	$data['city'];
		$project_name			=	$data['project_name'];
		$last_name				=	$data['last_name'];
		$second_address			=	$data['second_address'];
		$zip					=	$data['zip'];
		$vat					=	$data['vat'];
		$cardholdername			=	$data['cardholdername'];
		$selectYear				=	$data['select2'];
		$stripeToken			=	$data['stripeToken'];
		$license_type_id		=	get_license_type_by_amount($stage4_music_amount);
		
		$model					=	$this->browse_model->save_cart_value($stage4_track_id, $stage4_customer_id, $stage4_music_amount, $full_name, $address_line1, $city, $project_name, $last_name, $second_address, $zip, $vat, $cardholdername, $selectYear, $stripeToken,$license_type_id);	
		/* echo "<pre>";
		print_r($daga);
		echo "</pre>"; die; */
		return $this->load->view('cart/thank_you_popup', array('data'=>$data));
	}
	public function customer_songs()
	{
		if (! $this->ion_auth->logged_in()){
				redirect('login');
			}
			
				$speakerId			=	$this->ion_auth->user()->row()->user_id; 
				$data	=	$this->browse_model->customer_songs($speakerId);
				//print_r($data); die;
				$this->load->view('customer/browse_header_view');
				$this->load->view('customer/customer_songs_view',array('data'=>$data));
				//$this->load->view('artist/footer_view');
		
	}
	public function set_arists_bio(){
		$track_id		=	$this->input->post('track_id');
		$data			=	$this->browse_model->set_arists_bio($track_id);
		return $this->load->view('customer/set_arists_bio_view',array('data'=>$data));
	}
	public function filter_from_dashboard_by_category($catid=null, $artistsId=null){
		
		return $this->load->view('search/dashboard_category_search_view', array('catId'=>$catid, 'artistsId'=>$artistsId));
	}
}