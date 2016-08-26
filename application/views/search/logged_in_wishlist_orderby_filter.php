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

                  
                        
                    </span>	
<?php }else{
	echo "No music found.";
} ?>				