<div class="middle_content_inner mrgn_srch">
        <div class="contn_inner_pages">
            <div class="container">
			<?php 
				$data = get_page_data_by_id(4);
				if(!empty($data)){
				foreach($data	as  $pagesData){
						$page_title 		=	$pagesData['page_title'];
						$page_content 		=	$pagesData['page_content'];
				?>
                <h1 class="title_lic"><?php echo $page_title; ?></h1>
                <div class="cntnt_info">
                   <?php echo $page_content; ?>
                </div>
				<?php } }else{
					echo 'No data';
				} ?>
                <div class="brdr_bottom btm"></div>
            </div>
        </div>
    </div>
 