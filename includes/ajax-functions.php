<?php

add_action( 'wp_ajax_getschedulecoursename', 'cm_getschedulecoursename' );
add_action( 'wp_ajax_getpaymentmethodfields', 'cm_getpaymentmethodfields' );
add_action( 'wp_ajax_getuserinfo', 'cm_getuserinfo' );

add_action( 'wp_ajax_getschedulecoursename_front', 'cm_getschedulecoursename_front' );

add_action( 'wp_ajax_getcoursepayment_front', 'cm_getcoursepayment_front' );
add_action( 'wp_ajax_getparticipantform_front', 'cm_getparticipantform_front' );
add_action( 'wp_ajax_getgroupcoursepayment_front', 'cm_getgroupcoursepayment_front' );



function cm_getschedulecoursename() {
    // Make your response and echo it.
	$schedule_course_id = $_REQUEST['schedule_courseid'];
	
	$course_category_id = get_post_meta($schedule_course_id,'_cm_course_category',true);
	$coursecatinfo=get_term_by('id', $course_category_id, 'course_category');
	$course_category_name=$coursecatinfo->name;
	
	$course_id = get_post_meta($schedule_course_id,'_cm_course_id',true);
	$courseinfo=get_post( $course_id);
	$course_name = $courseinfo->post_title;
	
	$totalfees =  get_post_meta($schedule_course_id,'scheduled_course_settings_full-payment',true);
	?>
	  <table class="form-table">
                    <tr>
                     <th scope="row"><label for="category_name">Course Category :</label>
                        </th>
                        <td>
                      <?php _e($course_category_name);?>
					   <input type="hidden" id="category_name" name="category_name" value="<?php _e($course_category_name);?>">
                        </td>
                    </tr>
               </table>
			    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="course_name">Course Name :</label>
                        </th>
                        <td>
						 <?php _e($course_name);?>
                  <input type="hidden" id="course_name" name="course_name" value="<?php _e($course_name);?>">
                        </td>
                    </tr>
               </table>
			     <table class="form-table">
                    <tr>
                     <th scope="row"><label for="firstname">Course Fees :</label>
                        </th>
                        <td>
						 <?php _e(get_option('cm_currency').''.number_format($totalfees,2));?>
                   <input type="hidden" id="course_fees" name="course_fees" value="<?php _e($totalfees);?>">
                 
                        </td>
                    </tr>
               </table>
			    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="firstname">Service Tax :</label>
                        </th>
				<td>
				 <?php _e(get_option('cm_currency').''.$totalfees/100*get_option('cm_singapore_tax'));?>
		  		 	</td>
                    </tr>
               </table>
			    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="firstname">Total Fees :</label>
                        </th>
				<td>
				 <?php
					$grandtotal = ($totalfees/100*get_option('cm_singapore_tax'))+$totalfees;
				 _e(get_option('cm_currency').''.number_format($grandtotal,2));?>
		  		  <input type="hidden" id="total_fees" name="total_fees" value="<?php _e($grandtotal);?>">
				</td>
                    </tr>
               </table>
	<?php
    // Don't forget to stop execution afterward.
    wp_die();
}

function cm_getpaymentmethodfields()
{ 
	$method= $_REQUEST['method'];
	if($method=='cheque')
	{	
?>
	   <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Cheque Number* :</label>
                        </th>
                        <td>
                         <input type="text" name="cheque_number" id="cheque_number"  required  >
                        </td>
                    </tr>
               </table>
			   <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Payment Date* :</label>
                        </th>
                        <td>
                         <input type="date" name="payment_date" id="payment_date"  required  >
                        </td>
                    </tr>
               </table>
<?php	
	}
	if($method=='online')
	{	
?>
	   <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Reference No* :</label>
                        </th>
                        <td>
                         <input type="text" name="reference_no" id="reference_no"  required  >
                        </td>
                    </tr>
               </table>
			  
<?php	
	}
 // Don't forget to stop execution afterward.
    wp_die();
}
function cm_getuserinfo()
{
	$userid=$_REQUEST['user_id'];
	$userinfo=get_userdata( $userid );
	//print_r($userinfo);
	?> <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">User Login* :</label>
                        </th>
                        <td>
						<?php _e($userinfo->user_login); ?>
						 <input type="hidden" name="display_name" value="<?php _e($userinfo->display_name); ?>" id="display_name"   >
                       
                         <input type="hidden" name="user_login" value="<?php _e($userinfo->user_login); ?>" id="user_login"   >
                        </td>
                    </tr>
               </table>
			   <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Email ID :</label>
                        </th>
                        <td>
						<?php _e($userinfo->user_email); ?>
                         <input type="hidden" name="payer_email" value="<?php _e($userinfo->user_email); ?>" id="payer_email"   >
                        </td>
                    </tr>
               </table>
	<?php
	// Don't forget to stop execution afterward.
    wp_die();
}


function cm_getschedulecoursename_front() {
    // Make your response and echo it.
	$schedule_course_id = $_REQUEST['schedule_courseid'];
	if($schedule_course_id!='')
{
	$course_category_id = get_post_meta($schedule_course_id,'_cm_course_category',true);
	$coursecatinfo=get_term_by('id', $course_category_id, 'course_category');
	$course_category_name=$coursecatinfo->name;
	
	$course_id = get_post_meta($schedule_course_id,'_cm_course_id',true);
	$courseinfo=get_post( $course_id);
	$course_name = $courseinfo->post_title;
	
	$totalfees =  get_post_meta($schedule_course_id,'scheduled_course_settings_full-payment',true);
	$venue =  get_post_meta($schedule_course_id,'scheduled_course_settings_address',true);
	$date =  get_post_meta($schedule_course_id,'scheduled_course_settings_start-date',true);
	
	
	?>
	 <div class="col-md-12">
			    <div class="col-md-3 ">
                <label for="filter">Course Category :</label>
                </div>
              <div class="col-md-9 ">
            <div class="form-group">               
                                  		  
				 <?php _e($course_category_name);?>
					   <input type="hidden" id="category_name" name="category_name" value="<?php _e($course_category_name);?>">
                          </div>
                </div>
          </div>
		 <div class="col-md-12">
			    <div class="col-md-3 ">
                <label for="filter">Course Name :</label>
                </div>
              <div class="col-md-9 ">
            <div class="form-group">               
                                  		  
				 <?php _e($course_name);?>
                  <input type="hidden" id="course_name" name="course_name" value="<?php _e($course_name);?>">
                           </div>
                </div>
          </div>
	
		 <div class="col-md-12">
			    <div class="col-md-3 ">
                <label for="filter">Course Fees :</label>
                </div>
              <div class="col-md-9 ">
            <div class="form-group">               
                                  		  
				  <?php _e(get_option('cm_currency').''.number_format($totalfees,2));?> + GST (<?php _e(get_option('cm_singapore_tax')); ?>%)
                   <input type="hidden" id="course_fees" name="course_fees" value="<?php _e($totalfees);?>">
                          </div>
                </div>
          </div>
		<div class="col-md-12">
			    <div class="col-md-3 ">
                <label for="filter">Scheduled Date :</label>
                </div>
              <div class="col-md-9 ">
            <div class="form-group">               
                                  		  
				
                   <?php _e(date("d M, Y",strtotime($date)));?>
                          </div>
                </div>
          </div>
			<div class="col-md-12">
			    <div class="col-md-3 ">
                <label for="filter">Location :</label>
                </div>
              <div class="col-md-9 ">
            <div class="form-group">
                                  		  
				  <?php _e($venue);?>
                  
                          </div>
                </div>
          </div>
	<?php
}	
    // Don't forget to stop execution afterward.
    wp_die();
}

function cm_getcoursepayment_front()
{
	$schedule_course_id = $_REQUEST['schedule_courseid'];
	
if($schedule_course_id!='')
{
	$course_id = get_post_meta($schedule_course_id,'_cm_course_id',true);

	$totalfees =  get_post_meta($schedule_course_id,'scheduled_course_settings_full-payment',true);
	$gst = $totalfees/100*get_option('cm_singapore_tax');
	
	$totalamount =$totalfees+$gst;
	?>
	    <div class="col-md-12">
           <div class="col-md-3">
                 <label>Total Amount* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
				   <input name="total_payment"   class="form-control" id="total_payment" type="hidden"  value="<?php _e($totalamount);?>" >
              </div>
                                <input name="fee" readonly placeholder="$$$$$$" class="form-control" id="fee" type="text"  value="<?php _e(get_option('cm_currency').$totalamount);?>" >
              </div>
                </div>
          </div>
	<?php
}	
	 // Don't forget to stop execution afterward.
    wp_die();
}
function cm_getparticipantform_front()
{
	$total_participant=$_REQUEST['total_participants'];
	?>
	<div class="col-md-12">
						<div class="col-md-3 ">
						<label for="filter"></label>
						</div>
					  <div class="col-md-9 ">
					<div class="form-group">  
			<h3>Participants Information</h3>
                  
                          </div>
                </div>
          </div>
		
	<?php
	for($counter=1;$counter<=$total_participant;$counter++)
	{ //<div class="inner_pcontainer">
	?>
		
		<div class="col-md-12">
			<div class="col-md-3">
			</div>
			<div class="col-md-9 inner_pcontainer">
					<div class="row">
					<div class="col-md-3">
							<label for="filter">Participant <?php _e($counter);?></label>
							</div>
					</div>
				<div class="row">
							<div class="col-md-2 ">
							<label for="filter" class="form-control">Name :</label>
							</div>
						  <div class="col-md-10 ">
						<div class="form-group">  
				
						 <input type="text" value="" class="form-control" name="participant_name[]" required >             		  
					
					  
							  </div>
					</div>
			  </div>
			  <div class="row">
							<div class="col-md-2 ">
							<label for="filter" class="form-control">E-mail :</label>
							</div>
						  <div class="col-md-10 ">
						<div class="form-group">  
				
						 <input type="email" value="" class="form-control" name="participant_email[]" required >             		  
					
					  
							  </div>
					</div>
			  </div>
			  <div class="row">
							<div class="col-md-2 ">
							<label for="filter" class="form-control">Mobile :</label>
							</div>
						  <div class="col-md-10 ">
						<div class="form-group">  
				
						 <input type="number" value="" class="form-control" name="participant_mobile[]" required >             		  
					
					  
							  </div>
					</div>
				</div>
          </div>
		 </div> 
	<?php
	}
	 // Don't forget to stop execution afterward.
    wp_die();
}
function cm_getgroupcoursepayment_front()
{
	$schedule_course_id = $_REQUEST['schedule_courseid'];	
	$total_participants = $_REQUEST['total_participants'];
	
if($schedule_course_id!='')
{
	$course_id = get_post_meta($schedule_course_id,'_cm_course_id',true);

	$totalfees =  get_post_meta($schedule_course_id,'scheduled_course_settings_full-payment',true);
	$gst = $totalfees/100*get_option('cm_singapore_tax');
	
	$totalamountforone =$totalfees+$gst;
	$totalamount=0;
	$grandtotal= $totalamountforone * $total_participants;
	$totalamount=$grandtotal;
	if($total_participants>=3 && $total_participants<9)
	{
		$totaldiscountpercentage=get_post_meta($schedule_course_id,'scheduled_course_settings_3-person-discount',true);
		
		//echo "First Discount :".$totaldiscountpercentage;
		
		$totalamount = $grandtotal - ($grandtotal/100*$totaldiscountpercentage);
	}
	if($total_participants>=9)
	{
		$totaldiscountpercentage=get_post_meta($schedule_course_id,'scheduled_course_settings_9-person-discount',true);
		
		//echo "Second Discount :".$totaldiscountpercentage;
		$totalamount = $grandtotal - ($grandtotal/100*$totaldiscountpercentage);
		
	}
	
	?>
		<?php if($total_participants>=3) { ?>
		<div class="col-md-12">
           <div class="col-md-3">
                 <label>Total Fees :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
				<?php _e(get_option('cm_currency').number_format($grandtotal,2));?>
              </div>
                            
              </div>
                </div>
		 <div class="col-md-12">
           <div class="col-md-3">
                 <label>Discount :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
				<?php _e($totaldiscountpercentage."%");?>
              </div>
                            
              </div>
                </div>
		
		 <div class="col-md-12">
           <div class="col-md-3">
                 <label>Total Amount* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
				   <input name="total_payment"   class="form-control" id="total_payment" type="hidden"  value="<?php _e($totalamount);?>" >
              </div>
                                <input name="fee" readonly placeholder="$$$$$$" class="form-control" id="fee" type="text"  value="<?php _e(get_option('cm_currency').$totalamount);?>" >
              </div>
                </div>
          
		<?php }else {  ?>
	    <div class="col-md-12">
           <div class="col-md-3">
                 <label>Total Amount* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
				   <input name="total_payment"   class="form-control" id="total_payment" type="hidden"  value="<?php _e($totalamount);?>" >
              </div>
                                <input name="fee" readonly placeholder="$$$$$$" class="form-control" id="fee" type="text"  value="<?php _e(get_option('cm_currency').$totalamount);?>" >
              </div>
                </div>
		<?php } ?>		
          </div>
	<?php
}	
	 // Don't forget to stop execution afterward.
    wp_die();
	
}

?>