<?php
$adminData	=	$this->ion_auth->user()->row();
if(!empty($adminData)){
	$superAdminID 	=		$adminData->id;
	$adminEmail 	=		$adminData->email;
	$first_name 	=		$adminData->first_name;
	$last_name 		=		$adminData->last_name;
}
			
?>
<div class="dashboard_cont">
        <div class="container">
            <div class="welcom_strip tex-center">
                <h2 class="pull-left"><?php echo $first_name." ".$last_name;  ?></h2>
                <h2 class="text-center">Manage Journal</h3>
            </div>
         <div class="artist_draft_cont">
           
				<?php echo $this->session->flashdata('item'); ?>
             <h2 class="artst_drft_table">Post List</h2>
			<a href="<?php echo base_url(); ?>administrator/journal/add">Add New Post</a>
					
                        <div class="table-responsive">
                            <table id="page_list_table" class="table">
							
                               <thead>
									<tr>
										<th colspan="2">Sr No.</th>
										<th>Page Title</th>
										<th>Edit</th>
										<th>Delete</th>
										<th></th>
										
									</tr>
							</thead>
							
							<tbody>
							<?php if(!empty($data)){
								$counterFlag	=	'';	
							//echo "<pre>";	print_r($data);  echo "</pre>";	 die;
								foreach($data	as  $pagesData){
									$pageID 			=	$pagesData['id'];
									$page_tittle 		=	$pagesData['post_title'];
									
								$counterFlag++;	
							?>
							<tr>
								<td></td>
								
								<td><?php echo $counterFlag; ?></td>
                                <td><?php echo $page_tittle; ?></td>
                                <td class="lst_data">
									<a href="<?php echo base_url(); ?>administrator/journal/edit_journal_page/<?php echo $pageID; ?>">Edit Page</a>
                               </td>
							   <td>	<a onclick="return confirm('Are you sure you want to delete this post?');" href="<?php echo base_url()."administrator/journal/delete_journal/".$pageID; ?>">Delete</a></td>
						  </tr>
								
							<?php } } else { ?>
							<tr>
								
                                <td></td>
                                <td></td>
                                <td>No Records found</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
							</tr>
							<?php } ?>							
							 </tbody>
                          </table>
                       </div>
                   
            </div>
        </div>
    </div>
<script>
$(document).ready(function(){

});
</script>