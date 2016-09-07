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
						<span style="display:none" class="from_datepicker-error">Please select date.</span>
                    <p>to</p>
						<input  type="text" placeholder="click to show datepicker"  id="to_datepicker">
						<span style="display:none" class="to_datepicker-error">Please select date.</span>
                </div>		
                <div class="chcbox_sales">
                    <input type="button" value="Submit" class="css-checkbox" id="check_sales_btn">
                    <label class="css-label lite-blue-check" for="check_sales_btn"></label>
                </div>
				<div style="display:none" class="date_loader">
						<img src="<?php echo base_url(); ?>images/uploading.gif">
				</div>
            </div>				
           <?php $getMonthdata = get_total_sale_for_artist($artistID); 
					if(!empty($getMonthdata)){
						$dataPoints	=	array();
						foreach($getMonthdata as $fetchMonthData){
								//$monthList = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
								$monthName 		=	$fetchMonthData['monthName'];	
								$total_amount 	=	$fetchMonthData['total_amount'];
								$newPoints = array(
									'y' =>$total_amount,
									'label' => $monthName
								);
								array_push($dataPoints, $newPoints); 
							}
						}else{
						echo '<li><div data-points="" class="bar"></div><span>No Data</span></li>';
					}
					
			 ?>
				
		 </div>
<div class="append-graph-cls">		 
	<div id="chartContainer"></div>
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
								<input type="radio" class="make_single_graph" name="track_id" pid="<?php echo $trackId; ?>">
                                </td>
                                <td class="nme_user">
                                    <p><?php  echo $trackName; ?>
									</p>
									<div style="display:none" class="wishlist_loader_style graph_loader_<?php echo $trackId; ?>">
										<img src="<?php echo base_url(); ?>images/uploading.gif">
									</div>
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

 
        <script type="text/javascript">
 
            $(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme2",
                    animationEnabled: true,
                    title: {
                        text: ""
                    },
                    data: [
                    {
                        type: "column",                
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }
                    ]
                });
                chart.render();
            });
			
				$(document).on('change','.make_single_graph',function(){
				$('#from_datepicker').val("");
				$('#to_datepicker').val("");
				var track_id  	=	$(this).attr('pid');
				var atistId		=	'<?php echo $artistID; ?>'; 
				var  url		= 	'<?php echo base_url(); ?>artist/earning/single_track_graph';
				var loader		=	".graph_loader_"+track_id;
				  $(loader).show();
				  $.ajax({
						url: url,
						data: {track_id: track_id, atistId : atistId},                         // Setting the data attribute of ajax with file_data
						type: 'post',
						success:function(data){
								if(data ==1){
									var data = 'No records found.';
								}
								$('.append-graph-cls').empty().append(data);
								$(loader).hide();
								 $('html, body').animate({
										scrollTop: $(".date_range_col").offset().top
									}, 500);
							}
					}); 
			});	
		
				$(document).on('click','#check_sales_btn',function(){
					var from_datepicker 	=	$('#from_datepicker').val();
						if(from_datepicker==''){
							$('.from_datepicker-error').show();
							$(this).attr('checked', false);
						}else{
							$('.from_datepicker-error').hide();
						}
					var to_datepicker 	=	$('#to_datepicker').val();
						if(to_datepicker==''){
							$('.to_datepicker-error').show();
							$(this).attr('checked', false);
						}else{
							$('.to_datepicker-error').hide();
						}
					
						var track_id  	=	$("input[name='track_id']:checked").attr('pid');
						if (typeof track_id === "undefined") {
								var track_id	=	'';
							}else{
								
							}
						
					if(from_datepicker !='' && to_datepicker !=''){
						var loader		=	".date_loader";
						var  url		= 	'<?php echo base_url(); ?>artist/earning/date_range_graph';
						var atistId		=	'<?php echo $artistID; ?>';
						  $(loader).show();
						  $.ajax({
								url: url,
								data: {track_id: track_id, atistId : atistId, from_datepicker : from_datepicker, to_datepicker : to_datepicker},                         // Setting the data attribute of ajax with file_data
								type: 'post',
								success:function(data){
									if(data ==1){
										var data = 'No records found.';
									}
										$('.append-graph-cls').empty().append(data);
										$(loader).hide();
									}
							}); 
					}
			});	
        </script>

<script src="<?php echo base_url(); ?>js/canvasjs.min.js"></script>
