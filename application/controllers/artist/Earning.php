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
	public function single_track_graph()
	{
				$track_id	=	$this->input->post('track_id');
				$atistId	=	$this->input->post('atistId');
				
				return $this->load->view('artist/single_track_graph_view', array('track_id' => $track_id, 'atistId' => $atistId));
				
		
	}
	public function date_range_graph()
	{
				$track_id				=	$this->input->post('track_id');
				$atistId				=	$this->input->post('atistId');
				$from_datepicker		=	$this->input->post('from_datepicker');
				$to_datepicker			=	$this->input->post('to_datepicker');
				$data					=	$this->Earnings_model->date_range_graph($track_id, $atistId, $from_datepicker, $to_datepicker);
				return $this->load->view('artist/date_range_graph_view', array('data' => $data));
	}
}