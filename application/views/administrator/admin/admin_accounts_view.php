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
                <h2 class="pull-left"><?php echo $first_name." ".$last_name;  ?></h2>
                <h2 class="text-center">User Accounts</h3>
            </div>
         <div class="artist_draft_cont">
                <ul class="nav nav-tabs">
					<li><a data-toggle="tab" id="atrigger" href="#mnu1">Artists</a></li>
					 <li  class="active"><a data-toggle="tab" href="#mnu2">Customers</a></li>
                </ul>
				<?php echo $this->session->flashdata('message'); ?>
             <h2 class=" artst_drft_table">Account Detail</h2>
                <div class="tab-content">
                    <div id="mnu1" class="tab-pane fade in">
                        <div class="table-responsive">
                            <table id="artist_table" class="table">
							
                               <thead>
									<tr>
										 <th colspan="2">Name</th>
										<th>Signup Date</th>
										<th>Last Login</th>
										<th>Loaction</th>
										<th>No. of tracks</th>
										
										<th></th>
										<th></th>
									</tr>
							</thead>
							
							<tbody>
							<?php if(!empty($data['artists_accounts'])){ 
							
								foreach($data['artists_accounts']	as  $artistData){
									$artistID 			=	$artistData['id'];
									$ip_address 		=	$artistData['ip_address'];
									$artistUsername 	=	$artistData['username'];
									$artistPassword 	=	$artistData['password'];
									$artistEmail 		=	$artistData['email'];
									$created_on 		=	$artistData['created_on'];
									$last_login 		=	$artistData['last_login'];
									$artistFirstname 	=	$artistData['first_name'];
									$artistLastname 	=	$artistData['last_name'];
									$artistPublishDate	=  date("j F  Y", $created_on);
									$artistLastlogin	=	'';
									if($last_login!=''){
										$artistLastlogin	=	date("j F  Y", $last_login);
									}
									
									$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
									$addrDetailsArr = unserialize(file_get_contents($geopluginURL)); 
									$country = $addrDetailsArr['geoplugin_countryCode'];
									if(!$country){
									   $country='Not Define';
									}
									
							?>
							<tr>
								<td></td>
								<td class="input_chckbox table_padding width_input">
                                            <input type="checkbox" class="css-checkbox" id="input10">
                                            <label class="css-label lite-blue-check" for="input10"></label>
                                        </td>
                                        <td class="nme_user"><?php echo $artistFirstname." ".$artistLastname; ?></td>
                                        <td><?php echo $artistPublishDate; ?></td>
                                        <td><?php echo $artistLastlogin; ?></td>
                                        <td><?php echo $country; ?></td>
                                        <td><?php $trackCount =	get_trackcount($artistID); if($trackCount!=0){ echo $trackCount; }else{ echo '0'; }?></td>
                                        
                                        <td class="lst_data">
										<a href="<?php echo base_url(); ?>administrator/accounts/reset_password/<?php echo $artistID; ?>">Reset Password</a>
                                        </td>
								</tr>
								
							<?php } } else { ?>
							<tr>
								<td></td>
								<td></td>
                                <td></td>
                                <td></td>
                                <td>No Records found</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
							</tr>
							<?php } ?>							
							 </tbody>
                          </table>
                       </div>
                    </div>
					
                    <div id="mnu2" class="tab-pane fade in active">
                        <div class="table-responsive">
                            <table id="customer_table" class="table">
                                <thead>
                                    <tr>
										<th colspan="2">Name</th>
                                        <th>Signup Date</th>
                                        <th>Last Login</th>
                                        <th>Loaction</th>
                                        <th>Sale to Date</th>
										<th></th>
										<th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                 	<?php if(!empty($data['customer_accounts'])){ 
							//echo "<pre>";	print_r($data);  echo "</pre>";	
								foreach($data['customer_accounts']	as  $customerAccData){
									$customerID 		=	$customerAccData['id'];
									$ip_address 		=	$customerAccData['ip_address'];
									$customerUsername 	=	$customerAccData['username'];
									$customerPassword 	=	$customerAccData['password'];
									$customerEmail 		=	$customerAccData['email'];
									$created_on 		=	$customerAccData['created_on'];
									$last_login 		=	$customerAccData['last_login'];
									$customerFirstname 	=	$customerAccData['first_name'];
									$customerLastname 	=	$customerAccData['last_name'];
									$customerPublishDate=  date("j F  Y", $created_on);
									if($last_login!=''){
										$customerLastlogin	=	date("j F  Y", $last_login);
									}else{
										$customerLastlogin	=	'';
									}
									$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
									$addrDetailsArr = unserialize(file_get_contents($geopluginURL)); 
									$country = $addrDetailsArr['geoplugin_countryCode'];
									if(!$country){
									   $country='Not Define';
									}
									
							?>
                                <tr>
									<td></td>
                                        <td class="input_chckbox table_padding width_input">
                                            <input type="checkbox" class="css-checkbox" id="input15">
                                            <label class="css-label lite-blue-check" for="input15"></label>
                                        </td>
                                        <td class="nme_user"><?php echo $customerFirstname." ".$customerLastname; ?></td>
                                        <td><?php echo $customerPublishDate; ?></td>
                                        <td><?php echo $customerLastlogin; ?></td>
                                        <td><?php echo $country; ?></td>
                                      
                                        <td class="lst_data">
                                            <a href="<?php echo base_url(); ?>administrator/accounts/customer_reset_password/<?php echo $customerID; ?>">Reset Password</a>
                                        </td>
                                    </tr>
								<?php } }else{ ?>
									
								<tr>
								<td></td>
								<td></td>
                                <td></td>
                                <td></td>
                                <td>No Records found</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
							</tr>
								<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function(){
$( "#atrigger" ).trigger( "click" );
});
</script>
