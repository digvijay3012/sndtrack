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
                        <li><a href="">Artists</a></li>
                        <li><a href="">Songs</a></li>
                    </ul>
                </div>
                <div class="searchh your_music">
                    <h3 class="rt_hdng"> SEARCH</h3>
                    <div class="panel-group user_acc" id="accordion">
                        <div class="panel panel-default">
                            <h3 class="rt_hdng"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Mood</a></h3>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="">Angst</a></li>
                                        <li><a href="">Chilled</a></li>
                                        <li><a href="">Quiet</a></li>
                                        <li><a href="">Series</a></li>
                                        <li><a href="">Tense</a></li>
                                        <li><a href="">Thoughful</a></li>
                                        <li><a href="">Thrilled</a></li>
                                        <li><a href="">Upset</a></li>
                                        <li><a href="">Uplisting</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <h3 class="rt_hdng"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Energy </a></h3>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body"><img src="images/music_level.jpg" alt=""></div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <h3 class="rt_hdng"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Instruments </a> </h3>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="">Angst</a></li>
                                        <li><a href="">Chilled</a></li>
                                        <li><a href="">Quiet</a></li>
                                        <li><a href="">Series</a></li>
                                        <li><a href="">Tense</a></li>
                                        <li><a href="">Thoughful</a></li>
                                        <li><a href="">Thrilled</a></li>
                                        <li><a href="">Upset</a></li>
                                        <li><a href="">Uplisting</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <h3 class="rt_hdng"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsefv">Genre</a></h3>
                            <div id="collapsefv" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="">Angst</a></li>
                                        <li><a href="">Chilled</a></li>
                                        <li><a href="">Quiet</a></li>
                                        <li><a href="">Series</a></li>
                                        <li><a href="">Tense</a></li>
                                        <li><a href="">Thoughful</a></li>
                                        <li><a href="">Thrilled</a></li>
                                        <li><a href="">Upset</a></li>
                                        <li><a href="">Uplisting</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <h3 class="rt_hdng"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsefour">Artists</a></h3>
                            <div id="collapsefour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="">Angst</a></li>
                                        <li><a href="">Chilled</a></li>
                                        <li><a href="">Quiet</a></li>
                                        <li><a href="">Series</a></li>
                                        <li><a href="">Tense</a></li>
                                        <li><a href="">Thoughful</a></li>
                                        <li><a href="">Thrilled</a></li>
                                        <li><a href="">Upset</a></li>
                                        <li><a href="">Uplisting</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <h3 class="rt_hdng"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsefour">Instrumental</a><input type="checkbox"></h3>
                            <div id="collapsefour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="">Angst</a></li>
                                        <li><a href="">Chilled</a></li>
                                        <li><a href="">Quiet</a></li>
                                        <li><a href="">Series</a></li>
                                        <li><a href="">Tense</a></li>
                                        <li><a href="">Thoughful</a></li>
                                        <li><a href="">Thrilled</a></li>
                                        <li><a href="">Upset</a></li>
                                        <li><a href="">Uplisting</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <h3 class="rt_hdng"> <a class="accordion-toggle" contextmenu=""href="#">Vocal</a></h3>
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
            <div class="rt_sidebar art_browse">
                <div class="cont_artist">
                    <div class="lft_playlist pull-left">
                        <ul>
                            <li>
                                <img src="<?php echo base_url(); ?>images/play_list.png" alt="">
                            </li>
                        </ul>
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


        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.bxslider.js"></script>
        <script src="<?php echo base_url(); ?>js/toggle.js"></script>
        <script src="<?php echo base_url(); ?>js/wow.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.paginate.js"></script>
        <script src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
        <script src="https://use.typekit.net/auo4nbe.js"></script>
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

</body>

</html>