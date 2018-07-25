<?php get_header(); ?>
    <!-- Header Area End Here -->
       
	   
        <!-- Slider 1 Area Start Here -->
	<?php get_sidebar('banner'); ?>
	
	
	
	<!-- Video 2 Area Start Here -->
<?php get_sidebar('home_video');?>
   <!-- Video 2 Area End Here -->  
    

        <!-- About 2 Area Start Here -->
	<?php get_sidebar('services'); ?>
	
	   <!-- About 2 Area End Here -->
		
        <!-- Featured Area Start Here -->
		
		<?php get_sidebar('featured-courses'); ?>

<script src='https://unpkg.com/slick-carousel@1.7.1'></script>
<script  src="<?php bloginfo('template_url');?>/js/index1.js"></script>

    
        <!-- Featured Area End Here -->
		
 <?php get_sidebar('home-trainers');?>
     
        <!-- News and Event Area Start Here -->
		<?php get_sidebar('news-events'); ?>
     
      <?php get_sidebar('home-brand');?> 
      
      </div>  <!-- Brand Area End Here -->
       
                 
                
        <!-- Footer Area Start Here -->
      <?php get_footer(); ?>