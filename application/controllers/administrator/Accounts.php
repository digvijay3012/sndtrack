<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','custom_helper'));
		$this->load->library(array('ion_auth','form_validation'));
		if (!$this->ion_auth->logged_in()) {
			redirect('administrator/login');
        }
		 $ID			=	$this->ion_auth->user()->row()->user_id; 
		 $groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		$groupIdArray	=	array(1,2);
	
		if (!in_array($groupID, $groupIdArray)){
			redirect('administrator/login');
        }
		$this->load->model('administrator/accounts_model');
    }
	public function index()
	{
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		$data		=	$this->accounts_model->get_artist();
		$adminData	=	$this->accounts_model->get_artistBy_adminId($ID);
		$this->load->view('administrator/header_view');
		if($groupID==1){
			$this->load->view('administrator/superadmin/super_admin_accounts_view', array('data' => $data));
		}if($groupID==2){
			$this->load->view('administrator/admin/admin_accounts_view', array('data' => $adminData));
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
	public function setting(){
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		$data		=	$this->accounts_model->get_artist();
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
						if($groupID==1){
							$this->load->view('administrator/superadmin/account_settings_view');
						}if($groupID==2){
							$this->load->view('administrator/admin/account_settings_view.php');
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
						$adminImg		=	$_FILES['admin_image']['name'];
						$adminImgTmp	=	$_FILES['admin_image']['tmp_name'];
						
						$adminImgName	=	'';
						
						if($adminImg !=''){
							$adminImgName	=	$this->upload_image($adminImg,$adminImgTmp); 
						}
						$SubmitData		= 		$this->accounts_model->udateAccount_setting($ID,$first_name,$lastname,$first_address,$second_address,$city,$zip,$country,$email,$phone,$adminImgName);
						if($SubmitData==1){
							$this->session->set_flashdata('item', 'Account has been updated sucessfully.'); 
							redirect("administrator/accounts/setting");
						}
					}
				}
		
		if($groupID==1){
			$this->load->view('administrator/superadmin/account_settings_view');
		}if($groupID==2){
			$this->load->view('administrator/admin/account_settings_view.php');
		}
	}
	public function update_account_password(){
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		$data		=	$this->accounts_model->get_artist();
		if(!empty($_POST)){
					$this->form_validation->set_rules('old_password', 'Current Password', 'required|trim');
					$this->form_validation->set_rules('newpassword', 'New Password', 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|required|trim');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[newpassword]');
					if ($this->form_validation->run() == FALSE) { 
						if($groupID==1){
							$this->load->view('administrator/superadmin/super_admin_accounts_view');
						}if($groupID==2){
							$this->load->view('administrator/admin/account_settings_view.php');
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
								redirect("administrator/accounts/setting");
							}
							else{
								$this->session->set_flashdata('message', $this->ion_auth->errors());
								redirect("administrator/accounts/setting");
							}	
					}
				}
		if($groupID==1){
			$this->load->view('administrator/superadmin/super_admin_accounts_view');
		}if($groupID==2){
			$this->load->view('administrator/admin/account_settings_view.php');
		}
	}
	public function upload_image($artistImg,$artistImgTmp){
			if($artistImg !=''){
						$uploaddir         		= 'admin_images/';
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