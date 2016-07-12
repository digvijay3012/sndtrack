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