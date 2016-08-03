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
		/* if (! $this->ion_auth->logged_in()){
				redirect('artist/login');
			} */
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
}