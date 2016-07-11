<?php
$AdminData	=	$this->ion_auth->user()->row();
if(!empty($AdminData)){
	$adminID 		=		$AdminData->user_id;
	$adminEmail 	=		$AdminData->email;
	$first_name 	=		$AdminData->first_name;
	$last_name 		=		$AdminData->last_name;
}
?>
<div class="dashboard_cont">
        <div class="container">
            <div class="welcom_strip tex-center">
                <h2 class="pull-left"><?php echo $first_name." ".$last_name; ?></h2>
                <h2 class="text-center">Sndtrack Admin</h2>
            </div>
            <p class="note_dash text-center">Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
            <div class="btns_dashbord">
                <ul>
                    <li><a href="">Sales</a></li>
                    <li><a href="">Statistics</a></li>
                    <li><a href="">Accounts</a></li>
                </ul>
            </div>
        </div>
</div>
