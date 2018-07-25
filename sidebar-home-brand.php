  <div class="brand-area section" >
            <div class="container">
				 <h2 class="title-default-left"><?php _e("Clients");?></h2>
                <div class="rc-carousel" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="false" data-nav-speed="false" data-r-x-small="2" data-r-x-small-nav="false" data-r-x-small-dots="false" data-r-x-medium="3" data-r-x-medium-nav="false" data-r-x-medium-dots="false" data-r-small="4" data-r-small-nav="false" data-r-small-dots="false" data-r-medium="4" data-r-medium-nav="false" data-r-medium-dots="false" data-r-large="4" data-r-large-nav="false" data-r-large-dots="false">
      							
                   <?php wp_reset_query();
	 $args  = array(
									'showposts'       => $totalposts,									
									'post_type'       => 'brands',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=0;
					json
					 ?>	 
                   <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();
					
					global $post;
					
					 ?> 
									
                  

									
                   
                      <?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'"  alt="'.get_the_title().'" title="'.get_the_title().'"  '; 
		  
		  $image .='  />';	
		  
		  echo ' <div class="brand-area-box">'.$image.'</div>';
		 }		
		 ?> 
                    
					
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
        