<?php
$sessionId		=	session_id();
$loginStatus	=	'';
$customerId		=	'';
if ($this->ion_auth->logged_in()){
	$loginStatus	=	1;
	$customerId			=	$this->ion_auth->user()->row()->user_id; 
	$customerData		=	$this->ion_auth->user()->row();
	if(!empty($customerData)){
		$customerFirstName 		=		$customerData->first_name;
		$customerLastName 		=		$customerData->last_name;
	}
}
$getPlaylist_id	= $this->uri->segment(3); 
?>
<div class="cstmr_cont header-margin">
        <div class="music-bar">
            <figure><img src="<?php echo base_url(); ?>images/music-bar.jpg" alt="" title=""></figure>
        </div>
        <div class="container-fluid pdngg container-full">
            <div class="lft_sidebar">
              <div class="your_music">
                    <h3 class="rt_hdng">YOUR MUSIC</h3>
                    <ul>
                        <li><a href="">Hearted</a></li>
                        <div id="accordion2" class="panel-group user_acc">
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
				</div>
                        <li><a href="">Songs</a></li>
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
									echo $parentCatName;
									echo '<h3 class="rt_hdng"><input type="checkbox" name="Instruments" value="Instruments"></h3>';
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
                                        <a href="javascript:void(0);" ><li class="category_filter" catId="<?php echo $childCatId; ?>"><?php echo $childCatName; ?></li>	</a>
										
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
									<input type="hidden" name="redirectparamtr" value="<?php echo $getPlaylist_id; ?>">
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
			<div id="add_to_wishlist_msg"></div>
                <div class="cont_artist">
                   
                    <div class="lft_playlist lft_browse pull-left">
					<div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
                        <div class="order_list">
                            <div class="ordr_tabs">
                                <ul>
                                    <li>Order by:</li>
									<div style="display:none" class="orderBy_filter_loader">
									<img src="<?php echo base_url(); ?>images/uploading.gif">
								</div>
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
												<div style="display:none" class="wishlist_loader_<?php echo $musicId; ?>">
													<img src="<?php echo base_url(); ?>images/uploading.gif">
												</div>
												<?php 
													if ($this->ion_auth->logged_in()){ ?>
                                               <a href="javascript:void(0);">
													<li class="add_to_wishlist" track_id="<?php echo $musicId; ?>">
														<i class="fa fa-heart-o" aria-hidden="true"></i>
													</li>
											   </a>
											<?php } else{ ?>
											<a  data-target="#login_alert_popup" data-toggle="modal" href="javascript:void(0);">
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
                                           <a href="javascript:void(0);" data-toggle="modal" data-target="#popup_stage_1">License</a>
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
                        </div>
                    </div>
                    <div class="rgt_browse pull-right">
                        <div class="browse-right-box">
                            <h3>Clem Snide</h3>
                            <figure><img src="<?php echo base_url(); ?>images/browse-page-img.jpg" alt="" title=""></figure>
                            <p>Clem grew up in California listening to The Byrds and Lou Reed. He followed in his fathers foot-steps by learning to play the guitar and banjo. At the age of 16 he was playing local shows in San-Clemente, California and released his first record in Dec 2003 to critial acclaim.</p>
                            <a href="#" class="btn-trns ">More from this Artist</a>
                        </div>
                    </div>
                </div>
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
                                <ul>
                                    <li>
										<input id="license_terms" price="29" class="license_type" type="radio" name="license_type" value="Personal License - £29">
											<label for="license_terms">Personal License - £29 </label>
									 </li>
                                    <li>
									
										<input  id="lite_license" price="39" class="license_type" type="radio" name="license_type" value="Lite License - £39">
											<label for="lite_license">Lite License - £39 </label>
                                    </li>
                                    <li class="active">
									
										<input id="standard_license" price="49" class="license_type" type="radio" name="license_type" value="Standard License - £49 ">
										<label for="standard_license">Standard License - £49 </label>
                                    </li>
                                    <li>
										<input id="premium_license" price="59" class="license_type" type="radio" name="license_type" value="Premium License - £59 ">
										<label for="premium_license">Premium License - £59 </label>
                                    </li>
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
                    <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                    <div class="modal-body">
                        <div class="logo text-center">
                            <a href="">
                                <p>Sndtrack</p>
                                <span>music licensing</span>
                            </a>
                        </div>
                        <div class="content_inn_pop">
                            <h3>License Type</h3>
                            <div class="confirm_purchs">
                                <div class="list_pop">
                                    <ul>
                                        <li class="pull-left">Personal Licensed</li>
                                        <li class="pull-right"> &pound;29 </li>
                                    </ul>
                                    <ul>
                                        <li class="pull-left">Personal Licensed</li>
                                        <li class="pull-right"> &pound;29 </li>
                                    </ul>
                                </div>

                                <div class="ttl">
                                    <ul>
                                        <li class="pull-left">Total</li>
                                        <li class="pull-right"> &pound;29 </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="back_btn">
                                <a href="" class="custom-button">Back</a>
                                <a href="" class="custom-button">Purchase</a>
                            </div>
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
				var playlist_id= $(this).attr("playlist_id");
				var track_id = ui.draggable.attr("track_id");
				var loader		=	".wishlist_loader_"+track_id;
			var url	=	'<?php echo base_url(); ?>dashboard/add_to_playlist/'+playlist_id+"/"+track_id;
					  $(loader).show();
					  $.ajax({
							url: url,
							data: {playlist_id: playlist_id, track_id : track_id},                         // Setting the data attribute of ajax with file_data
							type: 'post',
							success:function(data){
								ui.draggable.draggable('option','revert',true); 
								$("#add_to_wishlist_msg").show();
									if(data==1){
										$(loader).hide();
										$("#add_to_wishlist_msg").empty().append('Added to playlist').delay(2000).fadeOut();
									}if(data==2){
										$(loader).hide();
										$("#add_to_wishlist_msg").empty().append('Already Added to playlist').delay(2000).fadeOut();
									}if(data==3){
										$(loader).hide();
										$("#add_to_wishlist_msg").empty().append('Please try again and drop song properly.').delay(3000).fadeOut();
									}
								}
						}); 
				
          ui.draggable.draggable('option','revert',true); 
        }
    });
  });

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
	var track_id	=	$(this).attr('track_id');
	var loader		=	".wishlist_loader_"+track_id;
	
	var url	=	'<?php echo base_url(); ?>dashboard/add_to_wishlist/'+track_id;
					  $(loader).show();
					  $.ajax({
							url: url,
							data: {track_id : track_id},                         // Setting the data attribute of ajax with file_data
							type: 'post',
							success:function(data){
								$("#add_to_wishlist_msg").show();
									if(data==1){
										$(loader).hide();
										$("#add_to_wishlist_msg").empty().append('Added to wishlist').delay(1000).fadeOut();
									}if(data==2){
										$(loader).hide();
										$("#add_to_wishlist_msg").empty().append('Already Added to wishlist').delay(1000).fadeOut();
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
	var short_type	=	$(this).attr('short_type');
	
	$('.draggable').draggable();
	var url	=	'<?php echo base_url(); ?>browse/filter_by_browse/'+short_type;
	  $('.orderBy_filter_loader').show();
	  $.ajax({
			url: url,
			data: {short_type : short_type},                         // Setting the data attribute of ajax with file_data
			type: 'post',
			success:function(data){	
					
					$('.orderBy_filter_loader').hide();
					$('.list_wishlist_info').empty().append(data);
					$('.draggable').draggable();
					$('.draggable').trigger('click');
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
		}
		
		var loginStatus		=	'<?php echo $loginStatus; ?>';
		 if(license_type !='' && loginStatus==1){
			 alert(555);
		 }if(license_type !='' && loginStatus==''){
			 var ajaxUrl	=	'<?php echo base_url(); ?>browse/store_temp_license_type';
			 $.ajax({
				url: ajaxUrl,
				data: {session_id : sessionId, license_type : license_type, customer_id : customerId, amount : amount,license_type_value : license_type_value},
				type: 'post',
				success:function(data){
						//alert(data);
					}
				}); 
			$('#popup_stage_1').modal('hide');
			$('#popup_stage_2').modal('show');
		 }else{
			 $('.error').show();
		 }
		
	});
	/************* Register Popup	************/	
	$(document).on('click','#register_popup_form',function(){
		var first_name	=	$('#first_name').val();
		var last_name	=	$('#last_name').val();
		var email		=	$('#email').val();
		var password	=	$('#password').val();	
		/* alert(email);
		alert(first_name);
		alert(last_name);
		alert(password); */
		 var url		=	'<?php echo base_url(); ?>register/popup_register';
		
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
				data: {first_name : first_name, last_name : last_name, email : email, password : password},                         // Setting the data attribute of ajax with file_data
				type: 'post',
				success:function(data){
						alert(data);
						$('.register_loader').hide();			
						if(data==2){
							$("#register_authentication_error").show();
						}else{
							$('#popup_stage_2').modal('hide');
							$('#popup_stage_3').modal('show');
						}
					}
					
				}); 
			}				
	});
$('document').ready(function () {
	$('.draggable').trigger('click');
});

</script>

</body>

</html>