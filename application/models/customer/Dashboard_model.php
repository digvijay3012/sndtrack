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
			$resultArray	=	array();
			if(!empty($selQry)){
				$artistId	=	$selQry->artist_id;
			}else{
				return $resultArray;
			}
			$query = $this->db->query("SELECT snd_artist_info.artist_bio, snd_artist_info.facebook_link, snd_artist_info.twitter_link, snd_artist_info.instagram_link,snd_artist_info.artist_image, users.id, users.first_name, users.last_name from users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_artist_info ON users.id=snd_artist_info.artist_id WHERE users_groups.group_id=3 AND users.id='$artistId'");
			
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
	function add_to_wishlist($track_id,$customerId){
			$selQry	=	$this->db->query("SELECT id FROM snd_customer_wishlist WHERE customer_id='$customerId' AND 	track_id='$track_id'")->row();
			if(!empty($selQry)){
						
				return 2;
			}else{
				$Data = array(
						"customer_id	" => $customerId,
						"track_id" 	=> $track_id
					);
				$this->db->insert('snd_customer_wishlist',$Data);
				return 1;
			}
	}
	function add_to_playlist($playlist_id, $track_id, $customerId){
		$selQry	=	$this->db->query("SELECT id FROM snd_customer_playlist_music WHERE playlist_id='$playlist_id' AND 	track_id='$track_id' AND customer_id='$customerId'")->row();
		if(!empty($selQry)){
						
				return 2;
			}else{
				$Data = array(
						"playlist_id"	 => $playlist_id,
						"track_id" 		 => $track_id,
						"customer_id" 	 => $customerId
					);
				$this->db->insert('snd_customer_playlist_music',$Data);
				return 1;
			}
	}
		function create_playlist_inpopup($track_id, $popup_playlist_name, $customerId){
			$currentDate			=	 date("Y-m-d");
			
		$Data = array(
				"playlist_name" => $popup_playlist_name,
				"customer_id" 	=> $customerId,
				"playlist_date" => $currentDate
			);
		$this->db->insert('snd_customer_playlist',$Data);
		$insertPlaylistId = $this->db->insert_id();
		
		$playlistData = array(
						"playlist_id"	 => $insertPlaylistId,
						"track_id" 		 => $track_id,
						"customer_id" 	 => $customerId
					);
				$this->db->insert('snd_customer_playlist_music',$playlistData);
				return 1;
	}
}