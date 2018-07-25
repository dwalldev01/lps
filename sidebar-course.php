    <div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion">
          <?php
		  global $post;
		  $currentpostid= $post->ID;
		  global $pcourse;
		  global $pcourseinfo;
		   $coursesubcategories = get_terms( 'course_category', array( 'parent' => $pcourseinfo->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );	
		  ?>
	<?php

	  if(count($coursesubcategories)>0)
	  {
		foreach ( $coursesubcategories as $coursesubcategory )
			{
		?>
		<input type="hidden" id="cat_id2" nane="cat_id2" value="20">

		<div class="panel panel-default">
		   <div class="panel-heading ">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php _e($coursesubcategory->term_id); ?>"><span class="glyphicon glyphicon-folder-close">
					</span><?php _e($coursesubcategory->name);?></a>
				</h4>
			</div>
			<div id="collapse_<?php _e($coursesubcategory->term_id); ?>" class="panel-collapse collapse <?php if($coursesubcategory->term_id==$pcourse->term_id) { ?> in <?php } ?>">
				<div class="panel-body">
					<table class="table">
										<?php


$args = array(
	'posts_per_page' => -1,
	'post_type' => 'course',
	'tax_query' => array(
		array(
			'taxonomy' => 'course_category',
			'field'    => 'id',
			'terms'    => $coursesubcategory->term_id,
		),
	),
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>
    <?php while ( $query->have_posts() ) : $query->the_post(); 
					global $post;
					
	?>		 
					 <tr>
							<td>

		<a href="<?php the_permalink();?>" id="<?php _e($post->ID);?>" class="alink <?php if($post->ID==$currentpostid) { ?> active <?php } ?>" ><?php the_title(); ?></a>
		<input type="hidden" id="course_id_<?php _e($post->ID);?>" name="course_id" value="<?php _e($post->ID);?>">
		
							</td>
						</tr>
			<?php 
		 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
?>  		
					</table>
				</div>
			</div>
		</div>

	<?php  }  
	} ?>		
	
	               
            </div>
        </div>
		