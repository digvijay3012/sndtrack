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
                <h2 class="text-center">Welcome</h3>
            </div>
            <p class="note_dash text-center">Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
			<div id="infoMessage"><?php echo $this->session->flashdata('item'); ?></div>
			<?php //if(isset($error)){echo $error;}?>
            <div class="login_cont text-center">
              <?php	
					$attributes = array('class' => 'login_form', 'id' => 'music_submission_form');
					echo form_open_multipart('artist/music_submission', $attributes); 
				?>
                    <ul>
                        <li>
                            <select name="song_type">
                                <option value="mp3">Upload Mp3</option>
                                
                            </select>
                        </li>
						<li>
                            <select name="track_type" id="track_type">
							 <option value="">Select Track</option>
                                <option value="single_track">Single Track</option>
                                 <option value="album">Album</option>
                            </select>
                        </li>
						<span id="track_img" style="display:none">
								 <li>
								Uplaod Track image: <input type="file" onchange="return ValidateImageUpload('track_image')" name="track_image" id="track_image">
									<?php  echo form_error('track_image'); ?>
								</li>
						</span>
						<span id="album_img" style="display:none">
						<?php  if(!empty($data)){
							echo ' <li><select name="album_name"><option value="">Select your album name.</option>';
							
							foreach($data as $albumData){
								$albumId 	=	$albumData['id']; 
								$albumName 	=	$albumData['album_name']; 
								echo '<option value="'.$albumId.'">'.$albumName.'</option>';
							}
							echo '</select> </li>';
						}else{
							 echo '<li><select name="album_name"><option value="">No Data available.</option></select> </li>';
						}
						
						?>
						</span>
						 <li>
                            Uplaod Music file: <input type="file" onchange="return ValidateFileUpload('upload_song')" name="upload_song" id="upload_song">
								<?php  echo form_error('upload_song'); ?>
                        </li>
						
						 
                        <li>
                            <input type="text" name="song_name" placeholder="Song Name">
							<?php  echo form_error('song_name'); ?>
                        </li>
                        <li>
                            <input type="text" name="instrument_tag" placeholder="instruments Tag">
							<?php  echo form_error('instrument_tag'); ?>
                        </li>
                        <li>
                            <input type="text" name="song_credits" placeholder="Writer Credits">
							<?php  echo form_error('song_credits'); ?>
                        </li>

                        <li>
                            <textarea name="song_notes" placeholder="Notes"></textarea>
							<?php  echo form_error('song_notes'); ?>
                        </li>
                        <li>
                            <button required="" name="submit" id="send" type="submit" class="sbmt hover_btn">Send</button>
                        </li>
                    </ul>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
<script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>

 <script>
	 $('#track_type').on('change', function() {
		var tarckType	=	this.value;
		if(tarckType	==	'single_track'){
			$('#track_img').show();
			$('#album_img').hide();
		}else if(tarckType	==	'album'){
			$('#album_img').show();
			$('#track_img').hide();
		}
	});
	
	 function ValidateFileUpload($inputId) {
	var fuData = document.getElementById($inputId);
	var FileUploadPath = fuData.value;
	if (FileUploadPath == '') {
		
		sweetAlert('', 'Please upload music file.', 'error');

	} else {
		var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
		if (Extension == "mp3" ) {
			if (fuData.files && fuData.files[0]) {
				jQuery('.sbmt').removeAttr("disabled");
					var size = fuData.files[0].size;
					//alert(size);
					var MAX_SIZE	=	15000000;
					if(size > MAX_SIZE){
					  
						sweetAlert('Oops...', 'Maximum file size exceeds.', 'error');
						return;
					}
				}
			} 
	else {
			sweetAlert('Oops...', 'Only allows mp3 files.', 'error');
			jQuery('.sbmt').attr("disabled","disabled");
			return false;
		}
	}}

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
			//jQuery('.sbmt').removeAttr("disabled");
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
		return false;
    }
}}
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
            $("#music_submission_form").validate({
                rules: {
					track_type: "required",
                    upload_song: "required",
                    song_name: "required",
                    instrument_tag: "required",
					song_credits: "required",
					song_notes: "required"
                },
                messages: {
                    track_type: "Please select your Track type.",
                    upload_song: "Please upload music file.",
					song_name: "Please enter song name.",
                    instrument_tag: "Please enter tags.",
					song_credits: "Please enter credits.",
					song_notes: "Please enter notes.",
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