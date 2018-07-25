                  <!-- Login Form Modal Starts here -->
                   
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
		 
		
		 
        <div class="login-form" id="login-form">
				<div class="title-default-left-bold"><?php _e("Sign in"); ?></div>				
				 <?php wp_login_form();?>	
				<br/> <a class="lost"  href="<?php if(get_option('cm_reset_password_page_id')) { _e(get_page_link(get_option('cm_reset_password_page_id'))); }else { _e('javascript:void();'); } ?>" >
					<?php _e("Lost your password?"); ?></a> | <a  class="lost"  href="<?php if(get_option('cm_register_page_id')) { _e(get_page_link(get_option('cm_register_page_id'))); }else { _e('javascript:void();'); } ?>" ><?php _e("Register"); ?></a><br/>	
			  </div>
                
				</div>
        </div>
       
      </div>
      
    </div>
 <!-- Login Form Modal Ends here -->
                    <!-- Modal -->
    <div class="modal fade" id="registerModal" role="dialog">
        <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                    <div class="modal-body">
                        
                <h2 style="text-align:center">Register/Sign In To Access</h2>
                <div class="register-button">
                 <a class="btn btn-default default-big-btn"  href="register.php" >Register</a>
                 <a class="btn btn-default default-big-btn " data-toggle="modal" data-target="#myModal" href="#"  data-dismiss="modal">Sign In</a>
                 <button type="button" class="btn btn-default default-big-btn " data-dismiss="modal">Cancel</button>
                 </div>
                 </div>
             </div>
        </div>
    </div>