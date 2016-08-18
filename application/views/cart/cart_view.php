<?php $data	=	get_cart_view_by_customerId($customer_id); 
	if(!empty($data)){
		foreach($data as $getData){
			$id						=	$getData['id'];
			$license_type			=	$getData['license_type'];
			$amount					=	$getData['amount'];
			$license_type_value		=	$getData['license_type_value'];
		}
	}
?>
<div class="logo text-center">
                            <a href="">
                                <p>Sndtrack</p>
                                <span>music licensing</span>
                            </a>
                        </div>
                        <div class="content_inn_pop">
                            <h3>License Type</h3>
                            <div class="confirm_purchs">
                                <div class="list_pop">
                                    <ul>
                                        <li class="pull-left">
										<?php 
											$explodeVar	=	explode("_", $license_type);
											$licence	=	ucfirst($explodeVar['0']);
											$type		=	ucfirst($explodeVar['1']);
											echo $licence." ".$type;
										?>
										</li>
                                        <li class="pull-right"> &pound;<?php echo $amount; ?> </li>
                                    </ul>
                                   
                                </div>

                                <div class="ttl">
                                    <ul>
									<input type="hidden" name="get_track_id" value="<?php echo $track_id; ?>" id="get_track_id">
									<input type="hidden" name="get_customer_id" value="<?php echo $customer_id; ?>" id="get_customer_id">
									<input type="hidden" name="get_music_amount" value="<?php echo $amount; ?>" id="get_music_amount">
                                        <li class="pull-left">Total</li>
                                        <li class="pull-right"> &pound;<?php echo $amount; ?> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="back_btn">
                                
                                <a href="javascript:void(0);" class="custom-button purchase_button">Purchase</a>
                            </div>
                            <div class="standard_info">
                                <p>Standard License - Company, brand, product, service, promotion, event, online series</p>
                            </div>
                            <div class="popup_social text-center">
                                <ul>
                                    <li><a href="">Privacy Policy</a></li>
                                    <li><a href="">User Agreement</a></li>
                                    <li><a href="">Terms & Consitions</a></li>
                                </ul>
                            </div>
                        </div>