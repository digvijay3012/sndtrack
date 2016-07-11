<?php
class Music_submission_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function add_music($artistID,$song_type,$upload_song,$song_name,$instrument_tag,$song_credits,$song_notes,$upload_song,$album_name,$TrackImageName,$track_type){
			$date	=	date("Y-m-d");
			$data = array(
			"artist_id" 		=> $artistID,
			"song_type" 		=> $song_type,
			"song_name" 		=> $song_name,
			"instrument_tag" 	=> $instrument_tag,
			"song_credits" 		=> $song_credits,
			"song_notes" 		=> $song_notes,
			"song_upload_date" 	=> $date, 
			"mp3_filename" 		=> $upload_song,
			"album_id" 			=> $album_name,
			"track_image" 		=> $TrackImageName,
			"track_type" 		=> $track_type,
			"track_status" 		=> 0
			);
			$this->db->insert('snd_artist_music',$data);
				return 1; 
		}
}