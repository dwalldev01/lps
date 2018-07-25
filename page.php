<?php get_header(); ?>
<style>
.footer-social {
    margin: 0 110px;
}
.enrol-section form {
    text-align: center;
}
</style>

<script>function refresh() {

    setTimeout(function () {
        location.reload()
    }, 100);
}</script>        <!-- Header Area End Here -->
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
        
		
		<div class="col-sm-12 col-md-12">
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