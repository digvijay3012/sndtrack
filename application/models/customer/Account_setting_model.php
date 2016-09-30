<?php
class Account_setting_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	function udateAccount_setting($ID,$adminImgName,$first_name,$lastname,$first_address,$second_address,$city,$zip,$country,$email,$phone){
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
			$query = $this->db->query("SELECT id FROM snd_customer_info WHERE customer_id='$ID' ");
			if($query->num_rows() == 0){
				$insertData = array(
						"customer_id" 	=> $ID,
						"customer_image" => $adminImgName,
						"first_address" => $first_address,
						"second_address" => $second_address,
						"city" 			=> $city,
						"zip" 			=> $zip,
						"country" 		=> $country
						);
					$this->db->insert('snd_customer_info',$insertData);
			}else{
				$updateData=array(
						
						"first_address" => $first_address,
						"second_address" => $second_address,
						"city" 			=> $city,
						"zip" 			=> $zip,
						"country" 		=> $country
				);
				$this->db->where('customer_id',$ID);
				$this->db->update('snd_customer_info',$updateData);
			}
			if($adminImgName != ''){
				$updateImg=array(
						"customer_image" => $adminImgName
				);
				$this->db->where('customer_id',$ID);
				$this->db->update('snd_customer_info',$updateImg);
			}
			return 1; 	
		}
	
}