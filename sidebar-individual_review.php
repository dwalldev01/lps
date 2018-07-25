   
   <div class="col-md-10 ">
        <h2 class="title-default-left"><?php _e("Review Information");?></h2>
	
		<form name="confirm_payment_form" method="post">
		<input type="hidden" name="formaction" value="paypal_individual_payment" />
			<?php
		$venue =  get_post_meta($_POST['schedule_course'],'scheduled_course_settings_address',true);
	$date =  get_post_meta($_POST['schedule_course'],'scheduled_course_settings_start-date',true);
		$totalfees= number_format($_POST['course_fees'],2);
		//print_r($_POST);
		foreach ($_POST as $key =>$value) { ?>
		<input type="hidden" name="<?php _e($key); ?>" value="<?php _e($value); ?>" />
		<?php }?>
		<div class="container">
				<div class="row">
				
				
				   <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Course Category :</label>
                </div>
				
				    <div class="col-md-9">
                  <div class="form-group">
                               <?php _e($_POST['category_name']);?>
              </div>
                </div>
				   
				   </div>
				    <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Course Name :</label>
                </div>
				
				    <div class="col-md-9">
                  <div class="form-group">
                               <?php _e($_POST['course_name']);?>
              </div>
                </div>
				   
				   </div>
				 
				     <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Course Fees :</label>
                </div>
				
				    <div class="col-md-9">
                  <div class="form-group">
                             <?php _e(get_option('cm_currency').' '.$totalfees);?> + GST (<?php _e(get_option('cm_singapore_tax')); ?>%)
              </div>
                </div>
				   
				   </div>
				    <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Scheduled Date :</label>
                </div>
				
				    <div class="col-md-9">
                  <div class="form-group">
                             <?php _e(date("d M, Y",strtotime($date)));?>
                  
              </div>
                </div>
				 <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Location :</label>
                </div>
				
				    <div class="col-md-9">
                  <div class="form-group">
                             <?php _e($venue);?>
                  
              </div>
                </div>
				   
				   </div>
				     <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Name :</label>
                </div>
				
				    <div class="col-md-9">
                  <div class="form-group">
                                 <?php _e($_POST['full_name']);?>
              </div>
                </div>
				   
				   </div>
				     <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Mobile :</label>
                </div>
				
				    <div class="col-md-9">
                  <div class="form-group">
                                 <?php _e($_POST['mobile']);?>
              </div>
                </div>
				   
				   </div>
				     <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Email :</label>
                </div>
				
				    <div class="col-md-9">
                  <div class="form-group">
                                 <?php _e($_POST['payer_email']);?>
              </div>
                </div>
				   
				   </div>
				     <div class="col-md-12">
				   
				    <div class="col-md-3">
                 <label>Total Payment :</label>
                </div>				
				    <div class="col-md-9">
                  <div class="form-group">
                                  <?php _e(get_option('cm_currency')." ".number_format($_POST['total_payment'],2));?>
              </div>
                </div>
				   
				   </div>
				   	<div class="col-md-12">
			 <div class="col-md-3">
               
                </div>
				 <div class="col-md-9">
            <div class="form-group">
			 <input type="image" name="submit" border="0"
        src="<?php bloginfo('template_url');?>/images/paypal_payment.png" alt="PayPal - The safer, easier way to pay online">
				<?php /* ?>
                  <button class="default-big-btn2" type="submit" name="submit" value="">Pay Now</button>
                  <button class="default-big-btn2" type="reset" value="">Back</button>
				  <?php */ ?>
                </div>
          </div></div>
				</div>
			</div>
		</form>
	</div>