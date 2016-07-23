<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact</title>
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
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
</head>

<body>
    <div class="login_cont text-center">
        <div class="logo text-center wow fadeInDown">
            <a href="<?php echo base_url(); ?>">
                <p>Sndtrack</p>
                <span>music licensing</span>
            </a>
        </div>
        <div class="login_text">
            <p>Sndtrack is a musician led creative team based in London.</p>
            <p>We understand that at the heart of every great film should be great music.</p>
        </div>
		<div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
			<?php 
				$attributes = array('class' => 'login_form', 'id' => 'contact_form', 'name' => 'contact_form');
				echo form_open_multipart('contact', $attributes); 
			?>
            <ul>
                <li>
                    <input type="text" name="first_name" placeholder="First Name" >
					<?php  echo form_error('first_name'); ?>
                </li>
                <li>
                    <input type="text"  name="last_name" placeholder="Last Name">
					<?php  echo form_error('last_name'); ?>
                </li>
                <li>
                    <input type="text" name="email" placeholder="Email address">
					<?php  echo form_error('email'); ?>
                </li>
                <li>
                    <select>
                        <option>Topic</option>
                        <option>Topic 2</option>
                        <option>Topic 3</option>
                    </select>
                </li>
                <li>
                    <textarea name="message" placeholder="Message"></textarea>
					<?php  echo form_error('message'); ?>
                </li>
				<li>
				<div class="g-recaptcha" name="recaptcha" id="recaptcha" data-sitekey="6LfotyUTAAAAAFrNWYsnLEn5qW7pdjMKXOTTBBIv"></div>
				</li>
                <li>
                    <button class="custom-button full-width" type="submit" id="Login" name="submit" required="">Send</button>
                </li>
            </ul>
         <?php echo form_close();?>
    </div>
    <footer>
        <div class="container-fluid">
            <div class="footer_logo">
                <ul>
                    <li>
                        <a href="<?php echo base_url(); ?>"><img src="images/black-logo.png" alt=""></a>
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
                    <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
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
<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script src="https://use.typekit.net/auo4nbe.js"></script>
<script>
	try {
		Typekit.load({
			async: true
		});
	} catch (e) {}
</script>
<script>
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#contact_form").validate({
                rules: {
					first_name: "required",
                    last_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    message: "required"
                },
                messages: {
                    first_name: "Please select your first name.",
                    last_name: "Please select your last name.",
					email: "Please enter valid email.",
                    message: "Please enter your message.",
					
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
$( document ).ready(function() {
$("#contact_form").bind('blur keydown focusout', function(){ 

        var dataArray = $("#contact_form").serializeArray(),
        dataObj = {};
        console.dir(dataArray); //require firebug
        //console.log(dataArray);

        $(dataArray).each(function(i, field){
          dataObj[field.name] = field.value;
        });

        var recaptcha = (dataObj['g-recaptcha-response']);

        if(recaptcha != "") {
                $( "#temp" ).remove();
        }       
    });

    $( ".custom-button" ).click(function() {

        var dataArray = $("#contact_form").serializeArray(),
            dataObj = {};
            console.dir(dataArray); //require firebug
            //console.log(dataArray);

        $(dataArray).each(function(i, field){
          dataObj[field.name] = field.value;
        });

        var recaptcha = (dataObj['g-recaptcha-response']);

        $( "#temp" ).remove();

            if(recaptcha == "") {
                $("#recaptcha").append('<label id="temp" style="color:red;line-height:normal;font-size: small;">This field is required.</label>');
            }

    });             

});
</script>
 <script src='https://www.google.com/recaptcha/api.js'></script>  
</body>

</html>