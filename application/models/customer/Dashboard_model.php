<?php
class Dashboard_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	function get_artist_profile($artistId){
			$query = $this->db->query("SELECT snd_artist_info.artist_bio, snd_artist_info.facebook_link, snd_artist_info.twitter_link, snd_artist_info.instagram_link,snd_artist_info.artist_image, users.id, users.first_name, users.last_name from users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_artist_info ON users.id=snd_artist_info.artist_id WHERE users_groups.group_id=3 AND users.id='$artistId'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
		}
	function get_artist_profile_by_trackId($track_id){
			$selQry	=	$this->db->query("SELECT artist_id FROM snd_artist_music WHERE id='$track_id'")->row();
			if(!empty($selQry)){
				$artistId	=	$selQry->artist_id;
			}
			$query = $this->db->query("SELECT snd_artist_info.artist_bio, snd_artist_info.facebook_link, snd_artist_info.twitter_link, snd_artist_info.instagram_link,snd_artist_info.artist_image, users.id, users.first_name, users.last_name from users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_artist_info ON users.id=snd_artist_info.artist_id WHERE users_groups.group_id=3 AND users.id='$artistId'");
			$resultArray	=	array();
			$resultArray['track_id']	=	$track_id;
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
		}		
	function follow_artist($artistId, $customerId){
		$Data = array(
						"customer_id" 		=> $customerId,
						"artist_id" 	=> $artistId,
						"status" 		=> 'follow'
			);
		$this->db->insert('snd_followed_artist',$Data);
		return 1;
	}
	function create_playlist($customerId,$playlist_name){
		$currentDate	=	 date("Y-m-d");
		$Data = array(
				"playlist_name" => $playlist_name,
				"customer_id" 	=> $customerId,
				"playlist_date" => $currentDate
			);
		$this->db->insert('snd_customer_playlist',$Data);
		return 1;
	}
}