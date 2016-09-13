<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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
	<link href="<?php echo base_url(); ?>/floraa/css/froala_editor.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="login_cont text-center">
	
        <div class="logo text-center wow fadeInDown animated">
            <a href="<?php echo base_url(); ?>">
                <p>Sndtrack</p>
                <span>music licensing</span>
            </a>
        </div>
      
		<div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
         <?php 
			if(!empty($page_data)){
				foreach($page_data as $getPostData){
					$postId				=	$getPostData['id'];
					$image_1			=	$getPostData['image_1'];
					$text_1				=	$getPostData['text_1'];
					$text_2				=	$getPostData['text_2'];
					$text_3				=	$getPostData['text_3'];
					
				}
			}else{
					$postId				=	'';
					$image_1			=	'';
					$text_1				=	'';
					$text_2				=	'';
					$text_3				=	'';
			}
		?>
		<?php
		$attributes = array('class' => 'login_form', 'id' => 'journal_form');
		echo form_open_multipart('administrator/pages/edit_home_page', $attributes); ?>
		<ul>
			
			<li>
				<?php 
				 if($image_1 !=''){
					echo '<span class="style-post-cls"><img src="'.base_url().'post_images/'.$image_1.'" alt="Smiley face" height="100" width="300"></span>';
				} 
				?>
			</li>
			<li>
			
				Uplaod backgound image: <input type="file" id="image_1" class="mycls" name="image_1">
		
				<input type="hidden" name="page_id"  value="<?php echo $postId; ?>">
			</li>
			<li>
			<input type="text" name="text_1" placeholder="Image Text" maxlength="100" value="<?php echo $text_1; ?>">
			</li>
			<li>
				<textarea name="text_2" class="edit"><?php echo $text_2; ?></textarea>
			 </li>
			 <li>
				<textarea name="text_3" class="edit"><?php echo $text_3; ?></textarea>
			 </li>
		 </ul>
		 <li>
			<button name="submit" id="send" type="submit" class="custom-button full-width">Save</button>
       </li>
		<?php echo form_close();?>
    </div>
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert.css">
	<script src="<?php echo base_url(); ?>js/sweetalert.min.js"></script>
    <script src="https://use.typekit.net/auo4nbe.js"></script>
    <script>
        try {
            Typekit.load({
                async: true
            });
        } catch (e) {}
    </script>
 <script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
   <script src="<?php echo base_url(); ?>/floraa/js/froala_editor.min.js"></script>
  <!--[if lt IE 9]>
    <script src="../js/froala_editor_ie8.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/tables.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/urls.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/lists.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/colors.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/font_family.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/font_size.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/block_styles.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/media_manager.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/video.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/char_counter.min.js"></script>
  <script src="<?php echo base_url(); ?>/floraa/js/plugins/entities.min.js"></script>

  <script>
      $(function(){
        $('.edit').editable({
		
		colorsStep: 20,
		countCharacters: true,
		inlineMode: false,
		height: 500,
		width: 600		
		//initOnClick:true 
		});
		
		
      });
  </script>

</body>

</html>