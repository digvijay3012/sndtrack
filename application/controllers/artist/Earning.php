<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Earning extends CI_Controller {


	function __construct() {
        parent::__construct();
		
		$this->load->model('artists/my_music_model');
		$this->load->helper(array('url','form'));
		//load custom helper 
		$this->load->helper('custom_helper');
		$this->load->library(array('ion_auth','form_validation','session'));
		$this->ion_auth->logged_in();
		if (! $this->ion_auth->logged_in()){
				redirect('artist/login');
			}
	}
	public function index()
	{
				$ArtistID	=	$this->ion_auth->user()->row()->user_id;
				//$data		=	$this->my_music_model->get_music($ArtistID);
				 
				/* echo "<pre>";
				print_r($data);
				echo "</pre>" */;
				
				$this->load->view('artist/header_view');
				$this->load->view('artist/earning_view.php');
				$this->load->view('artist/footer_view');
		
	}
	public function create_album(){
				$ArtistID	=	$this->ion_auth->user()->row()->user_id;
				if(!empty($_POST)){
					$this->form_validation->set_rules('album_name', 'Album Name', 'trim|required|min_length[2]|max_length[100]'); 
					if ($this->form_validation->run() == FALSE) { 
						$this->load->view('artist/header_view');
						$this->load->view('artist/create_album_view');
						$this->load->view('artist/footer_view');
					} else {
						$album_image					=	$_FILES["album_image"]['name'];
						if($album_image){
							$config['upload_path']          = 'music_images/';
							$config['allowed_types'] 		= 'gif|jpg|png|jpeg'; 
							$config['max_size']     		= 10000; 
							$config['max_width']     		= 5024; 
							$config['max_height']    		= 5068;  
							$RandNo		=	 rand(); 
							list($txt, $ext) = explode(".", $_FILES["album_image"]['name']);
							$actual_file_name = $txt."_".$RandNo.".".$ext;
							$config['file_name'] = $actual_file_name;
							$this->load->library('upload', $config);

							if ( ! $this->upload->do_upload('album_image')){
							
							$this->session->set_flashdata('item', 'Please upload a valid image file.'); 
							redirect("artist/music_submission");
							}
							$album_image	=	$actual_file_name;
						}
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
				$allAlbums 	=	$this->get_album($ArtistID);
				$this->load->view('artist/header_view');
				$this->load->view('artist/create_album_view', array('data'=>$allAlbums));
				$this->load->view('artist/footer_view');
		
	}
	function get_album($ArtistID=""){
		
		return $getData	=	$this->my_music_model->get_album($ArtistID);
	}
	function delete_album($albumID=""){
		if($albumID	==''){
			redirect("artist/music/create_album");
		}
		$getData	=	$this->my_music_model->delete_album($albumID);
		$this->session->set_flashdata('item', 'Album has been deleted sucessfully.'); 
		redirect("artist/music/create_album");
	}
}