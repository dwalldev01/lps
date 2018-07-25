 <div class="video2-area section">
        
            <div class="container">
                <h1 class="about-title"><?php _e("Company Videos"); ?></h1>
                <p class="about-sub-title">&nbsp;</p>
            </div>
     

    <div class="container">

<?php if(get_option('cm_home_video_cat_id')) { ?>
<!-- Grid row -->
<div class="row">

<?php 	
 wp_reset_query();
$galleryposts = query_posts(array(
  'post_type' => 'gallery',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'gallery_category',
      'field' => 'id',
      'terms' => get_option('cm_home_video_cat_id'), // Where term_id of Term 1 is "1".
      'include_children' => false
    )
  )
)); 
	  if ( have_posts() ) : while ( have_posts() ) : the_post();
					$counter++;
					global $post;
					//_e($post->ID);
					 ?>

	 <?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'"   alt="'.$post->post_title.'" title="'.$post->post_title.'"  '; 
		  
		  $image .='  />';	
		  
		 // echo $image;
		 }
		 ?> 
    <!-- Grid column -->
    <div class="col-lg-4 col-md-12 mb-4 home-v-cur">

        <!--Modal: Name-->
        <div class="modal fade" id="modal_<?php _e($post->ID);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">

                <!--Content-->
                <div class="modal-content">

                    <!--Body-->
                    <div class="modal-body mb-0 p-0">

                        <div id="yt-player<?php _e($post->ID); ?>" class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                            
                	<?php if(get_post_meta($post->ID,'video_settings_video-embedded-code',true)) { 
	_e(get_post_meta($post->ID,'video_settings_video-embedded-code',true)); }else { ?>
    <?php _e($image);?>
	<?php } ?>       
                        </div>

                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                        
                      
                        <button type="button" id="close<?php _e($post->ID);?>" class="close btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                    </div>

                </div>
                <!--/.Content-->

            </div>
        </div>
        <!--Modal: Name-->

        <a href="javascript:void();"  data-toggle="modal" data-target="#modal_<?php _e($gallery->ID); ?>"  class="img-fluid z-depth-1">
		
		<?php
		if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img class="img-fluid z-depth-1" src="'.$featuredimage[0].'" data-toggle="modal" data-target="#modal_'.$post->ID.'"   alt="'.$post->post_title.'" title="'.$post->post_title.'"  '; 
		  
		  $image .='  />';	
		  
		 echo $image;
		 }
		?><?php _e($gallery->post_title);?>
		</a>

    </div>
    <!-- Grid column -->
		<?php if($counter%3==0) { ?>
		</div>	
<div class="row">

		<?php } ?>
<script type="text/javascript">
    $('#close<?php _e($post->ID);?>').on('click', function() {  
 $('#modal_<?php _e($post->ID);?> iframe').attr("src", $("#modal_<?php _e($post->ID);?> iframe").attr("src"));
 
});
</script>		
 <?php 
		 
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
?>  	

</div>
<!-- Grid row -->
	</div>

	<?php } ?>  
    
    
    </div>
	
	