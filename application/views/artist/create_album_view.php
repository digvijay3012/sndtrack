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
					$attributes = array('class' => 'login_form', 'id' => 'album-form');
					echo form_open_multipart('artist/music/create_album', $attributes); 
				?>
                    <ul>
                      
					
							 <li>
								<input type="text" name="album_name" placeholder="Album Name">
								<?php  echo form_error('album_name'); ?>
							</li>
								 <li>
								Uplaod Album image: <input type="file" onchange="return ValidateImageUpload('album_image')" name="album_image" id="album_image">
									<?php  echo form_error('album_image'); ?>
								</li>
						
                        <li>
                            <button required="" name="submit" id="send" type="submit" class="sbmt hover_btn">Send</button>
                        </li>
                    </ul>
                <?php echo form_close();?>
            </div>
			
        </div>
		<div class="table-responsive">
                            <table class="table" id="example">
                                <tbody>
									<tr>
										<td class="width_tittle nme_user">Sr. No.</td>
										<td>Album Name</td>
										<td class="lst_data">
											Action
										</td>
									</tr>
						<?php if(!empty($data)){
							$counter='';
							foreach($data as $albumsData){
								$albumID		=	$albumsData['id'];
								$album_name		=	$albumsData['album_name'];
								$counter++; ?>
									<tr>
										<td class="width_tittle nme_user"><?php echo $counter; ?></td>
										<td><?php echo $album_name; ?></td>
										<td class="lst_data">
										<a onclick="return confirm('Are you sure you want to delete this album?');" href="<?php echo base_url()."artist/music/delete_album/".$albumID; ?>">Delete Album</a>
										</td>
									</tr>	
								
					<?php } } else { echo "No data to display.";} ?>
					</tbody>
                            </table>
                        </div>
			</div>
	
<script src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>

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
			jQuery('.sbmt').removeAttr("disabled");
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
		jQuery('.sbmt').prop('disabled', true);	
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
            $("#album-form").validate({
                rules: {
					album_name: "required"
                   
                },
                messages: {
                    album_name: "Please enter album name."
                  
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