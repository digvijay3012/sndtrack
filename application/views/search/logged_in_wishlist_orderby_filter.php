 <?php 
 $customerData	=	$this->ion_auth->user()->row();
 if(!empty($customerData)){
	$customerId 	=		$customerData->user_id;
	$first_name 	=		$customerData->first_name;
	$last_name 		=		$customerData->last_name;
}
$getAllMusic	=	filter_by_orderby($short_type, $customerId); 
if(!empty($getAllMusic)){
 ?>
 <span class="daga">
					
                        <div class="playlist_info">
		
                            <table class="table loop_table">
							<thead></thead>
                                <tbody>
								<?php $getAllMusic	=	filter_by_orderby($short_type, $customerId); 
						if(!empty($getAllMusic)){
							foreach($getAllMusic	as	$fectchPlaylist){
								$musicId 			=	$fectchPlaylist['id'];
								$getMusicFileEx 	=	explode(".", $fectchPlaylist['watermark_format']);
								$getMusicName		=	$getMusicFileEx['0'];
								$getMusicFileName	=	$fectchPlaylist['watermark_format'];
							?>
								 
                   <tr>
                       <td>
						<div class="audioplayer-tobe change-artst-bio auto-init" track_artst_id="<?php echo $musicId; ?>"  data-bgimage="img/bg.jpg" data-scrubbg="<?php echo base_url(); ?>waves/scrubbg.png" data-scrubprog="<?php echo base_url(); ?>waves/scrubprog.png" data-type="audio"data-source="<?php echo base_url(); ?>music/<?php echo $getMusicFileName; ?>" data-fakeplayer="#ap1" data-sourceogg="<?php echo base_url(); ?>music/<?php echo $getMusicFileName; ?>" data-options='{
							disable_volume: "off"
							,autoplay: "off"
							,cue: "on"
							,disable_scrub: "default"
							,design_skin: "skin-wave"
							,skinwave_dynamicwaves:"on"
							,skinwave_enableSpectrum: "off"
							,settings_backup_type:"full"
							,settings_useflashplayer:"auto"
							,skinwave_spectrummultiplier: "4"
							,skinwave_comments_enable:"on"
							,skinwave_mode: "small"
							,action_audio_play: action_audio_play_func
							}'>

							<!--  data-sourceogg="sounds/adg3.ogg"  -->
							<div class="the-comments">
							</div>
							<div track_id="<?php echo $musicId; ?>" class="meta-artist  nme_user draggable title_play"><span class="the-artist"><?php echo $first_name." ".$last_name; ?></span><span class="the-name"><?php echo $getMusicName; ?></span>
							</div>
						</div>
					</td>
                                        <td class="dwnld_cont">
                                            <ul>
                                                <li clsss="dwnld_icns">
													<a href="">
														<i class="fa fa-download" aria-hidden="true"></i>
													</a>
												</li>
												<div style="display:none" class="wishlist_loader_<?php echo $musicId; ?>">
													<img src="<?php echo base_url(); ?>images/uploading.gif">
												</div>
												<div id="add_to_wishlist_msg_<?php echo $musicId; ?>"></div>
                                               <a href="javascript:void(0);">
													<li class="add_to_wishlist" track_id="<?php echo $musicId; ?>">
														<i class="fa fa-heart-o" aria-hidden="true"></i>
													</li>
											   </a>
											   
                                                <li>
													<a class="add_to_popup_playlist" track_id="<?php echo $musicId; ?>" data-target="#addToPlaylistModal_<?php echo $musicId; ?>" data-toggle="modal" href="javascript:void(0);">
														<i class="fa fa-th-list" aria-hidden="true"></i>
													</a>
												</li>	
                                            </ul>

                                        </td>
                                        <td class="lst_data license">
                                            <a href="">License</a>
                                        </td>
                                    </tr>
				<!-- Modal -->
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="addToPlaylistModal_<?php echo $musicId; ?>" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                    <div class="modal-body">
                        <div class="logo text-center">
                            <a href=""><p>Sndtrack</p></a>
                        </div>
						<div class="download_popup">
						<?php $addedPlaylist 	=	get_customer_playlist($customerId);	
							if(!empty($addedPlaylist)){
								foreach($addedPlaylist as $getAddedplaylist){
									$addedPlaylistId		=	$getAddedplaylist['id'];	
									$addedPlaylistName		=	$getAddedplaylist['playlist_name'];	
								?>
								
									<ul>
										<li><?php echo $addedPlaylistName; ?></li>
										<li class="lst_data">
										<div style="display:none" class="playlist_loader_<?php echo $addedPlaylistId; ?>">
													<img src="<?php echo base_url(); ?>images/uploading.gif">
										</div>	
										<?php 
											$getAddstatus 	=	check_track_exitsin_playlist($addedPlaylistId, $musicId, $customerId);
											
											if($getAddstatus=='added'){ ?>
												<button  type="button">Added</button>	
											<?php }else{ ?>
												<button class="addedToPlayList_<?php echo $addedPlaylistId; ?>_<?php echo $musicId; ?>" style="display:none" type="button">Added</button>
												<button class="addToPlayList" playlist_id="<?php echo $addedPlaylistId; ?>" type="button" track_id="<?php echo $musicId; ?>">Add to playlist</button>
												
											<?php } ?>
										
											
										</li>
									</ul>
                        <?php }}?>
						</div>
                        <div class="login_text text-center">
                            <p>Create new playlist. </p>
                        </div>
						<?php
							$formId	=	'login_form_popup_id_'.$musicId;
							$attributes = array('class' => 'login_form login_form_popup', 'id' => $formId);
							echo form_open('dashboard/create_playlist_inpopup', $attributes); 
						?>
						<?php echo form_close(); ?>
						<div style="display:none" class="popup_playlist_loader_<?php echo $musicId; ?>">
								<img src="<?php echo base_url(); ?>images/uploading.gif">
						</div>	
							
                    </div>
                </div>
            </div>
        </div>
								<?php }
						}else{
							echo '<tr>No data to display.</tr>';
						}
					?>
	
                                </tbody>
                            </table>

                  
                        
                    </span>	
<?php }else{
	echo "No music found.";
} ?>
<link rel='stylesheet' type="text/css" href="<?php echo base_url(); ?>audioplayer/audioplayer.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo base_url(); ?>audioplayer/audioplayer.js" type="text/javascript"></script>
	
<script>
	 function action_audio_play_func(arg){
	//        console.info("action_audio_play_func", arg);

	//        setTimeout(function(){
	//            console.info("playmedia()", arg);
	//           arg.get(0).api_play_media({
	//               'api_report_play_media' : false
	//           });
	//        },2000);
		}
	jQuery(document).ready(function ($) {

		var settings_ap = {
			disable_volume: 'off'
			,autoplay: 'off'
			,cue: 'off'
			,disable_scrub: 'default'
			,design_skin: 'skin-wave'
			,skinwave_dynamicwaves:'on'
			,skinwave_enableSpectrum: "off"
			,settings_backup_type:'full'
			,settings_useflashplayer:'auto'
			,skinwave_spectrummultiplier: '4'
			,skinwave_comments_enable:'off'
			,skinwave_mode: 'small'
			,scrubbar_tweak_overflow_hidden : "on"
		};
		dzsap_init('#ap1',settings_ap);
	});
</script>					