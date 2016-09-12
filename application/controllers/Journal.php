<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','form'));
		//load custom helper 
		$this->load->helper('custom_helper');
		$this->load->library(array('ion_auth','form_validation','session'));
		$this->ion_auth->logged_in();
		$this->load->model('administrator/pages_model');
		$this->load->helper('form');
	}
	public function index()
	{
				$getData = $this->pages_model->get_posts($pageId=null);
				$this->load->view('pages/header_view');
				$this->load->view('pages/journal_view', array('data'=>$getData));
				$this->load->view('artist/footer_view');
		
	}
	public function view($postId)
	{
				$getData = $this->pages_model->get_single_post($postId);
				$this->load->view('pages/header_view');
				$this->load->view('pages/detailed_journal_view', array('data'=>$getData));
				$this->load->view('artist/footer_view');
		
	}
}