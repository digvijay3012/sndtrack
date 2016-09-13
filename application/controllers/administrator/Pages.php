<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {


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
		$data		=	$this->pages_model->get_all_pages();
		
		$this->load->view('administrator/header_view');
		if($groupID==1){
			$this->load->view('administrator/superadmin/manage_pages_view', array('data' => $data));
		
		}else{
			redirect('administrator/login');
		}
		$this->load->view('administrator/footer_view');
	
	}
	public function add(){
		
		$this->load->view('administrator/superadmin/add_journal_page_view');
 	}
	public function edit_page($pageId=null){
		
		$getData = $this->pages_model->get_page_data($pageId);
		$this->load->view('administrator/superadmin/edit_page_view', array('page_data' => $getData));
		if(!empty($_POST)){
			$page_id		=	$this->input->post('page_id');		
			$page_title		=	$this->input->post('page_title');	
			$page_content	=	$this->input->post('page_content');		
		
			$data		=	$this->pages_model->update_page_content($page_id, $page_title, $page_content);	
			if($data==1){
				$this->session->set_flashdata('item', 'Page has been updated sucessfully.'); 
				redirect('administrator/pages');	
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
	
	public function edit_home_page($pageId=null){
		$getData = $this->pages_model->get_home_page_data($pageId);
		$this->load->view('administrator/superadmin/edit_home_page_view', array('page_data' => $getData));
		if(!empty($_POST)){
			$page_id		=	$this->input->post('page_id');		
			$post_image		=	$_FILES['image_1']['name'];
			$postTempImg	=	$_FILES['image_1']['tmp_name'];
			$text_1			=	$this->input->post('text_1');		
			$text_2			=	$this->input->post('text_2');
			$text_3			=	$this->input->post('text_3');
			$post_image_name	=	'';
			if($post_image !=''){
				$post_image_name	=	$this->upload_image($post_image,$postTempImg); 
			}
			$data			=	$this->pages_model->update_home_page_content($page_id, $post_image_name, $text_1, $text_2, $text_3);	
			if($data==1){
				$this->session->set_flashdata('item', 'Page has been updated sucessfully.'); 
				redirect('administrator/pages');	
		}
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