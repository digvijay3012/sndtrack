 <?php 
$getAllMusic	=	get_artists_music_by_catid($catId); 
if(!empty($getAllMusic)){
 $customerData	=	$this->ion_auth->user()->row();
if(!empty($customerData)){
	$customerId 	=		$customerData->user_id;
	$first_name 	=		$customerData->first_name;
	$last_name 		=		$customerData->last_name;
}
 

 ?>
 <span class="daga">
 
					<div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
				 <div class="order_list">
					   <div class="ordr_tabs">
                                <ul>
                                    <li>Order by:</li>
									<div style="display:none" class="orderBy_filter_loader">
									<img src="<?php echo base_url(); ?>images/uploading.gif">
								</div>
                                    <li>
                                        <button class="short_order" short_cat_id="<?php echo $catId; ?>" short_type="Newest" type="button">Newest</button>
                                    </li>
                                    <li>
                                        <button class="short_order" short_cat_id="<?php echo $catId; ?>" short_type="Trending" class="active" type="button">Trending</button>
                                    </li>
                                    <li>
                                        <button class="short_order" short_cat_id="<?php echo $catId; ?>" short_type="Longest" type="button">Longest</button>
                                    </li>
                                    <li>
                                        <button class="short_order" short_cat_id="<?php echo $catId; ?>" short_type="Shortest"  type="button">Shortest</button>
                                    </li>
                                </ul>
                            </div>
                        <div class="playlist_info">
		
                            <table class="table loop_table">
							<thead></thead>
                                <tbody>
								<?php $getAllMusic	=	get_artists_music_by_catid($catId); 
						if(!empty($getAllMusic)){
							foreach($getAllMusic	as	$fectchPlaylist){
								$musicId 			=	$fectchPlaylist['id'];
								$getMusicFileEx 	=	explode(".", $fectchPlaylist['watermark_format']);
								$getMusicName		=	$getMusicFileEx['0'];
								$getMusicFileName	=	$fectchPlaylist['watermark_format'];
								$first_name			=	$fectchPlaylist['first_name'];
								$last_name			=	$fectchPlaylist['last_name'];
							?>
								 
                                    <tr>
                                        <td class="icons_play">
                                            <a href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </td>
                                        <td track_id="<?php echo $musicId; ?>" class="nme_user draggable title_play"><?php echo $first_name." ".$last_name; ?>
                                            <p><?php echo $getMusicName; ?></p>
                                        </td>
                                        <td class="text-center"><img src="images/play_vibrate.jpg" alt=""></td>
                                        <td>3:54</td>
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
                                               <a href="javascript:void(0);">
													<li class="add_to_wishlist" track_id="<?php echo $musicId; ?>">
														<i class="fa fa-heart-o" aria-hidden="true"></i>
													</li>
											   </a>
											    <?php } else { ?>
													<a href="#" data-target="#login_alert_popup" data-toggle="modal">
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
											   	<a href="#" data-target="#login_alert_popup" data-toggle="modal"><i class="fa fa-th-list" aria-hidden="true"></i></a>
											   <?php } ?>
                                            </ul>

                                        </td>
                                        <td class="lst_data license">
                                           <a href="javascript:void(0);" class="popup_stage_1_cls" music_id="<?php echo $musicId; ?>" data-toggle="modal" data-target="#popup_stage_1">License</a>
                                        </td>		
                                    </tr>
				<!-- Modal -->
        <div class="modal fade" id="addToPlaylistModal_<?php echo $musicId; ?>" role="dialog">
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

                        </div>
                        </div>
                    </span>	
<?php }else{
	echo "No music found.";
} ?>
<!-- Modal -->
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

						<?php $attributes = array('class' => 'login_form');
							echo form_open('register', $attributes);
						?> 
                           
                            <ul>
                               
                               <li>
									
                                </li>
                              
                                <a href="<?php base_url(); ?>register"><li>
                                    <button required="" name="submit" id="send" type="button" class="sbmt hover_btn">Create Account</button>
                                </li></a>
                            </ul>
                        <?php echo form_close(); ?>                   </div>
                </div>
            </div>
	</div>
</div>				