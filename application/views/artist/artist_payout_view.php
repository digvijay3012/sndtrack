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
                <h2 class="text-center">Payout</h3>
            </div>
            <div class="payout_cont">
                <div class="req_payout_lft pull-left">
                    <div class="requst_payout">
                        <div class="req_pay">Request a Payout</div>
                        <p><i>Minimum withdrwal is 199</i></p>
                    </div> 
						<div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
                     <?php	
						$attributes = array('class' => 'login_form', 'id' => 'payout_form');
						echo form_open('artist/payout', $attributes); 
					?>
                        <ul>
                            <li>
							<label>Amount:</label><input name="amount" type="text" placeholder="200">
								<?php  echo form_error('amount'); ?>
							</li>
							
                            <li><label>Account Holder Name:</label><input name="acoount_holder_name" type="text" placeholder="<?php echo $first_name." ".$last_name; ?>">
								<?php  echo form_error('acoount_holder_name'); ?>
							</li>
                            <li><label>Account Number:</label><input name="account_number" type="text" placeholder="123456789">
								<?php  echo form_error('account_number'); ?>
							</li>
                            <li><label>Sort Code</label><input  name="sort_code" type="text" placeholder="60-41-52">
								<?php  echo form_error('sort_code'); ?>
							</li>
                            <li><label>&nbsp;</label>
                            <button required="" name="submit" id="send" type="submit" class="sbmt hover_btn cstm_btn">Submit</button></li>
                        </ul>
                    <?php echo form_close();?>
                </div>
                <div class="crnt_blnc_rt pull-right">
                    <strong>Current Balance:</strong>
					<?php $totalAmnt 	=	get_total_sale_for_artist($artistID); 
					$total_amount = '';
							if(!empty($totalAmnt)){
								foreach($totalAmnt as $getAmount){
								 $get_total_amount 	=	$getAmount['total_amount'];
								 $total_amount      +=  $get_total_amount;
							}
						}
						
					?>
                    <p>&pound; <?php echo $total_amount; ?></p>
                </div>
                <i class="note_dash">Please note, funds take 7 working days to clear, 10 working days outside of the UK.</i>
            </div>
        </div>
    </div>
 <script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script>
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#payout_form").validate({
                rules: {
					amount: "required",
                    acoount_holder_name: "required",
                    account_number: "required",
                    sort_code: "required"
                },
                messages: {
                    amount: "Please enter amount.",
                    acoount_holder_name: "Please enter account holder name .",
					account_number: "Please enter account number.",
                    sort_code: "Please enter sort code."
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script> 