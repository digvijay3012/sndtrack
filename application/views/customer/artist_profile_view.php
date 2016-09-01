<?php 
//echo "<pre>";		print_r($artist_data);		echo "</pre>";
if(!empty($artist_data)){
	$artist_bio 		=	$artist_data['0']['artist_bio'];
	$facebook_link 		=	$artist_data['0']['facebook_link'];
	$twitter_link 		=	$artist_data['0']['twitter_link'];
	$instagram_link 	=	$artist_data['0']['instagram_link'];
	$artist_image 		=	$artist_data['0']['artist_image'];
	$artist_id 			=	$artist_data['0']['id'];
	$first_name 		=	$artist_data['0']['first_name'];		
	$last_name 			=	$artist_data['0']['last_name'];
	$sessionId		=	session_id();
$loginStatus	=	'';
$customerId		=	'';
if ($this->ion_auth->logged_in()){
	$loginStatus	=	1;
	$ArtistID				= 	$this->uri->segment(3); 
	$customerId			=	$this->ion_auth->user()->row()->user_id;  
	$customerData		=	$this->ion_auth->user()->row();
	if(!empty($customerData)){
		$customerFirstName 		=		$customerData->first_name;
		$customerLastName 		=		$customerData->last_name;
	}
}
?>
<div class="cstmr_cont header-margin">

        <div class="banner_artist" style="background-image: url('<?php echo base_url(); ?>timthumb.php?src=<?php echo base_url(); ?>artist_images/<?php echo $artist_image; ?>&h=420&w=1920&zc=1q=100');">
            <div class="banner_art_cntnt">
                <div class="scl_icns_banner">
                    <h2><?php echo $first_name." ".$last_name; ?></h2>
                    <ul>
                        <li><a target='_blank' href="<?php echo $facebook_link; ?>"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                        <li><a target='_blank' href="<?php echo $twitter_link; ?>"><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
                        <li><a target='_blank' href="<?php echo $instagram_link; ?>"><i aria-hidden="true" class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <p class="middle_cntnt"><?php echo $artist_bio; ?></p>
                <!--<div class="instrumnt_bnnr">
                    <h3>Instruments</h3>
                    <p>Lorem Ipsum, Electric guitar, piano, drums, bass</p>
                </div>-->
            </div>
            <div class="follow pull-right">
			 <div style="display:none" class="set_arists_status">
						<img src="<?php echo base_url(); ?>images/uploading.gif">
					</div>
			<?php 
				$customerId		=	$this->ion_auth->user()->row()->user_id;
				$followStatus 	=	get_artsit_follow_status($customerId, $artist_id);
				if($followStatus=='follow'){
					echo '<button type="button" class="follow_button">Followed</button>';
				}else{
					echo '<button type="button" style="display:none" class="follow_button dis-follow">Followed</button> <button type="button" customerId="'.$customerId.'" artist_id="'.$artist_id.'" class="follow_button start-follow">Follow</button>';
				}
			?>
               
            </div>
        </div>
        <div class="music-bar">
            <figure><img src="<?php echo base_url(); ?>images/music-bar.jpg" alt="" title=""></figure>
        </div>
        <div class="container-fluid pdngg container-full">
            <div class="lft_sidebar">
              <div class="your_music">
                    <h3 class="rt_hdng">YOUR MUSIC</h3>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>wishlist">Hearted</a></li>
                        <li><div id="accordion2" class="panel-group user_acc">
						<h3 class="rt_hdng"><a href="#collapseOne_22" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed" aria-expanded="false">
						Artists																
						</a></h3>
						<div class="panel-collapse collapse" id="collapseOne_22" aria-expanded="false" style="height: 0px;">
							<div class="panel-body">
							<?php if ($this->ion_auth->logged_in()){ ?>
							<ul>
							<?php $getFollowData	=	get_followed_artist_by_customer($customerId); 
									if(!empty($getFollowData)){
										foreach($getFollowData as $fetchFollowData){
											$getFollowedId		=	$fetchFollowData['id'];
											$getFollowedFname	=	$fetchFollowData['first_name'];
											$getFollowedLname	=	$fetchFollowData['last_name'];
										?>
										<li><a href="<?php echo base_url(); ?>dashboard/artist/<?php echo $getFollowedId; ?>">
											<?php echo $getFollowedFname." ".$getFollowedLname; ?>
										</a></li>
									<?php }}else{
										echo '<li>No records found.</li>';
									}
								?>
								
								</ul>
								<?php  } ?>	
							</div>
						</div>
				</div></li>
                        <li><a href="<?php echo base_url(); ?>browse/customer_songs">Songs</a></li>
                    </ul>
                </div>
                <div class="searchh your_music">
                    <h3 class="rt_hdng"> SEARCH</h3>
                    <div class="panel-group user_acc" id="accordion">
					<?php 
								$getCatdata 	=	get_category(); 
							if(!empty($getCatdata)){
								$counterFlag=0;
								foreach($getCatdata as $parentCatData){
									 $parentCatName	=	$parentCatData['category_name'];
									 $parentCatId	=	$parentCatData['id'];
									 $counterFlag++;
							?>
                        <div class="panel panel-default">
                           
								<?php if($parentCatName=='Instrumental'){
								
									echo '<h3 class="rt_hdng">'.$parentCatName.'<input type="checkbox" name="Instruments" value="Instruments" class="category_filter" catId="'.$parentCatId.'"></h3>';
									}else{ ?>
									 <h3 class="rt_hdng"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?php echo $counterFlag; ?>">
										<?php echo $parentCatName; ?>
									<?php }?>
							
							</a></h3>
                            <div id="collapseOne_<?php echo $counterFlag; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
								<?php
								$childcatData	= get_childCatName($parentCatId);
								if(!empty($childcatData)){
								foreach($childcatData as $childCat){
									 $childCatName	=	$childCat['category_name'];
									 $childCatId	=	$childCat['id']; ?>
                                       <li class="category_filter" catId="<?php echo $childCatId; ?>"> <a href="javascript:void(0);" ><?php echo $childCatName; ?></a></li>	
										
									<?php } } ?> 
                                    </ul>
                                </div>
								<div style="display:none" class="category_filter_loader">
									<img src="<?php echo base_url(); ?>images/uploading.gif">
								</div>	
                            </div>
                        </div>
						<?php } } ?>
                        <div class="panel panel-default">
                            <h3 class="rt_hdng"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Energy </a></h3>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body"><img src="<?php echo base_url(); ?>images/music_level.jpg" alt=""></div>
                            </div>
                        </div>
                       
                    </div>
                </div>
				 <!-- Modal -->
        <div class="modal fade" id="playlistModal" role="dialog">
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
                            <p>Please create your playlist. </p>
                        </div>


							<?php	
								$attributes = array('class' => 'login_form', 'id' => 'playlist_form');
								echo form_open('playlist/create_playlist', $attributes); 
							?>
                           
                            <ul>
                                <li>
                                    <input type="text" name="playlist_name" maxlength="25" placeholder="Enter Playlist">
                                </li>
                               <li>
									<input type="hidden" name="redirectparamtr" value="<?php //echo $getPlaylist_id; ?>">
                                </li>
                              
                                <li>
                                    <button class="sbmt hover_btn" type="submit" id="send" name="submit" required="">Create Playlist</button>
                                </li>
                            </ul>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
                <div class="your_music bottm_music">
				<?php 
				if ($this->ion_auth->logged_in()){ ?>
					<a href="#" data-toggle="modal" data-target="#playlistModal"><h3 class="rt_hdng playlist-icon">PLAYLISTS</h3></a>
				<?php } else { ?>
					<a href="#" data-target="#login_alert_popup" data-toggle="modal"><h3 class="rt_hdng playlist-icon">PLAYLISTS</h3></a>
				<?php } ?>
                    <?php if ($this->ion_auth->logged_in()){ ?> 
                    <ul>
                      <?php $getPlaylist	=	get_customer_playlist($customerId); 
						if(!empty($getPlaylist)){
							foreach($getPlaylist as $playlistData){
								$playlistId		=	$playlistData['id'];	
								$playlistName	=	$playlistData['playlist_name'];	
						?>	
							<li class="trash" playlist_id="<?php echo $playlistId; ?>"><a href="<?php echo base_url(); ?>playlist/view/<?php echo $playlistId; ?>"><?php echo $playlistName; ?></a></li>
						<?php } } else{
								echo '<li>No Record to display.</li>';
							}
						?>
                    </ul>
					<?php } ?>
                </div>
            </div>
            <div class="rt_sidebar browse-page">
			 <div class="lft_playlist lft_browse pull-left">
			
                <div class="cont_artist">
                  <div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
                        <div class="order_list">
                            <div class="ordr_tabs">
							<div style="display:none" class="orderBy_filter_loader">
									<img src="<?php echo base_url(); ?>images/uploading.gif">
								</div>
                                <ul>
                                    <li>Order by:</li>
									
                                    <li>
                                        <button class="short_order" short_type="Newest" type="button">Newest</button>
                                    </li>
                                    <li>
                                        <button class="short_order" short_type="Trending" class="active" type="button">Trending</button>
                                    </li>
                                    <li>
                                        <button class="short_order" short_type="Longest" type="button">Longest</button>
                                    </li>
                                    <li>
                                        <button class="short_order" short_type="Shortest"  type="button">Shortest</button>
                                    </li>
                                </ul>
                            </div>
			
				<div class="list_wishlist_info">				
				<div class="ordr_inner">
           
		
					<table class="table loop_table">
					<thead></thead>
						<tbody>
						<?php 
						$data 	=	get_artists_music_by_id($ArtistID);
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
											<?php if ($this->ion_auth->logged_in()){ ?>
                                             <li class="add_to_wishlist wishlist-loaderCls" track_id="<?php echo $musicId; ?>">
												<div style="display:none" class="wishlist_loader_style wishlist_loader_<?php echo $musicId; ?>">
													<img src="<?php echo base_url(); ?>images/uploading.gif">
												</div>
												<div class="wshlist-add" id="add_to_wishlist_msg_<?php echo $musicId; ?>">
												</div>
													 <a href="javascript:void(0);">
														<i class="fa fa-heart-o" aria-hidden="true"></i>
													</a>
												</li>
											  
											<?php } else { ?>
											<a data-target="#login_alert_popup" data-toggle="modal" href="javascript:void(0);">
													<li class="">
														<i class="fa fa-heart-o" aria-hidden="true"></i>
													</li>
											</a>
											<?php } ?>
											   <?php 
													if ($this->ion_auth->logged_in()){ ?>
														<li>
															<a class="add_to_popup_playlist" track_id="<?php echo $musicId; ?>" data-target="#addToPlaylistModal_<?php echo $musicId; ?>" data-toggle="modal" href="javascript:void(0);">
															<i class="fa fa-th-list" aria-hidden="true"></i>
															</a>
														</li>
													<?php } else{ ?>
														<li>
															<a class="" data-target="#login_alert_popup" data-toggle="modal" href="javascript:void(0);">
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
											<div class="added_pop">
												<div class="rt_playlist-nam"><?php echo $addedPlaylistName; ?></div>
												<div class="lst_data lft_playlst">
												<div style="display:none" class="loader_gif playlist_loader_<?php echo $addedPlaylistId; ?>">
															<img src="<?php echo base_url(); ?>images/uploading.gif">
												</div>	
												<?php 
													$getAddstatus 	=	check_track_exitsin_playlist($addedPlaylistId, $musicId, $customerId);
													
													if($getAddstatus=='added'){ ?>
														<button class="added"  type="button">Added</button>	
													<?php }else{ ?>
														<button class="addedToPlayList_<?php echo $addedPlaylistId; ?>_<?php echo $musicId; ?> added" style="display:none" type="button">Added</button>
														<button class="addToPlayList" playlist_id="<?php echo $addedPlaylistId; ?>" type="button" track_id="<?php echo $musicId; ?>">Add to playlist</button>
														
													<?php } ?>
												
													
												</div>
											</div>

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
                        </div>
                    </div>
					</div>
					
                  <div class="rt_playlists pull-right">
                        <h2 class="heading_artist">Similiar Artists</h2>
                        <ul class="effect_img">
                            <li>
                                <a href="">
                                    <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist1.jpg" alt=""></div>
                                    <div class="carousel-caption-custom">
                                        <p>Karon O</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist2.jpg" alt=""></div>
                                    <div class="carousel-caption-custom">
                                        <p>Allah Las</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist3.jpg" alt=""></div>
                                    <div class="carousel-caption-custom">
                                        <p>Dan Auerbach</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist4.jpg" alt=""></div>
                                    <div class="carousel-caption-custom">
                                        <p>Nick Cave</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
               
            
        </div>
    </div>
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
	
	<!-- Purchase Modal -->
        <div class="modal fade" id="popup_stage_1" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <div class="modal-body">
                        <div class="logo text-center">
                            <a href="">
                                <p>Sndtrack</p>
                                <span>music licensing</span>
                            </a>
                        </div>
                        <div class="content_inn_pop">
                            <h3>License Type</h3>
                            <div class="license_terms">
							<input type="hidden" id="get_track_id" name="get_track_id">
                                <ul>
								<?php 
									$getlicenceData 	=	get_license_types();
									foreach($getlicenceData as $licenceData){ ?>
										 <li>
											<input id="<?php echo $licenceData['license_type']; ?>" price="<?php echo $licenceData['license_amount']; ?>" class="license_type" type="radio" name="license_type" value="<?php echo $licenceData['license_description']; ?>">
												<label for="license_terms"><?php echo $licenceData['license_description']; ?></label>
									 </li>
									<?php } ?>
                                  
                                </ul>	
                            </div>
							<label style="display:none" class="error">Please select License.</label>
                            <input class="comfirm_btn hover_btn" type="button" value="Confirm">
                            <div class="standard_info">
                                <p>Standard License - Company, brand, product, service, promotion, event, online series</p>
                            </div>
                            <div class="popup_social text-center">
                                <ul>
                                    <li><a href="">Privacy Policy</a></li>
                                    <li><a href="">User Agreement</a></li>
                                    <li><a href="">Terms & Consitions</a></li>

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
	 <!-- Register Modal -->
        <div class="modal fade" id="popup_stage_2" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <!--button type="button" class="close" data-dismiss="modal">&times;</button
                    <div class="modal-body">
                        <div class="logo text-center">
                            <a href="">
                                <p>Sndtrack</p>
                                <span>music licensing</span>
                            </a>
                        </div>
                        <div class="login_text text-center">
                            <p>Please sign up to complete your order. </p>
                        </div>-->


							<?php	
								$attributes = array('class' => 'login_form');
								echo form_open('register', $attributes); 
							?>
						<label style="display:none" id="register_authentication_error"  generated="true" class="error email-error">This email has been already registered..</label>
                            <ul>
                                <li>
                                    <input type="text" id="first_name" name="first_name" placeholder="First Name">
										<label style="display:none"  generated="true" class="error first_name">Please enter your first name.</label>
									
                                </li>
                                <li>
                                    <input type="text" id="last_name" name="last_name" placeholder="Last Name">
									<label style="display:none"  generated="true" class="error last_name">Please enter your last name.</label>
                                </li>
                                <li>
                                    <input name="email" id="email" type="email" placeholder="Email address" required="">
									<label style="display:none"  generated="true" class="error email">Please enter your email.</label>
                                </li>
                                <li>
                                    <input type="password" id="password" name="password" placeholder="Password" required="">
										<label style="display:none"  generated="true" class="error password">Please enter your password.</label>
                                </li>
								<input type="hidden" id="stage2_track_id" name="stage2_track_id">
                                <li>
								<button class="sbmt hover_btn" id="register_popup_form" type="button" id="send" name="submit" required="">Create Account</button>
                                </li>
								<div style="display:none" class="register_loader">
									<img src="<?php echo base_url(); ?>images/uploading.gif">
								</div>
                            </ul>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
      
      <!--Popup satge 3 cart  Modal -->
        <div class="modal fade" id="popup_stage_3" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <!--<button  class="close close_popup_3" type="button">×</button>-->
                    <div class="modal-body popup_stage3">
                        
                    </div>
                </div>
            </div>
        </div>
		
<!-- Checkout Popup Modal -->
        <div class="modal fade purhased" id="popup_stage_4" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-body">
                        <div class="logo text-center">
                            <a href="">
                                <p>Sndtrack</p>
                                <span>music licensing</span>
                            </a>
                        </div>
						<div class="chckout_pop text-center">
                            <p>Checkout</p>
                        </div>
				<form action="" method="POST" id="payment-form" class="login_form">
                        <div class="alert alert-danger" id="a_x200" style="display: none;"> <strong>Error!</strong> <span class="payment-errors"></span> </div>
				<div class="input_fields">
  <span class="payment-success">
 
  </span>
  <fieldset>
  
  <!-- Form Name -->
 
   <div class="col-1-form col-sm-4 col-xs-12 pdngg-left">
	<ul>
  <!-- full_name -->
  <li>
   <div class="form-group">
      <input type="text" name="full_name" placeholder="Full Name" class="full_name">
	</div>
   </li>
  <input type="hidden" name="stage4_track_id" id="stage4_track_id" value="">
  <input type="hidden" name="stage4_customer_id" id="stage4_customer_id" value="">
  <input type="hidden" name="stage4_music_amount" id="stage4_music_amount" value="">
  <!-- City -->
 <li>
	<div class="form-group">
      <input type="text" name="address_line1" placeholder="First Line Address" class="address_line1 form-control">
	 	</div> 
   </li>	
  
  <!-- State -->
	<li>
	<div class="form-group">
		<input type="text" name="city" placeholder="City/State" class="city form-control">
     </div>
    </li>
  
  <!-- Country -->
	<li>
	<div class="form-group">
       <div class="country bfh-selectbox bfh-countries " name="country" placeholder="Select Country" data-flags="true" data-filter="true"> </div>
	</div>
    </li>
  </ul>
 </div>
 <div class="col-1-form col-sm-4 col-xs-12">
	<ul>
  <!-- Street -->
  <li>
  <div class="form-group">
	<input type="text" name="project_name"  class="project_name form-control" placeholder="Project Name">
  </div>  
   </li>
  
  <!-- City -->
 <li>
   <div class="form-group">
	  <input type="text" name="last_name" placeholder="Last Name" class="last_name form-control">
   </li>
   </div> 
  <!-- State -->
	<li>
	<div class="form-group">
      <input type="text" name="second_address" placeholder="Second Line Address">
    </div>
	</li>
  
  <!-- Postcal Code -->
	<li>
     <div class="form-group"> 
	  <input type="text" class="zip" placeholder="Postal Code" maxlength="9" name="zip" data-bv-field="zip">
	 </div>
    </li>
	<li>
		<input type="text" name="vat" placeholder="VAT (if applicable)">
	</li>
  </ul>
 </div>
    
   <div class="col-1-form col-sm-4 col-xs-12 pdngg-right">
		<ul>
			<li>
				<div class="form-group"> 			
				 <input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name" class="card-holder-name form-control">
				</div>
			</li>
			<li>
			<div class="form-group"> 	
			 <input type="text" id="cardnumber" maxlength="19" placeholder="Card Number" class="card-number">
			 </div>
			</li>
			<li class="expiry_dat">
			<div class="form-group"> 	
				<select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required">
					<option value="01" selected="selected">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				  </select>
				  <span> / </span>
				  <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required">
				  </select>
			</div>
			</li>
			<li>
			<div class="form-group"> 
				<input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc">
			</div>
			</li>
		</ul>
  </div>
    <!-- Submit -->
    <div class="control-group">
      <div class="controls">
        <center>
          <button class="btn btn-success custom-button" type="submit">Pay Now</button>
        </center>
      </div>
    </div>
 
  </form>
    </div>
                </div>
            </div>
        </div>
 </div>
    <!--Thank you  Modal Popup -->
        <div class="modal fade" id="popup_stage_5" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-body popup_stage_5_thank">
                       

                    </div>
                </div>

            </div>
        </div>
<style>
	.draggable, .trash{
		width:50px;
		height:50px;
		background-color:green;
		margin-bottom:40px;
		clear: both;
	}
</style>
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.bxslider.js"></script>
        <script src="<?php echo base_url(); ?>js/toggle.js"></script>
        <script src="<?php echo base_url(); ?>js/wow.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.paginate.js"></script>
        <script src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
		<script src="https://use.typekit.net/auo4nbe.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap-formhelpers-min.js"></script>
		<script src="<?php echo base_url(); ?>js/bootstrapValidator-min.js"></script>

<script>
/*************  Drag and Save  to playlist ************/
 //$(function() {
	 $(document).on('click','.draggable',function(){
    $('.draggable').draggable({
   revert : function(event, ui) {
            $(this).data("uiDraggable").originalPosition = {
                top : 0,
                left : 0
            };          
            return !event;   
			
        },
		live: true
    });
	
     $('.trash').droppable({
        accept: '.draggable',
         drop: function (event, ui) {
            ui.draggable.draggable('option','revert',true); 			
				var playlist_id			= $(this).attr("playlist_id");
				var track_id 			= ui.draggable.attr("track_id");
				var loader				=	".wishlist_loader_"+track_id;
				var add_to_wishlist_msg = "#add_to_wishlist_msg_"+track_id;
			var url	=	'<?php echo base_url(); ?>dashboard/add_to_playlist/'+playlist_id+"/"+track_id;
					  $(loader).show();
					  $.ajax({
							url: url,
							data: {playlist_id: playlist_id, track_id : track_id},                         // Setting the data attribute of ajax with file_data
							type: 'post',
							success:function(data){
								ui.draggable.draggable('option','revert',true); 
								$(add_to_wishlist_msg).show();
									if(data==1){
										$(loader).hide();
										$(add_to_wishlist_msg).empty().append('Added to playlist').delay(2000).fadeOut();
									}if(data==2){
										$(loader).hide();
										$(add_to_wishlist_msg).empty().append('Already Added to playlist').delay(2000).fadeOut();
									}if(data==3){
										$(loader).hide();
										$(add_to_wishlist_msg).empty().append('Please try again and drop song properly.').delay(3000).fadeOut();
									}
								}
						}); 
				
          ui.draggable.draggable('option','revert',true); 
        }
    });
  });

</script>
 <script type="text/javascript">
            var select = $(".card-expiry-year"),
            year = new Date().getFullYear();
 
            for (var i = 0; i < 12; i++) {
                select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
            }
        </script> 
        <script>
            try {
                Typekit.load({
                    async: true
                });
            } catch (e) {}
        </script>
        <script>
            //call paginate
            $('#example').paginate();
        </script>	
        <script>
            var wow = new WOW({
                boxClass: 'wow', // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset: 0, // distance to the element when triggering the animation (default is 0)
                mobile: true, // trigger animations on mobile devices (default is true)
                live: true, // act on asynchronously loaded content (default is true)
                callback: function (box) {
                    // the callback is fired every time an animation is started
                    // the argument that is passed in is the DOM node being animated
                },
                scrollContainer: null // optional scroll container selector, otherwise use window
            });
            wow.init();
        </script>
        <script>
            wow = new WOW({
                animateClass: 'animated',
                offset: 100,
                callback: function (box) {
                    console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                }
            });
            wow.init();
            document.getElementById('moar').onclick = function () {
                var section = document.createElement('section');
                section.className = 'section--purple wow fadeInDown';
                this.parentNode.insertBefore(section, this);
            };
        </script>
        <script>
            $(window).scroll(function () {

                if ($(this).scrollTop() > 0) {
                    $('header').addClass('off-canvas');
                } else {
                    $('header').removeClass('off-canvas');
                }
            });
        </script>
        <script>
            $('document').ready(function () {
                $('.drop_header').click(function () {
                    $('.drop_cntnt').slideToggle();
                });
				$('.start-follow').on('click', function(e) {
					var artist_id = $(this).attr('artist_id');
					var customerid = $(this).attr('customerid');
					var url	=	'<?php echo base_url(); ?>dashboard/follow_artist/'+artist_id+"/"+customerid;
					  $('.set_arists_status').show();
					  $.ajax({
							url: url,
							data: {artist_id : artist_id},                         // Setting the data attribute of ajax with file_data
							type: 'post',
							success:function(data){
									
									$('.set_arists_status').hide();
									$(".follow_button").empty().append('Followed');
									$('.dis-follow').show();
									$('.start-follow').remove();
								}
						}); 
				});

            });
        </script>	
        <script>
            function toggleChevron(e) {
                $(e.target)
                    .prev('.panel-heading')
                    .find('i.indicator')
                    .toggleClass('glyphicon-minus glyphicon-plus');
                //$('#accordion .panel-heading').css('background-color', 'green');
                $('#accordion .panel-heading').removeClass('highlight');
                $(e.target).prev('.panel-heading').addClass('highlight');
            }
            $('#accordion').on('hidden.bs.collapse', toggleChevron);
            $('#accordion').on('shown.bs.collapse', toggleChevron);
        </script>

        <script>
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 39,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: false
                    }
                }
            })
        </script>
<script>
/*************  Add Form Validation************/
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#playlist_form").validate({
                rules: {
					playlist_name: "required"
                },
                messages: {
                    playlist_name: "Please enter your playlist name.",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
/*************  checkout Form Validation************/	
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#checkout_form").validate({
                rules: {
					full_name: "required",
					first_line_address: "required",
					city: "required",
					country: "required",
					project_name: "required",
					last_name: "required",
					second_line_add: "required",
					zip_code: "required",
					vat: "required",
					card_name: "required",
					card_no: "required",
					expiry: "required",
					security_code: "required",
                },
                messages: {
                    full_name: "Please enter your full name.",
					first_line_address: "Please enter your first line address.",
					city: "Please enter your city name.",
					country: "Please enter your country name.",
					project_name: "Please enter your project name.",
					last_name: "Please enter your last name.",
					second_line_add: "Please enter your second line address.",
					zip_code: "Please enter your zip code.",
					vat: "Please enter your Vat.",
					card_name: "Please enter your card Name.",
					card_no: "Please enter your card number.",
					expiry: "Please enter your expiry.",
					security_code: "Please enter your security code.",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
/*************  Create Playlist Form Validation************/
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#login_form_popup_id").validate({
                rules: {
					popup_playlist_name: "required"
                },
                messages: {
                    popup_playlist_name: "Please enter your playlist name.",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

</script>
   
<script>
/*************  Add MUSIC to Wishlist ************/
$(document).on('click','.add_to_wishlist',function(){
	var track_id			=	$(this).attr('track_id');
	var loader				=	".wishlist_loader_"+track_id;
	var add_to_wishlist_msg = "#add_to_wishlist_msg_"+track_id;
	var url	=	'<?php echo base_url(); ?>dashboard/add_to_wishlist/'+track_id;
					  $(loader).show();
					  $.ajax({
							url: url,
							data: {track_id : track_id},                         // Setting the data attribute of ajax with file_data
							type: 'post',
							success:function(data){
								$(add_to_wishlist_msg).show();
									if(data==1){
										$(loader).hide();
										$(add_to_wishlist_msg).empty().append('Added to wishlist').delay(1000).fadeOut();
									}if(data==2){
										$(loader).hide();
										$(add_to_wishlist_msg).empty().append('Already Added to wishlist').delay(1000).fadeOut();
									}
								}
						}); 
});
/*************  Add MUSIC to playlist************/
$(document).on('click','.addToPlayList',function(){	
//var track_id	=	$("#login_form_popup input[name=popup_track_id]").attr('trackid');	
	var track_id	=	$(this).attr('track_id');
	
	var playlist_id	=	$(this).attr('playlist_id');
	
	var loader		=	".playlist_loader_"+playlist_id;
	var addButtonMsg	=	".addedToPlayList_"+playlist_id+"_"+track_id;
	var url	=	'<?php echo base_url(); ?>dashboard/add_to_playlist/'+playlist_id+"/"+track_id;
					  $(loader).show();
					  $.ajax({
							url: url,
							data: {playlist_id : playlist_id, track_id : track_id},                         // Setting the data attribute of ajax with file_data
							type: 'post',
							success:function(data){
								//alert(data);
									if(data==1){
										$(loader).hide();
										$(addButtonMsg).show();
										
									}
									
								}
						}); 
				$(this).remove();						
					
});	
</script>
<script>	
/*************  Add Play list From Popup	************/
	
			$(document).on('click','.add_to_popup_playlist',function(){
				
					var trackId	=	$(this).attr('track_id');
				
				$(".login_form_popup").empty();
				var appendForm	=	'<ul class="form_ul_test"><li><input type="text" placeholder="Enter Playlist" maxlength="25" name="popup_playlist_name" id="popup_playlist_name" required><div style="display:none" class="error error_cls_'+trackId+'"><p>Plesae enter your playlist name.</p></div><input type="hidden" trackId="'+trackId+'"  value="'+trackId+'" name="popup_track_id"></li><li><button name="submit" type="button" class="sbmt hover_btn create_popup_playlist">Create Playlist</button></li></ul>';
				//alert(appendForm);
				jQuery(appendForm).detach().appendTo('.login_form_popup'); 
				//$('#popup_track_id').attr("trackId",trackId);
				
			});	

/*************  create popup list	************/	
	$(document).on('click','.create_popup_playlist',function(){
		var track_id			=	$(".login_form_popup input[name=popup_track_id]").attr('trackid');
			
		var getplaylistname		=	"#login_form_popup_id_"+track_id+" "+"input[name=popup_playlist_name]";
		
		var get_popup_playlist_name	=	$(getplaylistname).val();
		
		var error_cls		=	".error_cls_"+track_id;
		$(error_cls).hide();
		if(get_popup_playlist_name!=''){
			var popup_playlist_name 	=	get_popup_playlist_name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, ' ');
		
			var loader		=	".popup_playlist_loader_"+track_id;
				var url	=	'<?php echo base_url(); ?>dashboard/create_playlist_inpopup/'+track_id+"/"+popup_playlist_name;
					  $(loader).show();
					  $.ajax({
							url: url,
							data: {track_id : track_id,popup_playlist_name : popup_playlist_name},                         // Setting the data attribute of ajax with file_data
							type: 'post',
							success:function(data){
								
								$('.download_popup').append(data);
								var get_popup_playlist_name	=	$(getplaylistname).val("");
									$(loader).hide();
								}
						}); 
		}else{
			$(error_cls).show();
		}
	});
	/*************  Category Filter	************/	
$(document).on('click','.category_filter',function(){
	var catId	=	$(this).attr('catId');
	$('.draggable').draggable();
	var url	=	'<?php echo base_url(); ?>browse/filter_by_category/'+catId;
	  $('.category_filter_loader').show();
	  $.ajax({
			url: url,
			data: {catId : catId},                         // Setting the data attribute of ajax with file_data
			type: 'post',
			success:function(data){
					//alert(data);
					$('.category_filter_loader').hide();
					$('.lft_playlist').empty().append(data);
					$('.draggable').draggable();
					$('.draggable').trigger('click');
				}
				
		}); 	
		
	});	
/*************  Short Order	************/		
$(document).on('click','.short_order',function(){
	$('.short_order').removeClass('active');
	$(this).addClass('active');
	var short_cat_id	=	'';
	var short_type	=	$(this).attr('short_type');
	var short_cat_id	=	$(this).attr('short_cat_id');	
	
	$('.draggable').draggable();
	var url	=	'<?php echo base_url(); ?>browse/filter_by_browse';
	  $('.orderBy_filter_loader').show();
	  $.ajax({
			url: url,
			data: {short_type : short_type, short_cat_id: short_cat_id},                         // Setting the data attribute of ajax with file_data
			type: 'post',
			success:function(data){
					if( typeof short_cat_id  !== "undefined"){
						$('.orderBy_filter_loader').hide();
						$('.playlist_info').empty().append(data);
						$('.draggable').draggable();
						$('.draggable').trigger('click');
					}else{
						$('.orderBy_filter_loader').hide();
						$('.list_wishlist_info').empty().append(data);
						$('.draggable').draggable();
						$('.draggable').trigger('click');
					}
				}
				
		}); 	
		
	});	
	
/*************  Popup Login	************/		
$(document).on('click','.login_button',function(){
var login_email_address	=	$('#login_email_address').val();
var login_password		=	$('#login_password').val();

if(login_email_address==''){
	$('.email-error').show();
}if(login_email_address!=''){
	$('.email-error').hide();	
}if(login_password==''){
	$('.pwd-error').show();	
}if(login_password!=''){
	$('.pwd-error').hide();	
}
$("#authentication_error").hide();
if(login_email_address !='' && login_password!=''){
 var url			=	'<?php echo base_url(); ?>login/popup_login';
 var redirectUrl	=	'<?php echo base_url(); ?>browse';	
 $("#authentication_error").hide();
  $('.login_loader').show();
  $.ajax({
		url: url,
		data: {login_email_address : login_email_address, login_password : login_password},                         // Setting the data attribute of ajax with file_data
		type: 'post',
		success:function(data){
				$('.login_loader').hide();			
				if(data==1){
					window.location.href=redirectUrl;
				}if(data==2){
					$("#authentication_error").show();
				}
			}
			
	});  
 }	
});
/************* Set Music Id to satge 1 popup	************/	
	$(document).on('click','.popup_stage_1_cls',function(){
		var music_id	=	$(this).attr('music_id');
		$('#get_track_id').val(music_id);
	});
/************* Licensce Type Popup	************/	
	$(document).on('click','.comfirm_btn',function(){
		 $('.error').hide();
		var license_type		=	'';
		var license_type_value	=	'';
		var amount				=	'';
		var sessionId			=	'<?php echo $sessionId; ?>';
		var customerId			=	'<?php echo $customerId; ?>';
		if($('input[name=license_type]:checked').val()){
			var license_type_value	=	$('input[name=license_type]:checked').val();
			var license_type		=	$('input[name=license_type]:checked').attr('id');
			var amount				=	$('input[name=license_type]:checked').attr('price');
			var track_id			=	$('#get_track_id').val();
		}else{
			 $('.error').show();
		}
		
		var loginStatus		=	'<?php echo $loginStatus; ?>';
		 if(license_type !='' && loginStatus==1){
			 var customer_id	=	'<?php echo $customerId; ?>';
			 var ajaxUrl	=	'<?php echo base_url(); ?>browse/store_temp_license_type';
			 var cartUrl		=	'<?php echo base_url(); ?>browse/get_cart_view_by_customer/';
			 $.ajax({
				url: ajaxUrl,
				data: {session_id : sessionId, license_type : license_type, customer_id : customer_id, amount : amount,license_type_value : license_type_value, track_id : track_id},
				type: 'post',
				success:function(data){
					$('#popup_stage_1').modal('hide');
								$.ajax({
										url: cartUrl+customer_id+"/"+track_id,
										data: {data : data},                         // Setting the data attribute of ajax with file_data
										type: 'post',
										success:function(data){
											$('.popup_stage3').empty().append(data);
										}
									}); 
						$('#popup_stage_3').modal({
								backdrop: 'static',
								keyboard: false
							});
					}
				}); 
		 }if(license_type !='' && loginStatus==''){
			 var ajaxUrl	=	'<?php echo base_url(); ?>browse/store_temp_license_type';
			 $.ajax({
				url: ajaxUrl,
				data: {session_id : sessionId, license_type : license_type, customer_id : customerId, amount : amount,license_type_value : license_type_value, track_id : track_id},
				type: 'post',
				success:function(data){
						//alert(data);
					}
				}); 
			$('#popup_stage_1').modal('hide');
			
			$('#popup_stage_2').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('#stage2_track_id').val(track_id);
		 }
		
	});
	/************* Register Popup	************/	
	$(document).on('click','#register_popup_form',function(){
		var first_name	=	$('#first_name').val();
		var last_name	=	$('#last_name').val();
		var email		=	$('#email').val();
		var password	=	$('#password').val();	
		var sessionId	=	"<?php echo $sessionId; ?>";
		var trackID		=	$('#stage2_track_id').val();
		/* alert(email);
		alert(first_name);
		alert(last_name);
		alert(password); */
		 var url			=	'<?php echo base_url(); ?>register/popup_register';
		 var cartUrl		=	'<?php echo base_url(); ?>browse/get_cart_view_by_customer/';
			if(first_name==''){
				$('.first_name').show();
			}if(last_name==''){
				$('.last_name').show();
			}if(email==''){
				$('.email').show();
			}if(password==''){
				$('.password').show();
			}if(first_name!=''){
				$('.first_name').hide();
			}if(last_name!=''){
				$('.last_name').hide();
			}if(email!=''){
				$('.email').hide();
			}if(password!=''){
				$('.password').hide();
			}
			if(first_name !="" && last_name !="" && email !="" && password !=""){
				$('.register_loader').show();
				$.ajax({
				url: url,
				data: {first_name : first_name, last_name : last_name, email : email, password : password, sessionId : sessionId},                         // Setting the data attribute of ajax with file_data
				type: 'post',
				success:function(data){
					
						$('.register_loader').hide();			
						if(data==2){
							$("#register_authentication_error").show();
						}else{
							$('#popup_stage_2').modal('hide');
									$.ajax({
										url: cartUrl+data+"/"+trackID,
										data: {data : data},                         // Setting the data attribute of ajax with file_data
										type: 'post',
										success:function(data){
												
												$('.popup_stage3').empty().append(data);
											}
										}); 
							$('#popup_stage_3').modal({
												backdrop: 'static',
												keyboard: false
											});
											
						}
					}
					
				}); 
			}				
	});
		
	$(document).on('click','.purchase_button',function(){
		var get_track_id		=	$('#get_track_id').val();
		var get_customer_id		=	$('#get_customer_id').val();
		var get_music_amount	=	$('#get_music_amount').val();
	
		$('#popup_stage_3').hide();
		$('#popup_stage_4').modal({backdrop: 'static',
									keyboard: false
								});
		$('#stage4_track_id').val(get_track_id);
		$('#stage4_customer_id').val(get_customer_id);
		$('#stage4_music_amount').val(get_music_amount);
	
	});	
	$(document).on('click','.close_popup_3',function(){
		/* $('#popup_stage_3').hide();
		window.location.href	=	'<?php echo base_url(); ?>browse'; */
	});
	$('document').ready(function () {
		$('.draggable').trigger('click');
	});

</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#payment-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitHandler: function(validator, form, submitButton) {
                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.card.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val(),
			name: $('.card-holder-name').val(),
			address_line1: $('.address_line1').val(),
			address_city: $('.city').val(),
			address_zip: $('.zip').val(),
			address_state: $('.state').val(),
			address_country: $('.country').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
        },
        fields: {
            full_name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required and cannot be empty'
                    },
					stringLength: {
                        min: 2,
                        max: 96,
                        message: 'The full_name must be more than 2 and less than 96 characters long'
                    }
                }
            },
			project_name: {
                validators: {
                    notEmpty: {
                        message: 'The project name is required and cannot be empty'
                    },
					stringLength: {
                        min: 2,
                        max: 96,
                        message: 'The project name must be more than 2 and less than 96 characters long'
                    }
                }
            },
			last_name: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    },
					stringLength: {
                        min: 2,
                        max: 96,
                        message: 'The last name must be more than 2 and less than 96 characters long'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'The city is required and cannot be empty'
                    }
                }
            },
			zip: {
                validators: {
                    notEmpty: {
                        message: 'The zip is required and cannot be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 9,
                        message: 'The zip must be more than 3 and less than 9 characters long'
                    }
                }
            },
           /*  email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
					stringLength: {
                        min: 6,
                        max: 65,
                        message: 'The email must be more than 6 and less than 65 characters long'
                    }
                }
            }, */
			cardholdername: {
                validators: {
                    notEmpty: {
                        message: 'The card holder name is required and can\'t be empty'
                    },
					stringLength: {
                        min: 6,
                        max: 70,
                        message: 'The card holder name must be more than 6 and less than 70 characters long'
                    }
                }
            },
			cardnumber: {
		selector: '#cardnumber',
                validators: {
                    notEmpty: {
                        message: 'The credit card number is required and can\'t be empty'
                    },
					creditCard: {
						message: 'The credit card number is invalid'
					},
                }
            },
			expMonth: {
                selector: '[data-stripe="exp-month"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration month is required'
                    },
                    digits: {
                        message: 'The expiration month can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var year         = validator.getFieldElements('expYear').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                validator.updateStatus('expYear', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            expYear: {
                selector: '[data-stripe="exp-year"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration year is required'
                    },
                    digits: {
                        message: 'The expiration year can contain digits only'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var month        = validator.getFieldElements('expMonth').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 100) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                validator.updateStatus('expMonth', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
			cvv: {
		selector: '#cvv',
                validators: {
                    notEmpty: {
                        message: 'The cvv is required and can\'t be empty'
                    },
					cvv: {
                        message: 'The value is not a valid CVV',
                        creditCardField: 'cardnumber'
                    }
                }
            },
        }
    });
});
</script>
<script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('pk_test_Ggl7xyWJ2YazeoQf9nOCXWh6');
 
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");
					// show hidden div
					document.getElementById('a_x200').style.display = 'block';
                    // show the errors on the form
                    $(".payment-errors").html(response.error.message);
                } else {
                    var form$ = $("#payment-form");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
					url				=	'<?php echo base_url(); ?>stripe/payment.php';
					save_cartUrl	=	'<?php echo base_url(); ?>browse/save_cart';
					var formData	=	$('#payment-form').serialize();
					$.ajax({
						url: url,
						data: formData,                         // Setting the data attribute of ajax with file_data
						type: 'post',
						success:function(data){
							if(data==2){
								alert('Payment Failure! Please check your payment details and try again.');
							}else{
								$.ajax({
									url: save_cartUrl,
									data: data,                    
									type: 'post',
									success:function(data){
											$('.popup_stage_5_thank').empty().append(data);
										}
									}); 
									$('#popup_stage_4').modal('hide');
									$('#popup_stage_5').modal({
												backdrop: 'static',
												keyboard: false
											});
								}
						}
					}); 
					//alert(formData);	
                    //form$.get(0).submit();
                }
            }
 

</script>
</body>
	
</html>  
<?php } ?>
