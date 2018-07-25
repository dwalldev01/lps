<?php 

add_action('admin_menu', 'add_theme_pages');

 function add_theme_pages() {

	add_theme_page('Theme Options', 'Theme Options', 8, 'themeoptions', 'themeoptions');
	
}

function themeoptions () { 

?>

<div class="wrap"> <?php echo "<h2 style='margin-bottom:25px;font-size:26px;'>" . __( get_option('blogname')) . " Themes Settings</h2>"; ?>

	<form method="post" action="options.php">

		<?php wp_nonce_field('update-options'); 

		?>

        <div class="inside">

         	<h2><?php _e('General Settings');?></h2>

            <div class="table">

                <table class="form-table">
			
					
					 <tr valign="top">

                        <td width="300" align="right"><label for="cm_contact_number"><?php _e('Contact Number');?></label></td>

                        <td>

 <input  name="cm_contact_number"  id="cm_contact_number" size="60" value="<?php echo get_option('cm_contact_number');?>" />
                        
           </td>

                    </tr>
					<tr valign="top">

                        <td width="300" align="right"><label for="cm_contact_number"><?php _e('Top Mobile Text');?></label></td>

                        <td>

 <input  name="cm_top_mobile_text"  id="cm_top_mobile_text" size="60" value="<?php echo get_option('cm_top_mobile_text');?>" />
                        
           </td>

                    </tr>
					 <tr valign="top">

                        <td width="300" align="right"><label for="cm_company_registration_number"><?php _e('Company Registration Number');?></label></td>

                        <td>

 <input  name="cm_company_registration_number"  id="cm_company_registration_number" size="60" value="<?php echo get_option('cm_company_registration_number');?>" />
                        
           </td>

                    </tr>
					 <tr valign="top">

                        <td width="300" align="right"><label for="cm_tax_registration_number"><?php _e('Tax Registration Number');?></label></td>

                        <td>

 <input  name="cm_tax_registration_number"  id="cm_tax_registration_number" size="60" value="<?php echo get_option('cm_tax_registration_number');?>" />
                        
           </td>

                    </tr>
				 <tr valign="top">

                        <td width="300" align="right"><label for="cm_footer_contact_number"><?php _e('Footer Contact Number');?></label></td>

                        <td>

 <input  name="cm_footer_contact_number"  id="cm_footer_contact_number" size="60" value="<?php echo get_option('cm_footer_contact_number');?>" />
                        
           </td>

                    </tr>	
           <tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Admin Contact Email ID');?></label></td>

                        <td>

 <input  name="admin_contact_email"  id="admin_contact_email" size="60" value="<?php echo get_option('admin_contact_email');?>" />

                        
           </td>

                    </tr>
					 <tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Invoice Contact No');?></label></td>

                        <td>

 <input  name="cm_invoice_contact"  id="cm_invoice_contact" size="60" value="<?php echo get_option('cm_invoice_contact');?>" />

                        
           </td>

                    </tr>
					 <tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Invoice Email ID');?></label></td>

                        <td>

 <input  name="invoice_contact_email"  id="invoice_contact_email" size="60" value="<?php echo get_option('invoice_contact_email');?>" />

                        
           </td>

                    </tr>
				 <tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Website for Invoice');?></label></td>

                        <td>

 <input  name="cm_website"  id="cm_website" size="60" value="<?php echo get_option('cm_website');?>" />

                        
           </td>

                    </tr>					
				 <tr valign="top">

                        <td width="300" align="right"><label for="cm_address"><?php _e('Contact Page Address');?></label></td>

                        <td>

 <textarea  name="cm_address" rows="7" cols="60" id="cm_address" size="100" ><?php echo get_option('cm_address');?></textarea>

                        
           </td>

                    </tr>	
					
                   
   <tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Footer About Us');?></label></td>

                        <td>

 <textarea  name="footer_content" rows="7" cols="60" id="footer_content" size="100" ><?php echo get_option('footer_content');?></textarea>

                        
           </td>

                    </tr> 
					<tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Footer Copyright Message');?></label></td>

                        <td>

 <textarea  name="footer_copyright_message" rows="7" cols="60" id="footer_copyright_message" size="100" ><?php echo get_option('footer_copyright_message');?></textarea>

                        
           </td>

                    </tr> 
					<tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Google Analytics Code');?></label></td>

                        <td>

 <textarea  name="cm_google_analytics" rows="7" cols="60" id="cm_google_analytics" size="100" ><?php echo get_option('cm_google_analytics');?></textarea>

                        
           </td>

                    </tr> cm_start_course_link
				  <tr valign="top">

                        <td width="300" align="right"><label for="cm_contact_page_id"><?php _e('Banner Start a Course Link');?></label></td>

                        <td>
           
 <input  name="cm_start_course_link"  id="cm_start_course_link" size="60" value="<?php echo get_option('cm_start_course_link');?>" />

            
           </td>

                    </tr>		

					  <tr valign="top">

                        <td width="300" align="right"><label for="cm_contact_page_id"><?php _e('Set Contact Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_contact_page_id', 
	'selected'	    => get_option('cm_contact_page_id'), 
); 
			wp_dropdown_pages( $args ); ?> 


            
           </td>

                    </tr>	
					
				  <tr valign="top">

                        <td width="300" align="right"><label for="cm_register_page_id"><?php _e('Set Registration Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_register_page_id', 
	'selected'	    => get_option('cm_register_page_id'), 
); 
			wp_dropdown_pages( $args ); ?> 


            
           </td>

                    </tr>	 
					  	  
				  <tr valign="top">

                        <td width="300" align="right"><label for="cm_account_page_id"><?php _e('Set Edit Account Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_account_page_id', 
	'selected'	    => get_option('cm_account_page_id'), 
); 
			wp_dropdown_pages( $args ); ?> 


            
           </td>

                    </tr>
					  <tr valign="top">

                        <td width="300" align="right"><label for="cm_reset_password_page_id"><?php _e('Set Reset Password Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_reset_password_page_id', 
	'selected'	    => get_option('cm_reset_password_page_id'), 
); 
			wp_dropdown_pages( $args ); ?> 


            
           </td>

                    </tr>
					 <tr valign="top">

                        <td width="300" align="right"><label for="cm_history_page_id"><?php _e('Set User History Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_history_page_id', 
	'selected'	    => get_option('cm_history_page_id'), 
); 
			wp_dropdown_pages( $args ); ?> 


            
           </td>

                    </tr>
					 <tr valign="top">

                        <td width="300" align="right"><label for="cm_individual_registration_page_id"><?php _e('Set Individual Enrol Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_individual_registration_page_id', 
	'selected'	    => get_option('cm_individual_registration_page_id'), 
); 
			wp_dropdown_pages( $args ); ?> 
            
           </td>
                    </tr>
						 <tr valign="top">

                        <td width="300" align="right"><label for="cm_group_registration_page_id"><?php _e('Set Group Enrol Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_group_registration_page_id', 
	'selected'	    => get_option('cm_group_registration_page_id'), 
); 
			wp_dropdown_pages( $args ); ?> 


            
           </td>

                    </tr> 
					 <tr valign="top">

                        <td width="300" align="right"><label for="cm_paypal_success_page"><?php _e('Set Paypal Success Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_paypal_success_page', 
	'selected'	    => get_option('cm_paypal_success_page'), 
); 
			wp_dropdown_pages( $args ); ?> 


            
           </td>

                    </tr> 
					 <tr valign="top">

                        <td width="300" align="right"><label for="cm_paypal_cancel_page"><?php _e('Set Paypal Cancel Page');?></label></td>

                        <td>
            <?php 
			$args = array(   
    'name'          => 'cm_paypal_cancel_page', 
	'selected'	    => get_option('cm_paypal_cancel_page'), 
); 
			wp_dropdown_pages( $args ); ?> 


            
           </td>

                    </tr> 
						<tr valign="top">

                        <td width="300" align="right"><label for="cm_max_participants"><?php _e('No. of Max Partcipants in Group Registration');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_max_participants');?>" size="60" name="cm_max_participants"  id="cm_max_participants"   >

                        
           </td>

                    </tr>
					
					<tr valign="top">

                        <td width="300" align="right"><label for="cm_home_video_cat_id"><?php _e('No. of Max Module in Course');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_max_module');?>" size="60" name="cm_max_module"  id="cm_max_module"   >

                        
           </td>

                    </tr>
					<tr valign="top">

                        <td width="300" align="right"><label for="cm_home_video_cat_id"><?php _e('Home Video Gallery Category ID');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_home_video_cat_id');?>" size="60" name="cm_home_video_cat_id"  id="cm_home_video_cat_id"   >

                        
           </td>

                    </tr> 
					<tr valign="top">

                        <td width="300" align="right"><label for="cm_training_cat_id"><?php _e('Training Gallery Category ID');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_training_cat_id');?>" size="60" name="cm_training_cat_id"  id="cm_training_cat_id"   >

                        
           </td>

                    </tr> 
					
					<tr valign="top">

                        <td width="300" align="right"><label for="cm_singapore_tax"><?php _e('Singapore Tax (%)');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_singapore_tax');?>" size="60" name="cm_singapore_tax"  id="cm_singapore_tax"   >

                        
           </td>

                    </tr> 
				<tr valign="top">

                        <td width="300" align="right"><label for="cm_currency"><?php _e('Payment Currency (like $,€,£ etc)');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_currency');?>" size="60" name="cm_currency"  id="cm_currency"   >

                        
           </td>

                    </tr> 	
						<tr valign="top">

                        <td width="300" align="right"><label for="cm_company_registraton_number"><?php _e('Company Registration No.');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_company_registraton_number');?>" size="60" name="cm_company_registraton_number"  id="cm_company_registraton_number"   >

                        
           </td>

                    </tr> 
						<tr valign="top">

                        <td width="300" align="right"><label for="cm_tax_registraton_number"><?php _e('Tax Registration Number');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_tax_registraton_number');?>" size="60" name="cm_tax_registraton_number"  id="cm_tax_registraton_number"   >

                        
           </td>

                    </tr> 
					
					
                    </table>

                    </div>

                    </div>  
<div class="inside">

         	<h2><?php _e('Social Network Links');?></h2>

            <div class="table">

                <table class="form-table">
				
		    
 
					 
					<tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Facebook Link');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_facebook_link');?>" size="60" name="cm_facebook_link"  id="cm_facebook_link"   >

                        
           </td>

                    </tr>  
						<tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Instagram Link');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_instagram_link');?>" size="60" name="cm_instagram_link"  id="cm_instagram_link"   >

                        
           </td>

                    </tr> 
					
					<tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Twitter Link');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_twitter_link');?>" size="60" name="cm_twitter_link"  id="cm_twitter_link"   >

                        
           </td>

                    </tr> 
					 
				
					
					
					<tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Linkedin URL');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_linkedin_link');?>" size="60" name="cm_linkedin_link"  id="cm_linkedin_link"   >

                        
           </td>

                    </tr> 
						<tr valign="top">

                        <td width="300" align="right"><label for="menu_title"><?php _e('Google Plus URL');?></label></td>

                        <td>

 <input type="text" value="<?php echo get_option('cm_google_plus_link');?>" size="60" name="cm_google_plus_link"  id="cm_google_plus_link"   >

                        
           </td>

                    </tr>
                    </table>

                    </div>

                    </div>
					
					
      <div class="table">

							  

	    <div>

	      <table width="800" border="0" cellspacing="0" cellpadding="0">

            <tr><br />

              <td width="334"><div align="right"></div></td>

              <td width="460"><input type="submit" value="<?php _e('Save Changes') ?>" name="submit_gallery" id="submit_gallery" /></td>

            </tr>  </table>

	      </td>
        <br />
		<input type="hidden" name="action" value="update" />

		<input type="hidden" name="page_options" value="cm_website,cm_invoice_contact, invoice_contact_email, cm_contact_number,cm_top_mobile_text,cm_company_registration_number, cm_tax_registration_number, cm_footer_contact_number, admin_contact_email,cm_address,footer_content,footer_copyright_message,cm_google_analytics,cm_start_course_link,cm_contact_page_id,cm_register_page_id,cm_account_page_id,cm_reset_password_page_id,cm_history_page_id,cm_individual_registration_page_id,cm_group_registration_page_id,cm_paypal_success_page,cm_paypal_cancel_page,cm_max_participants,cm_max_module,cm_home_video_cat_id, cm_training_cat_id,cm_singapore_tax,cm_currency,cm_company_registraton_number,cm_tax_registraton_number, cm_facebook_link,cm_instagram_link,cm_twitter_link,cm_google_plus_link,cm_linkedin_link" />

	</form>

	 </div>

	

	

</div>

<?php

}
?>