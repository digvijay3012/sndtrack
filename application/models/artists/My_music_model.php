<?php
class My_music_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_music($artistID){
			
			$musicArray		=	array();
		
			$getAlbum = $this->db->query("SELECT DISTINCT snd_artist_album.id AS album_id, snd_artist_album.album_name, snd_artist_album.album_image, snd_artist_album.album_date FROM snd_artist_album INNER JOIN  snd_artist_music ON snd_artist_album.id=snd_artist_music.album_id WHERE snd_artist_album.artist_id='$artistID' ORDER BY snd_artist_album.id ASC");
			foreach ($getAlbum->result_array() as $getAlbumID){
						$musicArray['album'][]	=	$getAlbumID;
				} 
			$Singletrackquery = $this->db->query("SELECT * FROM snd_artist_music WHERE artist_id='$artistID' AND track_status=1");
			
			
			foreach ($Singletrackquery->result_array() as $Trackdata){
				$musicArray['single_track'][]= $Trackdata;
			}
					return $musicArray;
		}
	function create_album($ArtistID,$album_name,$album_image){
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
	}
}