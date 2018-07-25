<?php get_header();  ?>
      <!-- Header Area End Here -->

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
			 
				   <div class="row service-list gallery_inner">

			   <?php $i=0;
if ( have_posts() ) :
			   while ( have_posts() ) : the_post();	 $i++; ?>  
                            <div class="col-md-3">
                           
                               	<a onClick="show_popup('<?php _e($post->ID);?>');" class="trigger_popup_fricc"> 
			
			 <?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'"   alt="'.get_the_title().'" title="'.get_the_title().'"  '; 
		  
		  $image .='  />';	
		  
		  echo $image;
		 }
		 ?>   <h4 class="subtitle" style="text-align: center;"><?php the_title();?></h4></a>
                           
						   
						   
<div class="hover_bkgr_fricc" id="gallery_zoom_section_<?php _e($post->ID);?>">
  <div>
    <div class="popupCloseButton" id="close_<?php _e($post->ID); ?>">X</div>
	<?php if(get_post_meta($post->ID,'video_settings_video-embedded-code',true)) { 
	_e(get_post_meta($post->ID,'video_settings_video-embedded-code',true)); }else { ?>
    <?php _e($image);?>
	<?php } ?>
    </div>
</div>

						   
                            </div>
                             
                    
						<?php if($i%4==0) { ?>
						 <div class="clearfix spacer-50"></div>
						<?php } ?>
                       <script type="text/javascript">
	

$(window).load(function () {	
  $('#close_<?php _e($post->ID); ?>').click(function(){
	  
        $('.hover_bkgr_fricc').hide();
		 $('#gallery_zoom_section_<?php _e($post->ID);?> iframe').attr("src", $("#gallery_zoom_section_<?php _e($post->ID);?> iframe").attr("src"));

    });
});

</script>
						  
  <?php endwhile; // end of the loop. 
  else :
  ?>
	<?php _e("No Gallery item found.");?>
  
  <?php
  endif;
  ?>                           

                            <div class="clearfix spacer-50"></div>

                      
                            

                        </div>
                  
		  </div>
        </div>
       
        <!-- Footer Area Start Here -->
<?php get_footer(); ?>
<script type="text/javascript">
	
	function show_popup(galleryid)
	{		
		 $('#gallery_zoom_section_'+galleryid).show();   
	}
$(window).load(function () {	
  $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
});

</script>