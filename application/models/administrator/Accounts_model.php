<?php
class Accounts_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function get_artist(){
		
			$slectQuery = $this->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id WHERE users_groups.group_id=2");
			$artistArray	=	array();
			foreach ($slectQuery->result_array() as $row){
						$artistArray[]= $row;
					}
				
				return $artistArray;		
	}
	function change_password($artistId,$password){
			$hasPassword	= md5($password);
			$data=array('password'=>$hasPassword);
			$this->db->where('id',$artistId);
			$this->db->update('users',$data);
			return 1;
	}
	
}