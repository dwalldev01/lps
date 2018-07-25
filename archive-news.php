<?php get_header(); ?>
       <!-- Header Area End Here -->
        
        
         <div class="inner-page-banner-area1">
            <div class="container">
                <div class="pagination-area">
                    <h1><?php post_type_archive_title(); ?></h1>
                    <ul>
                        <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>					  
						<li><?php post_type_archive_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        
        
        
       
        <!-- Inner Page Banner Area End Here -->
        
        <!-- About Page 1 Area Start Here -->
        
        <!-- About Page 1 Area End Here -->
        <!-- Certificate Area Start Here -->
        <div class="certificate-area" style="background-color:#f3f3f3">
            
            
             <h2 class="title-default-left"><?php _e("Latest News"); ?></h2>			 
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
                <?php the_excerpt(); ?></p>
             </div>
             </div>
             </div>
             </div>
             
            <?php endwhile; // end of the loop. ?>				
         <div class="container">    <div class="navigation"><p><?php posts_nav_link(); ?></p></div></div>
       
        </div>
       
<?php get_footer(); ?>