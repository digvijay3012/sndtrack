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
                <h2 class="text-center">Manage Pages</h3>
            </div>
         <div class="artist_draft_cont">
           
				<?php echo $this->session->flashdata('item'); ?>
             <h2 class="artst_drft_table">Page List</h2>
		
					
                        <div class="table-responsive">
                            <table id="page_list_table_2" class="table">
							
                               <thead>
									<tr>
										<th colspan="2">Sr No.</th>
										<th>Page Title</th>
										<th>Edit</th>
										
										<th></th>
										
									</tr>
							</thead>
							
							<tbody>
							<?php if(!empty($data)){
								$counterFlag	=	'';	
							//echo "<pre>";	print_r($data);  echo "</pre>";	 die;
								foreach($data	as  $pagesData){
									$pageID 			=	$pagesData['id'];
									$page_tittle 		=	$pagesData['page_title'];
									
								$counterFlag++;	
							?>
							<tr>
								<td></td>
								
								<td><?php echo $counterFlag; ?></td>
                                <td><?php echo $page_tittle; ?></td>
                                <td class="lst_data">
								<?php
									if($pageID==5){ ?>
										<a href="<?php echo base_url(); ?>administrator/pages/edit_home_page/<?php echo $pageID; ?>">Edit Page</a>
									<?php }else{ ?>	
										<a href="<?php echo base_url(); ?>administrator/pages/edit_page/<?php echo $pageID; ?>">Edit Page</a>									
									<?php } ?>
									
                               </td>
							  
						  </tr>
								
							<?php } } else { ?>
							<tr>
								
                                <td></td>
                                <td></td>
                                <td>No Records found</td>
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