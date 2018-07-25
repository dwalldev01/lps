<?php
if(isset($_REQUEST['action']) && $_REQUEST['action']=='saveparticipants' )
{
add_action('init','cm_save_participants');
}
if(isset($_REQUEST['action']) && $_REQUEST['action']=='scheduled_course_report' )
{
	if( $_REQUEST['report_format']=='excel')
	{
			require_once (TEMPLATEPATH . '/includes/scheduled-course-report-xls.php');
			exit;
		
	}elseif( $_REQUEST['report_format']=='pdf')
	{
		require_once (TEMPLATEPATH . '/includes/scheduled-course-report-pdf.php');
			exit;
		
	}
}	

 require_once (TEMPLATEPATH . '/includes/users-invoice-receipt.php');
	
function cm_save_participants()
{
	global $wpdb;
	//echo "<pre>";
	$schedule_course=$_POST['schedule_course'];
	$txn_id='';
	$gid='';	
	$course_fees=$_POST['course_fees'];
	$total_fees=$_POST['total_fees'];
	$deposit_fees=$_POST['deposit_fees'];
	$currency_code=get_option('cm_currency');
	$category_name=$_POST['category_name'];
	$course_name=$_POST['course_name'];
	$uid=$_POST['participant_name'];
	$user_login=$_POST['user_login'];
	$payer_email=$_POST['payer_email'];
	$mobileno=$_POST['mobile'];
	$full_name=$_POST['display_name'];
	$date = date("Y-m-d h:i:s");
	
	$payment_status=$_POST['payment_status'];
	
	$payment_method=$_POST['payment_method'];
	$cheque_date=$_POST['payment_date'];
	$cheque_number=$_POST['cheque_number'];
	$remarks=$_POST['remarks']; 
	
	$tableprefix=$wpdb->prefix;
	
	$query= "insert into ".INVOICE_TABLE." set
	uid='$uid',
	item_number='$schedule_course',
	txn_id='$txn_id',
	gid='$gid',
	payment_gross='$total_fees',
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
	//exit;

	$invoiceid=$wpdb->insert_id;
	
	$invoiceinfo = $wpdb->get_results("select * from ".INVOICE_TABLE." where payment_id='$invoiceid' ");
	
	
	////// Code Start for Adding Information of Receipt in Receipt Table /////////
	$invoiceid=$invoiceinfo[0]->payment_id;
	$uid=$invoiceinfo[0]->uid;
	$total_amount=$deposit_fees;
	$payment_method=$invoiceinfo[0]->payment_method;
	$txn_id=$invoiceinfo[0]->txn_id;
	$payment_info=serialize($_REQUEST);
	$cheque_date=$_POST['payment_date'];
	$cheque_number=$_POST['cheque_number'];
	$remarks=$_POST['remarks']; 
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
	
	/////// Endo of Code for Adding Students Information in Course Students Information Table ///////

$referer=$_POST['_wp_http_referer']."&response=success";
wp_redirect($referer);
exit;	
	
}

define("ITEM_PER_PAGE",20);
require_once (TEMPLATEPATH . '/includes/reports-table.class.php');
require_once (TEMPLATEPATH . '/includes/receipt-table.class.php');
require_once (TEMPLATEPATH . '/includes/attendance-table.class.php');
require_once (TEMPLATEPATH . '/includes/newsletter-subscriber-table.class.php');

class LPSReports {
	private $mlm_settings_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'lps_reports_menu' ) );
		//add_action( 'admin_init', array( $this, 'mlm_settings_page_init' ) );
	}
		public function lps_reports_menu() {
		global $lps_reports_page;
	
	$lps_reports_page=add_menu_page('LPS Reports', // page_title
			'Reports', // menu_title
			'manage_options', // capability
			'lps-reports', // menu_slug
			array( $this, 'lps_reports_menu_page' ), // function
			'dashicons-admin-site', // icon_url
			15 // position
			 );
	   add_submenu_page('lps-reports', 'Schedule Course', 'Scheduled Course', 'manage_options', 'view_scheduled_course',array( $this, 'view_scheduled_course' ) );
	   
	    add_submenu_page('lps-reports', 'Attendance Management', 'Attendance Management', 'manage_options', 'manage_attendance',array( $this, 'manage_attendance' ) );

	    add_submenu_page('lps-receipt', '', '', 'manage_options', 'lps_receipt',array( $this, 'lps_receipt' ) );
		 
		$lps_reports_page=add_menu_page('Newsletter Subscriber', // page_title
			'Newsletter Subscriber', // menu_title
			'manage_options', // capability
			'lps-newsletter-subscriber', // menu_slug
			array( $this, 'lps_newsletter_subscriber_menu_page' ), // function
			'dashicons-admin-site', // icon_url
			15 // position
			 );		 
 //  add_action("load-$lps_reports_page", "lps_reports_screen_options");
 	add_users_page('Enrol Participants', 'Enrol Participants', 'read', 'add_participants', 'enrol_participants_function');
	
	}
	public function lps_reports_menu_page()
	{		
	
if(isset($_REQUEST['action']) && $_REQUEST['action']=='view_invoice')
		{
			$invoiceid= $_REQUEST['invoiceid'];
			?>
			
			
			<script language="javascript" type="text/javascript">
function printerDiv(divID) {
//Get the HTML of div

var divElements = document.getElementById(divID).innerHTML;

//Get the HTML of whole page
var oldPage = document.body.innerHTML;

//Reset the pages HTML with divs HTML only

     document.body.innerHTML = 

     "<html><head><title></title></head><body>" + 
     divElements + "</body>";



//Print Page
window.print();

//Restore orignal HTML
document.body.innerHTML = oldPage;

}
</script>
			<!--		<div align="center">
<button type="button" onClick="javascript: printerDiv('invoice');"  class="button-primary"><i class="fa fa-print"></i>Print</button>

<a type="button" href="<?php //_e(admin_url()."?page=lps-reports&action=download_invoice&invoiceid=".$invoiceid);?>"  class="button-primary"><i class="fa fa-print"></i>Download</a>
<br><br>
	</div>-->
			<?php
			view_invoice($invoiceid);
			
			?>
			
			<div align="center" style="margin-top:30px">
<button type="button" onClick="javascript: printerDiv('invoice');"  class="button-primary"><i class="fa fa-print"></i>Print</button>

<a type="button" href="<?php _e(admin_url()."?page=lps-reports&action=download_invoice&invoiceid=".$invoiceid);?>"  class="button-primary"><i class="fa fa-print"></i>Download</a>
<button type="button" onclick="history.go(-1);" class="button-primary">Back</button>
<br><br>
	</div>
			
			<?php
			
		}else
		{	
		/////// Cdoe Starts for Creating Admin Payment Reports ////////
		
				$table = new PAYMENT_LIST_Table();
			$table->prepare_items();
			 $message = '';
			if ('delete' === $table->current_action()) {
				$message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'lps_wp'), count($_REQUEST['id'])) . '</p></div>';
			}
			?>
			<style>
			.wrap {
    margin: 44px 20px 0 2px;
}
			</style>
	<!--	<a href="?page=add_participants" class="button-primary" style="float:right;">Enrol Participants</a>
	<br>	<br>	<a href="?page=view_scheduled_course" class="button-primary" style="float:right;">Course Management</a>-->
			 
			<?php 
			
			if(isset($_REQUEST['response']) && $_REQUEST['response']=='success')
			{
					$successmessage='<div id="message" class="updated notice notice-success is-dismissible"><p>New Participant Added Successfully to Scheduled Course</p></div>';

				echo $successmessage; 
			}
			?>
			<div class="wrap">

			<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
		  
			
			<form id="mlm-user-table" method="get">
			
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
				<?php $table->search_box( 'search', 'search_id' );             ?>
			<label>Start Date <input type="date" value="<?php _e($_REQUEST['startdate']);?>" name="startdate" ></label><label> End Date <input type="date" value="<?php _e($_REQUEST['enddate']);?>" name="enddate" > </label>
			 <?php $table->display(); ?>
			</form>

		</div>
		<div align="center">
	<a href="?page=add_participants" class="button-primary" >Enrol Participants</a>
	<a href="?page=view_scheduled_course" class="button-primary" >Course Management</a>
	<button type="button" class="button-primary" onclick="history.go(-1);">Back</button>
			</div>
				<?php
				////// End of Code for Creating Admin Payment Reports ////////
				}
		
	}
	
	function lps_receipt()
	{
				if(isset($_REQUEST['action']) && $_REQUEST['action']=='view_receipt')
		{
			$receiptid= $_REQUEST['receiptid'];
			?>
<script language="javascript" type="text/javascript">
function printerDiv(divID) {
//Get the HTML of div

var divElements = document.getElementById(divID).innerHTML;

//Get the HTML of whole page
var oldPage = document.body.innerHTML;

//Reset the pages HTML with divs HTML only

     document.body.innerHTML = 

     "<html><head><title></title></head><body>" + 
     divElements + "</body>";



//Print Page
window.print();

//Restore orignal HTML
document.body.innerHTML = oldPage;

}
</script>
			<!--		<div align="center">
<button type="button" onClick="javascript: printerDiv('invoice');"  class="button-primary"><i class="fa fa-print"></i>Print</button>

<a type="button" href="<?php _e(admin_url()."?page=lps_receipt&action=download_receipt&receiptid=".$receiptid);?>"  class="button-primary"><i class="fa fa-print"></i>Download</a>
<br><br>
	</div>-->
			<?php
			view_receipt($receiptid);
		?>
			<div align="center" style="margin-top:30px">
<button type="button" onClick="javascript: printerDiv('invoice');"  class="button-primary"><i class="fa fa-print"></i>Print</button>

<a type="button" href="<?php _e(admin_url()."?page=lps_receipt&action=download_receipt&receiptid=".$receiptid);?>"  class="button-primary"><i class="fa fa-print"></i>Download</a>

<button type="button" class="button-primary" onclick="history.go(-1);">Back</button>
<br><br>
	</div>
		
		<?php
		}else { 
		
		/////// Cdoe Starts for Creating Admin Payment Reports ////////
		
				$table = new RECEIPT_LIST_Table();
			$table->prepare_items();
			 $message = '';
			if ('delete' === $table->current_action()) {
				$message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'lps_wp'), count($_REQUEST['id'])) . '</p></div>';
			}
			?>
			<style>
			.wrap {
    margin: 44px 20px 0 2px;
}
			</style>
		
			
		<!--<a href="?page=add_participants" class="button-primary" style="float:right;">Enrol Participants</a>
	<br>	<br>	<a href="?page=view_scheduled_course" class="button-primary" style="float:right;">Course Management</a>-->
			 
		
			<div class="wrap">

			<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
		  
			
			<form id="mlm-user-table" method="get">
			
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
		<input type="hidden" name="invoiceid" value="<?php echo $_REQUEST['invoiceid'] ?>"/>
		
			 <?php $table->display(); ?>
			</form>

		</div>
				<div align="center">
	<a href="?page=add_participants" class="button-primary" >Enrol Participants</a>
	<a href="?page=view_scheduled_course" class="button-primary" >Course Management</a>
	<button type="button" class="button-primary" onclick="history.go(-1);">Back</button>
			</div>	
				<?php
				////// End of Code for Creating Admin Payment Reports ////////
		}			
		
	}
	function view_scheduled_course()
	{ ?>
	<div class="wrap">
   <div class="welcome-panel">
   <h1>Scheduled Course Management</h1>
   
    <form method="post" action="<?php _e(admin_url());?>admin.php?page=<?php _e($_REQUEST['page']);?>" >
		<input type="hidden" value="scheduled_course_report" name="action" />
       <?php wp_nonce_field( 'schedule_course_report', 'scheduled_course_form' ); ?>
	  <input type="hidden" name="_wp_http_referer" value="<?php _e(admin_url());?>admin.php?page=<?php _e($_REQUEST['page']);?>" />   
	  <div class="postbox">
      
            <div class="inside">
               <table class="form-table">
                    <tr>
                     <th scope="row"><label for="firstname">Report Format* :</label>
                        </th>
                        <td>
                         <select name="report_format" id="report_format" required  >  
						 <option value=""> Select Format </option>
							<option value="excel">Excel</option>
							<option value="pdf">PDF</option>
                           </select>
                        </td>
                    </tr>
               </table>
           
		  
		   <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Start Date* :</label>
                        </th>
                        <td>
                        <input type="date" required value="<?php _e($_REQUEST['startdate']);?>" name="startdate" >
                        </td>
                    </tr>
               </table>
			   
		    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">End Date* :</label>
                        </th>
                        <td>
                       <input type="date" name="enddate" required value="<?php _e($_REQUEST['startdate']);?>" >
                        </td>
                    </tr>
               </table>
			   
           
               <p> <input class="button-primary" type="submit" name="settings_submit" value="View Report">
                </p>
                
            </div>
      </div>
    </form>
  
	</div>
</div>
	
	<?php		
		
	}
	function manage_attendance()
	{
		
		/////// Cdoe Starts for Creating Admin Payment Reports ////////
		
				$table = new STUDENT_LIST_Table();
			$table->prepare_items();
			 $message = '';
			if ('delete' === $table->current_action()) {
				$message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'lps_wp'), count($_REQUEST['id'])) . '</p></div>';
			}
			?>
			 
			<?php 
						
			if(isset($_SESSION['message']))
			{
				echo '<div id="message" class="updated notice notice-success is-dismissible"><p>'.$_SESSION['message'].'</p></div>';
				unset($_SESSION['message']);
			}
			?>
			<div class="wrap" >
			<h1 class="wp-heading-inline">Attendance Management</h1>
			<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
		  
			
			<form id="mlm-user-table" method="get">
			
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
			
			<label>Attendance Date <input type="date" value="<?php _e($_REQUEST['attendance_date']);?>" name="attendance_date" ></label>
			
			   <select name="courseid" id="courseid" required >  
						 <option value=""> Select Scheduled Course </option>
						 <?php 
						 $currentcourseid= $_REQUEST['courseid'];
						 cm_get_dropdown_scheduled_course_admin($currentcourseid);?>
                           </select>
                           <div id=
			 <?php $table->display(); ?>
			</form>

		</div>
				<div align="center" style="margin-top:30px">

<button type="button" onclick="history.go(-1);" class="button-primary">Back</button>
<br><br>
	</div>
				<?php
				////// End of Code for Creating Admin Payment Reports ////////
		
	}
	
	function lps_newsletter_subscriber_menu_page()
	{
	/////// Cdoe Starts for Creating Newsletter Subscriber Reports ////////
		
		$table = new NEWSLETTER_SUBSCRIBER_LIST_Table();
    $table->prepare_items();
	 $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Subscribers deleted: %d', 'lps_wp'), count($_REQUEST['id'])) . '</p></div>';
    }
	?>
	<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
   
    <?php echo $message; 
	
	?>

    <form id="mlm-user-table" method="get">
	
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->search_box( 'search', 'search_id' );             ?>
    <label>Start Date <input type="date" value="<?php _e($_REQUEST['startdate']);?>" name="startdate" ></label><label> End Date <input type="date" name="enddate" value="<?php _e($_REQUEST['startdate']);?>" > </label>
	 <?php $table->display(); ?>
    </form>

</div>
	
		<?php
		////// End of Code for Creating Newsletter Subscriber Reports ////////
		
	}
	
	
}



function enrol_participants_function()
	{
		?>
 <div class="wrap">
     <div class="welcome-panel">
           <h3>Enrol New Participants for Scheduled Course :-</h3>
    
    
    <form method="post" action="<?php _e(admin_url());?>admin.php?page=add_participants" >
		<input type="hidden" value="saveparticipants" name="action" />
       <?php wp_nonce_field( 'add_participants', 'participants_form' ); ?>
	  <input type="hidden" name="_wp_http_referer" value="<?php _e(admin_url());?>admin.php?page=lps-reports" />   
	  <div class="postbox">
      
            <div class="inside">
               <table class="form-table">
                    <tr>
                     <th scope="row"><label for="firstname">Select Scheduled Course* :</label>
                        </th>
                        <td>
                         <select name="schedule_course" id="schedule_course" required id="schedule_course" >  
						 <option value=""> Select Scheduled Course </option>
						 <?php 
						 $currentcourseid= $_REQUEST['courseid'];
						 cm_get_dropdown_scheduled_course($currentcourseid);?>
                           </select>
                        </td>
                    </tr>
               </table>
           <div id="course_name_container"></div>
		   
		    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Select Participant* :</label>
                        </th>
                        <td>
                        <?php
$usersargs = array(
    'show_option_all'         => null, // string
    'show_option_none'        => null, // string
    'hide_if_only_one_author' => null, // string
    'orderby'                 => 'id',
    'order'                   => 'DESC',
    'include'                 => null, // string
    'exclude'                 => null, // string
    'multi'                   => false,
    'show'                    => 'display_name',
    'echo'                    => true,
    'selected'                => false,
    'include_selected'        => false,
    'name'                    => 'participant_name', // string
    'id'                      => 'participant_name', // string
    'class'                   => null, // string 
    'blog_id'                 => $GLOBALS['blog_id'],
    'who'                     => null, // string,
    'role'                    => 'lps_member', // string|array,
    'role__in'                => null, // array    
    'role__not_in'            => null, // array        
); 
						wp_dropdown_users( $usersargs ); ?> 
						<p> if not in above list please <a href="<?php _e(admin_url());?>user-new.php" target="_blank">Add here</a></p>
                        </td>
                    </tr>
               </table>
			    <div id="user_info_container"></div>
		   <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Mobile No* :</label>
                        </th>
                        <td>
                         <input type="text" name="mobile" id="mobile" required  >
                        </td>
                    </tr>
               </table>
			   
		    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Deposit Fees* :</label>
                        </th>
                        <td>
                         <input type="text" name="deposit_fees" id="deposit_fees" required  >
                        </td>
                    </tr>
               </table>
			   
             <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Payment Method* :</label>
                        </th>
                        <td>
                         <select name="payment_method" id="payment_method" required >  
							<option value="cash"> Cash </option>
							<option value="cheque"> Cheque </option>
							<option value="online"> Online </option>
                           </select>
                        </td>
                    </tr>
               </table>
			    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Payment Status* :</label>
                        </th>
                        <td>
                         <select name="payment_status" id="payment_status" required >  
							<option value="Pending"> Pending </option>
							<option value="Processing"> Processing </option>
							<option value="Completed" selected > Completed </option>
							
                           </select>
                        </td>
                    </tr>
               </table>
              <div id="payment_method_container"></div>
		    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method">Remarks :</label>
                        </th>
                        <td>
                         <textarea name="remarks" id="remarks" rows="5" cols="50"  ></textarea>  
							
                           </select>
                        </td>
                    </tr>
               </table>
               <p> <input class="button-primary part" type="submit" name="settings_submit" value="Add Participants" style="float:left;margin-right: 20px;">
                </p> 
                <p> <input class="button-primary" type="button" name="back" onclick="history.go(-1);" value="Back">
                </p> 
            </div>
      </div>
    </form>
   </div>
</div>
   <script type="text/javascript">
jQuery( document ).ready(function() {
	
	<?php if(isset($_REQUEST['courseid']) && $_REQUEST['courseid']!='') { ?>
	jQuery.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getschedulecoursename&schedule_courseid=<?php _e($_REQUEST['courseid']);?>", function( data ) {
		//alert(data);
		document.getElementById('course_name_container').innerHTML=data;
  //$( ".result" ).html( data );
});
	<?php } ?>
	
 jQuery("#schedule_course").change(function(){
	
	jQuery.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getschedulecoursename&schedule_courseid="+ this.value, function( data ) {
		//alert(data);
		document.getElementById('course_name_container').innerHTML=data;
  //$( ".result" ).html( data );
});
});

 jQuery("#payment_method").change(function(){
	
	jQuery.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getpaymentmethodfields&method="+ this.value, function( data ) {
		//alert(data);
		document.getElementById('payment_method_container').innerHTML=data;
  //$( ".result" ).html( data );
});
});

user_id=document.getElementById('participant_name').value;

jQuery.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getuserinfo&user_id="+ user_id, function( data ) {
		//alert(data);
		document.getElementById('user_info_container').innerHTML=data;
  //$( ".result" ).html( data );
});

 jQuery("#participant_name").change(function(){
	
	jQuery.post( "<?php _e(admin_url('admin-ajax.php')); ?>?action=getuserinfo&user_id="+ this.value, function( data ) {
		//alert(data);
		document.getElementById('user_info_container').innerHTML=data;
  //$( ".result" ).html( data );
});
});

});
</script> 
		<?php
		
	}
function lps_reports_screen_options() {
 
    global $lps_reports_page;
 
    $screen = get_current_screen();
 
    // get out of here if we are not on our settings page
    if(!is_object($screen) || $screen->id != $lps_reports_page)
        return;
 
    $args = array(
        'label' => __('Order per page', 'lps_wp'),
        'default' => 10,
        'option' => 'lps_report_per_page'
    );
    add_screen_option( 'per_page', $args );

}

add_action( 'plugins_loaded', 'add_lps_filter' );
function add_lps_filter() {
    add_filter( 'set-screen-option', 'lps_reports_set_screen_option', 10, 3 );
} 

function lps_reports_set_screen_option($status, $option, $value) {
    if ( 'lps_report_per_page' == $option ) return $value;
}
add_filter('set-screen-option', 'lps_reports_set_screen_option', 10, 3);


if ( is_admin() )
	$lpsreports = new LPSReports();	
?>
