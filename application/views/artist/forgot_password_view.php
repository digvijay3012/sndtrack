<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forgot Password</title>
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
				$attributes = array('class' => 'login_form');
				echo form_open('artist/forgot_password', $attributes); ?>			
            <ul>
                <li>
				
                    <input type="text"  name="identity" placeholder="Email address">
					<?php  echo form_error('identity'); ?>
                </li>
                
                <li>
                    <button class="custom-button full-width" type="submit" id="send" name="submit" required="">Submit</button>
                    
                </li>
            </ul>
        <?php echo form_close();?>
    </div>

    <script src="https://use.typekit.net/auo4nbe.js"></script>
    <script>
        try {
            Typekit.load({
                async: true
            });
        } catch (e) {}
    </script>
   
</body>

</html>