<?php 
//echo "<pre>"; print_r($data);	echo "</pre>"; die;
$dataPoints	=	array();
 if(!empty($data)){ 
				
				foreach($data as $fetchMonthData){
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
				echo '1';
				die;
			}
			
	 ?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url(); ?>js/canvasjs.min.js"></script>

<div id="chartContainer"></div>
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
	</script>

