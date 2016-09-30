<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer_Account_Settings</title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>images/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo base_url(); ?>images/favicons/manifest.json">
    <link rel="mask-icon" href="<?php echo base_url(); ?>images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>images/favicons/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
</head>

<body>
<?php
$customerData	=	$this->ion_auth->user()->row();
if(!empty($customerData)){
	$adminId 		=		$customerData->user_id;
	$adminEmail 	=		$customerData->email;
	$first_name 	=		$customerData->first_name;
	$last_name 		=		$customerData->last_name;
	$phone 			=		$customerData->phone;
	$customerExtra 	=	get_customer_info($adminId);
	$first_address	=	$customerExtra[0]['first_address']; 
	$second_address	=	$customerExtra[0]['second_address']; 
	$city			=	$customerExtra[0]['city']; 
	$zip			=	$customerExtra[0]['zip']; 
	$country		=	$customerExtra[0]['country']; 
	$customer_image	=	$customerExtra[0]['customer_image']; 
	//echo "<pre>";	print_r($customerExtra);	echo "</pre>";
}

?>
    <div class="container">
        <div class="login_cont text-center">
            <div class="logo text-center wow fadeInDown">
                <a href="<?php echo base_url(); ?>">
                    <p>Sndtrack</p>
                    <span>music licensing</span>
                </a>
            </div>
			
        </div>
		<div class="inner-nave"><p>Logged in as:  <?php echo $first_name." ".$last_name; ?></p>  
		<p>Go to <a class="dash-cls" href="<?php echo base_url(); ?>dashboard">Dashboard</a></p>
		</div>
        <div class="login_cont text-center help_cnt cstmr_settings">
          	<div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
			<?php	
				$attributes = array('class' => 'login_form', 'id' => 'account_setting_form');
				echo form_open_multipart('account', $attributes); 
			?>

                <div class="col-1-form col-sm-4 pdngg-left">
                    <h3>Contact details</h3>
                    <ul>
                        <li>
                            <input type="text" id="first_name" value="<?php echo $first_name; ?>" maxlength="30" name="first_name" tabindex='1' placeholder="First Name" required="">
							<?php  echo form_error('first_name'); ?>
                        </li>
                        <li>
                            <input type="text" tabindex='3' name="first_address" value="<?php echo $first_address; ?>" placeholder="First Line Address">
							<?php  echo form_error('first_address'); ?>
                        </li>
                        <li>
                            <input type="text" tabindex='5' maxlength="30" value="<?php echo $city; ?>" name="city" placeholder="City/State">
							<?php  echo form_error('city'); ?>
                        </li>
                        <li>
						<select name="country" tabindex='7' class="input-medium bfh-countries" data-country="<?php if($country==""){ echo "AF";}else{ echo $country; } ?>"></select>
                         
							<?php  echo form_error('country'); ?>
                        </li>
                        <li>
                            <input type="text" tabindex='9' value="<?php echo $phone; ?>"  maxlength="15" name="phone" placeholder="Phone Number" >
							<?php  echo form_error('phone'); ?>
                        </li>
						
                    </ul>
                </div>
                <div class="col-1-form col-sm-4">
                    <h3>&nbsp;</h3>
                    <ul>
                        <li>
                            <input type="text" tabindex='2' maxlength="30" value="<?php echo $last_name; ?>" id="lastname" name="lastname" placeholder="Last Name">
							<?php  echo form_error('lastname'); ?>
                        </li>
                        <li>
                            <input type="text" tabindex='4' name="second_address" value="<?php echo $second_address; ?>" placeholder="Second Line Name">
							<?php  echo form_error('second_address'); ?>
                        </li>
                        <li>
                            <input type="text" tabindex='6' maxlength="15" value="<?php echo $zip; ?>" name="zip" placeholder="Zip/Post Code" >
							<?php  echo form_error('zip'); ?>
                        </li>
                        <li>
                            <input type="email" name="email" tabindex='8' value="<?php echo $adminEmail; ?>" placeholder="Email Address" >
							<?php  echo form_error('email'); ?>
                        </li>
						 <li>
						 <img src="<?php echo base_url(); ?>customer_images/<?php echo $customer_image; ?>" alt="<?php echo $first_name; ?>" style="width:200px;height:150px;"></br>
							Uplaod image: <input type="file" tabindex='10' onchange="return ValidateImageUpload('customer_image')" name="customer_image" id="customer_image">
								<?php  echo form_error('customer_image'); ?>
						</li>
                        <li>
                            <button class="custom-button full-width" type="submit" id="Login" name="submit" >Update</button>
                        </li>
                    </ul>	
                </div>
				
				  <?php echo form_close();?>
			<?php	
				$attributes = array('class' => 'login_form', 'id' => 'update_password_form');
				echo form_open_multipart('account/update_account_password', $attributes); 
			?>
			 	<?php echo $this->session->flashdata('message'); ?>
                <div class="col-1-form col-sm-4 pdngg-right">
                    <h3>New Password</h3>
			
                    <ul>
                        <li>
                            <input type="password" name="old_password" placeholder="Current Password">
							<?php  echo form_error('password'); ?>
                        </li>
                        <li>
                            <input type="password" name="newpassword" placeholder="New Password">
							<?php  echo form_error('newpassword'); ?>
                        </li>
                        <li>
                            <input type="password" name="cpassword" placeholder="Repeat Password">
							<?php  echo form_error('cpassword'); ?>			
                        </li>
                        <li>
                            <button class="custom-button full-width" type="submit" id="Login" name="submit">Update Password</button>
                        </li>
                    </ul>
		  <?php echo form_close();?>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="container-fluid">
            <div class="footer_logo">
                <ul>
                    <li>
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/black-logo.png" alt="logo"></a>
                    </li>
                    <li>
                        <p>2016</p>
                    </li>
                </ul>
            </div>
            <div class="middle_footer">
                <ul>
                    <li><a href="<?php echo base_url(); ?>browse">Browse</a></li>
                    <li><a href="<?php echo base_url(); ?>journal">Journal</a></li>
                    <li><a href="<?php echo base_url(); ?>contact">Contact</a></li>
                </ul>
                <ul class="social_icons">
                    <li><a href=""><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i aria-hidden="true" class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="footer_nav">
                <ul>
                    <li><a href="<?php echo base_url(); ?>private_policy">Private</a></li>
                    <li><a href="<?php echo base_url(); ?>licence_terms">License Terms</a></li>
                    <li><a href="<?php echo base_url(); ?>faq">FAQ</a></li>
                    <li><a href="<?php echo base_url(); ?>Terms_and_conditions">Terms &amp; Conditions</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
 <script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
    <script src="https://use.typekit.net/auo4nbe.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert.css">
<script src="<?php echo base_url(); ?>js/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-formhelpers-countries.js"></script>
   <script src="<?php echo base_url(); ?>js/bootstrap-formhelpers.js"></script>	
    <script>
        try {
            Typekit.load({
                async: true
            });
        } catch (e) {}
    </script>	
 <script>
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#account_setting_form").validate({
                rules: {
					first_name: "required",
                    first_address: "required",
                    city: "required",
					country: "required",
					phone: "required",
					lastname: "required",
					second_address: "required",
					zip: "required"
					 //email: {
                        //required: true,
                       // email: true
                    //}
                },
                messages: {
                    first_name: "Please enter your first name.",
                    first_address: "Please enter your first line address.",
					city: "Please enter your city.",
					country: "Please select your country.",
					phone: "Please select your phone.",
					lastname: "Please enter your last name.",
					second_address: "Please enter your second address.",
					zip: "Please enter your zip code.",
					email: "Please enter your email."
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
 <script>
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#update_password_form").validate({
                rules: {
					old_password: "required",
                    newpassword: "required",
                   cpassword: "required"
					
                },
                messages: {
                    old_password: "Please enter your password.",
                    newpassword: "Please enter your new password.",
					cpassword: "Please confirm your password."
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
 <script>

function ValidateImageUpload($inputId) {
var fuData = document.getElementById($inputId);
var FileUploadPath = fuData.value;
if (FileUploadPath == '') {
    
	sweetAlert('', 'Please upload an image.', 'error');

} else {
    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
	if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                || Extension == "jpeg" || Extension == "jpg") {
		if (fuData.files && fuData.files[0]) {
			jQuery('#Login').removeAttr("disabled");
				var size = fuData.files[0].size;
				//alert(size);
				var MAX_SIZE	=	1500000;
                if(size > MAX_SIZE){
                  
					sweetAlert('Oops...', 'Maximum file size exceeds.', 'error');
                    return;
                }
            }
		} 
else {
		sweetAlert('Oops...', 'Allows only file types of GIF, PNG, JPG, JPEG and BMP.', 'error');
		jQuery('#Login').prop('disabled', true);	
		return false;
    }
}}
</script> 
<!--************************************ Start Script use for enter Alphabets only in (Name) Text box********************-->
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery.noConflict();
   jQuery("input[name='first_name']").keypress(function(event){
       var inputValue = event.which;
       // allow letters and whitespaces only.
       if((inputValue > 33 && inputValue < 64) || (inputValue > 90 && inputValue < 97 ) || (inputValue > 123 && inputValue < 126)
&& (inputValue != 32)){
           event.preventDefault();
       }
   });
   jQuery("input[name='lastname']").keypress(function(event){
       var inputValue = event.which;
       // allow letters and whitespaces only.
       if((inputValue > 33 && inputValue < 64) || (inputValue > 90 && inputValue < 97 ) || (inputValue > 123 && inputValue < 126)
&& (inputValue != 32)){
           event.preventDefault();
       }
   });
   jQuery("input[name='zip']").keydown(function(event) {
		// Allow only backspace and delete
		if ( event.keyCode == 46 || event.keyCode == 8 ) {
			// let it happen, don't do anything
		}
		else {
			// Ensure that it is a number and stop the keypress
			if (event.keyCode < 48 || event.keyCode > 57 ) {
				event.preventDefault();	
			}	
		}
	});
 jQuery("input[name='phone']").keydown(function(event) {
		// Allow only backspace and delete
		if ( event.keyCode == 46 || event.keyCode == 8 ) {
			// let it happen, don't do anything
		}
		else {
			// Ensure that it is a number and stop the keypress
			if (event.keyCode < 48 || event.keyCode > 57 ) {
				event.preventDefault();	
			}	
		}
	});	
});
</script>
</body>

</html>