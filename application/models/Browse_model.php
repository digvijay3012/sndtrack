<?php
class Browse_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	function get_all_music(){
			$query = $this->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				//print_r($resultArray); die;
				return $resultArray;
		}
	function filter_by_browse($short_type, $short_cat_id, $artist_id){
		
		$myQuery	=	"SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id AND snd_artist_music.short_order='$short_type'";
		if($short_cat_id !=''){
			$myQuery	.= " AND snd_artist_music.cat_id='$short_cat_id'";
		}
		if($artist_id !=''){
			$myQuery	.= " AND snd_artist_info.artist_id='$artist_id'";
		}
			$query = $this->db->query($myQuery);
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				//print_r($resultArray); die;
				return $resultArray;
		}
	function filter_by_browse_wishlist($short_type, $wishlist_userId){

			$myQuery	= "SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id INNER JOIN snd_customer_wishlist ON snd_artist_music.id=snd_customer_wishlist.track_id WHERE snd_customer_wishlist.customer_id='$wishlist_userId' AND snd_artist_music.short_order='$short_type'";
			$query = $this->db->query($myQuery);
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				//print_r($resultArray); die;
				return $resultArray;
	}
	function filter_by_browse_playlist($short_type, $playlist_id){
			$myQuery	= "SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id INNER JOIN snd_customer_playlist_music ON snd_artist_music.id=snd_customer_playlist_music.track_id WHERE snd_customer_playlist_music.playlist_id='$playlist_id' AND snd_artist_music.short_order='$short_type'"; 
			
			$query = $this->db->query($myQuery);
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				//print_r($resultArray); die;
				return $resultArray;
	}
	function store_temp_license_type($session_id, $license_type, $customer_id, $amount, $license_type_value,$track_id){
			$data = array(
				"session_id" 		=> $session_id,
				"license_type" 		=> $license_type,
				"customer_id" 		=> $customer_id,
				"amount" 			=> $amount,
				"license_type_value" => $license_type_value,
				"track_id" 			=> $track_id
			);
			$this->db->insert('snd_temp_pack_info',$data);
				return 1; 
		}
	function save_cart_value($stage4_track_id, $stage4_customer_id, $stage4_music_amount, $full_name, $address_line1, $city, $project_name, $last_name, $second_address, $zip, $vat, $cardholdername, $selectYear, $stripeToken, $license_type_id){
			$order_date 	=	date("Y-m-d");
			$data = array(
				"track_id" 			=> $stage4_track_id,
				"customer_id" 		=> $stage4_customer_id,
				"order_amount" 		=> $stage4_music_amount,
				"full_name" 		=> $full_name,
				"address_line1" 	=> $address_line1,
				"city" 				=> $city,
				"project_name" 		=> $project_name,
				"last_name" 		=> $last_name,
				"second_address" 	=> $second_address,
				"zip" 				=> $zip,
				"vat" 				=> $vat,
				"cardholdername" 	=> $cardholdername,
				"expire_year" 		=> $selectYear,
				"stripeToken" 		=> $stripeToken,
				"order_date" 		=> $order_date,
				"license_type_id" 	=> $license_type_id
			);
			$this->db->insert('snd_music_orders',$data);
				return 1; 
		}
		function customer_songs($speakerId){
			
			$query = $this->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format,snd_music_orders.license_type_id from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id INNER JOIN snd_music_orders ON snd_artist_music.id = snd_music_orders.track_id WHERE snd_music_orders.customer_id='$speakerId'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				//print_r($resultArray); die;
				return $resultArray;
		}
		function set_arists_bio($track_id){
			$query = $this->db->query("SELECT users.id, users.first_name, users.last_name, snd_artist_info.artist_image, snd_artist_info.artist_bio from snd_artist_info INNER JOIN snd_artist_music ON snd_artist_info.artist_id=snd_artist_music.artist_id INNER JOIN users ON snd_artist_music.artist_id = users.id WHERE snd_artist_music.id='$track_id'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				//print_r($resultArray); die;
				return $resultArray;
		}
}