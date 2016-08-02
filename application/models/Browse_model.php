<?php
class Browse_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	function get_all_music(){
			$query = $this->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				//print_r($resultArray); die;
				return $resultArray;
		}
	function filter_by_browse($short_type){
			$query = $this->db->query("SELECT snd_artist_info.artist_id, users.first_name, users.last_name, snd_artist_music.id,snd_artist_info.artist_image, snd_musicfile_version.watermark_format from snd_artist_music INNER JOIN snd_musicfile_version ON snd_artist_music.id=snd_musicfile_version.track_id INNER JOIN snd_artist_info ON snd_artist_music.artist_id=snd_artist_info.artist_id INNER JOIN users ON snd_artist_music.artist_id=users.id AND snd_artist_music.short_order='$short_type'");
			$resultArray	=	array();
			foreach ($query->result_array() as $row){
						$resultArray[]= $row;
					}
				//print_r($resultArray); die;
				return $resultArray;
		}
}