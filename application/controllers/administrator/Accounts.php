<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','custom_helper'));
		$this->load->library(array('ion_auth','form_validation'));
		$this->ion_auth->logged_in();
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
			redirect('administrator/login');
        }
		$this->load->model('administrator/accounts_model');
    }
	public function index()
	{
		$data		=	$this->accounts_model->get_artist();
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id;
		$this->load->view('administrator/header_view');
		if($groupID==1){
			$this->load->view('administrator/super_admin_dashboard_view', array('data' => $data));
		}if($groupID==2){
			$this->load->view('administrator/admin_accounts_view', array('data' => $data));
		}
		$this->load->view('administrator/footer_view');
		
		
		
	}
	public function reset_password($artistId=null){
		if($artistId==''){
			redirect('administrator/accounts');
		}
		if(!empty($_POST)){
					$this->form_validation->set_rules('old_password', 'Current Password', 'required|trim');
					$this->form_validation->set_rules('password', 'Password', 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|required|trim');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
					if ($this->form_validation->run() == FALSE) { 
						$this->load->view('administrator/header_view');
						$this->load->view('administrator/reset_password_view');
						$this->load->view('administrator/footer_view');
					} else {
						$ArtistData	=	$this->db->query("SELECT email FROM users WHERE id='$artistId'")->row();
						if(!empty($ArtistData)){
							$identity 	=		$ArtistData->email;
						}
						$old_password	=		$this->input->post('old_password');
						$password		=		$this->input->post('password');
						$change = $this->ion_auth->change_password($identity, $old_password, $password);

							if ($change){
								//if the password was successfully changed
								$this->session->set_flashdata('message', $this->ion_auth->messages());
								redirect("administrator/accounts/");
							}
							else{
								$this->session->set_flashdata('message', $this->ion_auth->errors());
								redirect("administrator/accounts/");
							}	
					}
				}
		$this->load->view('administrator/header_view');
		$this->load->view('administrator/reset_password_view');
		$this->load->view('administrator/footer_view');
	}
}