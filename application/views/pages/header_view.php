<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Martel:400,200,300,600,700,800,900' rel='stylesheet' type='text/css'>
</head>

<body>
    <header class="wow fadeInDown dashbrd">
        <div class="container-fluid">
            <div class="header_bottom text-center">
                <div class="logo_header">
                    <ul>
                        <li class="with_search">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/black-logo.png" alt=""></a>
                        </li>
                        <li class="lastt">
                            <button class="tgle" type="button" name="message" value="Hide" id="toggle-message"><img src="<?php echo base_url(); ?>images/search_icon.png" alt=""></button>
                            <input type="text" name="search" id="message" value="" />
                        </li>
                    </ul>
                </div>
                <div class="header_nav">
                    <div class="middle_footer">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>browse">Browse Music</a></li>
                        </ul>
                    </div>
                </div>
                <div class="create_account pull-right">
				<?php
				$this->load->library(array('ion_auth'));
				if (! $this->ion_auth->logged_in()){  ?>
					<ul>
                        <li><a href="<?php echo base_url(); ?>artist/register">Create Account</a></li>
                        <li><a href="<?php echo base_url(); ?>artist/login">Login</a></li>
                    </ul>
						<?php }else{ ?>
					 <ul>
						<li><a href="<?php echo base_url(); ?>artist/dashboard">Dashboard</a></li>
						<li> </li>
                    </ul>
				<?php } ?>
                   
                </div>
            </div>
        </div>
    </header>