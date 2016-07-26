<?php
$adminData	=	$this->ion_auth->user()->row();
if(!empty($adminData)){
	$first_name 	=		$adminData->first_name;
	$last_name 		=		$adminData->last_name;
}
$ID			=	$this->ion_auth->user()->row()->user_id; 
$groupID 	= 	$this->ion_auth->get_users_groups($ID)->row()->id; 				
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
					$attributes = array('class' => 'login_form', 'id' => 'category-form');
					echo form_open_multipart('administrator/category', $attributes); 
				?>
                    <ul>
					<?php 
						$get_category	=	get_category();
						if(!empty($get_category)){
							echo ' <li><select id="parent_category" name="parent_category">
							<option value="">Select Parent Category.</option>';
							
							foreach($get_category as $getData){
								$parentCatId 		=	$getData['id']; 
								$category_name 		=	$getData['category_name']; 
							
								echo '<option value="'.$parentCatId.'">'.$category_name.'</option>';
							}
							echo '</select> </li>';
						}else{
							 echo '<li><select name="parent_category"><option value="">No Data available.</option></select> </li>';
						}
					?>
							<li>
								<input type="text" name="category_name" placeholder="Category Name">
								<?php  echo form_error('category_name'); ?>
							</li>
							
						
                        <li>
                            <button required="" name="submit" id="send" type="submit" class="sbmt hover_btn">Save</button>
                        </li>
                    </ul>
                <?php echo form_close();?>
            </div>
			
        </div>
		<div class="table-responsive">
                            <table class="table" id="listCategory">
                                <thead>
									<tr>
										<td class="width_tittle nme_user">Sr. No.</td>
										<td>Category Name</td>
										<td>Parent Category</td>
											<?php if($groupID==1){ ?>
									
											<td class="lst_data">
												Action
											</td>
									
											<?php } else { ?>
									<td></td>
									<?php } ?>
										
									</tr>
									</thead>
									<tbody>
						<?php if(!empty($data)){
							$counter='';
							
							foreach($data as $catData){
								$catID		=	$catData['id'];
								$category_name		=	$catData['category_name'];
								$counter++; ?>
									<tr>
										<td class="width_tittle nme_user"><?php echo $counter; ?></td>
										<td><?php echo $category_name; ?></td>
										<td><?php echo get_parentCatName($catID); ?></td>
									<?php if($groupID==1){ ?>
										<td class="lst_data">
										<a onclick="return confirm('Are you sure you want to delete this category?');" href="<?php echo base_url()."administrator/category/delete_category/".$catID; ?>">Delete Category</a>
										</td>
									<?php } else { ?>
									<td></td>
									<?php } ?>
									</tr>	
								
					<?php } } else { echo "No data to display.";} ?>
					</tbody>
                            </table>
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
            $("#category-form").validate({
                rules: {
					parent_category: "required",
					category_name: "required"
                   
                },
                messages: {
					 parent_category: "Please select parent category.",
                    category_name: "Please enter category name."
                  
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
