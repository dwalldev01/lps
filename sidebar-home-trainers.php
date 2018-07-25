       <!-- Lecturers Area Start Here -->
        <div class="lecturers-area section" id="lecturers-area " >
            <div class="container">
                <h2 class="title-default-left"><?php _e("Our Skilled Trainers"); ?></h2>
            </div>
            <div class="container">
                <div class="rc-carousel" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="3" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="4" data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="4" data-r-large-nav="true" data-r-large-dots="false">
								
                   <?php wp_reset_query();
	 $args  = array(
									'showposts'       => $totalposts,									
									'post_type'       => 'trainers',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=0;
					json
					 ?>	 
                   <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();
					
					global $post;
					
					 ?> 
								
                    <div class="single-item">
                        <div class="lecturers1-item-wrapper">
                            <div class="lecturers-img-wrapper">
                                
                                
                                  <a href="<?php the_permalink();?>" >
								  
                      <?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'" class="img-responsive" alt="'.get_the_title().'" title="'.get_the_title().'"  '; 
		  
		  $image .='  />';	
		  
		  echo $image;
		 }		
		 ?> 				  </a>
                                                  
                           </div>
                               
                     
                      <div class="lecturers-content-wrapper">
                                <h3 class="item-title"><a href="<?php the_permalink();?>" ><?php the_title();?></a></h3>
                             
                               <span class="item-designation"><?php _e(get_post_meta($post->ID,'trainer-post',true)); ?></span>
              <span class="item-designation"><?php _e(get_post_meta($post->ID,'trainer-subject',true)); ?></span>
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
        </div>
        <!-- Lecturers Area End Here -->
		