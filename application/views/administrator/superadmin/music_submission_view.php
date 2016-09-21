<?php
$adminData	=	$this->ion_auth->user()->row();
if(!empty($adminData)){

	$first_name 	=		$adminData->first_name;
	$last_name 		=		$adminData->last_name;
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
                        
						<?php   
						$artistData =	get_allArtists();
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
						<?php  echo form_error('artist_id'); ?>
					<?php   
						$categoryData =	get_allCategory();
						if(!empty($categoryData)){
							echo ' <li><select id="cat_id" name="cat_id"><option value="">Select category name.</option>';
							
							foreach($categoryData as $getData){
								$catId 			=	$getData['id']; 
								$category_name 	=	$getData['category_name']; 
								
								echo '<option value="'.$catId.'">'.$category_name.'</option>';
							}
							echo '</select> </li>';
						}else{
							 echo '<li><select name="cat_id"><option value="">No Data available.</option></select> </li>';
						}
						 
						?>
						<?php  echo form_error('cat_id'); ?>
						 
						 <li>
                            Upload Watermark Music file: <input type="file" onchange="return ValidateFileUpload('upload_song_1')" name="watermark_format" formatid="1" class="mycls" id="upload_song_1">
								<div class="filerror"></div>
								 <div class="uploading_1" style="display:none">
								
									<img src="<?php echo base_url(); ?>images/uploading.gif"/>
								</div>
								<div class="gallery" id="images_preview_1"></div>
                        </li>
						 <li>
                            Upload lite Version Music file: <input type="file" onchange="return ValidateFileUpload('upload_song_2')" name="lite_version" formatid="2" class="mycls" id="upload_song_2">
								<div class="filerror"></div>
								 <div class="uploading_2" style="display:none">
								
									<img src="<?php echo base_url(); ?>images/uploading.gif"/>
								</div>
								<div class="gallery" id="images_preview_2"></div>
                        </li>
						 <li>
                            Upload Personal format Music file: <input type="file" onchange="return ValidateFileUpload('upload_song_3')" name="personal_format" formatid="3" class="mycls" id="upload_song_3">
								<div class="filerror"></div>
								 <div class="uploading_3" style="display:none">
								
									<img src="<?php echo base_url(); ?>images/uploading.gif"/>
								</div>
								<div class="gallery" id="images_preview_3"></div>
                        </li>
						 <li>
                            Upload Standard licence Music file: <input type="file" onchange="return ValidateFileUpload('upload_song_4')" name="standard_licence" formatid="4" class="mycls" id="upload_song_4">
								<div class="filerror"></div>
								 <div class="uploading_4" style="display:none">
								
									<img src="<?php echo base_url(); ?>images/uploading.gif"/>
								</div>
								<div class="gallery" id="images_preview_4"></div>
                        </li>
						 <li>
                            Upload Premium licence Music file: <input type="file" onchange="return ValidateFileUpload('upload_song_5')" name="premium_licence" formatid="5" class="mycls" id="upload_song_5">
								<div class="filerror"></div>
								 <div class="uploading_5" style="display:none">
								
									<img src="<?php echo base_url(); ?>images/uploading.gif"/>
								</div>
								<div class="gallery" id="images_preview_5"></div>
                        </li>
						<li>
							<select name="short_order" id="short_order">
								<option value="">Select Order By</option>
								<option value="Newest">Newest</option>
								<option value="Trending">Trending</option>
								<option value="Longest">Longest</option>
								<option value="Shortest">Shortest</option>
							</select>
							<?php  echo form_error('short_order'); ?>
						</li>
						<li>
							<select name="energy_level" id="energy_level">
								<option value="">Select energy level</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
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
		jQuery( '.filerror' ).removeClass( 'red-class' );
		var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
		if (Extension == "mp3" || Extension == "wav") {
			if (fuData.files && fuData.files[0]) {
				jQuery('.sbmt').removeAttr("disabled");
					var size = fuData.files[0].size;
					//alert(size);
					var MAX_SIZE	=	15000000000000;
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
		jQuery( '.filerror' ).addClass( 'red-class' );
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
					cat_id: "required",
                     short_order: "required",
					 energy_level: "required",
                   instrument_tag: "required",
					song_credits: "required",
					song_notes: "required",
					watermark_format: "required",
					lite_version: "required",
					personal_format: "required",
					standard_licence: "required",
					premium_licence: "required"
                },
                messages: {
                    artist_id: "Please select artist.",
					cat_id: "Please select category name.",
                   short_order: "Please select order by.",
				   energy_level: "Please select energy level.",
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
	
	var cat_id = $("#cat_id option:selected").val();	
	var artist_id = $("#artist_id option:selected").val();
	if(cat_id==''){
			sweetAlert('Oops...', 'Plaese select category.', 'error');
			return false;
	}
	if(artist_id==''){
			sweetAlert('Oops...', 'Plaese select artist.', 'error');
			return false;
	}
	if ($(".filerror").hasClass( "red-class" )) {
		return false;
	}
	var formatid		=	$(this).attr('formatid');
	var column_name		=	$(this).attr('name');
	var upload_song 	=	"#upload_song_"+formatid; 
	var images_preview	=	"#images_preview_"+formatid; 
	var uploading		=	".uploading_"+formatid; 
	var data = new FormData();
	var fileCount			=	'';
	var image_form_submit	=	1;
	jQuery.each($(upload_song)[0].files, function(i, file) {
     data.append('musicfiles_'+i, file);
	 fileCount++;
 });
data.append("fileCount", fileCount); 
data.append("artist_id", artist_id);  
data.append("cat_id", cat_id); 
data.append("column_name", column_name);   
data.append("image_form_submit", image_form_submit);
	var url	=	'<?php echo base_url(); ?>administrator/music/upload_music';
	$(uploading).show();
		$.ajax({
        url: url,
		contentType: false,
		processData: false,
		async:	false,
		data: data,                         // Setting the data attribute of ajax with file_data
		type: 'post',
		success:function(data){
				$(uploading).hide();
				$(images_preview).empty().html(data);
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
$(document).on('click','.delete-file-handle-this',function(){
	$('#music_li_del').remove();
});
</script>