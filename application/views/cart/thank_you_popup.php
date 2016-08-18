<?php //$data	=	get_cart_view_by_customerId($customer_id); 
	if(!empty($data)){
		$track_id				=	$data['stage4_track_id'];
		$customer_id			=	$data['stage4_customer_id'];
		$music_amount			=	$data['stage4_music_amount'];
		
		$license_type			=	get_license_typeName_by_amount($music_amount);
		if($license_type == 'personal_license'){
			$license_type = 'personal_format';
		}elseif($license_type == 'lite_license'){
			$license_type = 'lite_version';
		}elseif($license_type == 'standard_license'){
			$license_type = 'standard_licence';
		}elseif($license_type == 'premium_license'){
			$license_type = 'premium_licence';
		}else{
			$license_type = 'watermark_format';
		}
		
		$getMusic	=	get_music_to_download($track_id, $license_type);
		$explodeMusic	=	explode(".mp3", $getMusic);
		$musicName		=	$explodeMusic['0'];
		$downloadUrl	=	base_url()."music/".$getMusic;
	}
?>
 <div class="logo text-center">
		<a href="">
			<p>Sndtrack</p>
			<span>music licensing</span>
		</a>
	</div>
	<div class="login_text text-center">
		<p>Thanks Greg !</p>
		<p>Your receipt will be emailed to you shortly.</p>
	</div>	

	<div class="content_inn_pop">
		<h3>Download Tracks</h3>
		<div class="download_popup">
			<ul>
				<li><?php echo $musicName; ?></li>
				<li class="lst_data">
					<a href="<?php echo $downloadUrl; ?>" download><button type="button">Download</button></a>
				</li>
			</ul>
			
		</div>
		<div class="modal-footer back_btn">
			<button type="button" data-dismiss="modal">Close</button>
		</div>
		<div class="popup_social text-center">
			<ul>
				<li><a href="">Privacy Policy</a></li>
				<li><a href="">User Agreement</a></li>
				<li><a href="">Terms & Consitions</a></li>

			</ul>

		</div>

	</div>