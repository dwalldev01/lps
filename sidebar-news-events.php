   <div class="news-event-area section"  >
            <div class="container">
                <div class="row">
				 <!-- News Area Start Here -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 news-inner-area"> 					
                        <h2 class="title-default-left"><?php _e("Latest News"); ?></h2>
                        <ul class="news-wrapper">
								
							                 <?php wp_reset_query();
	 $args  = array(
									'showposts'       => 2,									
									'post_type'       => 'news',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=0;				
					 ?>	 
                   <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();
					
					global $post;
					
					 ?> <li>
                                <div class="news-img-holder" style="padding:3px;">
                                   <a href="<?php the_permalink();?>"> 
								  
 <?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'" class="img-responsive"  alt="'.get_the_title().'" title="'.get_the_title().'"  '; 
		  
		  $image .='  />';	
		  
		  echo $image;
		 }		
		 ?>	
								   </a>
                                </div>
                                <div class="news-content-holder">
                                    <h3><a href="<?php the_permalink();?>"><?php the_title();?></a> </h3>
                                    <div class="post-date"> <?php _e(get_the_date('F j, Y')); ?></div>
                                    <p> <?php the_excerpt();?> </p>
                                </div>
                            </li>
				
					 <?php 
		 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
?>  	


					
                          
							
                        </ul>
                        <div class="news-btn-holder">
                                                         <a href="<?php _e(get_option('siteurl')); ?>/news/" class="view-all-accent-btn"  ><?php _e("View All"); ?></a>
				                                     </div>
                    </div>
                <!-- News Area Ends Here -->  
				
				<!-- Events Area Start Here -->				
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 event-inner-area">
                        <h2 class="title-default-left"><?php _e("Upcoming Events"); ?></h2>
                        <ul class="event-wrapper">
						   <?php wp_reset_query();
	 $args  = array(
									'showposts'       => 2,									
									'post_type'       => 'events',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=0;				
					 ?>	 
                   <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();
					
					global $post;
					
					 ?> 	
					   <li class="wow bounceInUp" data-wow-duration="2s" data-wow-delay=".1s">
<div class="event-calender-wrapper">
	<div class="event-calender-holder">
	<h4><?php $startdate=get_post_meta($post->ID,'event_settings_start-date',true);
$enddate=get_post_meta($post->ID,'event_settings_end-date',true);

$startmonth=date('M',strtotime($startdate));
$endmonth=date('M',strtotime($enddate));
	if($startdate!='')
	{ 
		_e(date('d',strtotime($startdate))."&nbsp;to&nbsp;".date('d',strtotime($enddate)));
	}
	?></h4>
		<p><?php if($startmonth==$endmonth) { _e($startmonth);}else { _e($startmonth." to ".$endmonth); }  ?></p>
		<span><?php _e(date('Y',strtotime($startdate))); ?></span>
	</div>
</div>
<div class="event-content-holder">
	<h3><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h3>
	 
				<?php the_excerpt(); ?>
  
		<ul>
	   <li><?php _e(get_post_meta($post->ID,'event_settings_time',true)); ?></li>
	   <li><?php _e(get_post_meta($post->ID,'event_settings_event-location',true)); ?></li>   
	   </ul>
</div>
</li>
					  
					 <?php 
		 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
?>  	

					
					
												  </ul>
                        <div class="event-btn-holder">
                                                        <a href="<?php _e(get_option('siteurl')); ?>/events/" class="view-all-accent-btn"  ><?php _e("View All"); ?></a>
				                                     </div>
                    </div>
              	<!-- Events Area Ends Here -->		
			  </div>
            </div>
        </div>
      