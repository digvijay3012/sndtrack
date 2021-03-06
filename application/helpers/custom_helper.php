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
			if(!empty($parentQuery)){
				return  $result = $parentQuery->customer_image;
			}
			
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
if ( ! function_exists('get_recently_added_music')){
   function get_recently_added_music(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id ORDER BY snd_artist_music.id ASC");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_artsit_follow_status')){
   function get_artsit_follow_status($customerId=null, $artist_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
			$parentQuery 	= $ci->db->query("SELECT status FROM snd_followed_artist WHERE customer_id='$customerId' AND artist_id='$artist_id'")->row();
			if(!empty($parentQuery)){
				return  $result = $parentQuery->status;
			}
			
	}
}
if ( ! function_exists('get_followed_artist_by_customer')){
   function get_followed_artist_by_customer($customerId){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
			$query = $ci->db->query("SELECT snd_artist_info.artist_image, users.id, users.first_name, users.last_name from users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_artist_info ON users.id=snd_artist_info.artist_id INNER JOIN snd_followed_artist ON users.id=snd_followed_artist.artist_id WHERE users_groups.group_id=3 AND snd_followed_artist.customer_id='$customerId'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}	
if ( ! function_exists('insert_recently_listened_music')){
   function insert_recently_listened_music($track_id=null, $customerId=null, $artist_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
	   $todayDate	=	date("Y-m-d");
		$query = $ci->db->query("SELECT id,listen_date FROM snd_recently_listened_music WHERE customer_id='$customerId' ORDER BY id DESC")->row();
			if(!empty($query)){
				$listenDate	=	 $query->listen_date; 
				$date1=date_create($listenDate);
				$date2=date_create($todayDate);
				$diff=date_diff($date1,$date2);
				 $dateDiffrenec	=	 $diff->days; 
				if($dateDiffrenec>2){
					$query = $ci->db->query("DELETE FROM snd_recently_listened_music WHERE customer_id='$customerId'");
						$insertData = array(
						"customer_id" 	=> $customerId,
						"track_id" 		=> $track_id,
						"artist_id" 	=> $artist_id,
						"listen_date" 	=> $todayDate
						);
						$ci->db->insert('snd_recently_listened_music',$insertData); 
				}else{
					$selQuery = $ci->db->query("SELECT id,listen_date FROM snd_recently_listened_music WHERE customer_id='$customerId' AND track_id='$track_id' AND artist_id='$artist_id'")->row();
					if(empty($selQuery)){
						$insertData = array(
						"customer_id" 	=> $customerId,
						"track_id" 		=> $track_id,
						"artist_id" 	=> $artist_id,
						"listen_date" 	=> $todayDate
						);
						$ci->db->insert('snd_recently_listened_music',$insertData);
					}
					
				}	
			}else{
				$insertData = array(
						"customer_id" 	=> $customerId,
						"track_id" 		=> $track_id,
						"artist_id" 	=> $artist_id,
						"listen_date" 	=> $todayDate
						);
						$ci->db->insert('snd_recently_listened_music',$insertData);
			}
		
   }
}
if ( ! function_exists('get_recently_listened_music')){
   function get_recently_listened_music($customerId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id as track_id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id INNER JOIN snd_recently_listened_music ON users.id=snd_recently_listened_music.artist_id WHERE snd_recently_listened_music.customer_id='$customerId' AND snd_artist_music.id=snd_recently_listened_music.track_id");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}	
if ( ! function_exists('get_customer_playlist')){
   function get_customer_playlist($customerId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT id, playlist_name FROM snd_customer_playlist WHERE customer_id='$customerId'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}	
if ( ! function_exists('get_artists_music_by_id')){
   function get_artists_music_by_id($artsitId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id WHERE snd_artist_music.artist_id='$artsitId'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('check_track_exitsin_playlist')){
   function check_track_exitsin_playlist($playlist_id=null, $track_id=null, $customer_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT id FROM snd_customer_playlist_music WHERE playlist_id='$playlist_id' AND track_id='$track_id' AND customer_id=$customer_id")->row();

       if(!empty($query)){
		   return 'added';
		}else{
		  return  "Add to Playlist";
	   }
   }
}
if ( ! function_exists('get_artists_music_by_catid')){
   function get_artists_music_by_catid($catId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id WHERE snd_artist_music.cat_id='$catId'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_customer_wishlist')){
   function get_customer_wishlist($customerId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id INNER JOIN snd_customer_wishlist ON snd_artist_music.id=snd_customer_wishlist.track_id WHERE snd_customer_wishlist.customer_id='$customerId'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('filter_by_orderby')){
   function filter_by_orderby($short_type=null, $customerId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id INNER JOIN snd_customer_wishlist ON snd_artist_music.id=snd_customer_wishlist.track_id WHERE snd_customer_wishlist.customer_id='$customerId' AND snd_artist_music.short_order='$short_type'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}	
if ( ! function_exists('get_customer_playlist_music')){
   function get_customer_playlist_music($customerId=null,$playlist_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id INNER JOIN snd_customer_playlist_music ON snd_artist_music.id=snd_customer_playlist_music.track_id WHERE snd_customer_playlist_music.customer_id='$customerId' AND snd_customer_playlist_music.playlist_id='$playlist_id'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('filter_playlist_orderby')){
   function filter_playlist_orderby($customerId=null,$playlist_id=null,$short_order=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id WHERE snd_artist_music.short_order='Trending'");
	
       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_playlist_name_by_id')){
   function get_playlist_name_by_id($playlist_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
       //get data from database 
		$query = $ci->db->query("SELECT playlist_name FROM snd_customer_playlist WHERE id='$playlist_id'")->row();
		return $query->playlist_name;
       
   }
}
if ( ! function_exists('get_cart_view_by_customerId')){
   function get_cart_view_by_customerId($customerId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
       //get data from database 
		$query = $ci->db->query("SELECT * FROM snd_temp_pack_info WHERE customer_id='$customerId'");
        $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_license_types')){
   function get_license_types(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
       //get data from database 
		$query = $ci->db->query("SELECT * FROM snd_license_type_price");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_license_type_by_amount')){
   function get_license_type_by_amount($license_amount=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
       //get data from database 
		$query = $ci->db->query("SELECT id FROM snd_license_type_price WHERE license_amount='$license_amount'")->row();
		return $query->id;
 }
}
if ( ! function_exists('get_license_typeName_by_amount')){
   function get_license_typeName_by_amount($license_amount=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
       //get data from database 
		$query = $ci->db->query("SELECT license_type FROM snd_license_type_price WHERE license_amount='$license_amount'")->row();
		return $query->license_type;
 }
}
if ( ! function_exists('get_music_to_download')){
   function get_music_to_download($track_id=null, $license_type=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
       //get data from database 
	   //echo "SELECT $license_type FROM snd_musicfile_version WHERE track_id='$track_id'"; die;
		$query = $ci->db->query("SELECT $license_type FROM snd_musicfile_version WHERE track_id='$track_id'")->row();
		if(!empty($query)){
			return	$query->$license_type;
		}
 }
}
if ( ! function_exists('get_single_artist_music_by_catid')){
   function get_single_artist_music_by_catid($catId=null, $artistId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id WHERE snd_artist_music.cat_id='$catId' AND snd_artist_music.artist_id='$artistId'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_track_personal_sale')){
   function get_track_personal_sale($tarckId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT  SUM(snd_music_orders.order_amount) AS personal_sale1  FROM snd_music_orders INNER JOIN snd_license_type_price ON snd_music_orders.license_type_id=snd_license_type_price.id WHERE snd_music_orders.track_id='$tarckId' AND snd_music_orders.license_type_id='1'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_track_lite_sale')){
   function get_track_lite_sale($tarckId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT  SUM(snd_music_orders.order_amount) AS lite_sale FROM snd_music_orders INNER JOIN snd_license_type_price ON snd_music_orders.license_type_id=snd_license_type_price.id WHERE snd_music_orders.track_id='$tarckId' AND snd_music_orders.license_type_id='2'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_track_standard_sale')){
   function get_track_standard_sale($tarckId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT  SUM(snd_music_orders.order_amount) AS standard_sale FROM snd_music_orders INNER JOIN snd_license_type_price ON snd_music_orders.license_type_id=snd_license_type_price.id WHERE snd_music_orders.track_id='$tarckId' AND snd_music_orders.license_type_id='3'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_track_premium_sale')){
   function get_track_premium_sale($tarckId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT  SUM(snd_music_orders.order_amount) AS premium_sale1 FROM snd_music_orders INNER JOIN snd_license_type_price ON snd_music_orders.license_type_id=snd_license_type_price.id WHERE snd_music_orders.track_id='$tarckId' AND snd_music_orders.license_type_id='4'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_total_sale_for_artist')){
   function get_total_sale_for_artist($artistid=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT MONTHNAME(snd_music_orders.order_date) as monthName, SUM(snd_music_orders.order_amount) AS total_amount, snd_music_orders.order_date FROM snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_music_orders ON snd_artist_music.id=snd_music_orders.track_id WHERE snd_artist_music.artist_id='$artistid' AND track_status=1 GROUP BY YEAR(snd_music_orders.order_date), MONTH(snd_music_orders.order_date)");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_singal_tracksale_for_artist')){
   function get_singal_tracksale_for_artist($artistid=null, $track_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT MONTHNAME(snd_music_orders.order_date) as monthName, SUM(snd_music_orders.order_amount) AS total_amount, snd_music_orders.order_date FROM snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_music_orders ON snd_artist_music.id=snd_music_orders.track_id WHERE snd_artist_music.artist_id='$artistid' AND track_status=1 AND snd_music_orders.track_id='$track_id' GROUP BY YEAR(snd_music_orders.order_date), MONTH(snd_music_orders.order_date)");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_arists_bio')){
   function get_arists_bio($track_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT users.id, users.first_name, users.last_name, snd_artist_info.artist_image, snd_artist_info.artist_bio from snd_artist_info INNER JOIN snd_artist_music ON snd_artist_info.artist_id=snd_artist_music.artist_id INNER JOIN users ON snd_artist_music.artist_id = users.id WHERE snd_artist_music.id='$track_id'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_page_data_by_id')){
   function get_page_data_by_id($page_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT * FROM snd_pages WHERE id='$page_id'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_home_page_data')){
   function get_home_page_data($page_id=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT * FROM snd_home_page WHERE id='$page_id'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_homepage_featured_artist')){
   function get_homepage_featured_artist(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT users.id, users.first_name, users.last_name, snd_artist_info.artist_image from snd_artist_info INNER JOIN users ON snd_artist_info.artist_id = users.id WHERE snd_artist_info.artist_type='feautred' AND snd_artist_info.artist_image !='' ORDER BY users.id DESC")->row();
		
			return $query;
   }
}
if ( ! function_exists('get_homepage_trending_artist')){
   function get_homepage_trending_artist(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id WHERE  snd_artist_music.short_order='Trending' LIMIT 8");
		
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}	
if ( ! function_exists('get_my_purchase_track')){
   function get_my_purchase_track($licenceId=null,$trackId=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT license_type FROM snd_license_type_price WHERE id='$licenceId'")->row();
		$license_type 	=	$query->license_type;
		
		$selQry			=	$ci->db->query("SELECT $license_type as musicFilename FROM snd_musicfile_version WHERE track_id='$trackId'")->row();
		$musicFormat 	=	$selQry->musicFilename;		
				return $musicFormat;
   }
}
if ( ! function_exists('get_homePage_playlist')){
   function get_homePage_playlist(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
     
       //get data from database 
		$query = $ci->db->query("SELECT * FROM snd_customer_playlist");
		$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}
if ( ! function_exists('get_artists_music_by_energy_level')){	
   function get_artists_music_by_energy_level($enery_level=null){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database 
		$query = $ci->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id WHERE snd_artist_music.energy_level='$enery_level'");

       $resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				
				return $resultArray;
   }
}	
