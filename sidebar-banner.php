	
       <div class="slider1-area overlay-default section" >
            <div class="bend niceties preview-1">
                <div id="ensign-nivoslider-3" class="slides">
				<?php wp_reset_query();
	 $args  = array(
									'showposts'       => $totalposts,									
									'post_type'       => 'Slides',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=1;					
					 ?>
					
					 <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();
					
					global $post;
					
					 ?> 				
				
                  
									<!-- Slider Image <?php _e($counter); ?> -->
<?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'"  alt="'.get_the_title().'" title="#slider-direction-'.$counter.'"  '; 
		  
		  $image .='  />';	
		  echo $image;
		 }		
		 ?> 

					

				 <?php 
		 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
?>  <!-- Slider Image Ends Here <?php _e($counter); ?>  -->

                          </div>
						<?php wp_reset_query();
	 $args  = array(
									'showposts'       => $totalposts,									
									'post_type'       => 'Slides',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=1;					
					 ?>
					
					 <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();
					
					global $post;
					
					 ?> 				
					
								
                <div id="slider-direction-<?php _e($counter); ?>" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-<?php _e($counter); ?>">
                        <div class="title-container s-tb-c">
                            <div class="title1"><h1 style="color:#fff;"><?php the_title(); ?></h1></div>											
                            <div class="slider-btn-area">
				 <a href="<?php _e(get_option('cm_start_course_link'));?>" class="default-big-btn"  ><?php _e('Start a Course'); ?></a>
				                                         </div>
                        </div>
                    </div>
                </div>	

	 <?php 
		 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
?>
				


		  </div>
        </div>
       