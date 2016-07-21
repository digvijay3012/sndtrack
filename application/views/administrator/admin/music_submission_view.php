<?php
$AdminData	=	$this->ion_auth->user()->row();
if(!empty($AdminData)){
	$adminId 		=		$AdminData->user_id;
	$first_name 	=		$AdminData->first_name;
	$last_name 		=		$AdminData->last_name;
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
					echo form_open_multipart('administrator/music', $attributes); 
				?>
                    <ul>
                        <li>
                            <select name="song_type">
                                <option value="mp3">Upload Mp3</option>
                                
                            </select>
                        </li>
						<?php   
						$artistData =	get_allArtistsBy_adminId($adminId);
						if(!empty($artistData)){
							echo ' <li><select id="artist_id" name="artist_id"><option value="">Select artist name.</option>';
							
							foreach($artistData as $getData){
								$artsistId 		=	$getData['id']; 
								$artsistFname 	=	$getData['first_name']; 
								$artsistLname 	=	$getData['last_name']; 
								echo '<option value="'.$artsistId.'">'.$artsistFname." ".$artsistLname.'</option>';
							}
							echo '</select> </li>';
						}else{
							 echo '<li><select name="artist_id"><option value="">No Data available.</option></select> </li>';
						}
						 
						?>
					
						 <li>
                            Uplaod Music file: <input type="file" onchange="return ValidateFileUpload('upload_song')" name="upload_song[]" class="mycls"  multiple  id="upload_song">
								<?php  echo form_error('upload_song'); ?>
								<div id="filerror"></div>
								 <div class="uploading" style="display:none">
								
									<img src="<?php echo base_url(); ?>images/uploading.gif"/>
								</div>
								<div class="gallery" id="images_preview"></div>
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
                            <button required="" name="submit" id="send" type="submit" class="sbmt hover_btn">Save</button>
                        </li>
                    </ul>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
<script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>js/fileInputmin.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.form.js"></script>
 <script>
 function ValidateFileUpload($inputId) {
	var fuData = document.getElementById($inputId);
	var FileUploadPath = fuData.value;
	if (FileUploadPath == '') {
		//$("#filerror").text('test');
		
		sweetAlert('', 'Please upload music file.', 'error');
		
		return false;
	} else {
		jQuery( '#filerror' ).removeClass( 'red-class' );
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
			/* var errorMsg = "<p>Example error message</p>";
		document.getElementById("filerror").innerHTML = errorMsg; */
		jQuery( '#filerror' ).addClass( 'red-class' );
			jQuery('.sbmt').attr("disabled","disabled");
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
					artist_id: "required",
                    upload_song: "required",
                   instrument_tag: "required",
					song_credits: "required",
					song_notes: "required"
                },
                messages: {
                    artist_id: "Please select artist.",
                    upload_song: "Please upload music file.",
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
<script type="text/javascript">
$(document).ready(function(){
	
	$('.mycls').on('change',function(){
	var artist_id = $("#artist_id option:selected").val();
	if(artist_id==''){
			sweetAlert('Oops...', 'Plaese select artist.', 'error');
			return false;
	}
	if ($("#filerror").hasClass( "red-class" )) {
		return false;
	}
	var data = new FormData();
	var fileCount			=	'';
	var image_form_submit	=	1;
	jQuery.each($("#upload_song")[0].files, function(i, file) {
     data.append('musicfiles_'+i, file);
	 fileCount++;
 });
data.append("fileCount", fileCount); 
data.append("artist_id", artist_id);    
data.append("image_form_submit", image_form_submit);
	var url	=	'<?php echo base_url(); ?>administrator/music/upload_image';
	$('.uploading').show();
		$.ajax({
        url: url,
		contentType: false,
		processData: false,
		data: data,                         // Setting the data attribute of ajax with file_data
		type: 'post',
		success:function(data){
				$('.uploading').hide();
				$('#images_preview').empty().html(data);
			}
	});
		 
	return false;	
	});	
});
$(document).on('click','.delete-file-handle',function(){
var pid		=	$(this).attr('pid');
var url		=	'<?php echo site_url(); ?>administrator/music/delete_mucic_file/'+pid;	

$.ajax({
        url: url,
		data: {pid : pid},                         // Setting the data attribute of ajax with file_data
		type: 'post',
		success:function(data){
				var removeLi 	=	"#music_li_"+pid; 
				$(removeLi).remove();
			}
	});
});
</script>