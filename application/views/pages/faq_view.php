<div class="middle_content_inner wow fadeIn animated mrgn_srch">
        <div class="banner_image" style="background-image: url('<?php echo base_url(); ?>images/faq_banner.jpg');">
		<?php 
				$data = get_page_data_by_id(3);
				if(!empty($data)){
				foreach($data	as  $pagesData){
						$page_title 		=	$pagesData['page_title'];
						$page_content 		=	$pagesData['page_content'];
				?>
            <div class="content_banner_inner text-center">
                <h2><?php echo $page_title; ?></h2>
            </div>
        </div>
        <div class="contn_inner_pages">
            <div class="container">
                <div class="cntnt_info">
                   <?php echo $page_content; ?>
                </div>
				<?php } }else{
					echo 'No data';
				} ?>
            </div>
        </div>
    </div>
 