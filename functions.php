<?php

add_action('init','sessionstart');
function sessionstart()
{
	if ( !session_id() )
	{
		session_start();
	}
}
global $wpdb;
define('INVOICE_TABLE',$wpdb->prefix."payments");
define('RECEIPT_TABLE',$wpdb->prefix."payment_receipt");
define('STUDENT_INFO_TABLE',$wpdb->prefix."course_student_info");
define('ATTENDANCE_TABLE',$wpdb->prefix."attendance");

define(GOOGLE_CAPTCHA_PUBLIC_KEY,'6Ld5oFoUAAAAACZcr7O1pe0CWTPTtIJ9V3YGubWp');
define(GOOGLE_CAPTCHA_PRIVATE_KEY,'6Ld5oFoUAAAAANyYCaovqN5_AfHhaR1qXo4_CTn8');
////// Code Start to Set User email and name for Sending mail /////

function wpb_sender_email( $original_email_address ) {
	$sendermail = get_option('admin_contact_email');
	if($sendermail=='')
	{
		$sendermail = get_option('admin_email');
	}
    return $sendermail;
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
	$sitename= get_option('blogname');
    return $sitename;
}
 add_filter('wp_mail_content_type','set_lps_content_type');
		function set_lps_content_type($content_type){
		return 'text/html';
		}
///// Function to get Email Template ///////

function get_email_template($template)
{
	ob_start();
	require(TEMPLATEPATH . '/email_templates/'.$template.'.tpl');
	return ob_get_clean();
	
}
 
// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );
///// End of Code to Set User Email and name for Sending mail /////


/////// Global  Message Variables /////////
	global $successmessage;
	$successmessage = '<div class="alert alert-success alert-dismissible">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>Congratulation! </strong> You have successfully subscribe to our newsletter.
	</div>';

	global $errormessage;
	$errormessage='<div class="alert alert-danger alert-dismissible">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong> </strong> Your email is already registered in our newsletter subscriber list.
	</div>';
	global $feedbacksuccessmsg;
	$feedbacksuccessmsg='<div class="alert alert-success alert-dismissible">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>Congratulation! </strong> Your feedback has been submitted successfully.
	</div>';
	global $registrationsuccessmessage;
	$registrationsuccessmessage='<div class="alert alert-success alert-dismissible">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>Congratulation! </strong> You have successfully registered at our webiste, please check your mail to confirm your email id and create your password.</div>';
//////// End of Global  Message Variables ////////

//////// Adding Custom User Roles Code /////////
 
$lps_member_role=add_role( 'lps_member', 'Member', array( 'read' => true, 'level_0' => true ) );
$lps_trainer_role=add_role( 'lps_trainer', 'Trainer', array( 'read' => true, 'level_0' => true ) );

/////// End of Adding Custom User Roles Code //////

register_nav_menus( array(
	'main_menu' => 'Main Menu',
	'footer_menu' => 'Footer Menu 1',
	'footer_menu_2' => 'Footer Menu 2'
) );
add_theme_support( 'title-tag' );

if ( ! function_exists( 'cm_render_title' ) ) {
	function cm_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	} 
	add_action( 'wp_head', 'cm_render_title' );
}
///// Themes Support Section Starts Here //////

add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
) );

add_theme_support( 'post-thumbnails' );
//add_theme_support( 'custom-background' );
//add_theme_support( 'custom-header' );
add_action( 'login_head', 'custom_login_logo' );
function custom_login_logo() {
?>
<style type="text/css">
.login h1 a {width:auto;}
.login h1 a { background-image: url('<?php bloginfo('template_directory'); ?>/images/logo-primary.png');
background-size: 300px 90px;
}
body { } 
</style>
<?php
}

add_action('login_footer','cm_login_footer');
function cm_login_footer()
{

}
function cm_list_child_pages() { 
global $post;  
if ( is_page() && $post->post_parent )
{ 
 $args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->post_parent,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );
}else 
{
 $args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );	
}		
$childpages = new WP_Query( $args );
 if ( $childpages->have_posts() ) :

 global $aboutusfirstpost;
 $i=0;
   while ( $childpages->have_posts() ) : $childpages->the_post(); 
   
   if($i==0)
   {
	   $aboutusfirstpost=$post->ID;	   
   }
   $i++;
   ?>
   
 <button class="tablinks" onclick="openCity(event, <?php the_ID(); ?>)" id="defaultOpen<?php the_ID(); ?>"><?php the_title(); ?></button>
				   
     <?php endwhile; ?>

<?php endif; wp_reset_postdata();  
}	

add_action("wp_footer","cm_google_analytics_display");
function cm_google_analytics_display()
{
	echo get_option('cm_google_analytics');
}

require_once (TEMPLATEPATH . '/includes/email-functions.php');
require_once (TEMPLATEPATH . '/includes/countrylist.php');
require_once (TEMPLATEPATH . '/includes/admin-functions.php');
require_once (TEMPLATEPATH . '/includes/custom_post_type.php');

require_once (TEMPLATEPATH . '/includes/meta_box_functions.php');
require_once (TEMPLATEPATH . '/includes/widget-functions.php');
require_once (TEMPLATEPATH . '/includes/admin-reports.php');

require_once (TEMPLATEPATH . '/includes/ajax-functions.php');
require_once (TEMPLATEPATH . '/includes/email-template-functions.php');

if(isset($_REQUEST['getevents']) && $_REQUEST['getevents']=='true' )
{
	require_once (TEMPLATEPATH . '/calender_events.php');
	exit;	
}
if(isset($_REQUEST['user_action']) && $_REQUEST['user_action']=='newsletter_subscription' )
{
	require_once (TEMPLATEPATH . '/newsletter_subscribes.php');
	exit;	
}

if(isset($_REQUEST['user_action']) && $_REQUEST['user_action']=='user_feedback' )
{
	require_once (TEMPLATEPATH . '/send_feedback.php');
	exit;
}

///////// Code Start to Register Member /////////
function cm_custom_regiser_fields( $user_id )
{        
	 $first_name = $_REQUEST['full_name'];
    /* do what you want to do with ID here */
	update_user_meta( $user_id,'first_name', $first_name, '' );
	
	
	$title = $_REQUEST['title'];
	update_user_meta( $user_id,'title', $title, '' );
	
	$organization = $_REQUEST['organization'];
	update_user_meta( $user_id,'organization', $organization, '' );
	
	$working_place = $_REQUEST['working_place'];
	update_user_meta( $user_id,'working_place', $working_place, '' );
	
	$destination = $_REQUEST['destination'];
	update_user_meta( $user_id,'destination', $destination, '' );
	
	$country_name = $_REQUEST['country_name'];
	update_user_meta( $user_id,'country_name', $country_name, '' );
	
	$user_type = $_REQUEST['user_type'];
	update_user_meta( $user_id,'user_type', $user_type, '' );
	
	
}
add_action( 'user_register', 'cm_custom_regiser_fields');

function cm_user_profile_fields( $profileuser ) {
?>
	<table class="form-table">
		<tr>
			<th>
				<label for="user_location"><?php esc_html_e( 'Title' ); ?></label>
			</th>
			<td>
  <select class="form-control" required name="title">
	<option value="" selected="">Title</option>
	<option value="Mr." <?php if(get_the_author_meta( 'title', $profileuser->ID )=='Mr.') {?> selected <?php } ?> >Mr.</option>
	<option value="Miss." <?php if(get_the_author_meta( 'title', $profileuser->ID )=='Miss.') {?> selected <?php } ?>>Miss.</option>
	<option value="Ms." <?php if(get_the_author_meta( 'title', $profileuser->ID )=='Ms.') {?> selected <?php } ?>>Ms.</option>
	<option value="Mrs." <?php if(get_the_author_meta( 'title', $profileuser->ID )=='Mrs.') {?> selected <?php } ?>>Mrs.</option>
	<option value="Mdm." <?php if(get_the_author_meta( 'title', $profileuser->ID )=='Mdm.') {?> selected <?php } ?>>Mdm.</option>
	<option value="Dr." <?php if(get_the_author_meta( 'title', $profileuser->ID )=='Dr.') {?> selected <?php } ?>>Dr.</option>
	<option value="Other" <?php if(get_the_author_meta( 'title', $profileuser->ID )=='Other') {?> selected <?php } ?>>Other</option>
                                 </select>
		
				<br><span class="description"><?php esc_html_e( 'Your Title.', 'lps' ); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="organization"><?php esc_html_e( 'Organization' ); ?></label>
			</th>
			<td>
			 <input type="text" class="form-control" name="organization" value="<?php _e(get_the_author_meta( 'organization', $profileuser->ID )); ?>" />
								
				<br><span class="description"><?php esc_html_e( 'User\'s Organization Name.', 'lps' ); ?></span>
			</td>
		</tr>	
		
		<tr>
			<th>
				<label for="working_place"><?php esc_html_e( 'Working Place' ); ?></label>
			</th>
			<td>
			 <input type="text" class="form-control" name="working_place" value="<?php _e(get_the_author_meta( 'working_place', $profileuser->ID )); ?>" />
								
				<br><span class="description"><?php esc_html_e( 'User\'s Working Place.', 'lps' ); ?></span>
			</td>
		</tr>	
		
		<tr>
			<th>
				<label for="destination"><?php esc_html_e( 'Destination' ); ?></label>
			</th>
			<td>
			 <input type="text" class="form-control" name="destination" value="<?php _e(get_the_author_meta( 'destination', $profileuser->ID )); ?>" />
								
				<br><span class="description"><?php esc_html_e( 'User\'s Destination.', 'lps' ); ?></span>
			</td>
		</tr>	
	<tr>
			<th>
				<label for="user_location"><?php esc_html_e( 'User Type' ); ?></label>
			</th>
			<td>
			 <select class="form-control" name="user_type" required >
									   
									   <option value="Individual" <?php if(get_the_author_meta( 'user_type', $profileuser->ID )=='Individual') {?> selected <?php } ?>>Individual</option>
									    <option value="Cooperate" <?php if(get_the_author_meta( 'user_type', $profileuser->ID )=='Cooperate') {?> selected <?php } ?> >Cooperate</option>
									  
									   </select>
		
				<br><span class="description"><?php esc_html_e( 'Your User Type.', 'lps' ); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_location"><?php esc_html_e( 'Country' ); ?></label>
			</th>
			<td>
			 <select class="form-control" name="country_name" required >
									   <option value="">Select Country</option>
									   <?php
global $countries;
foreach($countries as $key => $value) {

?>
<option value="<?= $key ?>" <?php if(get_the_author_meta( 'country_name', $profileuser->ID )==$key) {?> selected <?php } ?> title="<?= htmlspecialchars($value) ?>"><?php _e(htmlspecialchars($value)); ?></option>
<?php

}

?>
									   </select>
		
				<br><span class="description"><?php esc_html_e( 'Your location.', 'lps' ); ?></span>
			</td>
		</tr>
	</table>
<?php
}
add_action( 'show_user_profile', 'cm_user_profile_fields', 10, 1 );
add_action( 'edit_user_profile', 'cm_user_profile_fields', 10, 1 );

add_action('edit_user_profile_update', 'cm_update_extra_profile_fields');
 
 function cm_update_extra_profile_fields($user_id) {
     if ( current_user_can('edit_user',$user_id) )
	 {
			update_user_meta($user_id, 'title', $_POST['title']);

			update_user_meta($user_id, 'organization', $_POST['organization']);
			update_user_meta($user_id, 'working_place', $_POST['working_place']);
			update_user_meta($user_id, 'destination', $_POST['destination']);

			update_user_meta($user_id, 'country_name', $_POST['country_name']);
			update_user_meta($user_id, 'user_type', $_POST['user_type']);
	 }		
 }
 
if(isset($_REQUEST['action']) && $_REQUEST['action']=='member_registration')
{
	global $reg_errors;
	$reg_errors = new WP_Error;
	if (!isset( $_POST['member_register'] )  || ! wp_verify_nonce( $_POST['member_register'], 'member_registration'))
	{

		$siteurl = get_option('siteurl');
		wp_redirect($siteurl);
		exit;

	} else
	{
	
		  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
		  {	  
				 $post_data = http_build_query(
						array(
							'secret' => GOOGLE_CAPTCHA_PRIVATE_KEY,
							'response' => $_POST['g-recaptcha-response'],
							'remoteip' => $_SERVER['REMOTE_ADDR']
						)
					);
					$opts = array('http' =>
						array(
							'method'  => 'POST',
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $post_data
						)
					);
					$context  = stream_context_create($opts);
					$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
					$result = json_decode($response);
				
					if ($result->success) {
								
								///////// Code Start for Register a New User ////
								$user_login = $_POST['user_login'];
								$user_email = $_POST['user_email'];
								global $reg_errors;
								$reg_errors = register_new_user($user_login, $user_email);
							if ( !is_wp_error($reg_errors) ) {
								$redirect_to = $_REQUEST['referer']."?response=checkmailregistration";
								wp_safe_redirect( $redirect_to );
								exit();
							}else
							{							
								
							}
								//////// End of Code for Register a New User /////
					}else
					{
						$reg_errors->add('googleerror','Please ensure that you are human not robot.');
					}						
								
		  }else
		  {	
					
						$reg_errors->add('googleerror','Please ensure that you are human not robot.');
		  }				
						
	}		
   // process form data
	
}
////// End of Code to Register Member /////////////

////// Creating Short Code for User History Section //////////
function cm_user_history( $atts ){
	
	ob_start();
	global $wpdb;
	global $current_user;	
	$currentuserid=$current_user->ID;
	// $currentuserid= 52;
	$query="select * from ".INVOICE_TABLE." where uid='$currentuserid'";
	$results = $wpdb->get_results($query);
	
	 ?> 
	
<table id="user_history_table" class="display">
    <thead>
        <tr>
		<th><?php _e('Email ID');?></th>
		<th><?php _e('Mobile No');?></th>
		<th><?php _e('Total Fees');?></th>
		<th><?php _e('Course Category');?></th>
		<th><?php _e('Course Name');?></th>
		<th><?php _e('Payment Status');?></th>
        </tr>
    </thead>
    <tbody>
		<?php foreach($results as $record) { ?>
        <tr>
            <td><?php _e($record->payer_email);?></td>
            <td><?php _e($record->mobile);?></td>
			<td><?php _e($record->payment_gross);?></td>
            <td><?php _e($record->coursecategory);?></td>
			<td><?php _e($record->item_name);?></td>
            <td><?php _e($record->payment_status);?></td>
        </tr>
		<?php } ?>      
    </tbody>
</table>
<script>
$(document).ready( function () {
    $('#user_history_table').DataTable();
} );
</script>
	 <?php
    return ob_get_clean();
}
add_shortcode( 'user_history', 'cm_user_history' );
////// End of Code for Creating Short Code for User History Section ///////
///////// Code Start for Course Category Dropdown ///////
function cm_get_dropdown_course_category($selectedcategory=0)
{
	 $coursecategories = get_terms( 'course_category', array( 'orderby' => 'slug', 'hide_empty' => false ) );
			

	if ( ! empty( $coursecategories ) && ! is_wp_error( $coursecategories ) )
	{
		
		  foreach ( $coursecategories as $term ) {
			
			 echo "<option value='".$term->term_id."'>".$term->name."</option>";
		  }
		  
	}		  

}
////////////// Code Start to Get Scheduled Course Dropdown /////////////
function cm_get_dropdown_scheduled_course($selectedcourse=0)
{
	
	wp_reset_query();
	 $args  = array(
									'showposts'       => -1,									
									'post_type'       => 'scheduled_course',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=1;					
					  if ( have_posts() ) : while ( have_posts() ) : the_post();
					  global $post;
				global $wpdb;	
	$max_allowed_participants=get_post_meta($post->ID,'scheduled_course_settings_maximum-participants',true);
	$totalparticipants = $wpdb->get_var("select count(id) from ".STUDENT_INFO_TABLE." where course_id='".$post->ID."' ");
	$startdate=get_post_meta($post->ID,'scheduled_course_settings_start-date',true);
	
	$currenttime=time();											
	$coursestarttime=strtotime($startdate);
	
				if($currenttime<$coursestarttime && $max_allowed_participants>$totalparticipants)
				{
					
					 echo "<option value='".$post->ID."' ";
					 
					 if($selectedcourse==$post->ID)
					 {
						echo " selected "; 
						 
					 }
					 
					 echo ">".get_the_title()."</option>";
				}


				
					global $post;
					 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
	
}
function cm_get_dropdown_scheduled_course_admin($selectedcourse=0)
{
	
	wp_reset_query();
	 $args  = array(
									'showposts'       => -1,									
									'post_type'       => 'scheduled_course',   
									'post_status'     => 'publish' );
					query_posts( $args );
					$counter=1;					
					  if ( have_posts() ) : while ( have_posts() ) : the_post();
					  global $post;
				global $wpdb;	

					
					 echo "<option value='".$post->ID."' ";
					 
					 if($selectedcourse==$post->ID)
					 {
						echo " selected "; 
						 
					 }
					 
					 echo ">".get_the_title()."</option>";
			
				
					global $post;
					 $counter++;
		 	endwhile;
        else :
        endif;
		  wp_reset_query();
	
}
function paypal_payment_processing()
{
	if ( !session_id() )
	{
		session_start();
	}

	global $wpdb;
	
	if(isset($_POST['registration_type']) && $_POST['registration_type']=='group')
	{
			$ordertype ="cooperate";
			$total_participants = $_POST['total_participants'];
			$participant_infos =array();
			$participant_infos['participant_name'] = $_POST['participant_name'];
			$participant_infos['participant_email'] = $_POST['participant_email'];
			$participant_infos['participant_mobile'] = $_POST['participant_mobile'];
			$participant_info=serialize($participant_infos);
			$company_name = $_POST['company_name'];
			$company_address = $_POST['company_address'];
	}else 
	{
			$ordertype ="single";
			$total_participants =1;
			$participant_info ="";
	}
	$schedule_course=$_POST['schedule_course'];
	$txn_id='';
	$gid='';	
	$course_fees=$_POST['course_fees'];
	$total_payment=$_POST['total_payment'];
	$currency_code=get_option('cm_currency');
	$category_name=$_POST['category_name'];
	$course_name=$_POST['course_name'];
	$uid=$_POST['uid'];	
	$payer_email=$_POST['payer_email'];
	$mobileno=$_POST['mobile'];
	$full_name=$_POST['full_name'];
	$date = date("Y-m-d h:i:s");
	
	$payment_status='Under Process';
	
	$payment_method='online';
	$cheque_date=$_POST['payment_date'];
	$cheque_number=$_POST['cheque_number'];
	$remarks=$_POST['remarks'];
	$tableprefix=$wpdb->prefix;
	
	$query= "insert into ".INVOICE_TABLE." set
	uid='$uid',
	item_number='$schedule_course',
	txn_id='$txn_id',
	gid='$gid',
	ordertype='$ordertype',
	total_participants='$total_participants',
	participant_info='$participant_info',
	company_name='$company_name',
	company_address='$company_address',
	payment_gross='$total_payment', 
	course_fees='$course_fees',
	currency_code='$currency_code',
	coursecategory='$category_name',
	item_name='$course_name',
	payer_email='$payer_email',
	mobile='$mobileno',
	full_name='$full_name',
	date='$date',
	payment_status='$payment_status',
	payment_method='$payment_method',
	cheque_number='$cheque_number',
	cheque_date='$cheque_date',
	remarks='$remarks'
	  ";
	
	  
	$wpdb->query($query); 
	$invoiceid=$wpdb->insert_id;
	
	$_SESSION=$_POST;
$paypalurl="https://www.sandbox.paypal.com/cgi-bin/webscr";	
$businessemail="dwalldev01@gmail.com";
$cancel_return = get_page_link(get_option('cm_paypal_cancel_page'));	
$returnurl =  get_page_link(get_option('cm_paypal_success_page'));

$payer_email = $_POST['payer_email'];
$coursename = $_POST['course_name'];
$schedule_course = $_POST['schedule_course'];
$total_payment = $_POST['total_payment'];
$full_name = $_POST['full_name'];
$mobile = $_POST['mobile'];

	?>
	  <form action="<?php _e($paypalurl); ?>" id="paypal_payment" method="post">
       
        <input type="hidden" name="business" value="<?php _e($businessemail); ?>">
		<input type="hidden" name="cmd" value="_xclick">  
        <input type="hidden" name="item_name" value="<?php _e($coursename); ?>">
        <input type="hidden" name="item_number" value="<?php _e($invoiceid); ?>">
        <input type="hidden" name="amount" value="<?php _e($total_payment); ?>">
        <input type="hidden" name="email" value="<?php _e($payer_email); ?>">
        <input type="hidden" name="mobile" value="<?php _e($mobile); ?>">
        <input type="hidden" name="first_name" value="<?php _e($full_name); ?>">
        <input type="hidden" name="currency_code" value="USD">        
      
        <input type='hidden' name='cancel_return' value='<?php _e($cancel_return);?>'>
        <input type='hidden' name='return' value='<?php _e($returnurl);?>'>
        
      
    </form>
	<h1 align="center"> Payment is processing... Please don't refresh or press back button. </h1>
<script type="text/javascript">
paypal_form_submit();
function paypal_form_submit()
{
	document.getElementById("paypal_payment").submit();
	
}
</script>	
	<?php
	exit;
}

if(isset($_REQUEST['formaction']) && $_REQUEST['formaction']=='paypal_individual_payment' )
{
	paypal_payment_processing();
	exit;
	
}

////////// Code Start  to Save Payment Information ///////////
function save_user_payment_information()
{
	global $wpdb;
	$invoiceid = $_REQUEST['item_number'];
	$payment_status = $_REQUEST['st'];
	$txn_id = $_REQUEST['tx'];
	
	///////// Update Invoice Payment Status ////
	$invoiceupdatequery = $wpdb->query("update ".INVOICE_TABLE." set 
	txn_id='$txn_id',
	payment_status='$payment_status' 
	where payment_id='$invoiceid' ");
	
	$invoiceinfo = $wpdb->get_results("select * from ".INVOICE_TABLE." where payment_id='$invoiceid' ");
	
	////// Code Start for Adding Information of Receipt in Receipt Table /////////
	$schedule_course_id = $invoiceinfo[0]->item_number;
	$invoiceid=$invoiceinfo[0]->payment_id;
	$uid=$invoiceinfo[0]->uid;
	$total_amount=$invoiceinfo[0]->payment_gross;
	$payment_method='online';
	$txn_id=$invoiceinfo[0]->txn_id;
	$payment_info=serialize($_REQUEST);
	$cheque_number='';
	$cheque_date='';
	$remarks='';
	$payment_status=$payment_status;
	$dateadded=time();
	
	$receiptquery="insert into ".RECEIPT_TABLE." set
	uid='$uid',
	invoice_id='$invoiceid',
	total_amount='$total_amount',
	payment_method='$payment_method',
	txn_id='$txn_id',
	payment_info='$payment_info',
	cheque_number='$cheque_number',
	cheque_date='$cheque_date',
	remarks='$remarks',
	payment_status='$payment_status',
	dateadded='$dateadded'
	";
	$wpdb->query($receiptquery);
	
	////// End of Code for Adding Information of Receipt in Receipt Table ////////

	/////// Code Start for Adding Students Information in Course Students Information Table ///////
	if($invoiceinfo[0]->ordertype=='cooperate')
	{
		$participantinfos = unserialize($invoiceinfo[0]->participant_info);
		
		$course_id=$invoiceinfo[0]->item_number;
		$invoiceid=$invoiceinfo[0]->payment_id;
		$uid=$invoiceinfo[0]->uid;
		
		for($counter=0;$counter<count($participantinfos['participant_name']);$counter++)
		{
			$full_name=$participantinfos['participant_name'][$counter];
			$user_email=$participantinfos['participant_email'][$counter];
			$mobile=$participantinfos['participant_mobile'][$counter];
			
			$studentquery="insert into ".STUDENT_INFO_TABLE." set
			course_id='$course_id',
			invoice_id='$invoiceid',
			uid='$uid',
			full_name='$full_name',
			user_email='$user_email',
			mobile='$mobile'
			
			";
			$wpdb->query($studentquery);
			
		}
	}else
	{	
		
		$course_id=$invoiceinfo[0]->item_number;
		$invoiceid=$invoiceinfo[0]->payment_id;
		$uid=$invoiceinfo[0]->uid;
		$full_name=$invoiceinfo[0]->full_name;
		$user_email=$invoiceinfo[0]->payer_email;
		$mobile=$invoiceinfo[0]->mobile;
		
		$studentquery="insert into ".STUDENT_INFO_TABLE." set
		course_id='$course_id',
		invoice_id='$invoiceid',
		uid='$uid',
		full_name='$full_name',
		user_email='$user_email',
		mobile='$mobile'
		
		";
		$wpdb->query($studentquery);
	
	
	}
	

	/////// Endo of Code for Adding Students Information in Course Students Information Table ///////
	
	////// Code Start for Sending Email to Users About Their Enrolment and Payment Status ////////

$data=array();

 $userinfo = get_user_by('id', $uid);
 $to = $userinfo->user_email;
 if($to=='')
 {
	 $to = get_option('admin_email');
 }
	$startdate=get_post_meta($schedule_course_id,'scheduled_course_settings_start-date',true);
	$starttime=get_post_meta($schedule_course_id,'scheduled_course_settings_start-time',true);
	$address=get_post_meta($schedule_course_id,'scheduled_course_settings_address',true);
	$course_id = get_post_meta($schedule_course_id,'_cm_course_id',true);
	$courseinfo=get_post( $course_id);
	$course_name = $courseinfo->post_title;
	
	$data['course_title']=$course_name;
	$data['username']=$userinfo->user_nicename;
	$data['location']=$address;
	$data['start_course_date']=date("d<\s\up>S</\s\up> M Y",strtotime($startdate));
	$data['start_course_time']=$starttime;
	$data['payment_status'] = $payment_status;
	send_enrolment_confirmation_mail($to,$data);

}
//if(isset($_SESSION['action']) && $_SESSION['action']=='course_individual_enrolment' )
{
	
	if(isset($_REQUEST['tx']) && $_REQUEST['tx']!='' )
	{
		save_user_payment_information();
		
		
		$referer = get_page_link(get_option('cm_paypal_success_page'));		
		wp_redirect($referer);
		exit;
	}	
}

////////// End of Code to Save Payment Information ///////////

//-----------Footer logo-------------//
function themeName_customize_logo( $wp_customize ) {

    // Add Settings
    $wp_customize->add_setting('customizer_footer_logo_one', array(
        'transport'         => 'refresh',
        'height'         => 325,
    ));
   
    // Add Section
    $wp_customize->add_section('slideshow', array(
        'title'             => __('Footer logo', 'lps'), 
        'priority'          => 70,
    ));    

    // Add Controls
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'customizer_footer_logo_one_control', array(
        'label'             => __('Footer logo #1', 'lps'),
        'section'           => 'slideshow',
        'settings'          => 'customizer_footer_logo_one',    
    )));
   
}
add_action('customize_register', 'themeName_customize_logo');


//wp_handle_upload


?>