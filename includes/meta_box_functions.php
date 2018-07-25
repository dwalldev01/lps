<?php
 //////// Code Start for Creating Events Meta box ////////
class Events_Meta_Box {
	private $screens = array(
		'events',
	);
	private $fields = array(
		array(
			'id' => 'start-date',
			'label' => 'Start Date',
			'type' => 'date',
		),
		array(
			'id' => 'end-date',
			'label' => 'End Date',
			'type' => 'date',
		),
		array(
			'id' => 'start-time',
			'label' => 'Start Time',
			'type' => 'time',
		),
		array(
			'id' => 'end-time',
			'label' => 'End TIme',
			'type' => 'time',
		),
		array(
			'id' => 'event-location',
			'label' => 'Event Location',
			'type' => 'text',
		),
		array(
			'id' => 'time',
			'label' => 'Time',
			'type' => 'text',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'event-settings',
				__( 'Event Settings', 'lps_wp' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'advanced',
				'default'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'event_settings_data', 'event_settings_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'event_settings_' . $field['id'], true );
			switch ( $field['type'] ) {
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['event_settings_nonce'] ) )
			return $post_id;

		$nonce = $_POST['event_settings_nonce'];
		if ( !wp_verify_nonce( $nonce, 'event_settings_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'event_settings_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'event_settings_' . $field['id'], '0' );
			}
		}
	}
}
new Events_Meta_Box;
////// End of Code for Creating Events Meta box ////////

/////// Code Start for Creating Scheduled Course  Meta box /////////

class Scheduled_Course_Meta_Box {
	private $screens = array(
		'scheduled_course',
	);
	private $fields = array(
		array(
			'id' => 'start-date',
			'label' => 'Start Date',
			'type' => 'date',
		),
		array(
			'id' => 'end-date',
			'label' => 'End Date',
			'type' => 'date',
		),
		array(
			'id' => 'start-time',
			'label' => 'Start Time',
			'type' => 'time',
		),
		array(
			'id' => 'end-time',
			'label' => 'End Time',
			'type' => 'time',
		),
		array(
			'id' => 'address',
			'label' => 'Address',
			'type' => 'textarea',
		),
			array(
			'id' => 'full-payment',
			'label' => 'Full Payment',
			'type' => 'number',
		),
		array(
			'id' => '3-person-discount',
			'label' => '3 Person Discount (%)',
			'type' => 'number',
		),
		array(
			'id' => '9-person-discount',
			'label' => '9 Person Discount (%)',
			'type' => 'number',
		),
		array(
			'id' => 'maximum-participants',
			'label' => 'Maximum Allowed Participants',
			'type' => 'number',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'scheduled-course-settings',
				__( 'Scheduled Course Settings', 'Scheduled Course' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'advanced',
				'default'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'scheduled_course_settings_data', 'scheduled_course_settings_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'scheduled_course_settings_' . $field['id'], true );
			switch ( $field['type'] ) {
				case 'textarea':
					$input = sprintf(
						'<textarea class="large-text" id="%s" name="%s" rows="5">%s</textarea>',
						$field['id'],
						$field['id'],
						$db_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['scheduled_course_settings_nonce'] ) )
			return $post_id;

		$nonce = $_POST['scheduled_course_settings_nonce'];
		if ( !wp_verify_nonce( $nonce, 'scheduled_course_settings_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'scheduled_course_settings_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'scheduled_course_settings_' . $field['id'], '0' );
			} 
		}
	}
}
new Scheduled_Course_Meta_Box;

/////// End of Code for Creating Course Meta Box in Schedule Course Section ///////////

/////// Code Start for Creating Gallery Meta Box Section ////////
/**
 * Generated by the WordPress Meta Box Generator at http://goo.gl/8nwllb
 */
class Gallery_Meta_Box {
	private $screens = array(
		'gallery',
	);
	private $fields = array(
		array(
			'id' => 'video-embedded-code',
			'label' => 'Video Embedded Code',
			'type' => 'textarea',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'video-settings',
				__( 'Video Settings', 'lpw_wp' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'advanced',
				'default'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'video_settings_data', 'video_settings_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'video_settings_' . $field['id'], true );
			switch ( $field['type'] ) {
				case 'textarea':
					$input = sprintf(
						'<textarea class="large-text" id="%s" name="%s" rows="5">%s</textarea>',
						$field['id'],
						$field['id'],
						$db_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['video_settings_nonce'] ) )
			return $post_id;

		$nonce = $_POST['video_settings_nonce'];
		if ( !wp_verify_nonce( $nonce, 'video_settings_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'video_settings_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'video_settings_' . $field['id'], '0' );
			}
		}
	}
}
new Gallery_Meta_Box;
/////// End of Code for Creating Gallery Meta Box Section ///////

 ////// Code Start to Create Schedule Course Meta Box ///////////
 /////////// Code Start to Create  Tours Meta Box //////////
function cm_add_meta_box_schedule_course() {

	$screens = array( 'scheduled_course' );


$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  // check for a template type
 
  
	foreach ( $screens as $screen ) {

	
    add_meta_box(
			'myplugin_sectionid',
			__( 'Course Settings', 'myplugin_textdomain' ),
			'cm_meta_box_schedule_course_callback',
			$screen
		);
 
		
	}
}
	add_action( 'add_meta_boxes', 'cm_add_meta_box_schedule_course' );
	add_action( 'save_post', 'cm_save_meta_box_schedule_course' );

function cm_meta_box_schedule_course_callback( $post )
{
	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	
  $cm_course_category = get_post_meta( $post->ID, '_cm_course_category', true );	
  $cm_course_id = get_post_meta( $post->ID, '_cm_course_id', true );
		
?>
<style type="text/css">
.home_admin_box {padding-bottom:15px;}
.home_admin_box label{ width:200px;}
.home_admin_text { width:100%;}
.other_course {display:none;}
</style>
<?php
/*echo '</div>'; */
  echo '<table class="form-table"><tbody>';
  echo '<tr><th scope="row"><label for="course-name">Course Category</label></th><td> ';


 $args = array(
	'selected'           => $cm_course_category,
	'hierarchical'       => 1,
	'name'               => 'cm_course_category',
	'id'                 => 'cm_course_category',
	'class'              => 'form-control',
	'taxonomy'           => 'course_category',
	'hide_if_empty'      => false,
	'value_field'	     => 'term_id',
);
wp_dropdown_categories( $args );
echo '</td><tr>';
  echo '<tr><th scope="row"><label for="course-name">Course Name</label></th><td>';
  
  echo $course_cat_id = $_REQUEST['course_cat_id'];
$courseterms = get_terms( array(
    'taxonomy' => 'course_category',
    'hide_empty' => false,
) );

  foreach ( $courseterms as $term ) {
	  
$allcourse = query_posts(array(
  'post_type' => 'course',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'course_category',
      'field' => 'id',
      'terms' => $term->term_id, // Where term_id of Term 1 is "1".
      'include_children' => false
    )
  )
));
echo '<select type="text" class="form-control other_course"  id="cm_course_id_'.$term->term_id.'" name="cm_course_id_'.$term->term_id.'"  >';
		echo '<option value=""> ---- Select Course Name ---- </option>';
	foreach ( $allcourse as $post )
	{
		 setup_postdata( $post );
			
		
		echo "<option value='".$post->ID."' ";
		if($cm_course_id==$post->ID)
		{
			echo "selected ";
		}
		echo " >".$post->post_title."</option>";
		

	}	
	echo '</select>';
  } 
  


echo '</td><tr></table>';
?>
<script type="text/javascript">
jQuery( document ).ready(function() {
	 var cm_course_category =document.getElementById('cm_course_category').value; 
	
	jQuery("#cm_course_id_"+cm_course_category).css("display", "block");

 jQuery("#cm_course_category").change(function(){
  
  var course_cat_id = this.value;
 
  jQuery(".other_course").css("display", "none");
  jQuery("#cm_course_id_"+course_cat_id).css("display", "block");
 
});
/*
var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

jQuery('#start-date').val(today);
jQuery('#end-date').val(today);

 jQuery("#start-date").change(function(){  
 
 if(jQuery("#end-date").val()!=null)
 {
   if(jQuery("#end-date").val() < this.value )
   {	 
	  jQuery('#start-date').val(jQuery("#end-date").val());
	  alert("Course Start Date Should be Less than Course End Date.");
	  return false;
   }
 } 
   
});
*/
 jQuery("#start-date").change(function(){  
 
  jQuery('#end-date').val(jQuery("#start-date").val());
   jQuery('#end-date').focus();
});

 jQuery("#end-date").change(function(){  
 
   if(this.value < jQuery("#start-date").val() && jQuery("#start-date").val()!=null )
   {	 
	  jQuery('#end-date').val(jQuery("#start-date").val());
	  alert("Course End Date Should be Greater than Course Start  Date.");
	  return false;
   }
   
});

});
</script>
<?php
// $cm_course_id  */
}

function cm_save_meta_box_schedule_course( $post_id)
{
	
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

				// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'product' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	
			
			// Sanitize user input. 
	$cm_course_category = sanitize_text_field( $_POST['cm_course_category'] );
	
	$cm_course_id = sanitize_text_field( $_POST['cm_course_id_'.$cm_course_category] );
	
	
	// Update the meta field in the database.
	
	update_post_meta( $post_id, '_cm_course_category', $cm_course_category );		
	update_post_meta( $post_id, '_cm_course_id', $cm_course_id );
		
			
}
 ////// End of Code to Create Schedule Course Meta Box /////////
 
 //////// Code Start to Add Column in Scheduled Course Type /////
 add_filter( 'manage_scheduled_course_posts_columns', 'set_custom_scheduled_course_columns' );
function set_custom_scheduled_course_columns($columns) {
	
   // unset( $columns['author'] );
    $columns['participants_details'] = __( 'Participants Details', 'lps_wp' );
	  $columns['payment_details'] = __( 'Payment Details', 'lps_wp' );
	$columns['add_participants'] = __( 'Enrol New <br> Participants', 'lps_wp' );
	$columns['mark_attendance'] = __( 'Attendance', 'lps_wp' );
 
    return $columns;
}

// Add the data to the custom columns for the Scheduled Course post type:
add_action( 'manage_scheduled_course_posts_custom_column' , 'custom_scheduled_course_column', 10, 2 );

function custom_scheduled_course_column( $column, $post_id ) {
    switch ( $column ) {
        case 'participants_details' :           
              global $wpdb;
			  $tableprefix= $tableprefix=$wpdb->prefix;
			
			  $total = $wpdb->get_var("select count(id) from ".STUDENT_INFO_TABLE." where course_id='$post_id' ");
			
		
			 $xlsurl = admin_url()."admin.php?page=lps-reports&action=view_participants_xls&schedulecourse=".$post_id;
			 $pdfurl = admin_url()."admin.php?page=lps-reports&action=view_participants_pdf&schedulecourse=".$post_id;
			  _e("<a href='$xlsurl'>View Excel (".$total.")</a><br>");
			   _e("<a href='$pdfurl'>View PDF (".$total.") </a><br>");
            break;
			 case 'payment_details' :           
              global $wpdb;
			  $tableprefix= $tableprefix=$wpdb->prefix;
			
			  $total = $wpdb->get_var("select count(id) from ".STUDENT_INFO_TABLE." where course_id='$post_id' ");
			
		
			 $xlsurl = admin_url()."admin.php?page=lps-reports&action=view_payment_xls&schedulecourse=".$post_id;
			 $pdfurl = admin_url()."admin.php?page=lps-reports&action=view_payment_pdf&schedulecourse=".$post_id;
			  _e("<a href='$xlsurl'>View Excel (".$total.")</a><br>");
			   _e("<a href='$pdfurl'>View PDF (".$total.") </a><br>");
            break;
case 'add_participants' :           
             
			 $url = admin_url()."users.php?page=add_participants&courseid=".$post_id;
			  _e("<a href='$url'>Enrol New </a>");
            break;
    case 'mark_attendance' :           
             
			 $url = admin_url()."admin.php?page=manage_attendance&courseid=".$post_id;
			  _e("<a href='$url'>Mark Attendance</a>");
            break;   

    }
}
add_filter( 'manage_edit-scheduled_course_sortable_columns', 'custom_scheduled_course_sortable_column' );
function custom_scheduled_course_sortable_column( $columns ) {
    $columns['total_students'] = __( 'Total Participants', 'lps_wp' );
 
    //To make a column 'un-sortable' remove it from the array
    //unset($columns['date']);
 
    return $columns;
}
 ///////// End of Code to Add Column in Scheduled Course Type ////
 
 //////// Code Start for Creating Course Meta Box ///////////
 
 function cm_add_meta_box_course() {

	$screens = array( 'course' );


$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  // check for a template type
 
  
	foreach ( $screens as $screen ) {

	
    add_meta_box(
			'myplugin_sectionid',
			__( 'Course Information', 'lps_wp' ),
			'cm_meta_box_course_callback',
			$screen
		);
 
		
	}
}
	add_action( 'add_meta_boxes', 'cm_add_meta_box_course' );
	add_action( 'save_post', 'cm_save_meta_box_course' );

function cm_meta_box_course_callback( $post )
{
	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	
    $cm_work_objective = get_post_meta( $post->ID, '_cm_work_objective', true );
	
	$cm_total_module = get_post_meta( $post->ID, '_cm_total_module', true );
	
	$cm_module_title = array();
	$cm_module_desc = array();
	
	for($i=1;$i<=$cm_total_module;$i++)
	{
		$cm_module_title[$i] = get_post_meta( $post->ID, '_cm_module_title_'.$i, true );	
		$cm_module_desc[$i] = get_post_meta( $post->ID, '_cm_module_desc_'.$i, true );			
	}
		
?>
<style type="text/css">
.home_admin_box {padding-bottom:15px;}
.home_admin_box label{ width:200px;}
.home_admin_text { width:100%;}
.module_container {display:none;}
</style>
<?php
/*echo '</div>'; */


echo '<div class="home_admin_box"><label for="cm_work_objective" >';
_e( 'Workshop Objectives : ', 'lps_wp' );
echo '&nbsp;&nbsp;</label> ';
   wp_editor( htmlspecialchars_decode($cm_work_objective), 'cm_work_objective', $settings = array('textarea_name'=>'cm_work_objective') );
   echo '</div>';
	echo '<div class="home_admin_box"><label for="cm_total_module" >';
	_e( 'Total No of Module : ', 'lps_wp' );
	echo '&nbsp;&nbsp;</label> ';
	//echo '<input type="text" class="home_admin_text" id="cm_total_module" name="cm_total_module" value="' . esc_attr( $cm_total_module ) . '" />';
	
	echo '<select  id="cm_total_module" name="cm_total_module" onChange="show_module(this.value);">';
	echo '<option value="">Select No of Module</option>';
	$maxmodule=get_option('cm_max_module');
	if($maxmodule=='')
	{
		$maxmodule=15;
		
	}
	 for($i=1;$i<=$maxmodule;$i++)
	{
		echo '<option value"'.$i.'" ';
		if($cm_total_module==$i)
		{
			echo ' selected ';			
		}
		echo '>'.$i.'</option>';
	}
	echo '</select>';
	echo '</div>';
	
	
	 for($i=1;$i<=$maxmodule;$i++)
	 {
		//$cm_module_title= 'Title No : '.$i;
	echo '<div class="module_container" id="module_container_'.$i.'">';	   
  echo '<div class="home_admin_box"><label for="module_title" >';
	_e( 'Module Title '.$i.' : ', 'lps_wp' );
	echo '&nbsp;&nbsp;</label> ';
	echo '<input type="text" class="home_admin_text" id="cm_module_title_'.$i.'" name="cm_module_title_'.$i.'" value="' . esc_attr( $cm_module_title[$i] ) . '" />';
	  echo '</div>';
	  
	echo '<div class="home_admin_box"><label for="course_module_section" >';
_e( 'Course Module '.$i.' Desc  : ', 'lps_wp' );
echo '&nbsp;&nbsp;</label><br> ';
  // wp_editor( htmlspecialchars_decode($cm_work_objective), 'course_module_section_'.$i, $settings = array('textarea_name'=>'course_module_section_'.$i) ); 
  echo '<textarea cols="100" class="home_admin_text" id="cm_module_desc_'.$i.'" name="cm_module_desc_'.$i.'" rows="5">'.$cm_module_desc[$i].'</textarea>';
   echo '</div>';
    echo '</div>';
	 }
   ?>
   <script>
   show_module(<?php _e($cm_total_module);?>);
   function show_module(noofmodule)
   {
	     var maxmodule= "<?php _e($maxmodule);?>";
	   for (var i = 1; i <= maxmodule ; i++)
	   {
		 document.getElementById('module_container_'+i).style.display="none";		   
	   }
	   
	   for (var j = 1; j <= noofmodule ; j++)
	   {
		 document.getElementById('module_container_'+j).style.display="block";		   
	   }
	  
	   
   }
   </script>
   <?php
   
}

function cm_save_meta_box_course( $post_id)
{
	
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

				// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'product' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	
			
			// Sanitize user input. 

	$cm_total_module = sanitize_text_field( $_POST['cm_total_module'] );	
	$cm_work_objective=htmlspecialchars($_POST['cm_work_objective']);	
		
	// Update the meta field in the database.
		update_post_meta( $post_id, '_cm_total_module', $cm_total_module );
		
		update_post_meta( $post_id, '_cm_work_objective', $cm_work_objective );
		//print_r($_POST);
		for($i=1;$i<=$cm_total_module;$i++)
	{		
		 update_post_meta( $post_id, '_cm_module_title_'.$i, sanitize_text_field( $_POST['cm_module_title_'.$i]) );	
		 update_post_meta( $post_id, '_cm_module_desc_'.$i, sanitize_text_field( $_POST['cm_module_desc_'.$i] ));			
	}
			
}
 //////// End of Code for Creating Course Meta Box //////////
 
 
?>