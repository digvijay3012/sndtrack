<?php
class Earnings_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_sale($artistID){
			
			$musicArray		=	array();
		
			$selQuery = $this->db->query("SELECT SUM(snd_music_orders.order_amount) AS total_amount, snd_artist_music.id, snd_artist_music.song_upload_date,snd_musicfile_version.watermark_format,snd_musicfile_version.lite_version , snd_musicfile_version.personal_format, snd_musicfile_version.standard_licence,  snd_musicfile_version.premium_licence, snd_music_orders.order_amount, snd_music_orders.license_type_id FROM snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_music_orders ON snd_artist_music.id=snd_music_orders.track_id WHERE snd_artist_music.artist_id='$artistID' AND track_status=1 GROUP BY snd_artist_music.id");	
				foreach ($selQuery->result_array() as $allData){
					$musicArray[]= $allData;
				}
				return $musicArray;
		}
		function date_range_graph($track_id, $atistId, $from_datepicker, $to_datepicker){
			
			$musicArray		=	array();
			if($track_id == ""){
				$query	="SELECT MONTHNAME(snd_music_orders.order_date) as monthName, SUM(snd_music_orders.order_amount) AS total_amount, snd_music_orders.order_date FROM snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_music_orders ON snd_artist_music.id=snd_music_orders.track_id WHERE snd_artist_music.artist_id='$atistId' AND track_status=1 AND (snd_music_orders.order_date BETWEEN '$from_datepicker' AND  '$to_datepicker') GROUP BY YEAR(snd_music_orders.order_date), MONTH(snd_music_orders.order_date)";
			}else{
				$query	="SELECT MONTHNAME(snd_music_orders.order_date) as monthName, SUM(snd_music_orders.order_amount) AS total_amount, snd_music_orders.order_date FROM snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_music_orders ON snd_artist_music.id=snd_music_orders.track_id WHERE snd_artist_music.artist_id='$atistId' AND track_status=1 AND snd_music_orders.track_id='$track_id' AND (snd_music_orders.order_date BETWEEN '$from_datepicker' AND  '$to_datepicker') GROUP BY YEAR(snd_music_orders.order_date), MONTH(snd_music_orders.order_date)";
			}
			
			$selQuery = $this->db->query($query);	
				foreach ($selQuery->result_array() as $allData){
					$musicArray[]= $allData;
				}
				return $musicArray;
		}
}