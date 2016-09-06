<?php
class Earnings_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_sale($artistID){
			
			$musicArray		=	array();
		
			$selQuery = $this->db->query("SELECT SUM(snd_music_orders.order_amount) AS total_amount, snd_artist_music.id, snd_artist_music.song_upload_date,snd_musicfile_version.watermark_format,snd_musicfile_version.lite_version , snd_musicfile_version.personal_format, snd_musicfile_version.standard_licence,  snd_musicfile_version.premium_licence, snd_music_orders.order_amount, snd_music_orders.license_type_id FROM snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_music_orders ON snd_artist_music.id=snd_music_orders.track_id WHERE snd_artist_music.artist_id='$artistID' AND track_status=1 GROUP BY snd_artist_music.id");	
				foreach ($selQuery->result_array() as $allData){
					$musicArray[]= $allData;
				}
				return $musicArray;
		}
	/* function create_album($ArtistID,$album_name,$album_image){
		$date	=	date("Y-m-d");
		$data = array(
			"artist_id" 		=> $ArtistID,
			"album_name" 		=> $album_name,
			"album_image" 		=> $album_image,
			"album_date" 		=> $date
			);
		
		$this->db->insert('snd_artist_album',$data);
		return 1; 
	}
	function get_album($ArtistID){
		
		$Albumquery = $this->db->query("SELECT * FROM snd_artist_album WHERE artist_id='$ArtistID' ");
		
			$albumArray	=	array();
			foreach ($Albumquery->result_array() as $row){
						$albumArray[]= $row;
					}
				
				return $albumArray;	
	}
	function delete_album($albumID){
		
		$Albumquery = $this->db->query("DELETE FROM snd_artist_album WHERE id='$albumID' ");
		
				return 1;	
	} */
}