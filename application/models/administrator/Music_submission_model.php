<?php
class Music_submission_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function add_music($adminID,$artist_id,$cat_id,$instrument_tag,$song_credits,$song_notes){
			$date	=	date("Y-m-d");
			$query = $this->db->query("SELECT * FROM snd_tmp_music_store WHERE admin_id='$adminID' AND artist_id='$artist_id'");
			foreach ($query->result_array() as $musicData){
						//$song_name	=	$musicData['file_name'];
						echo $tempSong_id	=	$musicData['id'];
						$tempCatid		=	$musicData['cat_id'];
					echo	$watermark_format	=	$musicData['watermark_format'];
						$lite_version		=	$musicData['lite_version'];	
						$personal_format	=	$musicData['personal_format'];
						$standard_licence	=	$musicData['standard_licence'];
						$premium_licence	=	$musicData['premium_licence'];
						$data = array(
						"artist_id" 		=> $artist_id,
						"cat_id" 			=> $tempCatid,
						//"song_name" 		=> $song_name,
						"instrument_tag" 	=> $instrument_tag,
						"song_credits" 		=> $song_credits,
						"song_notes" 		=> $song_notes,
						"song_upload_date" 	=> $date, 
						"track_status" 		=> 1
						);
					echo	"track".$trackID 	=	$this->db->insert('snd_artist_music',$data);
						die;
						$versionData = array(
						"track_id" 		=> $trackID,
						"watermark_format" 	=> $watermark_format,
						"lite_version" 		=> $lite_version,
						"personal_format" 	=> $personal_format,
						"standard_licence" 		=> $standard_licence,
						"premium_licence" 		=> $premium_licence
						);
						$this->db->insert('snd_musicfile_version',$versionData);
						
						$this->db->where('id', $tempSong_id);
						$this->db->delete('snd_tmp_music_store'); 
					}
			return 1; 
		}
	function delete_mucic_file($musicFileId){
		$this->db->where('id', $musicFileId);
		$this->db->delete('snd_tmp_music_store'); 
		return 1;
	}
}