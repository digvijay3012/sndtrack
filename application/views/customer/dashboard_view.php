<?php
$customerData	=	$this->ion_auth->user()->row();
if(!empty($customerData)){
	$customerId 	=		$customerData->user_id;
	$first_name 	=		$customerData->first_name;
	$last_name 		=		$customerData->last_name;
}
?>
<div class="cstmr_cont header-margin">
        <div class="container-fluid pdngg container-full">
            <div class="banner_image wow fadeIn animated mrgn_srch" style="background-image: url('<?php echo base_url(); ?>images/premi_bnnr.jpg');">
                <div class="content_banner_inner text-center">
                    <h2>Welcome</h2>
                    <p>Hi <?php echo $first_name; ?> ! </p>
                </div>
            </div>
            <div class="music-bar">
                <figure><img title="" alt="" src="<?php echo base_url(); ?>images/music-bar.jpg"></figure>
            </div>
            <div class="lft_sidebar">
                <div class="your_music">
                    <h3 class="rt_hdng">YOUR MUSIC</h3>
                    <ul>
                        <li><a href="">Hearted</a></li>
                        <li><a href="">Artists</a></li>
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
                            <h3 class="rt_hdng"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?php echo $counterFlag; ?>">
								<?php echo $parentCatName; ?>
							
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
                                        <li><a href="" pid="<?php echo $childCatId; ?>"><?php echo $childCatName; ?></a></li>
									<?php } } ?> 
                                    </ul>
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
                <div class="your_music bottm_music">
                    <h3 class="rt_hdng playlist-icon">PLAYLISTS</h3>
                    <ul>
                        <li><a href="#">Songs</a></li>
                        <li><a href="#">Artists</a></li>
                        <li><a href="#">Songs</a></li>
                    </ul>
                </div>
            </div>
            <div class="rt_sidebar pull-right">
                <div class="cont_artist">
                    <div class="slider_cnt">
                        <div class="slider-col">
                            <h2 class="heading_artist slider_hdng frst-hdng">Recently listened</h2>
                            <div id="owl-example" class="owl-carousel effect_img">
                                <div>
                                    <a href="">
                                        <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist1.jpg" alt=""></div>
                                        <div class="carousel-caption-custom">
                                            <p>Claim Snide</p>
                                            <span>My Time is now</span>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a href="">
                                        <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist2.jpg" alt=""></div>
                                        <div class="carousel-caption-custom">
                                            <p>Claim Snide</p>
                                            <span>My Time is now</span>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a href="">
                                        <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist3.jpg" alt=""></div>
                                        <div class="carousel-caption-custom">
                                            <p>Claim Snide</p>
                                            <span>My Time is now</span>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a href="">
                                        <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist4.jpg" alt=""></div>
                                        <div class="carousel-caption-custom">
                                            <p>Claim Snide</p>
                                            <span>My Time is now</span>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a href="">
                                        <div class="img_inner"><img src="<?php echo base_url(); ?>images/artist5.jpg" alt=""></div>
                                        <div class="carousel-caption-custom">
                                            <p>Claim Snide</p>
                                            <span>My Time is now</span>
                                        </div>
                                    </a>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="slider-col">
                            <h2 class="heading_artist slider_hdng">Recently Added</h2>
                            <div id="owl-example" class="owl-carousel effect_img">
							<?php $recentAddedData 	=	get_recently_added_music(); 
								if(!empty($recentAddedData)){
									foreach($recentAddedData as $getRecentData){
										$recentAddedfirst_name		=	$getRecentData['first_name'];
										$recentAddedlast_name		=	$getRecentData['last_name'];
										$recentAddedMusicId			=	$getRecentData['id'];
										$recentAddedArtistId		=	$getRecentData['artist_id'];
										$recentExMusic				=	explode(".", $getRecentData['watermark_format']);
										$recentMusicName			=	$recentExMusic['0'];
										$recentMusicFile			=	$getRecentData['watermark_format'];
										$recentArtistImg			=	$getRecentData['artist_image'];
										$setUrl						=	base_url()."artist_images/";
										if($recentArtistImg!=''){
											$addedArtistImgUrl	=	$setUrl.$recentArtistImg;
										}else{
											$addedArtistImgUrl	=	$setUrl."No_image.png";
										} ?>
								 <div>
                                    <a href="<?php echo base_url(); ?>dashboard/artist_music/<?php echo $recentAddedMusicId; ?>">
                                        <div class="img_inner"><img src="<?php echo base_url(); ?>timthumb.php?src=<?php echo $addedArtistImgUrl; ?>&h=183&w=363&zc=1q=100" alt="<?php echo $recentAddedfirst_name." ".$recentAddedlast_name; ?>" /></div>
                                        <div class="carousel-caption-custom">
                                            <p><?php echo $recentAddedfirst_name." ".$recentAddedlast_name; ?></p>
                                            <span><?php echo $recentMusicName; ?></span>
                                        </div>
                                    </a>
                                </div>
									<?php } }else{
										echo '<div> No data to display.</div>';
										}
									?>
                               
                               
                            </div>
                        </div>
                        <div class="slider-col">
                            <h2 class="heading_artist slider_hdng">Our Suggestions </h2>
							 <div id="owl-example" class="owl-carousel effect_img">
							<?php 
							$suggestArtistData	=	get_suggest_artist();	
							//echo "<pre>"; print_r($suggestArtistData); echo "</pre>"; 
							if(!empty($suggestArtistData)){
								foreach($suggestArtistData as $getSuggestArtists){
									$suggestArtistImg 			=	$getSuggestArtists['artist_image'];
									$suggestArtistId 			=	$getSuggestArtists['id'];
									$suggestArtistFirstName 	=	$getSuggestArtists['first_name'];
									$suggestArtistLastName 		=	$getSuggestArtists['last_name'];
									$setUrl						=	base_url()."artist_images/";
									if($suggestArtistImg!=''){
										$suggestArtistImgUrl	=	$setUrl.$suggestArtistImg;
									}else{
										$suggestArtistImgUrl	=	$setUrl."No_image.png";
									} ?>
									<div>
										<a href="<?php echo base_url(); ?>dashboard/artist/<?php echo $suggestArtistId; ?>">
										<div class="img_inner"><img src="<?php echo base_url(); ?>timthumb.php?src=<?php echo $suggestArtistImgUrl; ?>&h=183&w=363&zc=1q=100" alt="<?php echo $suggestArtistFirstName." ".$suggestArtistLastName; ?>" /></div>
											<div class="carousel-caption-custom">
												<p><?php echo $suggestArtistFirstName." ".$suggestArtistLastName; ?></p>
											</div>
										</a>
                                </div>
								<?php } }else{
									echo '<div> No data to display.</div>';
								}
							?>
                           
                            </div>
                        </div>

                        <div class="slider-col">
                            <h2 class="heading_artist slider_hdng">Followed artists</h2>
                            <div id="owl-example" class="owl-carousel effect_img">
							<?php $followArtsist	=	get_followed_artist_by_customer($customerId); 
								if(!empty($followArtsist)){
									foreach($followArtsist as $followData){
									$followtArtistImg 			=	$followData['artist_image'];
									$followArtistId 			=	$followData['id'];
									$followArtistFirstName 		=	$followData['first_name'];
									$followArtistLastName 		=	$followData['last_name'];
									$setUrl						=	base_url()."artist_images/";
									if($followtArtistImg!=''){
										$followArtistImgUrl	=	$setUrl.$followtArtistImg;
									}else{
										$followArtistImgUrl	=	$setUrl."No_image.png";
									} ?>
								<div>
									<a href="<?php echo base_url(); ?>dashboard/artist/<?php echo $followArtistId; ?>">
									<div class="img_inner"><img src="<?php echo base_url(); ?>timthumb.php?src=<?php echo $followArtistImgUrl; ?>&h=183&w=363&zc=1q=100" alt="<?php echo $followArtistFirstName." ".$followArtistLastName; ?>" /></div>
										<div class="carousel-caption-custom">
											<p><?php echo $followArtistFirstName." ".$followArtistLastName; ?></p>
										</div>
									</a>
								</div>
							<?php } }else {  echo '<div>No data to display.</div>'; } ?>
                           
                               
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.bxslider.js"></script>
        <script src="<?php echo base_url(); ?>js/toggle.js"></script>
        <script src="https://use.typekit.net/auo4nbe.js"></script>
        <script>
            try {
                Typekit.load({
                    async: true
                });
            } catch (e) {}
        </script>
        <script src="<?php echo base_url(); ?>js/wow.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.paginate.js"></script>
        <script src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
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
                margin: 0,
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


</body>

</html>