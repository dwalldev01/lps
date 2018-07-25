<?php
if ( function_exists('register_sidebar') ) {
register_sidebars(1,array('name' => 'Home Page Featured Course Sidebar','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));


	}
	function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;
 
	return (isset($sidebars[$key]));
}

class home_featured_course_widget extends WP_Widget {

	function home_featured_course_widget() {

	//Constructor

		$widget_ops = array('classname' => 'home_featured_course_widget', 'description' => 'Home Featured Course Widget' );		

		$this->WP_Widget('home_featured_course_widget', 'CM -> Home Featured Course Widget', $widget_ops);

	}

	function widget($args, $instance) {

	// prints the widget

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);

	
  		$featuredcategories = empty($instance['featuredcategories']) ? '&nbsp;' : apply_filters('widget_featuredcategories', $instance['featuredcategories']);

  $catarray=array();

$catarray = explode(",",$featuredcategories);
		$title=str_replace("&nbsp;",'',$title);

		 ?>
	        <div class="courses1-area section" >
            <div class="container">
                <h2 class="title-default-left"><?php _e($title);?></h2>
            </div>
            	<div class="slider container" id="slider">
    
	<?php  $coursecategories = get_terms( 'course_category', array( 'orderby' => 'slug', 'hide_empty' => false ) );
							
				  if(count($coursecategories)>0)
				    {
							foreach ( $coursecategories as $coursesubcategory )
							{	
								if(in_array($coursesubcategory->term_id,$catarray))	
								{
							?>
                       <div class="courses-box1">
                        <div class="single-item-wrapper">
                            <div class="courses-img-wrapper hvr-bounce-to-bottom">
                                
                                   <?php if (function_exists('z_taxonomy_image_url'))
														{
															
															if(get_option('z_taxonomy_image'.$coursesubcategory->term_id)!=='')
															{
															?>
															<img class="img-responsive" src="<?php _e( get_option('z_taxonomy_image'.$coursesubcategory->term_id));?>" alt="<?php _e($coursesubcategory->name);?>">

														<?php } 
														}?>
                                
                               
                                
                                     <a href="<?php _e(get_term_link( $coursesubcategory ));?>" > <i class="fa fa-link" aria-hidden="true"></i></a>
                                                
                                
                             
                            </div>
                            <div class="courses-content-wrapper">
                                
                                      <a href="<?php _e(get_term_link( $coursesubcategory ));?>"><?php _e($coursesubcategory->name);?></a>
                                                
                                
                                <p class="item-content"></p>
                                <ul class="courses-info">
                                    <li>Number of Courses - <?php
														$term = get_term( $coursesubcategory->term_id, 'course_category' );//for example uncategorized category
echo $term->count;?>                                                          </li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
				
						 <?php  }  
						    }
					}?>	
					
                </div>
        </div>
  
 
		  
 	<?php

	}

	function update($new_instance, $old_instance) {

	//save the widget

		$instance = $old_instance;		

		$instance['title'] = strip_tags($new_instance['title']);

		$instance['featuredcategories'] = ($new_instance['featuredcategories']);
		
		

		return $instance;

	}

	function form($instance) {

	//widgetform in backend

		$instance = wp_parse_args( (array) $instance, array( 'title' => '',  'featuredcategories' => '') );		

		$title = strip_tags($instance['title']);
		$featuredcategories = ($instance['featuredcategories']); 		

?>

		<p ><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title ');?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
	<p><label for="<?php echo $this->get_field_id('featuredcategories'); ?>"><?php _e('Featured Course Categories ID');?>: <textarea class="widefat" id="<?php echo $this->get_field_id('featuredcategories'); ?>" name="<?php echo $this->get_field_name('featuredcategories'); ?>" type="text" value="" ><?php echo attribute_escape($featuredcategories); ?></textarea> Enter Comma "," Separated ID of Course Categories</label></p>



       

<?php


	}}

register_widget('home_featured_course_widget');

?>