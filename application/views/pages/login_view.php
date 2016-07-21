<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
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
        <div class="logo text-center wow fadeInDown animated">
            <a href="<?php echo base_url(); ?>">
                <p>Sndtrack</p>
                <span>music licensing</span>
            </a>
        </div>
        <div class="login_text">
            <p>Sndtrack is a musician led creative team based in London.</p>
            <p>We understand that at the heart of every great film should be great music.</p>
        </div>
       	<div id="infoMessage"><?php echo $message;?></div>
          <?php
				$attributes = array('class' => 'login_form', 'id' => 'login_form');
				echo form_open('login', $attributes); ?>			
            <ul>
                <li>
				<?php  /*  echo "hhhhhh".$userId = $this->ion_auth->get_user_id(); 
						echo "<pre>";
						print_r($_SESSION);
						echo "</pre>"; */
				?>
                    <input type="text"  name="identity" placeholder="Email address">
					<?php  echo form_error('identity'); ?>
                </li>
                <li>
                    <input type="password"  name="password" placeholder="Password">
					<?php  echo form_error('password'); ?>
                </li>
                <li>
                    <button class="custom-button full-width" type="submit" id="send" name="submit" required="">Login</button>
                    <a href="<?php echo base_url(); ?>artist/forgot_password" class="forgot">forgot password</a>
                </li>
            </ul>
        <?php echo form_close();?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.bxslider.js"></script>
    <script src="https://use.typekit.net/auo4nbe.js"></script>
    <script>
        try {
            Typekit.load({
                async: true
            });
        } catch (e) {}
    </script>
  
 <script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
   <script>
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#login_form").validate({
                rules: {
					identity: "required",
					password: "required"
					
                },
                messages: {
                    identity: "Please enter your email.",
					password: "Please enter your password."
					
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
   
</body>

</html>