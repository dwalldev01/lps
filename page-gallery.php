<?php
/* 
Template Name: Gallery Page
*/
 get_header(); ?>
 
 
  <!-- Inner Page Banner Area Start Here -->
    <div class="inner-page-banner-area1">
    <div class="container">
      <div class="pagination-area">
        <h1><?php the_title(); ?></h1>
        <ul>
          <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>
          <li><?php the_title(); ?></li>
        </ul>
      </div>
    </div>
  </div>
        <!-- Inner Page Banner Area End Here -->
        <div class="clr" style="clear:both"></div>
        <!-- About Page 1 Area Start Here -->
 
<div id="wrapper">
<div class="container">
    <div class="row">


<h2><?php the_title(); ?></h2>

<?php $galleryterms = get_terms( array(
    'taxonomy' => 'gallery_category',
    'hide_empty' => false,
) );

?>

<div class="row">
<?php if ( ! empty( $galleryterms ) && ! is_wp_error( $galleryterms ) )
{
$i=0;
	  foreach ( $galleryterms as $term ) {
		  $i++;
	?>
	
	  <div class="col-md-3">
                            <div>
			<a href="<?php _e(get_term_link(34));?>"> 
						
						<?php if (function_exists('z_taxonomy_image_url'))
			{

			if(get_option('z_taxonomy_image'.$term->term_id)!=='')
			{
			?>
			<img class="img-responsive" src="<?php _e( get_option('z_taxonomy_image'.$term->term_id));?>" alt="<?php _e($term->name);?>">

			<?php } 
			}?></a> 
                            </div>
                            <h4 ><a href="<?php _e(get_term_link(34));?>"><?php _e($term->name); ?></a></h4>                    
							                            
                        </div>
						<?php if($i%4==0) { ?>
						 <div class="clearfix spacer-50"></div>
						<?php } ?>
	

<?php 
	  }
} ?>

  </div>  

 </div>   
</div>
</div>
<?php get_footer(); ?>