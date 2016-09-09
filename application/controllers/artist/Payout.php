<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payout extends CI_Controller {


	function __construct() {
        parent::__construct();
		
		$this->load->model('artists/payout_model');
		$this->load->helper(array('url','form','custom_helper'));
		$this->load->library(array('ion_auth','form_validation','session'));
		$this->ion_auth->logged_in();
		
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
			$ArtistData		=		$this->ion_auth->user()->row();
			$artistID 		=		$ArtistData->user_id;
			
			
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[2]|max_length[35]|greater_than[198]'); 
			$this->form_validation->set_rules('acoount_holder_name', 'Acoount holder name ', 'trim|required|min_length[2]|max_length[50]');
			$this->form_validation->set_rules('account_number', 'Account number', 'trim|required|min_length[2]|max_length[50]');        
			$this->form_validation->set_rules('sort_code', 'Sort code', 'trim|required|min_length[2]|max_length[30]');    
		if ($this->form_validation->run() == FALSE) {
				
				$this->load->view('artist/header_view');
				$this->load->view('artist/artist_payout_view');
				$this->load->view('artist/footer_view');
         } else {
						$amount					=		$this->input->post('amount');
						$acoount_holder_name	=		$this->input->post('acoount_holder_name');
						$account_number			=		$this->input->post('account_number');
						$sort_code				=		$this->input->post('sort_code');
						
						$SubmitData		= 		$this->payout_model->payout_form($artistID,$amount,$acoount_holder_name,$account_number,$sort_code);	
                       $this->session->set_flashdata('item', 'Form has been submitted sucessfully.'); 
						redirect("artist/payout");
		} 
		
	}

}