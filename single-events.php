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
        
        
         <div class="inner-page-banner-area1">
            <div class="container">
                <div class="pagination-area">
                    <h1>Latest Events</h1>
                    <ul>
                        <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>				  
						
						<li><?php the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        
        
        
       
        <!-- Inner Page Banner Area End Here -->
        
        <!-- About Page 1 Area Start Here -->
        
        <!-- About Page 1 Area End Here -->
        <!-- Certificate Area Start Here -->
        <div class="certificate-area" style="background-color:#f3f3f3">
            
            
             <h2 class="title-default-left"><?php the_title(); ?></h2>
			 
			       <?php while ( have_posts() ) : the_post();

		?>          
             
              <div class="section1">
              <div class="container">
             <div class="col-md-12 no-padding profile">
             <div class="col-md-3 left-padding">
			<a href="<?php the_permalink();?>"> 
			 <?php if ( has_post_thumbnail()) {
		   $featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		  $image='<img src="'.$featuredimage[0].'" class="img-responsive img1"  alt="'.get_the_title().'" title="'.get_the_title().'"  '; 
		  
		  $image .='  />';	
		  
		  echo ' <div class="brand-area-box">'.$image.'</div>';
		 }		
		 ?> </a>
		                         
             <h4 class="my4"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
             <p style="color:#002147; margin-bottom:0px; text-align:center;"><?php _e(get_the_date('F j, Y')); ?></p>             
             </div>
             
             <div class="col-md-9">
			 <h4> <a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
             <p style="text-align:justify; margin-bottom:0px;">
			
                <?php the_content(); ?></p>
             </div>
             </div>
             </div>
             </div>
             
            <?php endwhile; // end of the loop. ?>				
       
           
        </div>
       
<?php get_footer(); ?>