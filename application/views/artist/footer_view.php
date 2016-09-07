 <footer>
        <div class="container-fluid">
            <div class="footer_logo">
                <ul>
                    <li>
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/black-logo.png" alt="logo"></a>
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
                    <li><a href=""><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i aria-hidden="true" class="fa fa-instagram"></i></a></li>
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
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css"/>
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
        $('.bxslider').bxSlider({
            minSlides: 3,
            maxSlides: 4,
            slideWidth: 365,
            slideMargin: 30
        });
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
	  <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
        <script type="text/javascript">
				// When the document is ready
			$( function() {
				$( "#from_datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
				$( "#to_datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
			} );
        </script>	
</body>

</html>