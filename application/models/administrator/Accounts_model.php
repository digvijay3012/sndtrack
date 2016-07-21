<?php
class Accounts_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function get_artist(){
		$finalArray	=	array();
			$slectAdminAcc = $this->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id WHERE users_groups.group_id=2");
			
			foreach ($slectAdminAcc->result_array() as $row){
						$finalArray['admin_accounts'][]= $row;
					}
			$slectArtsistAcc = $this->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id WHERE users_groups.group_id=3");
			
			foreach ($slectArtsistAcc->result_array() as $row){
						$finalArray['artists_accounts'][]= $row;
					}
				
				return $finalArray;		
	}
		function get_artistBy_adminId($adminID=null){
		$finalArray	=	array();
			
			$slectArtsistAcc = $this->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_admin_artist_group ON users.id=snd_admin_artist_group.artist_id WHERE users_groups.group_id=3 AND snd_admin_artist_group.admin_id='$adminID'");
			
			foreach ($slectArtsistAcc->result_array() as $row){
						$finalArray['artists_accounts'][]= $row;
					}
				
				return $finalArray;		
	}
	function change_password($artistId,$password){
			$hasPassword	= md5($password);
			$data=array('password'=>$hasPassword);
			$this->db->where('id',$artistId);
			$this->db->update('users',$data);
			return 1;
	}
	
}