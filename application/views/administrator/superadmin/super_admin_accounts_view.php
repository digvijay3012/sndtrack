<?php
$adminData	=	$this->ion_auth->user()->row();
if(!empty($adminData)){
	$superAdminID 	=		$adminData->id;
	$adminEmail 	=		$adminData->email;
	$first_name 	=		$adminData->first_name;
	$last_name 		=		$adminData->last_name;
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
					<li class="active"><a data-toggle="tab" href="#mnu3">Admins</a></li>
                    <li><a data-toggle="tab" href="#mnu1">Artists</a></li>
					 <li><a data-toggle="tab" href="#mnu2">Customers</a></li>
                </ul>
				<?php echo $this->session->flashdata('message'); ?>
             <h2 class="artst_drft_table">Account Detail</h2>
			
			 <div id="stuts-msg"></div>
                <div class="tab-content">
                    <div id="mnu1" class="tab-pane fade in">
					<div style="display:none" class="set_arists_status">
						<img src="<?php echo base_url(); ?>images/uploading.gif">
					</div>
                        <div class="table-responsive">
                            <table id="artist_table" class="table">
							
                               <thead>
									<tr>
										 <th colspan="2">Name</th>
										<th>Signup Date</th>
										<th>Last Login</th>
										<th>Loaction</th>
										<th>No. of tracks</th>
										<th>Artist Type</th>
										<th></th>
										<th></th>
									</tr>
							</thead>
							
							<tbody>
							<?php if(!empty($data['artists_accounts'])){
								$counterFlag	=	'';	
							//echo "<pre>";	print_r($data['artists_accounts']);  echo "</pre>";	 die;
								foreach($data['artists_accounts']	as  $artistData){
									$artistID 			=	$artistData['id'];
									$artist_type 			=	$artistData['artist_type'];
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
								$counterFlag++;	
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
                                        <td><input class="radio-artist-cls" pid="<?php echo $artistID; ?>" type="radio" name="artist_type_<?php echo $counterFlag; ?>" value="feautred" <?php if($artist_type=='feautred'){ echo 'checked'; } ?>> feautred
										<input type="radio" class="radio-artist-cls" pid="<?php echo $artistID; ?>" name="artist_type_<?php echo $counterFlag; ?>" value="trending" <?php if($artist_type=='trending'){ echo 'checked'; } ?>> trending
										</td>
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
					<div id="mnu3" class="tab-pane fade in active">
                        <div class="table-responsive">
                            <table id="admin_table" class="table">
							
                               <thead>
									<tr>
										 <th colspan="2">Name</th>
										<th>Signup Date</th>
										<th>Last Login</th>
										<th>Loaction</th>
										
										<th></th>
										<th></th>
									</tr>
							</thead>
							
							<tbody>
							<?php if(!empty($data['admin_accounts'])){ 
							//echo "<pre>";	print_r($data);  echo "</pre>";	
								foreach($data['admin_accounts']	as  $adminAccData){
									$adminID 			=	$adminAccData['id'];
									$ip_address 		=	$adminAccData['ip_address'];
									$adminUsername 		=	$adminAccData['username'];
									$adminPassword 		=	$adminAccData['password'];
									$adminEmail 		=	$adminAccData['email'];
									$created_on 		=	$adminAccData['created_on'];
									$last_login 		=	$adminAccData['last_login'];
									$adminFirstname 	=	$adminAccData['first_name'];
									$adminLastname 		=	$adminAccData['last_name'];
									$adminPublishDate	=  date("j F  Y", $created_on);
									if($last_login!=''){
										$adminLastlogin	=	date("j F  Y", $last_login);
									}else{
										$adminLastlogin	=	'';
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
                                        <td class="nme_user"><?php echo $adminFirstname." ".$adminLastname; ?></td>
                                        <td><?php echo $adminPublishDate; ?></td>
                                        <td><?php echo $adminLastlogin; ?></td>
                                        <td><?php echo $country; ?></td>
                                       
                                        <td class="lst_data">
										<a href="<?php echo base_url(); ?>administrator/accounts/reset_password/<?php echo $adminID; ?>">Reset Password</a>
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
                                    <tr>
									<td></td>
                                        <td class="input_chckbox table_padding width_input">
                                            <input type="checkbox" class="css-checkbox" id="input13">
                                            <label class="css-label lite-blue-check" for="input13"></label>
                                        </td>
                                        <td class="nme_user">Kurt Ville</td>
                                        <td>21 January 2016</td>
                                        <td>28 Jan 2016</td>
                                        <td>UK</td>
                                        <td>3,882</td>
                                        <td class="lst_data">
                                            <a href="">Reset Password</a>
                                        </td>
                                    </tr>
                                    <tr>
									<td></td>
                                        <td class="input_chckbox table_padding width_input">
                                            <input type="checkbox" class="css-checkbox" id="input14">
                                            <label class="css-label lite-blue-check" for="input14"></label>
                                        </td>
                                        <td class="nme_user">Kurt Ville</td>
                                        <td>21 January 2016</td>
                                        <td>28 Jan 2016</td>
                                        <td>UK</td>
                                        <td>3,882</td>
                                        <td class="lst_data">
                                            <a href="">Reset Password</a>
                                        </td>
                                    </tr>
                                    <tr>
									<td></td>
                                        <td class="input_chckbox table_padding width_input">
                                            <input type="checkbox" class="css-checkbox" id="input15">
                                            <label class="css-label lite-blue-check" for="input15"></label>
                                        </td>
                                        <td class="nme_user">Kurt Ville</td>
                                        <td>21 January 2016</td>
                                        <td>28 Jan 2016</td>
                                        <td>UK</td>
                                        <td>3,882</td>
                                        <td class="lst_data">
                                            <a href="">Reset Password</a>
                                        </td>
                                    </tr>
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
$('.radio-artist-cls').click(function(){
    if ($(this).is(':checked'))
    {
		var pid = $(this).attr('pid');
	
	  var url 		=	'<?php echo base_url(); ?>administrator/artist/set_artist_type';
      var artist_type =	$(this).val();
	  
	  var adminID	=	'<?php echo $superAdminID; ?>';
	  $('.set_arists_status').show();
	  $.ajax({
        url: url,
		data: {artist_type : artist_type, artist_id : pid, adminID : adminID},                         // Setting the data attribute of ajax with file_data
		type: 'post',
		success:function(data){
				$("#stuts-msg").empty();
				$('.set_arists_status').hide();
				$("#stuts-msg").empty().append('Artist type has been set.');
				
			}
	});
    }
  });
});
</script>