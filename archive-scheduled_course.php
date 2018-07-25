<?php get_header(); ?> 
    <!-- Header Area End Here -->
        <!-- Inner Page Banner Area Start Here -->
        <div class="inner-page-banner-area1">
            <div class="container">
                <div class="pagination-area">
                    <h1><?php post_type_archive_title(); ?></h1>
                    <ul>
                        <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>					  
						<li><?php post_type_archive_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Page Banner Area End Here -->
        <!-- Event Page Area Start Here -->
        <div class="event-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row event-inner-wrapper">
	<?php  
		$i=0;

			while ( have_posts() ) : the_post();
			$i++;
		 
			$startdate=get_post_meta($post->ID,'scheduled_course_settings_start-date',true);
			$enddate=get_post_meta($post->ID,'scheduled_course_settings_end-date',true);
			$starttime=get_post_meta($post->ID,'scheduled_course_settings_start-time',true).":00";
			$endtime=get_post_meta($post->ID,'scheduled_course_settings_end-time',true).":00";
			$address=get_post_meta($post->ID,'scheduled_course_settings_address',true);
			$fullpayment=get_post_meta($post->ID,'scheduled_course_settings_full-payment',true);
			$threepersondiscount=get_post_meta($post->ID,'scheduled_course_settings_3-person-discount',true);
			$ninepersondiscount=get_post_meta($post->ID,'scheduled_course_settings_9-person-discount',true);
			$course_category=get_post_meta($post->ID,'_cm_course_category',true);
			$cm_course_id=get_post_meta($post->ID,'_cm_course_id',true);
			$max_allowed_participants=get_post_meta($post->ID,'scheduled_course_settings_maximum-participants',true);
			$coursecatinfo=get_term_by('id',$course_category,'course_category');
			global $wpdb;
			$totalparticipants = $wpdb->get_var("select count(id) from ".STUDENT_INFO_TABLE." where course_id='".$post->ID."' ");
			
			
		?>        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="single-item">
                                    
                                    <div class="item-content">
                                        <h3 class="sidebar-title"><?php _e($coursecatinfo->name);?></h3>
<?php if($cm_course_id) { $courseinfo   = get_post($cm_course_id); ?>                                      
									  <p><?php _e($courseinfo->post_title);?></p>
<?php } ?>
                                        <div class="col-md-12 no-padding">
                                        <div class="col-md-5">
                                        <ul class="event-info-block">
	<li><i class="fa fa-clock-o" aria-hidden="true"></i><?php _e($starttime." to ".$endtime);?></li>
												<li><i class="fa fa-calendar" aria-hidden="true"></i>
				<?php if($startdate!='') { _e(date("d<\s\up>S</\s\up> M Y",strtotime($startdate))); } ?><br/>	<?php 
				if($enddate!='') { _e(date("d<\s\up>S</\s\up> M Y",strtotime($enddate))); } ?></li>
                                           <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php _e($address); ?></li>
                                        </ul>
                                        </div>
                                        <div class="col-md-7">
                                        <ul class="schedule-list">
                                            
                                            <li>
                                            <a class="btn btn-primary btn-sm schedule" href="<?php _e(get_permalink($cm_course_id));?>" target="_blank" ><?php _e("Learn More"); ?></a>
                                            </li>
											
											<?php

											$currenttime=time();											
											$coursestarttime=strtotime($startdate);
										
											// $courseendtime=strtotime($startdate);
											if($currenttime<$coursestarttime && $max_allowed_participants>$totalparticipants) { ?>
                                            <div class="btn-group">
                                                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Enrol Now <span class="caret"></span></button>
                                                 <ul class="dropdown-menu" role="menu">
												 
                                                  <li><a href="<?php _e(get_page_link(get_option('cm_group_registration_page_id')));;?>?schedulecourse=<?php _e($post->ID);?>"><?php _e("Group"); ?></a></li>
												  
                                                  <li><a href="<?php _e(get_page_link(get_option('cm_individual_registration_page_id')));;?>?schedulecourse=<?php _e($post->ID);?>"><?php _e("Individual"); ?></a></li>
                                                  </ul>
                                                  
                                                  
                                                  </div>
											<?php }else {  ?>
											  <li><a class="btn btn-primary btn-sm " ><?php _e("Reg. Close"); ?> </a></li>
											<?php } ?>		
                                            <li><a class="btn btn-primary btn-sm schedule" href="mailto:someone@yoursite.com?&subject=Big%20News&body=<?php _e($mailbody);?>"><?php _e("Send to Friend"); ?> </a></li>
											
											
                                        </ul>
                                        </div>
                                        </div>
                                        
                                       <p style="margin-bottom:0px;">&nbsp;</p>
                                        <div class="col-md-12 no-padding">
                                             <p style="margin-bottom:0px;">&nbsp;</p>
                                        <div class="col-md-12 no-padding">
                                        <div class="col-md-5 col-xs-9">
										
                                        <ul class="payment-list">
                                        <li><?php _e("Full Payment for individual"); ?> </li>
                                        <li><?php _e("3 person discount"); ?></li>
                                        <li><?php _e("9 person discount"); ?></li>
										<?php if($max_allowed_participants) { ?>
										<li><?php _e("Maximum Participant"); ?></li>
										<?php } ?>
										<li><?php _e("Registered Participants"); ?></li>
										<?php if($max_allowed_participants) { ?>
											<li><?php _e("Available Seats"); ?></li>
												<?php } ?>
                                        </ul>
										
                                        </div>
                                        <div class="col-md-5 col-xs-3">
										
                                        <ul class="payment-list">
                                        <li><?php _e(get_option('cm_currency')." ".number_format($fullpayment,2));?></li>
                                        <li><?php _e($threepersondiscount."%");?></li>
                                        <li><?php _e($ninepersondiscount."%");?></li>
										<?php if($max_allowed_participants) { ?>
										<li><?php _e($max_allowed_participants);?></li>
										<?php } ?>
										<li><?php _e($totalparticipants);?></li>
										<?php if($max_allowed_participants) { ?>
											<li><?php _e($max_allowed_participants-$totalparticipants);?></li>
										<?php } ?>
                                        </ul>
										
                                        </div>
                                        <div class="col-md-4">
                                        <ul class="payment-list">
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        </ul>
                                        </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                         <?php if($i%2==0) { ?>
							</div>
							<div class="row event-inner-wrapper">
						 <?php }?>

						   
<?php endwhile; // end of the loop. ?>		
	                                    
                        
                    </div>
                 

				  </div>
                </div>
            </div>
        </div>
        <!-- Event Page Area End Here -->
         </div>
 
        <!-- Footer Area Start Here -->
<?php get_footer(); ?>