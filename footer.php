  <footer>

            <div class="footer-area-top">

                <div class="container">

                    <div class="row">

               
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                            <div class="footer-box">

                                <h3>Featured Links</h3>
								  
<?php 
			$args= array(
			 'menu'           => 'Footer Menu',	
			'menu_class'           => 'featured-links',			 
			 'theme_location' => 'footer_menu'
			);
			wp_nav_menu( $args );?>
			


                                 <?php 
		/*	$args= array(
			 'menu'           => 'Footer Menu 2',
			'menu_class'           => 'featured-links',		
			 'theme_location' => 'footer_menu_2'
			);
			wp_nav_menu( $args ); */ ?> 
										
                              
                            </div>

                        </div>

                        

                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">

                            <div class="footer-box">

                                 
<a href="<?php _e(get_option('siteurl'));?>"><img src="<?php echo esc_url( get_theme_mod( 'customizer_footer_logo_one' ) ); ?>" alt="<?php _e(get_option('blogname')); ?>"  title="<?php _e(get_option('blogname')); ?>"></a>
                                <div class="footer-about">

<p style="text-align:justify"><?php _e(get_option('footer_content')); ?></p>

                                </div>

                                <ul class="footer-social">
									<?php if(get_option('cm_facebook_link')) { ?>
                                    <li><a href="<?php echo get_option('cm_facebook_link');?>" target="_blank" ><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<?php } ?>
									<?php if(get_option('cm_twitter_link')) { ?>
                                    <li><a href="<?php echo get_option('cm_twitter_link');?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										<?php } ?>
									<?php if(get_option('cm_instagram_link')) { ?>
                                    <li><a href="<?php echo get_option('cm_instagram_link');?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
										<?php } ?>
									<?php if(get_option('cm_linkedin_link')) { ?>
                                    <li><a href="<?php echo get_option('cm_linkedin_link');?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
										<?php } ?>
									<?php if(get_option('cm_google_plus_link')) { ?>
                               
                                    <li><a href="<?php echo get_option('cm_google_plus_link');?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
										<?php } ?>
                                </ul>

                            </div>

                        </div>

                        

                       <!-- <div class="col-lg-1">

                        </div>-->

                         <div class="col-lg-1 col-md-2 col-sm-1">

                         </div>

                        

                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">

                            <div class="footer-box">

                                <h3>Information</h3>
								
                                <ul class="corporate-address">
									<?php if(get_option('cm_contact_number')) { ?>
                                    <li><i class="fa fa-phone" aria-hidden="true"></i><a href="Phone:<?php _e(get_option('cm_contact_number'));?>"> <?php _e(get_option('cm_contact_number'));?></a></li>
									<?php } ?>
						<?php if(get_option('admin_contact_email')) { ?>
                                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="<?php _e(get_page_link(get_option('cm_contact_page_id'))); ?>"><?php _e(get_option('admin_contact_email'));?></a></li>
								<?php } ?>
                                </ul>

                                <div class="newsletter-area">

                                    <h3>Newsletter</h3>

                                       <form method="post"action="" id="subscription_form">
									   <input type="hidden" name="referer" value="<?php _e(get_option('siteurl'));?>">
									<input type="hidden" name="user_action" value="newsletter_subscription">
                                    <div class="input-group stylish-input-group">

                                        <input type="email" placeholder="Enter your e-mail here" required class="form-control" name="user_email" id="user_email">

                                        <span class="input-group-addon">

                                                <button type="submit" name="sub" id="sub">

                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>

                                                </button>  

                                            </span>
       

                                    </div>

                                     </form>

                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

            <div class="footer-area-bottom">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">

                            <p><?php echo get_option('footer_copyright_message');?> </p>

                        </div><div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 text-right">

                            <p>Designed by<a target="_blank" href="http://www.dwalltechnosoft.com/"> Dwall Technosoft PVT LTD</a></p>

                        </div>

                    </div>

                </div>

            </div>

        </footer>        <!-- Footer Area End Here -->
   
    <!-- Main Body Area End Here -->
 
 
    
    <script>
	function selectOnlyThis(id) {
    for (var i = 1;i <= 3; i++){
        if ("Check" + i === id && document.getElementById("Check" + i).checked === true){
            document.getElementById("Check" + i).checked = true;
            } else {
              document.getElementById("Check" + i).checked = false;
            }
    }  
}


function selectOnlyThis2(id) {
    for (var i = 4;i <= 6; i++){
        if ("Check" + i === id && document.getElementById("Check" + i).checked === true){
            document.getElementById("Check" + i).checked = true;
            } else {
              document.getElementById("Check" + i).checked = false;
            }
    }  
}
	</script>


    <!-- jquery-->
    <script src="<?php bloginfo('template_url');?>/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        
    <!-- Plugins js -->
    <script src="<?php bloginfo('template_url');?>/js/plugins.js" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="<?php bloginfo('template_url');?>/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- WOW JS -->
    <script src="<?php bloginfo('template_url');?>/js/wow.min.js"></script>
    <!-- Nivo slider js -->
    <script src="<?php bloginfo('template_url');?>/js/jquery.nivo.slider.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url');?>/js/home.js" type="text/javascript"></script>
    <!-- Owl Cauosel JS -->
    <script src="<?php bloginfo('template_url');?>/js/owl.carousel.min.js" type="text/javascript"></script>
    <!-- Meanmenu Js -->
    <script src="<?php bloginfo('template_url');?>/js/jquery.meanmenu.min.js" type="text/javascript"></script>
    <!-- Srollup js -->
    <script src="<?php bloginfo('template_url');?>/js/jquery.scrollUp.min.js" type="text/javascript"></script>
    <!-- jquery.counterup js -->
    <script src="<?php bloginfo('template_url');?>/js/jquery.counterup.min.js"></script>
    <script src="<?php bloginfo('template_url');?>/js/waypoints.min.js"></script>
    <!-- Countdown js -->
    <script src="<?php bloginfo('template_url');?>/js/jquery.countdown.min.js" type="text/javascript"></script>
    <!-- Isotope js -->
    <script src="<?php bloginfo('template_url');?>/js/isotope.pkgd.min.js" type="text/javascript"></script>
    <!-- Magic Popup js -->
    <script src="<?php bloginfo('template_url');?>/js/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <!-- Gridrotator js -->
    <script src="<?php bloginfo('template_url');?>/js/jquery.gridrotator.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url');?>/js/jquery.mousewheel.min.js" type="text/javascript"></script>
    <!-- Custom Js -->
    <script src="<?php bloginfo('template_url');?>/js/main.js" type="text/javascript"></script>
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    
	
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.fullpage.js"></script> 
    <script src="<?php bloginfo('template_url');?>/js/jquery-ui.min.js" type="text/javascript"></script> 


    <script type="text/javascript" src="<?php bloginfo('template_url');?>/js/scroll-slider.js"></script>

    
   
    
<script type="text/javascript">
    $(function () {
        $("input[name='chkPassPort']").click(function () {
            if ($("#chkYes").is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
			 if ($("#chkNo").is(":checked")) {
                $("#dvPassport1").show();
            } else {
                $("#dvPassport1").hide();
            }
        });
    });
    
    
   
</script>
<script>
            $(document).ready(function() {				
             var owl = $(".owl-stage");
            // alert(owl);
              owl.on('mousewheel', '.owl-stage', function(e) {
                  
                if (e.deltaY > 0) {
                  owl.trigger('next.owl');
                } else {
                  owl.trigger('prev.owl');
                }
                e.preventDefault();
              });
            })
          </script>
          
          
<?php wp_footer();?> 

</body>


</html>
