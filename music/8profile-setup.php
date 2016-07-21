<?php
/*
 Template Name: Speaker Profile Setup Template
 */
?>
<?php get_header(); ?>
<?php
if(isset($_POST['submit'])){
	echo "<pre>";   print_r($_POST);  echo "</pre>";
$firstname					=		$_POST['firstname'];
$lastname					=		$_POST['lastname'];
$email						=		$_POST['email'];
$prof_headline				=		$_POST['prof_headline'];
$biography					=		$_POST['biography'];
$fee_range					=		$_POST['fee_range'];
$phone						=		$_POST['phone'];
$website					=		$_POST['website'];
$embed_video1				=		$_POST['embed_video1'];
$embed_video2				=		$_POST['embed_video2'];
$detailed_biography			=	$_POST['detailed_biography'];
$detailed_photo1			=	$_POST['detailed_photo1'];
$detailed_photo2			=	$_POST['detailed_photo2'];
$detailed_photo3			=	$_POST['detailed_photo3'];
// Array varaibles
$keynote_photo				=	$_POST['keynote_photo'];
/* if(empty($keynote_photo)){
	echo "daga here";
	
}else{
	echo "daga else";
} */
$keynote_title				=	$_POST['keynote_title'];
$keynote_description		=	$_POST['keynote_description'];
$keynote_program1			=	$_POST['keynote_program1'];
$keynote_program2			=	$_POST['keynote_program2'];
$keynote_program3			=	$_POST['keynote_program3'];
$keynote_program4			=	$_POST['keynote_program4'];
$detailed_testimonial		=	$_POST['detailed_testimonial'];
$client_name				=	$_POST['client_name'];
$client_img					=	$_POST['client_img'];
}
session_id(); 
?>
<form enctype="multipart/form-data" action="" method="POST" name="speaker-pro-setup"  id="speaker-pro-setup">
<div class="speaker-profile-section">

  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-9">
        <div class="profile-pic">
           <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/speaker-Profile-SetUp-pagepp.jpg" alt="...." />
           <a class="add-image">Add Primary Photo
		   <input id="fileUpload" name='user_img'  type="file"/></a>
		   
		</div> <!---profile-pic--->
       <style type="text/css">.thumb-image{float:left;width:100px;position:relative;padding:5px;}</style>

        <div class="speaker-description border-d">
           <div class="overview-setup">
       <?php if(isset($_SESSION['visitor_name'])) {
				$visitor_name = $_SESSION['visitor_name'];
			} else {
				$visitor_name = '';
			}
			if(isset($_SESSION['visitor_email'])) {
					$visitor_email = $_SESSION['visitor_email'];
				} else {
					$visitor_email = '';
				} 	
			if(isset($_SESSION['visitor_lastname'])) {
					$visitor_lastname = $_SESSION['visitor_lastname'];
				} else {
					$visitor_lastname = '';
				}				
		?>
				<input type="text" value='<?php echo $visitor_name; ?>' name="firstname" class="form-control" placeholder="First Name">
				<input type="text" value='<?php echo $visitor_lastname; ?>' class="form-control marg" name="lastname" placeholder="Last Name"> <a class="editor-button" href="#"></a>
				<input type="email"  class="form-control marg" name="email" placeholder="Email"> <a class="editor-button" href="#"></a>
          </div>
          <div class="overview-tittle-setup">
              <input type="text" class="form-control" name="prof_headline" placeholder="Your Professional Headline"> <a class="editor-button" href="#"></a>
          </div>
          <div class="overview-tittle-setup">
                 <p>(Maximum 200 character)</p>
              <textarea class="form-control" name="biography" placeholder="Biography"></textarea> <a class="editor-button" href="#"></a>
          </div>
          
          <div class="overview-free-setup">
              <select type="text" name="fee_range" class="form-control"> 
                   <option>Fee Range (USA)</option>
                   <option>$5,000 to $7,500</option>
                   <option>$7,500 to $15,000</option>
                   <option>$25,000+</option>
              </select>
              
              <input type="text" class="form-control" name="phone" placeholder="Phone">
              <input type="text" class="form-control" name="website" placeholder="Website">
              <a class="editor-button" href="#"></a>
          </div>
           
          </div> 
           
        </div> <!---speaker-description--->
        
      </div> <!---col-xs-12 col-md-8--->
      
     
    </div> <!--row-->
  </div> <!---container--->
</div> <!---speaker-profile-section--->

<div class="video-section">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-6">
        <div class="embed-responsive embed-responsive-16by9">
            <div class="video-set-up">
               <h3>Embed Video</h3>
              
             <div class="url-input">
               <p>We currently support Youtube and Vimeo</p>
               <input type="text" name="embed_video1" class="form-control" placeholder="Enter Video URL">
             </div>  
             <button type="button" class="btn btn-default btn-save">Save</button> 
             <button type="button" class="btn btn-default btn-close">Close</button>  
            </div>
         </div> <!--embed-responsive-->
      </div> <!--col-xs-12 col-md-6-->
      
       <div class="col-xs-12 col-md-6">
         <div class="embed-responsive embed-responsive-16by9">
            <div class="video-set-up">
               <h3>Embed Video</h3>
              
             <div class="url-input">
               <p>We currently support Youtube and Vimeo</p>
               <input type="text" name="embed_video2" class="form-control" placeholder="Enter Video URL">
             </div>  
             <button type="button" class="btn btn-default btn-save">Save</button> 
             <button type="button" class="btn btn-default btn-close">Close</button>  
            </div>
         </div> <!--embed-responsive-->
      </div> <!--col-xs-12 col-md-6-->
      
    </div> <!--row-->
  </div> <!--container-->
</div>  <!---video-section--->

<div class="biography">
  <div class="container">
     <div class="biography-content editor-setup">    
       <h2>Biography</h2>
       
      
         <div class="biography-editor"> 
          <p>(Maximum 1000 character)</p>
           <div class="input-holder"> 
            <div class="boigraphy-icon"></div> 
             <textarea class="form-control" name="detailed_biography" placeholder="Biography"></textarea>
             <a href="#" class="editor-button"></a>
           </div>
         </div> 
       </div> 
  
  </div>
</div>  <!--biography-->

<div class="speaker-gallery">
  <div class="container">
   <div class="row">
       <div class="col-sm-4 gallery-box"> 
          <div class="img-gallery" id="image-holder-1">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/speaker-Profile-SetUp-pagepp.jpg" alt="....">
            <a class="add-more" href=""></a>
            <a class="add-photo" href="">Add Photo
			</a>
		</div>
		 <input id="detailed_photo1" name="detailed_photo1"  type="file"/>
			<span class="first_agreement" style="display:none;"><input type="checkbox" name="first_agreement" value="yes">I Agree</span>
        </div> <!--gallery-box-->
      
     <div class="col-sm-4 gallery-box">
       <div class="img-gallery" id="image-holder-2">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/speaker-Profile-SetUp-pagepp.jpg" alt="....">
            <a class="add-more" href=""></a>
            <a class="add-photo" href="">Add Photo
			</a>
          </div>
		  <input id="detailed_photo2" name="detailed_photo2" multiple="multiple" type="file"/>
		  <span class="second_agreement" style="display:none;"><input type="checkbox" name="second_agreement" value="yes">I Agree</span>
     </div> <!--gallery-box-->
    
    <div class="col-sm-4 gallery-box">
      <div class="img-gallery" id="image-holder-3">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/speaker-Profile-SetUp-pagepp.jpg" alt="....">
            <a class="add-more" href=""></a>
            <a class="add-photo" href="">Add Photo
			</a>
          </div>
		  <input id="detailed_photo3" name="detailed_photo3" multiple="multiple" type="file"/>
		    <span class="third_agreement" style="display:none;"><input type="checkbox" name="third_agreement" value="yes">I Agree</span>
    </div> <!--gallery-box-->
    
  </div>
 </div> 
</div> <!---speaker-gallery--->


<div class="keynote-programs">
  <div class="container keynote-contnr">
    <h2>keynote programs</h2>
    
    <div class="keynote-box boder"> 
      <div class="img-gallery" id="keynote-holder">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/speaker-Profile-SetUp-pagepp.jpg" alt="....">
            <a class="add-more" href=""></a>
            <a class="add-photo" href="">Add a Thumbnail Image (300 x 300 pixels)
			</a><input id="keynote_photo"  name="keynote_photo[]" type="file"/>
          </div>
     <div class="keynote-content">
        <div class="overview-tittle-setup">
              <input type="text" name="keynote_title[]" placeholder="Title" class="form-control"> <a href="#" class="editor-button"></a>
          </div>
          
         <div class="overview-tittle-setup">
              <textarea placeholder="Description" name="keynote_description[]" class="form-control"></textarea> <a href="#" class="editor-button"></a>
          </div> 
          <h3>Program Take-Aways</h3>
          <div class="overview-tittle-setup keynote-area">
              <input type="text"  name="keynote_program1[]" class="form-control"> <a href="#" class="editor-button"></a>
          </div> 
          
          <div class="overview-tittle-setup keynote-area">
              <input type="text" name="keynote_program2[]" class="form-control"> <a href="#" class="editor-button"></a>
          </div> 
          
          <div class="overview-tittle-setup keynote-area">
              <input type="text" name="keynote_program3[]" class="form-control"> <a href="#" class="editor-button"></a>
          </div> 
          
           <div class="overview-tittle-setup keynote-area">
              <input type="text" name="keynote_program4[]" class="form-control"> <a href="#" class="editor-button"></a>
          </div> 
          
     </div> <!--keynote-content-->  
    </div> <!---keynote-box close--->
  
    <a class="add-more-key-nodes" id="add-more-keynote" href="">Add More Keynote Programs</a>    
  </div>
</div> <!--keynote-programs Close--> 


<div class="testimonial-section">
  <div class="container">
   <div class="cd-testimonials-wrapper cd-container">
      <h2>Testimonials</h2>
	 <div class="testimonial-set-up">
        <div class="input-holder"> 
            <div class="boigraphy-icon"></div> 
             <textarea name="detailed_testimonial[]" class="form-control" placeholder="Testimonial"></textarea>
           </div>
          <div class="input-holder text-center"> 
               <input type="text" name="client_name[]" class="form-control" placeholder="Client Name & Title"> 
          </div>  
	      <div class="client-pp" id="client_img_holder">
            <a href="">Add Photo</a>
			<input id="client_img"  name="client_img[]" type="file"/>
          </div>
     </div>

    </div> <!-- cd-testimonials-wrapper --> 
    
     
       <a class="add-more-key-testimonial" href="">Add More Testimonials</a>

 
  </div>
</div> <!--testimonial-section-->

<div class="container bott-section">
  <button type="submit" name="submit" class="btn btn-default btn-sunet">SAVE</button>
  <button type="button" class="btn btn-default btn-cancel">CANCEL</button>
</div>  
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
jQuery(document).ready(function() {
        jQuery("#fileUpload").on('change', function() {
          //Get count of selected files
          var countFiles = jQuery(this)[0].files.length;
          var imgPath = jQuery(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = jQuery("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  jQuery("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
        jQuery("#detailed_photo1").on('change', function() {
          //Get count of selected files
		  jQuery('.first_agreement').show();
          var countFiles = jQuery(this)[0].files.length;
          var imgPath = jQuery(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = jQuery("#image-holder-1");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  jQuery("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });	
   jQuery("#detailed_photo2").on('change', function() {
          //Get count of selected files
		  jQuery('.second_agreement').show();
          var countFiles = jQuery(this)[0].files.length;
          var imgPath = jQuery(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = jQuery("#image-holder-2");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  jQuery("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });	
 jQuery("#detailed_photo3").on('change', function() {
          //Get count of selected files
		  jQuery('.third_agreement').show();
          var countFiles = jQuery(this)[0].files.length;
          var imgPath = jQuery(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = jQuery("#image-holder-3");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  jQuery("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
	jQuery("#keynote_photo").on('change', function() {
          //Get count of selected files
		
          var countFiles = jQuery(this)[0].files.length;
          var imgPath = jQuery(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = jQuery("#keynote-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  jQuery("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
		jQuery("#client_img").on('change', function() {
          //Get count of selected files
		
          var countFiles = jQuery(this)[0].files.length;
          var imgPath = jQuery(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = jQuery("#client_img_holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  jQuery("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
/**************** add more keynote**************/
	var max_fields      = 3; //maximum input boxes allowed
    var wrapper         = $(".keynote-contnr"); //Fields wrapper
    var add_button      = $("#add-more-keynote"); //Add button ID
    
    var x = 0; //initlal text box count
    jQuery(add_button).click(function(e){ 

         e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
			jQuery.ajax({
            type: "POST",
            url: '<?php echo site_url(); ?>'+'/wp-content/themes/Speakersyndicate/keynote_program.php',
            data: {DivId : x},
            beforeSend: function(){
               // jQuery('#result').html('<img src="loading.gif" />');
            },
            success: function(data){
               
				//jQuery(data).insertAfter('div.keynote-box:last');     
				
				jQuery(wrapper).append(data);
				//alert(data);
            }
        });
            //jQuery(wrapper).append(); //add input box
        } 
    });
   
    jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        //e.preventDefault(); jQuery(this).parent('div').remove(); x--;
		var currentId		=	jQuery(this).attr('divid');
		var closeCls		=	'close_'+currentId+'';
		//alert(closeCls);
		jQuery('.'+closeCls+'').remove(); x--;
    })	
 	$(".keynote-contnr").on("click", ".daga", function(){
			
			var $picid 			= jQuery(this).attr("picid");
			var $holderid 		= jQuery(this).attr("holderid");
			var onchangeId 		= '#' + $picid;
			var holderid 		= '#' + $holderid;
			jQuery(onchangeId).on('change', function() {
      
          var countFiles = jQuery(this)[0].files.length;
          var imgPath = jQuery(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = jQuery(holderid);
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  jQuery("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
			
});
/**************** add more testinomial**************/
	var max_fields_test      = 3; //maximum input boxes allowed
    var wrapper_test         = $(".testimonial-set-up"); //Fields wrapper
    var add_button_test      = $(".add-more-key-testimonial"); //Add button ID
    
    var counter = 0; //initlal text box count
    jQuery(add_button_test).click(function(e){ 

         e.preventDefault();
        if(counter < max_fields_test){ //max input box allowed
            counter++; //text box increment
			jQuery.ajax({
            type: "POST",
            url: '<?php echo site_url(); ?>'+'/wp-content/themes/Speakersyndicate/more_testnomial.php',
            data: {testimonialId : counter},
            beforeSend: function(){
               // jQuery('#result').html('<img src="loading.gif" />');
            },
            success: function(data){
               
				//jQuery(data).insertAfter('div.keynote-box:last');     
				
				jQuery(wrapper_test).append(data);
				//alert(data);
            }
        });
            //jQuery(wrapper).append(); //add input box
        } 
    });
    
    jQuery(wrapper_test).on("click",".remove_field", function(e){ //user click on remove text
       var currentId		=	jQuery(this).attr('testimonialId');
		var closeCls		=	'close_'+currentId+'';
		jQuery('.'+closeCls+'').remove(); counter--;
    })	
 	$(".testimonial-set-up").on("click", ".customCls", function(){
			
			var $picid 			= jQuery(this).attr("picid");
			var $holderid 		= jQuery(this).attr("holderid");
			var onchangeId 		= '#' + $picid;
			var holderid 		= '#' + $holderid;
			jQuery(onchangeId).on('change', function() {
      
          var countFiles = jQuery(this)[0].files.length;
          var imgPath = jQuery(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = jQuery(holderid);
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  jQuery("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
			
}); 
/****** submit form******/
    jQuery('.btn-sunet1').click(function(e){ 

         e.preventDefault();
   jQuery.ajax({
            type: "POST",
            url: '<?php echo site_url(); ?>'+'/wp-content/themes/Speakersyndicate/profile_setup_ajax.php',
            data:jQuery('#speaker-pro-setup').serialize(),
            beforeSend: function(){
               // jQuery('#result').html('<img src="loading.gif" />');
            },
            success: function(data){
               jQuery(wrapper).append(data);
				//alert(data);
            }
        });
    }); 
  });

 
</script>
<?php get_footer(); ?>