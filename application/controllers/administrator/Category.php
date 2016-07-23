<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {


	function __construct() {
        parent::__construct();
		
		$this->load->model('administrator/category_model');
		$this->load->helper(array('url','form'));
		//load custom helper 
		$this->load->helper('custom_helper');
		$this->load->library(array('ion_auth','form_validation','session'));
		
		if (! $this->ion_auth->logged_in()){
				redirect('administrator/login');
			}
		$ID				=	$this->ion_auth->user()->row()->user_id; 
		$groupID 		= 	$this->ion_auth->get_users_groups($ID)->row()->id; 
		$groupIdArray	=	array(1,2);
	
		if (!in_array($groupID, $groupIdArray)){
			redirect('administrator/login');
        }
	}
	public function index()
	{
			$AdminID	=	$this->ion_auth->user()->row()->user_id;
				if(!empty($_POST)){
					$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|min_length[2]|max_length[100]'); 
					if ($this->form_validation->run() == FALSE) { 
						$this->load->view('administrator/header_view');
						$this->load->view('administrator/superadmin/category_view');
						$this->load->view('administrator/footer_view');
					} else {
						
						$category_name		=		$this->input->post('category_name');
						$SubmitData		= 		$this->category_model->create_category($AdminID,$category_name);	
						if($SubmitData==1){
							$this->session->set_flashdata('item', 'Category has been created sucessfully.'); 
							redirect("administrator/category");
						}else{
							$this->session->set_flashdata('item', 'There is problem to create Category, Please try again..'); 
							redirect("administrator/category");
						}
						
					}
				}
				$allCategory 	=	$this->get_category($AdminID);
				$this->load->view('administrator/header_view');
				$this->load->view('administrator/category_view', array('data'=>$allCategory));
				$this->load->view('administrator/footer_view');
	}
	
	function get_category($AdminID=""){
		
		return $getData	=	$this->category_model->get_category($AdminID);
	}
	function delete_category($catid=""){
		if($catid	==''){
			redirect("administrator/category");
		}
		$getData	=	$this->category_model->delete_category($catid);
		$this->session->set_flashdata('item', 'Category has been deleted sucessfully.'); 
		redirect("administrator/category");
	}
}