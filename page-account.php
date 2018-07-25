<?php
/* 
Template Name: Account Page
*/
if(!is_user_logged_in())
{
	$siteurl=get_option('siteurl');
	wp_redirect($siteurl);
	exit;		
}
 get_header(); ?> 
       <!-- Header Area End Here -->
  <?php while ( have_posts() ) : the_post(); ?>

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
     
        
<div class="contact_section">
<div class="container">
    <div class="row">
		<?php get_sidebar('account');?>
		<div class="col-sm-9 col-md-9">
			<div class="courses1">	
			<?php the_content(); ?>		    

			</div>
		</div>
    </div>
</div>
</div>
<?php endwhile; // end of the loop. ?>				

        
        <!-- Courses Page 1 Area End Here -->
        <!-- Footer Area Start Here -->
<?php get_footer(); ?>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>