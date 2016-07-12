<div class="dashboard_cont">
<div class="container">
            <div class="welcom_strip tex-center">
                <h2 class="pull-left">Greg Keegan </h2>
                <h2 class="text-center">Welcome</h2>
            </div>
            <p class="note_dash text-center">Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
			<div id="infoMessage"></div>
		
			<div class="login_cont text-center">
			<?php 
					$artistId = $this->uri->segment(4);
					$actionUrl 	=	"administrator/accounts/reset_password/".$artistId;
					$attributes = array('class' => 'login_form', 'id' => 'reset_password_form');
					echo form_open($actionUrl, $attributes); 
			?>
                    <ul>
						<li>
							<input type="text" placeholder="Password" name="password">
						</li>
							 <li>
								<input type="text" placeholder="Confirm Password Name" name="cpassword">
							</li>
						
                        <li>
                            <button class="sbmt hover_btn" type="submit" id="send" name="submit" required="">Send</button>
                        </li>
                    </ul>
               <?php echo form_close(); ?>   
			</div>
	 </div>
</div>