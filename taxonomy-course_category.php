<?php get_header();  ?>
      <!-- Header Area End Here -->
<?php 
$pcourse = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
									

if($pcourse->parent==0)
{
 $coursesubcategories = get_terms( 'course_category', array( 'parent' => $pcourse->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );	
?>
        <!-- Inner Page Banner Area Start Here -->
        <div class="inner-page-banner-area1">
            <div class="container">
			 			
                <div class="pagination-area">
                    <h1><?php single_term_title(); ?> </h1>
                    <ul> 
                           <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li> 	
                        <li><?php single_term_title(); ?></li>
                    </ul> 
                </div> 
			            </div> 
        </div>
        <!-- Inner Page Banner Area End Here -->
        <div class="clr" style="clear:both"></div>
        <!-- Courses Page 1 Area Start Here -->
        <div class="courses-page-area1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                                        <?php 
  
       
   
									if(count($coursesubcategories)>0)
									  {
										?><div class="courses-page-top-area">
                                    <div class="courses-page-top-left">
                                         <p>Showing 1-<?php _e(count($coursesubcategories)); ?> results</p>   </div>
                                 
                                </div>	
								  <?php } ?>		 
                       
                            </div>
                        </div>
                        <div class="row">
                            <!-- Tab panes -->
                            <div class="tab-content">
							
							
                                <div role="tabpanel" class="tab-pane active" id="gried-view">
                                 <div class="col-lg-12">
								  <?php
								
								  if(count($coursesubcategories)>0)
								  {
								    foreach ( $coursesubcategories as $coursesubcategory ) {
										
										
								  ?>								 
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="courses-box1">
                                            <div class="single-item-wrapper">
                                                <div class="courses-img-wrapper hvr-bounce-to-bottom">
                                                    <?php if (function_exists('z_taxonomy_image_url'))
														{
															
															if(get_option('z_taxonomy_image'.$coursesubcategory->term_id)!=='')
															{
															?>
															<img class="img-responsive" src="<?php _e( get_option('z_taxonomy_image'.$coursesubcategory->term_id));?>" alt="<?php _e($coursesubcategory->name);?>">

														<?php } 
														}?>
                                                    <a href="<?php _e(get_term_link( $coursesubcategory ));?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="courses-content-wrapper">
                                                    <h3 class="item-title"><a href="<?php _e(get_term_link( $coursesubcategory ));?>" ><?php _e($coursesubcategory->name);?></a></h3>
                                                    <p class="item-content"></p>
                                                    <ul class="courses-info">
                                                        <li>Number of Courses - <?php
														$term = get_term( $coursesubcategory->term_id, 'course_category' );//for example uncategorized category
echo $term->count;?></li>
                                                   
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									 	
<?php  }  
								  }else { 
 _e('<div class="container">No Course Category Found.</div>'); } ?>
                                    
                                    </div>
                                </div>
  <!-- Listed product show ........................................................................................................................................... -->
                                
                            </div>
                        </div>
                      
                    </div>
                  
                </div>
            </div>
        </div>
        <!-- Courses Page 1 Area End Here -->
<?php }
else
{ 
global $pcourseinfo;
$pcourseinfo = get_term_by( 'id', $pcourse->parent, get_query_var( 'taxonomy' ) ); 

?>
	    
        <!-- Inner Page Banner Area Start Here -->
        <div class="inner-page-banner-area1">
             <div class="container">
			 			
                <div class="pagination-area">
                    <h1><?php _e($pcourseinfo->name);?></h1>
                    <ul>
                        <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>	
                        <li><?php _e($pcourseinfo->name);?> - </li>
						   <li><?php single_term_title(); ?></li>
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
	  <?php 
	  $counter=0;
	  while ( have_posts() ) : the_post();
  $counter++;
	if($counter==1)
	{
		?>        
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
                                        <ul class="courses-list">
                                      <?php _e(htmlspecialchars_decode ($workobjective)); ?>                                    </ul>
                                        </div>
										<?php } ?>
        <?php /*        ?>                <div class="col-lg-6 col-md-6 no-padding">
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
     <?php
	}
	 endwhile; // end of the loop. ?>				
     <div class="clr" style="clear:both"></div>
		
        <br><br>

   </div>
</div>


        
        <!-- Courses Page 1 Area End Here -->
        
       

<?php 
	
}
?>		
		
        <!-- Footer Area Start Here -->
<?php get_footer(); ?>