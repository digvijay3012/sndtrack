 <?php 
 if ($this->ion_auth->logged_in()){
	$customerData	=	$this->ion_auth->user()->row();
	 if(!empty($customerData)){
		$customerId 	=		$customerData->user_id;
		$first_name 	=		$customerData->first_name;
		$last_name 		=		$customerData->last_name;
	}
}
if(!empty($data)){
	
 ?>
 <span class="daga">
					
                        <div class="playlist_info">
		
                            <table class="table loop_table">
							<thead></thead>
                                <tbody>	
								<?php
						if(!empty($data)){
							foreach($data	as	$fectchPlaylist){
								$musicId 			=	$fectchPlaylist['id'];
								$getMusicFileEx 	=	explode(".", $fectchPlaylist['watermark_format']);
								$getMusicName		=	$getMusicFileEx['0'];
								$getMusicFileName	=	$fectchPlaylist['watermark_format'];
								$first_name			=	$fectchPlaylist['first_name'];
								$last_name			=	$fectchPlaylist['last_name'];
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
											<?php if ($this->ion_auth->logged_in()){ ?>
                                               
													<li class="add_to_wishlist" track_id="<?php echo $musicId; ?>">
														<a href="javascript:void(0);">
															<i class="fa fa-heart-o" aria-hidden="true"></i>
														</a>
													</li>
											   
											<?php } else { ?>
												<a class=""   data-target="#login_alert_popup" data-toggle="modal" href="javascript:void(0);">
														<i class="fa fa-heart-o" aria-hidden="true"></i>
													</a>
											<?php } ?>
											   <?php if ($this->ion_auth->logged_in()){ ?>
                                                <li>
													<a class="add_to_popup_playlist" track_id="<?php echo $musicId; ?>" data-target="#addToPlaylistModal_<?php echo $musicId; ?>" data-toggle="modal" href="javascript:void(0);">
														<i class="fa fa-th-list" aria-hidden="true"></i>
													</a>
												</li>	
											   <?php } else { ?>
												<li>
													<a class=""   data-target="#login_alert_popup" data-toggle="modal" href="javascript:void(0);">
														<i class="fa fa-th-list" aria-hidden="true"></i>
													</a>
												</li>	
											   <?php } ?>
                                            </ul>

                                        </td>
                                       <td class="lst_data license">
                                           <a href="javascript:void(0);" class="popup_stage_1_cls" music_id="<?php echo $musicId; ?>" data-toggle="modal" data-target="#popup_stage_1">License</a>
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
					<?php if ($this->ion_auth->logged_in()){ ?>
						<div class="download_popup">
						<?php $addedPlaylist 	=	get_customer_playlist($customerId);	
							if(!empty($addedPlaylist)){
								foreach($addedPlaylist as $getAddedplaylist){
									$addedPlaylistId		=	$getAddedplaylist['id'];	
									$addedPlaylistName		=	$getAddedplaylist['playlist_name'];	
								?>
								
								<div class="added_pop">
								<div class="rt_playlist-nam"><?php echo $addedPlaylistName; ?></div>
								<div class="lst_data lft_playlst">
								<div style="display:none" class="loader_gif playlist_loader_<?php echo $addedPlaylistId; ?>">
											<img src="<?php echo base_url(); ?>images/uploading.gif">
								</div>	
								<?php 
									$getAddstatus 	=	check_track_exitsin_playlist($addedPlaylistId, $musicId, $customerId);
									
									if($getAddstatus=='added'){ ?>
										<button class="added" type="button">Added</button>	
									<?php }else{ ?>
										<button class="addedToPlayList_<?php echo $addedPlaylistId; ?>_<?php echo $musicId; ?> added" style="display:none" type="button">Added</button>
										<button class="addToPlayList" playlist_id="<?php echo $addedPlaylistId; ?>" type="button" track_id="<?php echo $musicId; ?>">Add to playlist</button>
										
									<?php } ?>
								
									
								</div>
							</div>
                        <?php }}?>
						</div>
					<?php } ?>
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
	exit;
} ?>
<!-- Login Modal -->
<div class="modal fade" id="login_alert_popup" role="dialog">
<div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                    <div class="modal-body">
                        <div class="logo text-center">
                            <a href="">
                                <p>Sndtrack</p>
                                <span>music licensing</span>
                            </a>
                        </div>
                        <div class="login_text text-center">
                            <p>Please create your account. </p>
                        </div>

						<?php $attributes = array('class' => 'login_form','id' => 'login_form_id');
							echo form_open('login', $attributes);
						?> 
                           
                  <ul>
				  	<label style="display:none" id="authentication_error"  generated="true" class="error email-error">Please check your details and try again.</label>
					   <li>
					
							<input type="text" id="login_email_address" name="identity" placeholder="Email address">
							<?php  echo form_error('identity'); ?>
							<label style="display:none" for="login_email_address" generated="true" class="error email-error">Please enter your email.</label>
					  </li>
						<li>
							<input type="password" id="login_password"  name="password" placeholder="Password">
							<?php  echo form_error('password'); ?>
							<label style="display:none" for="login_email_address" generated="true" class="error pwd-error">Please enter your password.</label>
						</li>
                   
						 <li>
							<button required="" name="submit" id="send" type="button" class="sbmt hover_btn login_button">Login</button>
							<a class="forgot" href="<?php echo base_url(); ?>register">Register</a>
						 </li>
								<div style="display:none" class="login_loader">
									<img src="<?php echo base_url(); ?>images/uploading.gif">
								</div>
                   </ul>
                        <?php echo form_close(); ?>    
						
			</div>
                </div>
            </div>
	</div>
	<link rel='stylesheet' type="text/css" href="<?php echo base_url(); ?>audioplayer/audioplayer.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="<?php echo base_url(); ?>audioplayer/audioplayer.js" type="text/javascript"></script>
	
			<section class="dzsap-sticktobottom dzsap-sticktobottom-for-skin-wave">
				<div id="ap1" class="audioplayer-tobe" style="width:100%; " data-bgimage="img/bg.jpg" data-scrubbg="waves/scrubbg.png" data-scrubprog="waves/scrubprog.png" data-type="fake" data-source="fake" data-sourceogg="sounds/itsabeautifulday.ogg">
					<!--  data-sourceogg="sounds/adg3.ogg"  -->
					<div class="the-comments">
					</div>	
					<div class="meta-artist"><span class="the-artist">Tim McMorris</span><span class="the-name"><a href="http://codecanyon.net/item/zoomsounds-wordpress-audio-player/6181433?ref=ZoomIt" target="_blank">It's a beautiful day</a></span>
					</div>
				</div>
			</section>	
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