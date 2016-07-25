<?php
class Artist_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

		function get_artistBy_adminId($adminID=null){
		$finalArray	=	array();
			
			$slectArtsistAcc = $this->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_admin_artist_group ON users.id=snd_admin_artist_group.artist_id WHERE users_groups.group_id=3 AND snd_admin_artist_group.admin_id='$adminID'");
			
			foreach ($slectArtsistAcc->result_array() as $row){
						$finalArray['artists_accounts'][]= $row;
					}
				
				return $finalArray;		
	}
	function add_admin_artist_relation($ID,$artistID){
			$relationData = array('admin_id'	=>  $ID , 'artist_id'=> $artistID);
			$this-> db->insert('snd_admin_artist_group', $relationData);
			return true;
	}
	function add_artist_info($artistID,$ID,$artist_bio,$artistImgName){
		$Data = array('artist_id'	=>  $artistID , 'admin_id'=> $ID, 'artist_image'=> $artistImgName, 'artist_bio'=> $artist_bio);
			$this-> db->insert('snd_artist_info', $Data);
			return true;
	}
	function set_artist_type($artistId,$adminId,$artist_type){
			$qry =	$this->db->query("UPDATE snd_artist_info SET artist_type='$artist_type' WHERE artist_id='$artistId' AND admin_id='$adminId'");
			return 1;
	}
}