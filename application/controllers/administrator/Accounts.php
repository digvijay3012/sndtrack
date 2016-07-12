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
		$this->load->view('administrator/header_view');
		$this->load->view('administrator/accounts_view', array('data' => $data));
		$this->load->view('administrator/footer_view');
	}
	public function reset_password($artistId=null){
		if($artistId==''){
			redirect('administrator/accounts');
		}
		if(!empty($_POST)){
					 $this->form_validation->set_rules('password', 'Password', 'required|trim');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
					if ($this->form_validation->run() == FALSE) { 
						$this->load->view('administrator/header_view');
						$this->load->view('administrator/reset_password_view');
						$this->load->view('administrator/footer_view');
					} else {
						
						$album_name		=		$this->input->post('album_name');
						$SubmitData		= 		$this->my_music_model->create_album($ArtistID,$album_name,$album_image);	
						if($SubmitData==1){
							$this->session->set_flashdata('item', 'Album has been created sucessfully.'); 
							redirect("artist/music/create_album");
						}else{
							$this->session->set_flashdata('item', 'There is problem to create your album, Please try again..'); 
							redirect("artist/music/create_album");
						}
						
					}
				}
		$this->load->view('administrator/header_view');
		$this->load->view('administrator/reset_password_view');
		$this->load->view('administrator/footer_view');
	}
}