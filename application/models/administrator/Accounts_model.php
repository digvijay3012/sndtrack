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
			$slectArtsistAcc = $this->db->query("SELECT snd_artist_info.artist_type, users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_artist_info ON users.id=snd_artist_info.artist_id WHERE users_groups.group_id=3");
			
			foreach ($slectArtsistAcc->result_array() as $row){
						$finalArray['artists_accounts'][]= $row;
					}
				
		$slectCustomertAcc = $this->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id WHERE users_groups.group_id=4");
		
		foreach ($slectCustomertAcc->result_array() as $row){
					$finalArray['customer_accounts'][]= $row;
				}
				return $finalArray;		
	}
		function get_artistBy_adminId($adminID=null){
		$finalArray	=	array();
			
			$slectArtsistAcc = $this->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id INNER JOIN snd_admin_artist_group ON users.id=snd_admin_artist_group.artist_id WHERE users_groups.group_id=3 AND snd_admin_artist_group.admin_id='$adminID'");
			
			foreach ($slectArtsistAcc->result_array() as $row){
						$finalArray['artists_accounts'][]= $row;
					}
			$slectCustomertAcc = $this->db->query("SELECT users.id, users.ip_address, users.username, users.password, users.email, users.created_on, users.last_login, users.first_name, users.last_name FROM users INNER JOIN users_groups ON users.id=users_groups.user_id WHERE users_groups.group_id=4");
		
		foreach ($slectCustomertAcc->result_array() as $row){
					$finalArray['customer_accounts'][]= $row;
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
	function udateAccount_setting($ID,$first_name,$lastname,$first_address,$second_address,$city,$zip,$country,$email,$phone,$adminImgName){
			if($email!=''){
				$upadteEmail=array(
				'username'=>$email,
				'email'=>$email
				);
				$this->db->where('id',$ID);
				$this->db->update('users',$upadteEmail);
			}
			if($first_name!=''){
				$upadteFname=array(
				'first_name'=>$first_name
				);
				$this->db->where('id',$ID);
				$this->db->update('users',$upadteFname);
			}
			if($lastname!=''){
				$upadteLname=array(
				'last_name'=>$lastname
				);
				$this->db->where('id',$ID);
				$this->db->update('users',$upadteLname);
			}
			if($phone!=''){
				$upadtePhone=array(
				'phone'=>$phone
				);
				$this->db->where('id',$ID);
				$this->db->update('users',$upadtePhone);
			}
			$query = $this->db->query("SELECT id FROM snd_admin_info WHERE admin_id='$ID' ");
			if($query->num_rows() == 0){
				$insertData = array(
						"admin_id" 		=> $ID,
						"admin_image" 	=> $adminImgName,
						"first_address" => $first_address,
						"second_address" => $second_address,
						"city" 			=> $city,
						"zip" 			=> $zip,
						"country" 		=> $country
						);
					$this->db->insert('snd_admin_info',$insertData);
			}else{
				$updateData=array(
						"admin_image" 	=> $adminImgName,
						"first_address" => $first_address,
						"second_address" => $second_address,
						"city" 			=> $city,
						"zip" 			=> $zip,
						"country" 		=> $country
				);
				$this->db->where('admin_id',$ID);
				$this->db->update('snd_admin_info',$updateData);
			}
			
			return 1; 
		}
	
}