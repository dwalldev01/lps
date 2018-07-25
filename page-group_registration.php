<?php 
/* 
Template Name: Individual Enrol Page
*/
get_header(); ?>   
<style type="text/css">
.form-group {text-align:left;}
.enrol-section form {
    text-align: right;
}
</style>
 <!-- Header Area End Here --> 
      <!-- Inner Page Banner Area Start Here -->
      <div class="inner-page-banner-area1">
    <div class="container">
          <div class="pagination-area">
        <h1><?php the_title(); ?></h1>
        <ul>
              <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home");?> </a> -</li>
              <li><?php the_title(); ?> </li>
            </ul>
      </div>
        </div>
  </div>
      <!-- Inner Page Banner Area End Here -->
      <div class="clr" style="clear:both"></div>
      <p>&nbsp;</p>
      <div class="enrol-section">
    <div class="container">
	
	<?php
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='course_group_enrolment' )
	{
		get_sidebar('group_review');
	}else
	{	
	?>
          <div class="col-md-10 ">
        <h2 class="title-default-left">Group Course Enrolment</h2>
		
		<?php if(!is_user_logged_in()) { ?>
		 <div class="container">
		<div class="row">
		   <div class="col-md-12">
		Please <a href="" data-toggle="modal" data-target="#myModal" class="btn btn-primary">login</a> or <a class="btn btn-primary" href="<?php if(get_option('cm_register_page_id')) { _e(get_page_link(get_option('cm_register_page_id'))); }else { _e('javascript:void();'); } ?>">Register</a> your account for Course Enrolment 
		</div>	</div></div>
		   <div class="clr" style="clear:both"></div>
      <p>&nbsp;</p>
		<?php }else { 
		global $current_user;
		
		?>		
        <form action="" method="post" >
		   <?php wp_nonce_field( 'course_group_enrolment', 'course_enrolment' ); ?>
				<input type="hidden" name="action" value="course_group_enrolment">
             	<input type="hidden" name="referer" value="<?php the_permalink();?>">
              <div class="col-md-12">
			    <div class="col-md-3 ">
                <label for="filter">Select Scheduled Course* :</label>
                </div>
              <div class="col-md-9 ">
            <div class="form-group">               
                                  		  
				  <select name="schedule_course" class="form-control" id="schedule_course" required  >  
						 <option value=""> Select Scheduled Course </option>
						 <?php 
						 $currentcourseid= $_REQUEST['schedulecourse'];
						 cm_get_dropdown_scheduled_course($currentcourseid);?>
                           </select>     </div>
                </div>
          </div>
		   <div id="course_name_container"></div>
		 
		 <div class="col-md-12">
            <div class="col-md-3">
                 <label>Name* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
				  <input type="hidden" name="uid" value="<?php _e($current_user->ID); ?>" />
                                <input name="full_name" required placeholder="Full Name" class="form-control"  type="text" value="<?php _e($current_user->display_name);?>">
              </div>
                </div>
          </div>
		    <div class="col-md-12">
            <div class="col-md-3">
                 <label>Mobile No* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
                                <input name="mobile" required placeholder="Mobile No" class="form-control"  type="text" value="">
              </div>
                </div>
          </div>
		  
              <div class="col-md-12">
           <div class="col-md-3">
                 <label>Email* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
                                <input name="payer_email" readonly required placeholder="Email" class="form-control" type="text" value="<?php _e($current_user->user_email);?>">
              </div>
                </div>
          </div>
		                <div class="col-md-12">
           <div class="col-md-3">
                 <label>Company Name* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
                                <input name="company_name"  required placeholder="Company Name" class="form-control" type="text" value="">
              </div>
                </div>
          </div>
		  <div class="col-md-12">
           <div class="col-md-3">
                 <label>Company Address* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
                                <textarea name="company_address"  required placeholder="Company Address" class="form-control" type="text" value="" ></textarea>
              </div>
                </div>
          </div>
		   <div class="col-md-12">
           <div class="col-md-3">
                 <label>No of Participants* :</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
                                <select name="total_participants" id="total_participants"  required  class="form-control" type="text" >
								<option value="">Select Participants</option>
							<?php
							$max_participant= get_option('cm_max_participants');
							
						global $wpdb;	
						$courseid= $_REQUEST['schedulecourse'];
	$max_allowed_participants=get_post_meta($courseid,'scheduled_course_settings_maximum-participants',true);
	$totalparticipants = $wpdb->get_var("select count(id) from ".STUDENT_INFO_TABLE." where course_id='".$courseid."' ");
			$max_participant = $max_allowed_participants-$totalparticipants;

						if($max_participant=='')
							{
								$max_participant=20;
							}
							for($counter=1;$counter<=$max_participant;$counter++) { ?>
							
							<option value="<?php _e($counter);?>"><?php _e($counter);?></option>
							<?php } ?>	
								</select>
              </div>
                </div>
          </div>
		   <div id="participant_container"></div>
			
		   <div id="payment_container"></div>
		     <div class="col-md-12">
           <div class="col-md-3">
                 <label>&nbsp;</label>
                </div>
            <div class="col-md-9">
                  <div class="form-group">
                              
              </div>
                </div>
          </div>
		
             
			<div class="col-md-12">
			 <div class="col-md-3">
               
                </div>
				 <div class="col-md-9">
            <div class="form-group">
                  <button class="default-big-btn2" type="submit" name="submit" value="">Submit & Pay</button>
                  <button class="default-big-btn2" type="reset" value="">Reset</button>
                </div>
          </div></div>
            </form>
		
		
		<?php } ?>
	 </div>
	  <?php } ?>   
	  </div>
  </div>
 <script type="text/javascript">
$( document ).ready(function() {
	
	<?php if(isset($_REQUEST['schedulecourse']) && $_REQUEST['schedulecourse']!='') { ?>
	jQuery.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getschedulecoursename_front&schedule_courseid=<?php _e($_REQUEST['schedulecourse']);?>", function( data ) {
		//alert(data);
		document.getElementById('course_name_container').innerHTML=data;
  //$( ".result" ).html( data );
});

$.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getcoursepayment_front&schedule_courseid=<?php _e($_REQUEST['schedulecourse']);?>", function( data ) {
	
		document.getElementById('payment_container').innerHTML=data;
  //$( ".result" ).html( data );
});

	<?php } ?>
	
 $("#schedule_course").change(function(){

	$.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getschedulecoursename_front&schedule_courseid="+ this.value, function( data ) {
		//alert(data);
		document.getElementById('course_name_container').innerHTML=data;
  //$( ".result" ).html( data );
});

$.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getcoursepayment_front&schedule_courseid="+ this.value, function( data ) {
	
		document.getElementById('payment_container').innerHTML=data;
  //$( ".result" ).html( data );
});

});


 $("#total_participants").change(function(){

		$.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getparticipantform_front&total_participants="+ this.value, function( data ) {		
			document.getElementById('participant_container').innerHTML=data;
			
		});
		
		schedule_courseid= document.getElementById('schedule_course').value;
		
		$.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getgroupcoursepayment_front&total_participants="+this.value+"&schedule_courseid="+ schedule_courseid, function( data ) {
	
		document.getElementById('payment_container').innerHTML=data;
  //$( ".result" ).html( data );
});

	});

});
</script>       
      <!-- Footer Area Start Here -->
     <?php get_footer();?>
	   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>