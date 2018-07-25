<?php header('Content-Type: application/json');
//////// Code Start to Get All Upcoming Events ///////
$eventsarray= array();
wp_reset_query();
	 $args  = array(
									'showposts'       => -1,							
									'post_type'       => 'events',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=0;				
					 if ( have_posts() ) : while ( have_posts() ) : the_post();
					
			global $post;
			//////// Loop Code Starts here //////
			$id=$post->ID; 
			$name=get_the_title(); 
			$startdate=get_post_meta($post->ID,'event_settings_start-date',true);
			$enddate=get_post_meta($post->ID,'event_settings_end-date',true);
			$starttime=get_post_meta($post->ID,'event_settings_start-time',true).":00";
			$endtime=get_post_meta($post->ID,'event_settings_end-time',true).":00";
			$color='#FF6347'; 
if($enddate>=date('Y-m-d'))
{
  $eventsarray[] = array('id'=> $id, 'name'=> $name,'startdate'=> $startdate, 'enddate'=> $enddate,'starttime'=> $starttime, 'endtime'=> $endtime,'color'=> $color, 'url'=> "");
}  
					/////// Loop Code Ends here ///////
					
					
					
					
					 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
////// Code Start for Getting All Upcoming Scheduled Course /////////
$scheduledcoursearray= array();
wp_reset_query();
	 $args  = array(
									'showposts'       => -1,							
									'post_type'       => 'scheduled_course',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=0;				
					 if ( have_posts() ) : while ( have_posts() ) : the_post();
					
			global $post;
			//////// Loop Code Starts here //////
			$id=$post->ID; 
			$name=get_the_title(); 
			$startdate=get_post_meta($post->ID,'scheduled_course_settings_start-date',true);
			$enddate=get_post_meta($post->ID,'scheduled_course_settings_end-date',true);
			$starttime=get_post_meta($post->ID,'scheduled_course_settings_start-time',true).":00";
			$endtime=get_post_meta($post->ID,'scheduled_course_settings_end-time',true).":00";
			$color='#ffb128'; 
if($enddate>=date('Y-m-d'))
{
  $eventsarray[] = array('id'=> $id, 'name'=> $name,'startdate'=> $startdate, 'enddate'=> $enddate,'starttime'=> $starttime, 'endtime'=> $endtime,'color'=> $color, 'url'=> "");
}  
					/////// Loop Code Ends here ///////
					
					
					
					
					 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
		  
$eventjasondata = json_encode($eventsarray);		  
_e('{"monthly":'.$eventjasondata."}");	  
/////// End of Code to Get All Upcoming Events ///////
?>