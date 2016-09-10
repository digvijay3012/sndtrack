<div class="dashboard_cont">
<div class="container">
            <div class="welcom_strip tex-center">
			<?php 
			$FirstName ="";
			$LastName ="";
				if ($this->ion_auth->logged_in()){
						
						$adminData		=	$this->ion_auth->user()->row();
						if(!empty($adminData)){
							$FirstName 		=		$adminData->first_name;
							$LastName 		=		$adminData->last_name;
						}
					}
			
			?>
                <h2 class="pull-left"><?php echo $FirstName." ".$LastName; ?> </h2>
                <h2 class="text-center">Welcome</h2>
            </div>
            <p class="note_dash text-center">Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
			<div id="infoMessage"></div>
		
			<div class="login_cont text-center">
			<?php 
					$customerId = $this->uri->segment(4);
					$actionUrl 	=	"administrator/accounts/customer_reset_password/".$customerId;
					$attributes = array('class' => 'login_form', 'id' => 'reset_password_form');
					echo form_open($actionUrl, $attributes); 
			?>
                    <ul>
						<li>
							<input type="password"  name="old_password" placeholder="Current Password">
							<?php  echo form_error('old_password'); ?>
						</li>
						<li>
							<input type="password" placeholder="Password" name="password">
							<?php  echo form_error('password'); ?>
						</li>
							 <li>
								<input type="password" placeholder="Confirm Password Name" name="cpassword">
								<?php  echo form_error('cpassword'); ?>
							</li>
						
                        <li>
                            <button class="sbmt hover_btn" type="submit" id="send" name="submit" required="">Submit</button>
                        </li>
                    </ul>
               <?php echo form_close(); ?>   
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
            $("#reset_password_form").validate({
                rules: {
					old_password: "required",
					password: "required",
                    cpassword: "required"
                   
                },
                messages: {
					old_password: "Please enter your old Password.",
                    password: "Please enter your Password.",
                    cpassword: "Please confirm your Password."
					
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