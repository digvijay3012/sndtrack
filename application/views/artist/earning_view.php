
 <?php
$ArtistData	=	$this->ion_auth->user()->row();
if(!empty($ArtistData)){
	$artistID 		=		$ArtistData->user_id;
	$artistEmail 	=		$ArtistData->email;
	$first_name 	=		$ArtistData->first_name;
	$last_name 		=		$ArtistData->last_name;
}
?>
 <div class="dashboard_cont sales_mn">
        <div class="container">
            <div class="welcom_strip tex-center">
                <h2 class="pull-left"><?php echo $first_name." ".$last_name; ?></h2>
                <h2 class="text-center">Sales</h3>
            </div>
            <div class="date_range_col">
                    <div class="sales_songs_cnt text-center">
                            <!--h2>Web Traffic</h2-->
                <div class="date_range h2_hiidn">
				
                    <h3>Date Range:</h3>
						<input  type="text" placeholder="click to show datepicker"  id="from_datepicker">
                    <p>to</p>
						<input  type="text" placeholder="click to show datepicker"  id="to_datepicker">
                </div>		
                <div class="chcbox_sales">
                    <input type="checkbox" class="css-checkbox" id="input7">
                    <label class="css-label lite-blue-check" for="input7"></label>
                </div>
            </div>
            <div class="graph">
			
			 <div id="chart">
      <ul id="numbers">
        <li><span></span></li>
        <li><span>900 &euro;</span></li>
        <li><span>800 &euro;</span></li>
        <li><span>700 &euro;</span></li>
        <li><span>600 &euro;</span></li>
        <li><span>500 &euro;</span></li>
        <li><span>400 &euro;</span></li>
        <li><span>300 &euro;</span></li>
        <li><span>200 &euro;</span></li>
        <li><span>100 &euro;</span></li>
        <li><span>0 &euro;</span></li>
      </ul>
      <ul id="bars">
	  <?php $getMonthdata = get_total_sale_for_artist($artistID); 
			if(!empty($getMonthdata)){
				foreach($getMonthdata as $fetchMonthData){
					//echo "<pre>";		print_r($fetchMonthData);		echo "</pre>";
					$monthList = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
					$monthName 	=	$fetchMonthData['monthName'];	
					$total_amount 	=	$fetchMonthData['total_amount'];
				?>					
					 <li><div data-percentage="<?php echo $total_amount; ?>" class="bar"></div><span><?php echo $monthName; ?></span></li>	
			<?php 	}
			}else{
				echo '<li><div data-points="" class="bar"></div><span>No Data</span></li>';
			}
			
	  ?>
       
      </ul>
    </div>
			
			</div>
        </div>
        <div class="date_range_table">
            <h2>Sales</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" class="nme_user">Track</th>
                                <th>Release Date</th>
                                <th>Personal sales</th>
                                <th>Lite sales</th>
                                <th>standard sales </th>
                                <th>Premium Sales</th>
                                <th>Other Sales</th>
                                <th>Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
							if(!empty($data)){
								$totalOrderAmount = 	'';
								foreach($data as $getSaleData){
									$trackId 		=		$getSaleData['id'];
									$watermark_format	= $getSaleData['watermark_format']; 
									$GettrackName		=	explode(".", $watermark_format);
									$trackName			=	$GettrackName['0'];
									$songUploadDate		=	$getSaleData['song_upload_date'];
									$modifyDate			= 	strtotime($songUploadDate);
									$songPublishDate	=  date('j F  Y', $modifyDate);
									$total_amount	= $getSaleData['total_amount']; 
									$totalOrderAmount += $total_amount;
						?>
                            <tr>
                                <td>
									<input type="radio" class="make_single_graph" pid="<?php echo $trackId; ?>">
                                </td>
                                <td class="nme_user">
                                    <p><?php  echo $trackName; ?>
									</p>
                                </td>
                                <td> <?php echo $songPublishDate; ?>
								</td>
                                <td><?php $getPsale = 	get_track_personal_sale($trackId); 
									$personal_sale   = 	$getPsale['0']['personal_sale1'];
									if($personal_sale==''){
										echo $personal_sale = 0;
									}else{
										echo $personal_sale;
									}
								?></td>
                                <td><?php $getLsale = 	get_track_lite_sale($trackId); 
									$lite_sale   = 	$getLsale['0']['lite_sale'];
									if($lite_sale==''){
										echo $lite_sale = 0;
									}else{
										echo $lite_sale;
									}
								?></td>
                                <td><?php $getSsale = 	get_track_standard_sale($trackId); 
									$standard_sale   = 	$getSsale['0']['standard_sale'];
									if($standard_sale==''){
										echo $standard_sale = 0;
									}else{
										echo $standard_sale;
									}
								?></td>
                                <td><?php $getPsale = 	get_track_premium_sale($trackId); 
									$premium_sale   = 	$getPsale['0']['premium_sale1'];
									if($premium_sale==''){
										echo $premium_sale = 0;
									}else{
										echo $premium_sale;
									}
								?></td>
                                <td>0</td>
                                <td><?php if($total_amount==''){
											echo 0;
										}else{
											echo $total_amount;
										}
									?></td>
                            </tr>	
							<?php } } else{
								echo ' <tr>
                                <td></td>
                                <td class="nme_user"></td>
                                <td></td>
                                <td></td>
                                <td>There is no data to display.</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>';
							}?>
                        </tbody>
                    </table>
                    <table class="table total">
                        <tbody>
                            <tr>
                                <td>Total</td>
                                <td><?php echo $totalOrderAmount; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/graph_style.css"/>

<script src="<?php echo base_url(); ?>js/script.js"></script>
