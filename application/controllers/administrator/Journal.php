<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {


	function __construct() {
        parent::__construct();
		$this->load->helper(array('url','custom_helper'));
		$this->load->library(array('ion_auth','form_validation'));
		if (!$this->ion_auth->logged_in()) {
			redirect('administrator/login');
        }
		 $ID			=	$this->ion_auth->user()->row()->user_id; 
		 $groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		$groupIdArray	=	array(1);
	
		if (!in_array($groupID, $groupIdArray)){
			redirect('administrator/login');
        }
		$this->load->model('administrator/pages_model');
		$this->load->helper('form');
    }
	public function index()
	{
		$ID			=	$this->ion_auth->user()->row()->user_id; 
		$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		$data		=	$this->pages_model->get_pages();
		
		$this->load->view('administrator/header_view');
		if($groupID==1){
			$this->load->view('administrator/superadmin/manage_journal_pages_view', array('data' => $data));
		
		}else{
			redirect('administrator/login');
		}
		$this->load->view('administrator/footer_view');
	
	}
	public function add(){
		
		$this->load->view('administrator/superadmin/add_journal_page_view');
 	}
	public function edit_journal_page($pageId=null){
		if($pageId!=''){
			$getData = $this->pages_model->get_posts($pageId);
			$this->load->view('administrator/superadmin/add_journal_page_view', array('post_data' => $getData));
		}else{
			$this->load->view('administrator/superadmin/add_journal_page_view');
		}
		
		
		if(!empty($_POST)){
		$post_id		=	$this->input->post('post_id');		
		$post_title		=	$this->input->post('post_title');	
		$post_image		=	$_FILES['post_image']['name'];
		$postTempImg	=	$_FILES['post_image']['tmp_name'];
		$image_text		=	$this->input->post('image_text');
		$short_desc		=	$this->input->post('short_desc');		
		$long_content	=	$this->input->post('long_content');	
		$post_image_name	=	'';
		if($post_image !=''){
			$post_image_name	=	$this->upload_image($post_image,$postTempImg); 
		}
		if($post_id==''){
			$data		=	$this->pages_model->insert_journal_post($post_title, $post_image_name, $image_text, $short_desc, $long_content);
			if($data==1){
				$this->session->set_flashdata('item', 'Post has been created sucessfully.'); 
				redirect("administrator/journal/");
			}
		}else{
			$data		=	$this->pages_model->update_journal_post($post_id, $post_title, $post_image_name, $image_text, $short_desc, $long_content);	
			if($data==1){
				$this->session->set_flashdata('item', 'Post has been updated sucessfully.'); 
				redirect('administrator/journal/edit_journal_page/'.$post_id.'');	
			}
		}
	}
 }
 function delete_journal($postId=""){
		if($postId	==''){
			redirect("administrator/journal");
		}
		$getData	=	$this->pages_model->delete_journal($postId);
		$this->session->set_flashdata('item', 'Post has been deleted sucessfully.'); 
		redirect("administrator/journal");
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
						$uploaddir         		= 'post_images/';
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