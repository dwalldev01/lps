  <?php get_header();  ?>
      <!-- Header Area End Here -->
	      

			       <?php while ( have_posts() ) : the_post();

		?>         
<?php 

$terms = get_the_terms( get_the_ID(), 'course_category' );

//echo $terms[0]->term_id;
global $pcourse;

$pcourse = get_term_by( 'id', $terms[0]->term_id, 'course_category' ); 
global $pcourseinfo;
$pcourseinfo = get_term_by( 'id', $pcourse->parent, 'course_category' ); 

 ?>
	
        <!-- Inner Page Banner Area Start Here -->
        <div class="inner-page-banner-area1">
             <div class="container">
			 			
                <div class="pagination-area">
                    <h1><?php _e($pcourseinfo->name);?></h1>
                    <ul>
                        <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>	
                        <li><?php _e($pcourseinfo->name);?> - </li>
						   <li><?php _e($pcourse->name); ?> - </li>
						    <li><?php the_title(); ?></li>
                    </ul>
                </div>
			            </div>
        </div>
        <!-- Inner Page Banner Area End Here -->
		
        <div class="clr" style="clear:both"></div>
		
        <br><br>
        <!-- Courses Page 1 Area Start Here -->
		
        <div class="container">
    <div class="row">
	
    <?php get_sidebar('course'); ?>
	
		<div class="result">		

		<div class="col-sm-9 col-md-9">
		
		 
		
											<div class="courses1">
												<h2 class="course-h2"><?php the_title(); ?></h2>
                                        <p><?php the_content();?></p>
                                        <div class="clr" style="clear:both"></div>
                                        
                                        <div class="col-lg-12 col-md-12 no-padding">
										<?php $workobjective=get_post_meta($post->ID,'_cm_work_objective',true);
										if($workobjective)
										{
										?>
                                        <h2 class="course-h2"><?php _e("Workshop Objectives:"); ?></h2>
                                        <div class="col-lg-12 col-md-12 no-padding">
                                        <div class="courses-list">
                                      <?php _e(htmlspecialchars_decode ($workobjective)); ?></div>
                                        </div>
										<?php } ?>
   <?php /*    ?>                                 <div class="col-lg-6 col-md-6 no-padding">
										 <?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'" class="img-responsive"  alt="'.get_the_title().'" title="'.get_the_title().'"  '; 
		  
		  $image .='  />';	
		  
		  _e($image);
		 }		
		 ?>      </div> <?php */ ?>
                                        </div>
                                      <div class="clr" style="clear:both"></div>
                                        
                                    </div>
                              	
                                    <div class="ac-container">
				<?php 	$totalmodule = get_post_meta($post->ID,'_cm_total_module',true);
						for($counter=1;$counter<=$totalmodule;$counter++)
						{
							if(get_post_meta($post->ID,'_cm_module_title_'.$counter,true))
							{
				?>
                	<div class="ac">
                		<a href="#" class="ac-q"><span><?php _e("Module"); ?> <?php _e($counter);?> :</span> 
						<?php _e(get_post_meta($post->ID,'_cm_module_title_'.$counter,true)); ?></a>
                		<div class="ac-a" style="height: 0px; transition-duration: 600ms;">
                			<p class="module-p"><?php _e(get_post_meta($post->ID,'_cm_module_desc_'.$counter,true)); ?></p>
                		</div>
                	</div>
					
				  <?php 	} 
						}
				  ?>
       
</div>
                                    
		</div>
		<script src="<?php bloginfo('template_url');?>/js/accordion.min.js"></script>	

		<script>
			var accordion = new Accordion();	
		</script>
		
</div>
         
		 <div class="clr" style="clear:both"></div>
		
        <br><br>

        </div>
    </div>
</div>
       
        <!-- Courses Page 1 Area End Here -->
 <?php endwhile; // end of the loop. ?>				
      	
        <!-- Footer Area Start Here -->
<?php get_footer(); ?>