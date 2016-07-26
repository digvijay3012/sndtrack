<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','custom_helper'));
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model('customer/account_setting_model');
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
	public function index(){
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		
		if(!empty($_POST)){
					$this->form_validation->set_rules('first_name', 'First name', 'required|trim');
					$this->form_validation->set_rules('lastname', 'Last name', 'required|trim');
					$this->form_validation->set_rules('first_address', 'First line address', 'required|trim');
					$this->form_validation->set_rules('second_address', 'Second line address', 'required|trim');
					$this->form_validation->set_rules('city', 'City/State', 'required|trim');
					$this->form_validation->set_rules('zip', 'Zip/Post Code', 'required|trim');
					$this->form_validation->set_rules('country', 'Country', 'required|trim');
					//$this->form_validation->set_rules('email', 'email', 'required|trim');
					$this->form_validation->set_rules('phone', 'Phone', 'required|trim');
					if ($this->form_validation->run() == FALSE) { 
						if($groupID==4){
							$this->load->view('customer/account_settings_view');
						}
					} else {
						$first_name		=		$this->input->post('first_name');	
						$lastname		=		$this->input->post('lastname');	
						$first_address	=		$this->input->post('first_address');
						$second_address	=		$this->input->post('second_address');
						$city			=		$this->input->post('city');
						$zip			=		$this->input->post('zip');
						$country		=		$this->input->post('country');
						$email			=		$this->input->post('email');
						$phone			=		$this->input->post('phone');
						$adminImg		=	$_FILES['customer_image']['name'];
						$adminImgTmp	=	$_FILES['customer_image']['tmp_name'];
						
						$adminImgName	=	'';
						
						if($adminImg !=''){
							$adminImgName	=	$this->upload_image($adminImg,$adminImgTmp); 
						}
						$SubmitData		= 		$this->account_setting_model->udateAccount_setting($ID,$adminImgName,$first_name,$lastname,$first_address,$second_address,$city,$zip,$country,$email,$phone);
						if($SubmitData==1){
							$this->session->set_flashdata('item', 'Account has been updated sucessfully.'); 
							redirect("account");
						}
					}
				}
		
		if($groupID==4){
			$this->load->view('customer/account_settings_view');
		}
	}
	public function update_account_password(){
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
	
		if(!empty($_POST)){
					$this->form_validation->set_rules('old_password', 'Current Password', 'required|trim');
					$this->form_validation->set_rules('newpassword', 'New Password', 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|required|trim');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[newpassword]');
					if ($this->form_validation->run() == FALSE) { 
						if($groupID==4){
							$this->load->view('customer/account_settings_view');
						}
					} else {
						$admindata	=	$this->db->query("SELECT email FROM users WHERE id='$ID'")->row();
						if(!empty($admindata)){
							$identity 	=		$admindata->email;
						}
						$old_password	=		$this->input->post('old_password');
						$password		=		$this->input->post('newpassword');
						$change = $this->ion_auth->change_password($identity, $old_password, $password);

							if ($change){
								//if the password was successfully changed
								$this->session->set_flashdata('message', $this->ion_auth->messages());
								redirect("account");
							}
							else{
								$this->session->set_flashdata('message', $this->ion_auth->errors());
								redirect("account");
							}	
					}
				}
		if($groupID==4){
			$this->load->view('customer/account_settings_view');
		}
	}
	public function upload_image($artistImg,$artistImgTmp){
			if($artistImg !=''){
						$uploaddir         		= 'customer_images/';
						 $RandNo				=	 rand(); 
						list($txt, $ext) 		= explode(".",$artistImg);
						$actual_file_name 		= $txt."_".$RandNo.".".$ext;
						$uploadfile = $uploaddir . basename($actual_file_name);
							if (move_uploaded_file($artistImgTmp, $uploadfile)) {
								  return $actual_file_name;
								} else {
								  return false;
								}
					}else{
						 return false;
					}
	}
}