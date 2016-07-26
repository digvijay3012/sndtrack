<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Music extends CI_Controller {


	function __construct() {
        parent::__construct();
		
		$this->load->model('administrator/music_submission_model');
		//$this->load->model('artists/my_music_model');
		$this->load->helper(array('url','form','custom_helper'));
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
				$adminID			=	$this->ion_auth->user()->row()->user_id; 
				$groupID 			= 	$this->ion_auth->get_users_groups($adminID)->row()->id; 
			$this->form_validation->set_rules('artist_id', 'Select Artist', 'required');
			$this->form_validation->set_rules('cat_id', 'Select Category', 'required');	
			$this->form_validation->set_rules('short_order', 'Select Order By', 'required');
			$this->form_validation->set_rules('energy_level', 'Select Energy level', 'required');			
			$this->form_validation->set_rules('instrument_tag', 'Instrument tag', 'trim|required|min_length[2]|max_length[300]');
			$this->form_validation->set_rules('song_credits', 'Song Credits tag', 'trim|required|min_length[2]|max_length[500]');        
			$this->form_validation->set_rules('song_notes', 'Song Notes', 'trim|required|min_length[2]|max_length[1000]');    
		if ($this->form_validation->run() == FALSE) {
				
				$this->load->view('administrator/header_view');
				if($groupID==1){
					
					$this->load->view('administrator/superadmin/music_submission_view');
				}
				if($groupID==2){
					$this->load->view('administrator/admin/music_submission_view');	
				}
				$this->load->view('administrator/footer_view');
         } else {
				
				$artist_id 		= 		$this->input->post('artist_id');
				$cat_id 		= 		$this->input->post('cat_id');
				$short_order	=		$this->input->post('short_order');
				$energy_level	=		$this->input->post('energy_level');
				$instrument_tag	=		$this->input->post('instrument_tag');
				$song_credits	=		$this->input->post('song_credits');
				$song_notes		=		$this->input->post('song_notes');
				$SubmitData		= 		$this->music_submission_model->add_music($adminID,$artist_id,$cat_id,$short_order,$energy_level,$instrument_tag,$song_credits,$song_notes);	
				$this->session->set_flashdata('item', 'Music has been submit sucessfully.'); 
				redirect("administrator/music");
				} 
		
	}
	public function upload_music(){
		if($_POST['image_form_submit'] == 1){
		$inserStatusArr	= array();
		$inserStatus = '';
		$cat_id	='';
		$artist_id		 =	$this->input->post('artist_id');
		$cat_id	 		=	$this->input->post('cat_id');
		$column_name	=	$this->input->post('column_name');
		$adminID	 	=	$this->ion_auth->user()->row()->user_id; 
		$images_arr 		= array();
		$getFileNameArr		=	array();
		$fileCount	=	$_POST['fileCount'];
		for($i=0;$i<$fileCount;$i++){
			$fileName	=	"musicfiles_".$i;
			$image_name = $_FILES[$fileName]['name']; 
			$tmp_name 	= $_FILES[$fileName]['tmp_name'];
			$size 		= $_FILES[$fileName]['size'];
			$type 		= $_FILES[$fileName]['type'];
			$error 		= $_FILES[$fileName]['error'];
			array_push($getFileNameArr, $image_name);
			############ upload and stored  into the folder #############
			
			$target_dir = "music/";
			$target_file = $target_dir.$_FILES[$fileName]['name'];
			if(move_uploaded_file($_FILES[$fileName]['tmp_name'],$target_file)){
				$images_arr[] = $target_file;
			}
			
			$inserStatus	=	store_temp_mucic($adminID,$artist_id,$image_name,$cat_id,$column_name);
			array_push($inserStatusArr, $inserStatus);
		}
	
		if(!empty($images_arr)){ $count=0;
			foreach($images_arr as $image_src){ $count++?>
				<ul class="reorder_ul reorder-photos-list">
				<?php 
				//echo "daga".$column_name; die;
					$musicFileName	=	$getFileNameArr[$count-1]; 
					$musicID		=	get_music_id($adminID,$artist_id,$musicFileName,$column_name);
				?>
				<?php if($musicID!=''){ ?>
					<li id="music_li_<?php echo $musicID; ?>" >
						<a href="javascript:void(0);" style="float:none;" class="image_link"><?php echo $getFileNameArr[$count-1]; ?></a>
						
						<span class="delete-file-handle" pid="<?php echo $musicID; ?>">
						 X </span><span class="al-msg"><?php if (in_array($musicFileName, $inserStatusArr)){ echo "This file has been already uplaod for this artist".$musicFileName; } ?></span>
						
					</li>
					<?php } else { ?>
					<li id="music_li_del" >
						<a href="javascript:void(0);" style="float:none;" class="image_link"><?php echo $getFileNameArr[$count-1]; ?></a>
						
						<span class="delete-file-handle-this">
						 X </span><span class="al-msg"><?php if (in_array($musicFileName, $inserStatusArr)){ echo "This file has been already uplaod for this artist"; } ?></span>
					</li>
					<?php } ?>
				</ul>
				<?php }
				}
			}
	}
	function delete_mucic_file($musicFileId=null){ 
		$musicFileId	=	$this->input->post('pid');
		echo $getData	=	$this->music_submission_model->delete_mucic_file($musicFileId);
	} 
	/* public function upload_image($trackImg,$trackImgTmp){
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
	} */
	/* function get_album($ArtistID=""){
		
		return $getData	=	$this->my_music_model->get_album($ArtistID);
	} */
}