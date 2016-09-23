<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sndtrack</title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo base_url(); ?>images/favicons/manifest.json">
    <link rel="mask-icon" href="<?php echo base_url(); ?>images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>images/favicons/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/owl.carousel.css">
</head>

<body>
<?php
$UserData	=	$this->ion_auth->user()->row();
if(!empty($UserData)){
	$userID 		=		$UserData->user_id;
}
?>
<?php 
	$data = get_home_page_data(5);
	if(!empty($data)){
	foreach($data	as  $pagesData){
			$image_1 		=	$pagesData['image_1'];
			$text_1 		=	$pagesData['text_1'];
			$text_2 		=	$pagesData['text_2'];
			$text_3 		=	$pagesData['text_3'];
	}}else{
		$image_1 		=	'';
		$text_1 		=	'';
		$text_2 		=	'';
		$text_3 		=	'';
	}?>
    <div class="se-pre-con"></div>
    <div class="top_header" style="background-image:url('<?php echo base_url(); ?>post_images/<?php echo $image_1; ?>')">
        <header class="wow fadeInDown">
            <div class="container-fluid">
                <div class="create_account pull-right">
				<?php if (! $this->ion_auth->logged_in()){  ?>
					<ul>
                        <li><a href="<?php echo base_url(); ?>register">Create Account</a></li>
                        <li><a href="<?php echo base_url(); ?>login">Login</a></li>
                    </ul>
						<?php }else{
							echo '<ul>';
							$user_groups = $this->ion_auth->get_users_groups($userID)->result();
							$userGroupId = $user_groups[0]->id;
							 if($userGroupId==1){
							echo '<li><a href="'.base_url().'administrator/dashboard">Dashboard</a></li>
									<li><a href="'.base_url().'logout">Logout</a> </li>';
									
							}elseif($userGroupId==2){
									echo '<li><a href="'.base_url().'administrator/dashboard">Dashboard</a></li>
									<li><a href="'.base_url().'logout">Logout</a> </li>';
								
							}elseif($userGroupId==3){
								echo '<li><a href="'.base_url().'artist/dashboard">Dashboard</a></li>
									<li><a href="'.base_url().'logout">Logout</a> </li>';
								
							}elseif($userGroupId==4){
								echo '<li><a href="'.base_url().'dashboard">Dashboard</a></li>
									<li><a href="'.base_url().'logout">Logout</a> </li>';
							
							}else{
								/* $logout = $this->ion_auth->logout();
								redirect('login', 'refresh'); */
							}
						?>
					
						
                    </ul>
						<?php } ?>	
                   
                </div>
                <div class="logo text-center">
                    <a href="<?php echo base_url(); ?>">
                        <p>Sndtrack</p>
                        <span>music licensing</span>
                    </a>
                </div>
            </div>
        </header>
        <div class="banner_top  wow fadeIn ">
            <div class="container">
                <div class="text-center content_banner">
                    <div class="banner_cont">
                        <div class="music_for">
                            <p><?php echo $text_1; ?></p>
                        </div>
                        <div class="banner_input">
                            <a class="custom-button" href="<?php echo base_url(); ?>browse">Browse music</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle_content text-center ">
        <div class="container">
          <?php echo $text_2; ?>

        </div>
    </div>
<?php
$getSingleArtist 	=	get_homepage_featured_artist();
$artist_image		=	$getSingleArtist->artist_image;
$featuredArtistId	=	$getSingleArtist->id;
?>
   <div class="banner_bottom wow fadeInUp animated" style="background-image:url('<?php echo base_url(); ?>artist_images/<?php echo $artist_image; ?>')">
        <div class="container">
            <div class="left_content">
                <div class="claim_snide">
                    <a href="<?php echo base_url(); ?>dashboard/artist_music/<?php echo $featuredArtistId; ?>">
							<?php echo $getSingleArtist->first_name." ".$getSingleArtist->last_name; ?>
						</a>
                </div>
                <p>Featured Artist</p>
            </div>
        </div>
    </div>

    <div class="trending_cont wow fadeInUp animated">
        <div class="container">
            <div class="slider_boot pdng_inr">
                <h2>Trending</h2>
                <div class="carousel slide">
                    <div class="flexslider1 carousel">
                        <ul class="bxslider slides">
						<?php $gethomepageTrendingArtist = get_homepage_trending_artist(); 
						$trackCounter='';
						//echo "<pre>";	print_r($homepageTrendingArtist);		echo "</pre>";
						if(!empty($gethomepageTrendingArtist)){
							foreach($gethomepageTrendingArtist as $homepageTrendingArtist){
								$trendingArtistId	=	 $homepageTrendingArtist['id'];
								$trendingFname		=	 $homepageTrendingArtist['first_name'];
								$trendingLname		=	 $homepageTrendingArtist['last_name'];
								$trendingArtimg		=	 $homepageTrendingArtist['artist_image'];
								$musicFormat		=	 $homepageTrendingArtist['watermark_format'];
								$setUrl				=	base_url()."artist_images/";
								$musicFileUrl		=	base_url()."music/";
								if($trendingArtimg!=''){
									$trendingArtistImgUrl	=	$setUrl.$trendingArtimg;
								}else{
									$trendingArtistImgUrl	=	$setUrl."No_image.png";
								}
								$musicFile		= 	$musicFileUrl.$musicFormat;
								$trackCounter++;
						?>
                            <li>
                                <div class="carousel-inner">
                                    <!-- Slide -->
                                    <div class="item active">
                                        <div class="frst_clmn">
                                            <a href="">
                                                <div class="img_inner"><img src="<?php echo base_url(); ?>timthumb.php?src=<?php echo $trendingArtistImgUrl; ?>&h=183&w=366&zc=1q=100" alt="<?php echo $trendingFname." ".$trendingLname; ?>" /></div>
                                                <div class="carousel-caption-custom">
                                                    <p><?php echo $trendingFname." ".$trendingLname; ?></p><span>My Time is now</span>
													
                                            </a>
											<!--<div class="play" id="btn<?php echo $trackCounter; ?>"><img src="<?php echo base_url(); ?>images/play.png" alt=""></div>-->
										</div>
											<audio id="sound<?php echo $trackCounter; ?>">
												<source src="<?php echo $musicFile; ?>" type="audio/mp3" />
											</audio>
                                        </div>
                                       
                                    </div>
                                </div>
                            </li>
						<?php }}else{
							echo "No record found.";
						} ?>
                          
                        </ul>
                    </div>
                </div>
                <!--div class="botm_brdr"></div-->
            </div>
        </div>
    </div>


    <div class="playlist_cont wow fadeInUp animated">
        <div class="container">
            <div class="pdng_inr">
                <h2>Playlists</h2>
                <div class="flexslider carousel">
                    <ul class="bxslider slides">
					<?php $getPlaylist 	=	get_homePage_playlist();
							if(!empty($getPlaylist)){
								foreach($getPlaylist as $fetchPlyalist){
									$playlistId			=	$fetchPlyalist['id'];
									$playlistName		=	$fetchPlyalist['playlist_name'];
									$customer_id		=	$fetchPlyalist['customer_id'];
								?>
                        <li>
                            <div class="inner_slider">
                                <img src="<?php echo base_url(); ?>images/bx_slider1 (1).jpg" />
                                <div class="content_slider">
                                    <span><a href="<?php echo base_url(); ?>playlist/view/<?php echo $customer_id; ?>"><?php echo $playlistName; ?></a></span>
                                </div>
                            </div>
                        </li>
                      <?php } }else{
						  echo '<li>No record found.</li>';
					  } ?>
                    </ul>
                </div>

            </div>
        </div>

    </div>
    <!--div class="botm_brdr middlee"></div-->
    <div class="news_letr_cont">
        <div class="container">
            <div class="lft_prt">
                <div class="pull-left news_content">
                    <h2>Relevant News & offers</h2>
                    <div class="input_mail">
                        <input type="text" placeholder="Email">
                        <button type="" class="custom-button">Subscribe</button>
                    </div>
                </div>
            </div>
            <div class="rt_prt">
                <div class="news_ltr_text pull-right">
                    <?php echo $text_3; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="bespoke_cont text-center wow fadeIn animated" style="background-image:url(images/bespoke_banner.jpg)">
        <div class="inr_bspok">
            <h2>bespoke</h2>
            <p>Need a custom score ? We can do this for you.</p>
            <a href="<?php echo base_url(); ?>contact" class="custom-button">Get in touch</a>
        </div>
    </div>

    <footer>
        <div class="container-fluid">
            <div class="footer_logo">
                <ul>
                    <li class="footer-logo-img">
                        <a href="index.html"><img src="images/black-logo.png" alt=""></a>
                    </li>
                    <li>
                        <p>2016</p>
                    </li>
                </ul>
            </div>
            <div class="middle_footer">
                <ul>
                      <li><a href="<?php echo base_url(); ?>browse">Browse</a></li>
                    <li><a href="<?php echo base_url(); ?>journal">Journal</a></li>
                    <li><a href="<?php echo base_url(); ?>contact">Contact</a></li>
                </ul>
              <ul class="social_icons">
                    <li><a href="https://www.facebook.com/" target="_blank"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com" target="_blank"><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com" target="_blank"><i aria-hidden="true" class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="footer_nav">
                <ul>
                   <li><a href="<?php echo base_url(); ?>private_policy">Private</a></li>
                    <li><a href="<?php echo base_url(); ?>licence_terms">License Terms</a></li>
                    <li><a href="<?php echo base_url(); ?>faq">FAQ</a></li>
                    <li><a href="<?php echo base_url(); ?>Terms_and_conditions">Terms &amp; Conditions</a></li>

                </ul>
            </div>

        </div>
    </footer>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/wow.js"></script>
    <script defer src="<?php echo base_url(); ?>js/jquery.flexslider.js"></script>
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
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: true,
            live: true,
            callback: function (box) {},
            scrollContainer: null
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

            if ($(this).scrollTop() > 100) {
                $('header').addClass('off-canvas');
            } else {
                $('header').removeClass('off-canvas');
            }
        });
    </script>
    <script>
        (function () {


            var $window = $(window),
                flexslider = {
                    vars: {}
                };


            function getGridSize() {
                return (window.innerWidth > 1600) ? 5 :
                    (window.innerWidth < 600) ? 2 :
                    (window.innerWidth < 900) ? 3 : 4;

            }

            $(function () {
                SyntaxHighlighter.all();
            });

            $window.load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    animationLoop: false,
                    itemWidth: 220,
                    itemMargin: 10,
                    slideshowSpeed: 10000,
                    animationSpeed: 1000,
                    touch: true,
                    mousewheel: false,
                    minItems: getGridSize(),
                    maxItems: getGridSize()
                });
            });


            $window.resize(function () {
                var gridSize = getGridSize();

                flexslider.vars.minItems = gridSize;
                flexslider.vars.maxItems = gridSize;
            });
        }());
    </script>
    <script>
        (function () {


            var $window = $(window),
                flexslider = {
                    vars: {}
                };


            function getGridSize() {
                return (window.innerWidth < 600) ? 2 :
                    (window.innerWidth < 900) ? 3 : 4;

            }

            $(function () {
                SyntaxHighlighter.all();
            });

            $window.load(function () {
                $('.flexslider1').flexslider({
                    animation: "slide",
                    animationLoop: false,
                    itemWidth: 220,
                    itemMargin: 0,
                    slideshowSpeed: 10000,
                    touch: true,
                    animationSpeed: 1000,
                    mousewheel: false,
                    minItems: getGridSize(),
                    maxItems: getGridSize()
                });
            });


            $window.resize(function () {
                var gridSize = getGridSize();

                flexslider.vars.minItems = gridSize;
                flexslider.vars.maxItems = gridSize;
            });
        }());
    </script>
    <script>
        $(window).load(function () {
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
<script>
$('.play').click(function(){
	
    var $this = $(this);
    var id = $this.attr('id').replace(/btn/, '');
	
    $this.toggleClass('active');
    if($this.hasClass('active')){
		
        $this.html('pause'); 
		
        $('audio[id^="sound"]')[id-1].play();        
    } else {
        $this.html('<img alt="" src="<?php echo base_url(); ?>images/play.png">');
		
        $('audio[id^="sound"]')[id-1].pause();
    }
});
</script>
</body>

</html>