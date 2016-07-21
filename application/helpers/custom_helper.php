<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_album_tracks')){
   function get_album_tracks($album_id){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $query = $ci->db->get_where('snd_artist_music',array('album_id'=>$album_id));
       
       if($query->num_rows() > 0){
           $result = $query->result_array();
           return $result;
       }else{
           return false;
       }
   }
}
if ( ! function_exists('get_trackcount')){
   function get_trackcount($artistId){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $query = $ci->db->get_where('snd_artist_music',array('artist_id'=>$artistId));
       
       if($query->num_rows() > 0){
           $result = $query->num_rows();
           return $result;
       }else{
           return false;
       }
   }
}
if ( ! function_exists('get_allArtists')){
   function get_allArtists(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT users.id, users.first_name, users.last_name from users INNER JOIN users_groups ON users.id=users_groups.user_id WHERE users_groups.group_id=3");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('store_temp_mucic')){
   function store_temp_mucic($adminID=null,$artist_id=null,$file_name=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
	   $query = $ci->db->query("SELECT * FROM snd_tmp_music_store WHERE file_name='$file_name' AND artist_id='$artist_id'" );
	  
	   if($query->num_rows() == 0){
           $data = array(
			"admin_id" 		=> $adminID,
			"artist_id" 		=> $artist_id,
			"file_name" 		=> $file_name
			);
			$ci->db->insert('snd_tmp_music_store',$data);
       }else{
		   return $file_name;
	   }
	}
}
if ( ! function_exists('get_music_id')){
   function get_music_id($adminID=null,$artist_id=null,$file_name=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
	   $query = $ci->db->query("SELECT id FROM snd_tmp_music_store WHERE file_name='$file_name' AND artist_id='$artist_id' AND admin_id='$adminID'" );
	  $getData = $query->row();
	  return $getData->id;
	   
	}
}
if ( ! function_exists('get_allArtistsBy_adminId')){
   function get_allArtistsBy_adminId($adminID){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_admin_artist_group ON users.id=snd_admin_artist_group.artist_id WHERE users_groups.group_id=3 AND snd_admin_artist_group.admin_id='$adminID'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}