<?php
class Pages_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function get_pages(){
		$finalArray	=	array();
			$slectPages = $this->db->query("SELECT id, post_title FROM snd_Journal_posts");
			
			foreach ($slectPages->result_array() as $row){
						$finalArray[]= $row;
					}
		
				return $finalArray;		
	}
	function insert_journal_post($post_title, $post_image_name, $image_text, $short_desc, $long_content){
			$currentDate 	=	date("Y-m-d");
			$data = array(
				"post_title" 		=> $post_title,
				"post_image_name" 	=> $post_image_name,
				"image_text" 		=> $image_text,
				"short_desc" 		=> $short_desc,
				"long_content" 		=> $long_content,
				"post_date" 		=> $currentDate
			);
			$this->db->insert('snd_Journal_posts',$data);
				return 1; 
		}
	function update_journal_post($post_id, $post_title, $post_image_name, $image_text, $short_desc, $long_content){
		if($post_image_name==""){
			$data = array(
				"post_title" 		=> $post_title,
				
				"image_text" 		=> $image_text,
				"short_desc" 		=> $short_desc,
				"long_content" 		=> $long_content
			);
		}else{
			$data = array(
				"post_title" 		=> $post_title,
				"post_image_name" 	=> $post_image_name,
				"image_text" 		=> $image_text,
				"short_desc" 		=> $short_desc,
				"long_content" 		=> $long_content
			);
		}
		
				$this->db->where('id',$post_id);
				$this->db->update('snd_Journal_posts',$data);
				return 1; 
	}		
	function get_posts($post_id){
		$finalArray	=	array();
			$slectPages = $this->db->query("SELECT * FROM snd_Journal_posts");
			
			foreach ($slectPages->result_array() as $row){
						$finalArray[]= $row;
					}
		
				return $finalArray;		
	}
	function get_single_post($post_id){
		$finalArray	=	array();
			$slectPages = $this->db->query("SELECT * FROM snd_Journal_posts WHERE id='$post_id'");
			
			foreach ($slectPages->result_array() as $row){
						$finalArray[]= $row;
					}
		
				return $finalArray;		
	}
	function delete_journal($post_id){
		$delQry = $this->db->query("DELETE FROM snd_Journal_posts WHERE id='$post_id'");
		return true;
	}
}