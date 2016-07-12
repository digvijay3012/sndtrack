<div class="dashboard_cont">
        <div class="container">
            <div class="welcom_strip tex-center">
                <h2 class="pull-left">Clem Snide</h2>
                <h2 class="text-center">User Accounts</h3>
            </div>
         <div class="artist_draft_cont">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#mnu1">Artists</a></li>
                    <li><a data-toggle="tab" href="#mnu2">Customers</a></li>
                </ul>
             <h2 class=" artst_drft_table">Account Detail</h2>
                <div class="tab-content">
                    <div id="mnu1" class="tab-pane fade in active">
                        <div class="table-responsive">
                            <table id="artist_table" class="table">
							
                               <thead>
									<tr>
										 <th colspan="2">Name</th>
										<th>Signup Date</th>
										<th>Last Login</th>
										<th>Loaction</th>
										<th>No. of tracks</th>
										<th>Earnings to Date</th>
										<th></th>
										<th></th>
									</tr>
							</thead>
							
							<tbody>
							<?php if(!empty($data)){ 
							//echo "<pre>";	print_r($data);  echo "</pre>";	
								foreach($data	as  $artistData){
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
									$artistLastlogin	=	date("j F  Y", $last_login);
									
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
                                        <td>10</td>
                                        <td class="lst_data">
                                            <a href="">Reset Password</a>
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
