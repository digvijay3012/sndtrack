<?php 
//echo "<pre>";		print_r($artist_data);		echo "</pre>"; die;
if(!empty($artist_data)){
	$track_id 		=	$artist_data['track_id'];
	$artist_bio 		=	$artist_data['0']['artist_bio'];
	$facebook_link 		=	$artist_data['0']['facebook_link'];
	$twitter_link 		=	$artist_data['0']['twitter_link'];
	$instagram_link 	=	$artist_data['0']['instagram_link'];
	$artist_image 		=	$artist_data['0']['artist_image'];
	$artist_id 			=	$artist_data['0']['id'];
	$first_name 		=	$artist_data['0']['first_name'];
	$last_name 			=	$artist_data['0']['last_name'];
	$customerId			=	$this->ion_auth->user()->row()->user_id;
	$inserRecentListData	=	insert_recently_listened_music($track_id, $customerId, $artist_id);
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
                        <li><a href="">Hearted</a></li>
                        <div id="accordion2" class="panel-group user_acc">
						<h3 class="rt_hdng"><a href="#collapseOne_22" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed" aria-expanded="false">
						Artists																
						</a></h3>
						<div class="panel-collapse collapse" id="collapseOne_22" aria-expanded="false" style="height: 0px;">
							<div class="panel-body">
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
								echo form_open('dashboard/create_playlist', $attributes); 
							?>
                           
                            <ul>
                                <li>
                                    <input type="text" name="playlist_name" maxlength="25" placeholder="Enter Playlist">
                                </li>
                               <li>
									<input type="hidden" name="redirectparamtr" value="<?php echo 'artist_music/'.$track_id.''; ?>">
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
                     <a href="#" data-toggle="modal" data-target="#playlistModal"><h3 class="rt_hdng playlist-icon">PLAYLISTS</h3></a>
                    <ul>
                      <?php $getPlaylist	=	get_customer_playlist($customerId); 
						if(!empty($getPlaylist)){
							foreach($getPlaylist as $playlistData){
								$playlistId		=	$playlistData['id'];	
								$playlistName	=	$playlistData['playlist_name'];	
						?>	
							<li class="trash" playlist_id="<?php echo $playlistId; ?>"><a href="<?php echo base_url(); ?>playlist"><?php echo $playlistName; ?></a></li>
						<?php } } else{
								echo '<li>No Record to display.</li>';
							}
						?>
                    </ul>
                </div>
            </div>
            <div class="rt_sidebar art_browse">
				<div id="add_to_wishlist_msg"></div>
                <div class="cont_artist">
                    <div class="lft_playlist pull-left">
					<div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
                        <div class="playlist_info">
		
                            <table class="table loop_table">
							<thead></thead>
                                <tbody>
								<?php $getAllMusic	=	get_artists_music_by_id($artist_id); 
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

                        </div>
                        <nav class="paginate-pagination cstm_pagintn">
                            <ul>
                                <li><a class="page page-prev deactive" data-page="prev" href="#">«</a></li>
                                <li><a class="page page-1 active" data-page="1" href="#paginate-1">1</a></li>
                                <li><a class="page page-1 " data-page="1" href="#paginate-1">2</a></li>
                                <li><a class="page page-1 " data-page="1" href="#paginate-1">3</a></li>
                                <li><a class="page page-next deactive" data-page="next" href="#">»</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="rt_playlists pull-right">
                        <h2 class="heading_artist">Similiar Artists</h2>
                        <ul class="effect_img">
                            <li>
                                <a href="">
                                    <div class="img_inner"><img alt="" src="<?php echo base_url(); ?>images/artist1.jpg"></div>
                                    <div class="carousel-caption-custom">
                                        <p>Karon O</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="img_inner"><img alt="" src="<?php echo base_url(); ?>images/artist2.jpg"></div>
                                    <div class="carousel-caption-custom">
                                        <p>Allah Las</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="img_inner"><img alt="" src="<?php echo base_url(); ?>images/artist3.jpg"></div>
                                    <div class="carousel-caption-custom">
                                        <p>Dan Auerbach</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="img_inner"><img alt="" src="<?php echo base_url(); ?>images/artist4.jpg"></div>
                                    <div class="carousel-caption-custom">
                                        <p>Nick Cave</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<?php }else{ ?>
<div class="cstmr_cont header-margin">
        <div class="banner_artist" style="background-image: url('<?php echo base_url(); ?>images/img_dash.jpg');">
            <div class="banner_art_cntnt">
                <div class="scl_icns_banner">
                    <h2>No Data to display</h2>
       </div>
                </div>
            </div>
        </div>
<?php } ?>

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
$(document).on('click','.category_filter',function(){
	var catId	=	$(this).attr('catId');
	$('.draggable').draggable();
	var url	=	'<?php echo base_url(); ?>dashboard/filter_by_category/'+catId;
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
$('document').ready(function () {
	$('.draggable').trigger('click');
});	
</script>
</body>

</html>