<?php
/* 
Template Name: Event Calender Page
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
     
        
<div class="contact_section">
<div class="container">
<div class="page">
	<div style="float:right;text-align:right;"><?php _e("Events"); ?> : <span style="background-color:#FF6347">&nbsp;&nbsp;&nbsp;&nbsp;</span><br><?php _e("Schedule Course"); ?> : <span style="background-color:#ffb128">&nbsp;&nbsp;&nbsp;&nbsp;</span><br><br>
</div>
<div style="width:100%; max-width:1100px; display:inline-block;">
		<div class="monthly" id="mycalendar"></div>
		</div>
        </div>
</div>
</div>

        
        <!-- Courses Page 1 Area End Here -->
        <!-- Footer Area Start Here -->
<?php get_footer(); ?>
  <!-- Event Calender Script Start Here -->
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/monthly.js"></script>
<script type="text/javascript">
	$(window).load( function() {
		$('#mycalendar').monthly({
			mode: 'event',
			jsonUrl: '<?php _e(get_option('siteurl'));?>/?getevents=true',
			dataType: 'json'			
		});
	
	switch(window.location.protocol) {
	case 'http:':
	case 'https:':
	// running on a server, should be good.
	//break;
	//case 'file:':
	//alert('Just a heads-up, events will not work when run locally.');
	}

	});
</script>