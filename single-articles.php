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
        <?php while ( have_posts() ) : the_post();
global $currentterms;		
$currentterms = get_the_terms( $post->ID , 'article_category' );

		?>
  
        <div class="inner-page-banner-area1">
            <div class="container">
                <div class="pagination-area">
                    <h1>Articles</h1>
                           <ul>
                        <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>
						  <li>Article - </li>
						  <?php if($currentterms[0]->name) { ?>
						   <li><?php _e($currentterms[0]->name);?> - </li>
						  <?php } ?>
          <li><?php the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
       
        <div class="clr" style="clear:both"></div>
        <br><br>
        <!-- Courses Page 1 Area Start Here -->
        <div class="container">
    <div class="row">
     
	 <?php get_sidebar('articles');?>   
	 
			<div class="result"></div>
		  <div class="firstload" id="firstload">
		<div class="col-sm-9 col-md-9">
		
												<div class="courses1">
											    	<h2 class="course-h2"><?php the_title(); ?></h2>
													<strong><?php the_author();?>, <?php the_date();?> </strong>
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