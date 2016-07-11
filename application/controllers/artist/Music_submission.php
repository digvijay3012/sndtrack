<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Music_submission extends CI_Controller {


	function __construct() {
        parent::__construct();
		
		$this->load->model('artists/music_submission_model');
		$this->load->model('artists/my_music_model');
		$this->load->helper(array('url','form'));
		$this->load->library(array('ion_auth','form_validation','session'));
		$this->ion_auth->logged_in();
		
		if (! $this->ion_auth->logged_in()){
				redirect('artist/login');
			}
	}
	public function index()
	{
			$ArtistData		=		$this->ion_auth->user()->row();
			$artistID 		=		$ArtistData->user_id;
			$albumData		=	$this->get_album($artistID); 
			
			//$this->form_validation->set_rules('upload_song', 'Music File', 'required'); 
			$this->form_validation->set_rules('song_name', 'Song Name', 'trim|required|min_length[2]|max_length[100]'); 
			$this->form_validation->set_rules('instrument_tag', 'Instrument tag', 'trim|required|min_length[2]|max_length[300]');
			$this->form_validation->set_rules('song_credits', 'Song Credits tag', 'trim|required|min_length[2]|max_length[500]');        
			$this->form_validation->set_rules('song_notes', 'Song Notes', 'trim|required|min_length[2]|max_length[1000]');    
		if ($this->form_validation->run() == FALSE) {
				
				$this->load->view('artist/header_view');
				$this->load->view('artist/music_submission_view', array("data"	=>	$albumData));
				$this->load->view('artist/footer_view');
         } else {
					
				$config['upload_path']          = 'music/';
                $config['allowed_types']        = 'mp3|wav';
                $config['max_size']             = 1000000;
                $RandNo		=	 rand(); 
				list($txt, $ext) = explode(".", $_FILES["upload_song"]['name']);
				$actual_file_name = $txt."_".$RandNo.".".$ext;
				$config['file_name'] = $actual_file_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('upload_song')){
					
                    $this->session->set_flashdata('item', 'Please upload a valid music file.'); 
					redirect("artist/music_submission");
					}else{
							$trackImg		=	$_FILES['track_image']['name'];
							$trackImgTmp	=	$_FILES['track_image']['tmp_name'];
							
							$TrackImageName	=	'';
							
							if($trackImg !=''){
								$TrackImageName	=	$this->upload_image($trackImg,$trackImgTmp); 
							}
							
						
						$getFileName 	=		$this->upload->data();
						
						$file_name 		= 		$getFileName['file_name'];
						$song_type		=		$this->input->post('song_type');
						$track_type		=		$this->input->post('track_type');
						$upload_song	=		$actual_file_name;
						$song_name		=		$this->input->post('song_name');
						$instrument_tag	=		$this->input->post('instrument_tag');
						$song_credits	=		$this->input->post('song_credits');
						$song_notes		=		$this->input->post('song_notes');
						$album_name		=		$this->input->post('album_name');
						$SubmitData		= 		$this->music_submission_model->add_music($artistID,$song_type,$file_name,$song_name,$instrument_tag,$song_credits,$song_notes,$upload_song,$album_name,$TrackImageName,$track_type);	
                       $this->session->set_flashdata('item', 'Form has been submit sucessfully..'); 
						redirect("artist/music_submission");
					}			 
          
         } 
		
	}
	public function upload_image($trackImg,$trackImgTmp){
			if($trackImg !=''){
						$uploaddir         		= 'music_images/';
						 $RandNo				=	 rand(); 
						list($txt, $ext) 		= explode(".",$trackImg);
						$actual_file_name 		= $txt."_".$RandNo.".".$ext;
						$uploadfile = $uploaddir . basename($actual_file_name);
							if (move_uploaded_file($trackImgTmp, $uploadfile)) {
								  return $actual_file_name;
								} else {
								  return false;
								}
					}else{
						 return false;
					}
	}
	function get_album($ArtistID=""){
		
		return $getData	=	$this->my_music_model->get_album($ArtistID);
	}
}