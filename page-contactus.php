<?php
/* 
Template Name: Contact Us Page
*/
 get_header(); ?>
 <!-- Inner Page Banner Area Start Here -->
         <div class="inner-page-banner-area1">
            <div class="container">
                <div class="pagination-area">
                    <h1><?php the_title(); ?></h1>
                    <ul>
                       <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>				  
						
						<li><?php the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Page Banner Area End Here -->
        <div class="clr" style="clear:both"></div>
        <br><br>

<div class="contact_section">
<div class="container">

<div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="contact-us-info1">
                            <ul>
							<?php if(get_option('cm_contact_number')) { ?>
                                <li>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <h3><?php _e("Phone"); ?></h3>
                                    <p><?php _e(get_option('cm_contact_number')); ?></p>
                                </li>
							<?php } ?>
							<?php if(get_option('cm_address')) { ?>
                                <li>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <h3><?php _e("Address"); ?></h3>
                                    <p><?php _e(get_option('cm_address')); ?>                                       </p>
                                </li>
								<?php } ?>
									<?php if(get_option('admin_contact_email')) { ?>
                                <li>
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <h3><?php _e("E-mail"); ?></h3>
                                    <p><a href="mailto:<?php _e(get_option('admin_contact_email')); ?>"><?php _e(get_option('admin_contact_email')); ?></a></p>
                                </li>
								<?php } ?>
                                <li>
                                    <h3>Follow Us</h3>
                                    <ul class="contact-social">
									<?php if(get_option('cm_facebook_link')) { ?>
                                        <li><a href="<?php echo get_option('cm_facebook_link');?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
										<?php } ?>
										<?php if(get_option('cm_instagram_link')) { ?>
                                        <li><a href="<?php echo get_option('cm_instagram_link');?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
										<?php } ?>
										
											<?php if(get_option('cm_twitter_link')) { ?>
                                        <li><a href="<?php echo get_option('cm_twitter_link');?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										<?php } ?>
											<?php if(get_option('cm_linkedin_link')) { ?>
                                        <li><a href="<?php echo get_option('cm_linkedin_link');?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
										<?php } ?>
											<?php if(get_option('cm_google_plus_link')) { ?>
                                        <li><a href="<?php echo get_option('cm_google_plus_link');?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
										<?php } ?>
                                    </ul>
									<br>
                                </li>
								
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					                                    <fieldset>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2 class="title-default-left title-bar-high">Your's Feedback</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="contact-form1">
                                <form id="contact-form" method="post">      
								<input type="hidden" name="user_action" value="user_feedback">
								<input type="hidden" name="referer" value="<?php the_permalink();?>">
                                   
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group"> 
                                                <input placeholder="Title of feedback / Request" class="form-control" name="feedback_title" id="form-name" data-error="Name field is required" required type="text">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="Name*" class="form-control" name="user_name" id="form-name" data-error="Name field is required" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="email" placeholder="Email*" class="form-control" name="user_email" id="form-email" data-error="Email field is required" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <textarea placeholder="Message*" class="textarea form-control" name="user_message" id="form-message" rows="8" cols="20" data-error="Message field is required" required></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-lg-8 col-md-8 col-sm-6 col-sm-12">
                                            <div class="form-group margin-bottom-none">
                                                <button class="default-big-btn2" type="submit" value="">Send Message</button>
                                                <button class="default-big-btn2" type="reset" value="">Reset</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-6 col-sm-12">
                                            <div class='form-response'></div>
                                        </div>
                                   
                                </form>
                            </div>
                        </div>
						 </fieldset>
                    </div>
                </div>
                </div>
                </div>

        
        <!-- Contact Page Area End Here -->
        <!-- Footer Area Start Here -->
<?php get_footer(); ?>