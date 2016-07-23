<?php
class Category_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function create_category($AdminID,$category_name){
		$date	=	date("Y-m-d");
		$data = array(
			"category_name" => $category_name,
			"admin_id" 		=> $AdminID,
			"category_date" => $date
			);
		
		$this->db->insert('snd_track_category',$data);
		return 1; 
	}
	function get_category($AdminId){
		
		$Qry = $this->db->query("SELECT * FROM snd_track_category");
		
			$catArray	=	array();
			foreach ($Qry->result_array() as $row){
						$catArray[]= $row;
					}
				
				return $catArray;	
	}
	function delete_category($catId){
		
		$Qry = $this->db->query("DELETE FROM snd_track_category WHERE id='$catId' ");
		
				return 1;	
	}
}