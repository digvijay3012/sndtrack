<?php
$ArtistData	=	$this->ion_auth->user()->row();
if(!empty($ArtistData)){
	$artistID 		=		$ArtistData->user_id;
	$artistEmail 	=		$ArtistData->email;
	$first_name 	=		$ArtistData->first_name;
	$last_name 		=		$ArtistData->last_name;
}
?>
<div class="dashboard_cont">
        <div class="container">
            <div class="welcom_strip tex-center">
                <h2 class="pull-left"><?php echo $first_name." ".$last_name; ?></h2>
                <h2 class="text-center">Welcome</h3>
            </div>
            <p class="note_dash text-center">Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
            <div class="btns_dashbord">
                <ul>
                    <li><a href="<?php echo base_url(); ?>artist/earning">Earnings</a></li>
					 <li><a href="<?php echo base_url(); ?>artist/music">Your Music</a></li>
					<li><a href="<?php echo base_url(); ?>artist/payout">Payout Form</a></li> 
                </ul>
            </div>
        </div>
    </div>
   