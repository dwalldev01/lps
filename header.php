<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
	      <!-- Event Calender CSS -->
		  <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css">
	<style type="text/css">
		body, html {
			padding:0px;
			margin:0px;		
			background-attachment: fixed;
			
			color:#fff;
			line-height: 1.4em;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
		}
		
		
		.monthly {
			box-shadow: 0 13px 40px rgba(0, 0, 0, 0.5);
			font-size:15px;
		}

		
		.desc {
			max-width: 250px;
			text-align: left;
			font-size:14px;
			padding-top:30px;
			line-height: 1.4em;
		}
		.resize {
			background: #222;
			display: inline-block;
			padding: 6px 15px;
			border-radius: 22px;
			font-size: 13px;
		}
		@media (max-height: 700px) {
			.sticky {
				position: relative;
			}
		}
		@media (max-width: 600px) {
			.resize {
				display: none;
			}
		}
	</style>
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/monthly.css">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/animate.min.css">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/font-awesome.min.css">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/owl.theme.default.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/meanmenu.min.css">
    <!-- nivo slider CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/nivo-slider.css" type="text/css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/preview.css" type="text/css" media="screen" />
    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/jquery.datetimepicker.css">
    <!-- Magic popup CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/magnific-popup.css">
    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/hover-min.css">
    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/reImageGrid.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/style.css">
	
	 <link rel="stylesheet" href="<?php bloginfo('template_url');?>/style.css">
	 
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='https://unpkg.com/slick-carousel@1.7.1/slick/slick.css'>
<link rel='stylesheet prefetch' href='https://unpkg.com/slick-carousel@1.7.1/slick/slick-theme.css'>

   
	 	<style type="text/css">
	.ac {
	margin-top: 10px;
	border: 1px solid #ddd;
	background-color: #fff;
}
.ac > .ac-q {
	color: #0b284b;
	cursor: pointer;
	display: block;
	font-weight: 400;
	font-size: 19px;
	outline: 0 none;
	padding: 10px 30px 10px 10px;
	position: relative;
	text-decoration: none;
}
.ac > .ac-q span {
	color: #ed1c27
}
.ac > .ac-q::after {
	content: "+";
	text-align: center;
	width: 15px;
	right: 10px;
	top: 50%;
	transform: translate(0, -50%);
	position: absolute;
}
.ac > .ac-a {
	overflow: hidden;
	-webkit-transition-property: all;
	-webkit-transition-timing-function: ease;
	transition-property: all;
	transition-timing-function: ease;
}
.ac > .ac-a p {
	color: #444;
	font-size: 15px;
	line-height: 1.5;
	margin: 0;
	padding: 10px;
	text-align: justify;
}
.ac.active > .ac-q::after {
	content: "\2013";
}
	
	.slider {
 /* margin: 30px 0px*/;
}

.slick-slide {

  color: #000;
  padding: 0px 10px;
  font-size: 13px;
  font-family: "Arial", "Helvetica", sans-serif;
  text-align: center;
}

.slick-prev::before,
.slick-next::before {
  color: black;
}

.slick-slide:nth-child(odd) {

}


/**
 * bootstrap-imageupload v1.1.2
 * https://github.com/egonolieux/bootstrap-imageupload
 * Copyright 2016 Egon Olieux
 * Released under the MIT license
 */

.imageupload.imageupload-disabled {
  cursor: not-allowed;
  opacity: 0.60;
}
.imageupload.imageupload-disabled > * {
  pointer-events: none;
}
.imageupload .panel-title {
  margin-right: 15px;
  padding-top: 8px;
}
.imageupload .alert {
  margin-bottom: 10px;
}
.imageupload .btn-file {
  overflow: hidden;
  position: relative;
}
.imageupload .btn-file input[type="file"] {
  cursor: inherit;
  display: block;
  font-size: 100px;
  min-height: 100%;
  min-width: 100%;
  opacity: 0;
  position: absolute;
  right: 0;
  text-align: right;
  top: 0;
}
.imageupload .file-tab button {
  display: none;
}
.imageupload .file-tab .thumbnail {
  margin-bottom: 10px;
}
.imageupload .url-tab {
  display: none;
}
.imageupload .url-tab .thumbnail {
  margin: 10px 0;
}

</style>   

   <!-- Modernizr Js -->
    <script src="<?php bloginfo('template_url');?>/js/modernizr-2.8.3.min.js"></script>
    <script src="<?php bloginfo('template_url');?>/js/jquery-2.1.0.js"></script> 
        
<script src="<?php bloginfo('template_url');?>/js/accordion.min.js"></script>	

	
	<style type="text/css">
	.res {
    width: 262px;
    margin-left: 36px;
}
.reg {
    width: 536px !important;
}</style>
<script>
	var accordion = new Accordion();	
</script>
<style>
.footer-social {
    margin: 0 110px;
}
.enrol-section form {
    text-align: center;
}
</style>

<script>function refresh() {

    setTimeout(function () {
        location.reload()
    }, 100);
}</script>  
<?php wp_head();?>
<script src='https://www.google.com/recaptcha/api.js'></script>


</head>


<body <?php body_class(); ?>>
<?php 
get_sidebar('response_message');
?>
<div class="visible-xs my1">
 <ul class="top-list">
   <li><a class="btn-lg" href="<?php if(get_option('cm_register_page_id')) { _e(get_page_link(get_option('cm_register_page_id'))); }else { _e('javascript:void();'); } ?>"><i class="fa fa-lock" aria-hidden="true"></i> <?php _e("Register"); ?></a></li>
   <li>&nbsp;</li>
   <li><a class="btn-lg" href="javascript:void();" data-toggle="modal" data-target="#myModal"><i class="fa fa-lock" aria-hidden="true"></i> <?php _e("Sign In"); ?></a></li>
 </ul>
</div>
    
 
    <!-- Preloader End Here -->
    <!-- Main Body Area Start Here -->
    <div id="wrapper">
    
     
        <!-- Header Area Start Here -->
         <style>.lost {
    font-weight: 900 !important;
}</style>
<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/5d681f34a0800706705143e09/fdfdec88477f7bc6a9de59556.js");</script>
<header>
  <div id="header2" class="header4-area  "  style="height: 80px;">
    <div class="header-top-area  ">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="header-top-left">
              <div class="logo-area"> <a href="<?php _e(get_option('siteurl'));?>">
			  <?php
			  $custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			if($image[0]!='')
			{ ?> 
		  <img class="img-responsive" src="<?php _e($image[0]); ?>" alt="<?php _e(get_option('blogname')); ?>" title="<?php _e(get_option('blogname')); ?>">
		<?php }else { 
			  ?>
			  <img class="img-responsive" src="<?php bloginfo('template_url');?>/images/logo-primary.png" alt="<?php _e(get_option('blogname')); ?>" title="<?php _e(get_option('blogname')); ?>" >
			<?php } ?>
			  </a> </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="header-top-right">
                <nav id="desktop-nav1" >
              <ul>
							<?php /* if(get_option('cm_company_registration_number'))
							{ ?>		
							<li>
                              <i class="fa fa-registered" aria-hidden="true"></i>
								<strong>CRN :</strong><?php _e(get_option('cm_company_registration_number')); ?>
                               </li>
							   <?php } 
							   if(get_option('cm_tax_registration_number'))
							   {
							   ?>
			  			         <li>
                                  <i class="fa fa-registered" aria-hidden="true"></i>
                            <strong>TRN :</strong>  <?php _e(get_option('cm_tax_registration_number')); ?>
                                 </li> 
							   <?php } */  ?>
			  
			  <?php if(get_option('cm_contact_number')) { ?>
         <li><i class="fa fa-whatsapp" aria-hidden="true"></i><a href="Tel:<?php _e(get_option('cm_contact_number')); ?>"> <?php _e(get_option('cm_contact_number')); ?><?php if(get_option('cm_top_mobile_text')) { ?> <span><?php _e(get_option('cm_top_mobile_text')); ?></span> <?php } ?></a> </li>
			<?php } ?>
			<?php if(get_option('admin_contact_email')) { ?>
           <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="<?php _e(get_page_link(get_option('cm_contact_page_id'))); ?>"><?php _e(get_option('admin_contact_email'));?></a></li>
			  <?php } ?>
			  <?php if(is_user_logged_in()) { 
			  global $current_user;
			
			  ?>
		           <li>         <a href="JavaScript:Void(0)"><i class="fa fa-user" aria-hidden="true"></i><?php _e($current_user->display_name);?></a>
                  
                   
                      <ul>                
                        <li  class="has-child-menu">
	  <ul class="thired-level">
		<li><a class="btn-lg"  href="<?php if(get_option('cm_account_page_id')) { _e(get_page_link(get_option('cm_account_page_id'))); }else { _e('javascript:void();'); } ?>" ><i class="fa fa-lock" aria-hidden="true"></i><?php _e("Edit Account"); ?></a>   </li>
		
		<li><a class="btn-lg"  href="<?php if(get_option('cm_account_page_id')) { _e(get_page_link(get_option('cm_account_page_id'))."#wppb-form-element-7"); }else { _e('javascript:void();'); } ?>"><i class="fa fa-lock" aria-hidden="true"></i><?php _e("Change Password"); ?></a>   </li>
		
		<li><a class="btn-lg"  href="<?php if(get_option('cm_history_page_id')) { _e(get_page_link(get_option('cm_history_page_id'))); }else { _e('javascript:void();'); } ?>"><i class="fa fa-lock" aria-hidden="true"></i><?php _e("User history"); ?></a>   </li>
		
		<li>		
		<a class="btn-lg" href="<?php echo wp_logout_url(get_option('siteurl')); ?>"><i class="fa fa-lock" aria-hidden="true"></i><?php _e("Logout"); ?></a> </li>
                            </ul>
                        </li>
                        
                        </ul>
                    </li>
			  <?php }else { 
			  
			  ?>     
			   	<li> <a class="btn-lg"  href="<?php if(get_option('cm_register_page_id')) { _e(get_page_link(get_option('cm_register_page_id'))); }else { _e('javascript:void();'); } ?>" ><i class="fa fa-edit" aria-hidden="true"></i><?php _e("Register"); ?></a></li>
		
                <li>
                                    <a class="btn-lg" data-toggle="modal" data-target="#myModal" href="#" ><i class="fa fa-lock" aria-hidden="true"></i> Sign in</a>
                 </li>                  
          
			  <?php }?>
                  
<?php get_sidebar('popup');?>
  </div>
  
                  
                  
           
                  </div>
             
              </ul></nav>
            </div>
          </div>
        </div>
      </div>
  
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
  
  <div class="main-menu-area bg-primary" id="sticker">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <nav id="desktop-nav">
			
			<?php 
			$args= array(
			 'menu'           => 'Main Menu', 
    'theme_location' => 'main_menu'
			);
			wp_nav_menu( $args );?>
           		
		</div>
        </div>
      </div>
    </div>
  
  <!-- Mobile Menu Area Start -->
  <div class="mobile-menu-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mobile-menu">
            <nav id="dropdown" style="display: block;">
			
			
				<?php 
			$args= array(
			 'menu'           => 'Main Menu', 
    'theme_location' => 'main_menu'
			);
			wp_nav_menu( $args );?> 
           
	
      </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Mobile Menu Area End --> 
</header>