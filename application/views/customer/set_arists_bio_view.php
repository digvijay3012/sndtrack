 <?php 
 function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }
	if(!empty($data)){
		foreach($data as $getData){
			$artistId				=	$getData['id'];	
			$first_name				=	$getData['first_name'];	
			$last_name				=	$getData['last_name'];	
			$artist_image			=	$getData['artist_image'];	
			$artist_bio				=	$getData['artist_bio'];	
		?>
			 <div class="browse-right-box">
			<h3><?php echo $first_name." ".$last_name; ?></h3>
			<?php if($artist_image !=''){
				echo '<figure><img src="'.base_url().'artist_images/'.$artist_image.'" alt="'.$first_name.'" title=""></figure>';
			}
			?>
			
			<p><?php echo limit_text($artist_bio, 100)  ?></p>
			<a href="<?php echo base_url(); ?>dashboard/artist/<?php echo $artistId; ?>" class="btn-trns ">More from this Artist</a>
			</div>
	<?php }}else{
		echo "No data";
	}
	?>