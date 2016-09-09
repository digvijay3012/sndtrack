<?php
class Payout_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function payout_form($artistID,$amount,$acoount_holder_name,$account_number,$sort_code){
			$date	=	date("Y-m-d");
			$data = array(
				"artist_id" 				=> $artistID,
				"amount" 					=> $amount,
				"acoount_holder_name" 		=> $acoount_holder_name,
				"account_number" 			=> $account_number,
				"sort_code" 				=> $sort_code,
				"payout_date" 				=> $date
			);
			$this->db->insert('snd_payout_accounts',$data);
				return 1; 
		}
}