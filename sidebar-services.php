		
        <div class="about2-area section" >
            <div class="container">
                <h1 class="about-title"><?php _e("Future Trainings");?></h1>
                <p class="about-sub-title">&nbsp;</p>
            </div>
			
<?php $methodologyterms = get_terms( array(
    'taxonomy' => 'methodology_category',
    'hide_empty' => false,
) );

?>
<?php if ( ! empty( $methodologyterms ) && ! is_wp_error( $methodologyterms ) )
{

	  foreach ( $methodologyterms as $term ) {	 ?>		
				<div class="<?php if($term->term_id==9) { ?>container-fluid<?php }else { ?>container<?php } ?>">
					<div class="col-md-12 no-padding" <?php if($term->term_id!==9) { ?>style="margin-bottom:25px;" <?php } ?>>
				<?php if($term->term_id==9) { ?>	
					 <div class="col-lg-1 col-md-1">
                </div>
				<?php }?>
					<?php


$args = array(
	'post_type' => 'methodology',
	'tax_query' => array(
		array(
			'taxonomy' => 'methodology_category',
			'field'    => 'id',
			'terms'    => $term->term_id,
		),
	),
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>
    <?php while ( $query->have_posts() ) : $query->the_post(); 
					global $post;
					
	?>				
			
                <div class="<?php if($term->term_id==9) { ?>col-lg-2 col-md-2 col-sm-4 col-xs-12 wow fadeIn<?php }else { ?> col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeIn<?php } ?>" data-wow-duration="2s" data-wow-delay=".1s">
                        <div class="service-box2">
                            <div class="service-box-icon">
                                <a href="<?php the_permalink();?>">
								<?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'" class="fa fa-user" alt="'.get_the_title().'"  '; 
		  
		  $image .='  />';	
		  echo $image;
		 }		
		 ?> 
						
								</a>
                            </div>
                            <h3>  <a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                            <p>   <?php 
$excerpt = get_the_excerpt();
    _e(substr($excerpt, 0, 150)); ?>
							</p>
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
  <?php 
	  }
} ?> 
<br><br>
     </div>
       