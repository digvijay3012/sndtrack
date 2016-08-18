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
		
	}
	public function index()
	{
				$data	=	$this->browse_model->get_all_music();
				//print_r($data); die;
				$this->load->view('customer/browse_header_view');
				$this->load->view('customer/browse_view',array('data'=>$data));
				//$this->load->view('artist/footer_view');
		
	}
	public function filter_by_browse($short_type)
	{
				$data	=	$this->browse_model->filter_by_browse($short_type);
				//print_r($data); die;
				
				return $this->load->view('search/browse_orderby_filter',array('data'=>$data));
				//$this->load->view('artist/footer_view');
		
	}
	public function filter_by_category($catid=null){
		
		return $this->load->view('search/category_search_view', array('catId'=>$catid));
	}
	public function store_temp_license_type()
	{
		$session_id					=	$this->input->post('session_id');
		$license_type				=	$this->input->post('license_type');
		$customer_id				=	$this->input->post('customer_id');
		$amount						=	$this->input->post('amount');
		$license_type_value			=	$this->input->post('license_type_value');
		$track_id					=	$this->input->post('track_id');		
		$data						=	$this->browse_model->store_temp_license_type($session_id, $license_type, $customer_id, $amount, $license_type_value, $track_id);
				
	}
	public function get_cart_view_by_customer($customerId=null,$track_id=null){
		
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
}