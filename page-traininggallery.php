<?php 
/* 
Template Name: Training Gallery Page
*/
get_header();  ?>
      <!-- Header Area End Here -->

        <!-- Inner Page Banner Area Start Here -->
        <div class="inner-page-banner-area1">
            <div class="container">			 			
                <div class="pagination-area">
                    <h1><?php the_title(); ?> </h1>
                    <ul> 
                           <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li> 	
                        <li><?php the_title(); ?></li>
                    </ul> 
                </div> 
			            </div> 
        </div>
        <!-- Inner Page Banner Area End Here -->
        <div class="clr" style="clear:both"></div>
        <!-- Courses Page 1 Area Start Here -->
        <div class="courses-page-area1">
            <div class="container">
			 
				   <div class="row service-list gallery_inner">

			   <?php  $gallerysubcategories = get_terms( 'gallery_category', array( 'parent' => get_option('cm_training_cat_id'), 'orderby' => 'id', 'hide_empty' => false ) );	
$i=0;
			   foreach($gallerysubcategories as $subcatinfo)
			   { $i++;
			   ?>  
                            <div class="col-md-3">                            
                               	<a href="<?php _e(get_term_link( $subcatinfo ));?>"> 
			
		<?php if (function_exists('z_taxonomy_image_url'))
														{
															
															if(get_option('z_taxonomy_image'.$subcatinfo->term_id)!=='')
															{
															?>
															<img class="img-responsive training_img" src="<?php _e( get_option('z_taxonomy_image'.$subcatinfo->term_id));?>" alt="<?php _e($subcatinfo->name);?>">

														<?php } 
														}?></a>  <h4 style="text-align: center;" class="subtitle"> 	<a href="<?php _e(get_term_link( $subcatinfo ));?>"> 
			<?php _e($subcatinfo->name);?></a></h4>
                           
                            </div>
                             
                    
						<?php if($i%4==0) { ?>
						 <div class="clearfix spacer-50"></div>
						<?php } ?>
                          
			   <?php  }  ?>                           

                            <div class="clearfix spacer-50"></div>

                      
                            

                        </div>
                  
		  </div>
        </div>
       
        <!-- Footer Area Start Here -->
<?php get_footer(); ?>