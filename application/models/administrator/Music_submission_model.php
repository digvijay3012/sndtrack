<?php
class Music_submission_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function add_music($adminID,$artist_id,$song_type,$instrument_tag,$song_credits,$song_notes){
			$date	=	date("Y-m-d");
			$query = $this->db->query("SELECT * FROM snd_tmp_music_store WHERE admin_id='$adminID' AND artist_id='$artist_id'");
			foreach ($query->result_array() as $musicData){
						$song_name	=	$musicData['file_name'];
						$song_id	=	$musicData['id'];
						$data = array(
						"artist_id" 		=> $artist_id,
						"song_type" 		=> $song_type,
						"song_name" 		=> $song_name,
						"instrument_tag" 	=> $instrument_tag,
						"song_credits" 		=> $song_credits,
						"song_notes" 		=> $song_notes,
						"song_upload_date" 	=> $date, 
						"track_status" 		=> 0
						);
						$this->db->insert('snd_artist_music',$data);
						
						$this->db->where('id', $song_id);
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