<h1 class="title_lic jrnl_title">JOURNAL</h1>
 <?php 
 if(!empty($data)){
	foreach($data as $getPageData){
		$post_title   			=   $getPageData['post_title'];
		$post_image_name   		=   $getPageData['post_image_name'];
		$image_text   			=   $getPageData['image_text'];
		$short_desc   			=   $getPageData['short_desc'];
		$long_content   		=   $getPageData['long_content'];
		$post_date   			=   $getPageData['post_date'];
		$modifyDate				= 	strtotime($post_date);
		$publishDate	=  date('j F  Y', $modifyDate);
	?>

  <h2 class="date_jrnl text-center"><?php echo $publishDate; ?></h2>
    <div class="banner_image wow fadeIn animated mrgn_srch jrnl_bnr" style="background-image: url('<?php echo base_url(); ?>post_images/<?php echo $post_image_name; ?>');">
        <div class="content_banner_inner text-center">
            <h2><?php echo $post_title; ?></h2>
            <p><?php echo $image_text; ?></p>
        </div>
    </div>
    <div class="content_inner_page">
        <div class="container">
            <div class="jounal_page">
                <p><?php echo $short_desc; ?></p>
            </div>
        </div>
    </div>

	<?php } } else{ echo "No data found"; } ?> 