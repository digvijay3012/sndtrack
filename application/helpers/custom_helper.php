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
   function store_temp_mucic($adminID=null,$artist_id=null,$file_name=null,$cat_id=null,$column_name=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
	 
	   $query = $ci->db->query("SELECT * FROM snd_tmp_music_store WHERE admin_id='$adminID' AND artist_id='$artist_id'" );
	  /* $getData = $query->row();
	  $rowId	=	 $getData->id; */
	   if($query->num_rows() == 0){
		     $checkFilequery = $ci->db->query("SELECT snd_artist_music.id FROM snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_admin_artist_group ON snd_artist_music.artist_id=snd_admin_artist_group.artist_id WHERE snd_artist_music.artist_id='$artist_id' AND snd_musicfile_version.$column_name='$file_name'" );
			/*  echo "SELECT snd_artist_music.id FROM snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_admin_artist_group ON snd_artist_music.artist_id=snd_admin_artist_group.artist_id WHERE snd_artist_music.artist_id='$artist_id' AND snd_musicfile_version.$column_name='$file_name'";
			 echo $checkFilequery->num_rows(); die; */
			  if($checkFilequery->num_rows() != 0){
				    return $file_name;
			  }else{
			$data = array(
			"admin_id" 		=> $adminID,
			"artist_id" 	=> $artist_id,
			"cat_id" 		=> $cat_id,
			$column_name 	=> $file_name
			);
			$ci->db->insert('snd_tmp_music_store',$data); 
			  }
          
       }else{
		    $checkFilequery = $ci->db->query("UPDATE snd_tmp_music_store SET $column_name='$file_name' WHERE admin_id='$adminID' AND artist_id='$artist_id'" );
	   }
	}
}
if ( ! function_exists('get_music_id')){
   function get_music_id($adminID=null,$artist_id=null,$file_name=null,$column_name=null){
       //get main CodeIgniter object
       $ci =& get_instance();
      
       //load databse library
       $ci->load->database();
	  
	   $query = $ci->db->query("SELECT id FROM snd_tmp_music_store WHERE $column_name='$file_name' AND artist_id='$artist_id' AND admin_id='$adminID'" );
	  $getData = $query->row();
	if(!empty($getData)){
		  return $getData->id;
	}
	
	   
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
if ( ! function_exists('get_allCategory')){
   function get_allCategory(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT * FROM snd_track_category WHERE parent_category!=0");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_admin_data')){
   function get_admin_data($admin_id){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $query = $ci->db->get_where('snd_admin_info',array('admin_id'=>$admin_id));
       
       if($query->num_rows() > 0){
           $result = $query->result_array();
           return $result;
       }else{
           return false;
       }
   }
}
if ( ! function_exists('get_artist_data')){
   function get_artist_data($artist_id){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $query = $ci->db->get_where('snd_artist_info',array('artist_id'=>$artist_id));
       
       if($query->num_rows() > 0){
           $result = $query->result_array();
           return $result;
       }else{
           return false;
       }
   }
}
if ( ! function_exists('get_category')){
   function get_category(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $query = $ci->db->query("SELECT * FROM snd_track_category WHERE parent_category=0");
       
       if($query->num_rows() > 0){
           $result = $query->result_array();
           return $result;
       }else{
           return false;	
       }
   }
}
if ( ! function_exists('get_parentCatName')){
   function get_parentCatName($catId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       $query = $ci->db->query("SELECT parent_category FROM snd_track_category WHERE id='$catId'")->row();
	   
		$parentCatId 	=	$query->parent_category;
		if($parentCatId!=0){
			$parentQuery 	= $ci->db->query("SELECT category_name FROM snd_track_category WHERE id='$parentCatId'")->row();
				return $parentQuery->category_name;
		}else{
		  return "";
	  }
   }
}
if ( ! function_exists('get_childCatName')){
   function get_childCatName($catId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
			$parentQuery 	= $ci->db->query("SELECT * FROM snd_track_category WHERE parent_category='$catId'");
			  $result = $parentQuery->result_array();
				return $result;
		
   }
}

if ( ! function_exists('get_customer_info')){	
   function get_customer_info($customer_id){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $query = $ci->db->get_where('snd_customer_info',array('customer_id'=>$customer_id));
       
       if($query->num_rows() > 0){
           $result = $query->result_array();
           return $result;
       }else{
           return false;
       }
   }
}
if ( ! function_exists('get_customer_image')){
   function get_customer_image($customerId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
			$parentQuery 	= $ci->db->query("SELECT customer_image FROM snd_customer_info WHERE customer_id='$customerId'")->row();
			return  $result = $parentQuery->customer_image;
	}
}
if ( ! function_exists('get_suggest_artist')){
   function get_suggest_artist(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_image, users.id, users.first_name, users.last_name from users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_artist_info ON users.id=snd_artist_info.artist_id WHERE users_groups.group_id=3");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}