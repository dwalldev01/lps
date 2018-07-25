<?php
 global $wpdb;        
define("PAYMENT_TABLE_NAME",INVOICE_TABLE);

if($_REQUEST['page']=='lps-reports' && $_REQUEST['action']=='view_payment_pdf' )
 {
			require_once (TEMPLATEPATH . '/includes/payment-course-report-pdf.php');
			exit;	 
 }else if($_REQUEST['page']=='lps-reports' && $_REQUEST['action']=='view_payment_xls' )
 {
			require_once (TEMPLATEPATH . '/includes/payment-course-report-xls.php');
			exit; 	 
 } 
 
if($_REQUEST['page']=='lps-reports' && $_REQUEST['action']=='view_participants_pdf' )
 {
			require_once (TEMPLATEPATH . '/includes/participants-report-pdf.php');
			exit;
	 
 }else if($_REQUEST['page']=='lps-reports' && $_REQUEST['action']=='view_participants_xls' )
 {
			require_once (TEMPLATEPATH . '/includes/participants-report-xls.php');
			exit; 	 
 } 
  if($_REQUEST['page']=='lps-reports' && $_REQUEST['action']=='users_pdf' )
 {
	
	 require_once (TEMPLATEPATH . '/includes/users-reports-pdf.php');
			exit;
	 
 }else if($_REQUEST['page']=='lps-reports' && $_REQUEST['action']=='users_excel' )
 {
	  
	 require_once (TEMPLATEPATH . '/includes/users-reports-xls.php');
			exit;
	 
 }
 if($_REQUEST['page']=='lps-reports' && $_REQUEST['action']=='pdf' )
 {
	 require_once (TEMPLATEPATH . '/includes/payment-report-pdf.php');
			exit;
	 
 }else if($_REQUEST['page']=='lps-reports' && $_REQUEST['action']=='excel' )
 {
	 require_once (TEMPLATEPATH . '/includes/payment-report-xls.php');
			exit;
	 
 }
 if($_REQUEST['page']=='lps-reports' && $_REQUEST['invoiceid']!='' && $_REQUEST['action']=='download_invoice' )
 {
			require_once (TEMPLATEPATH . '/includes/invoice-pdf.php');
			exit;
	 
 }
 
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class PAYMENT_LIST_Table extends WP_List_Table
{
    /**
     * Set the amount of stores that are shown on each page
     * @since 1.0
     * @var string
     */
     private $_per_page;
    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */ 
    function __construct(){
	
         global $status,$page;
		
         parent::__construct(array(
            'singular' => 'user',
            'plural' => 'users',
        ));
      
     
     }
     
     /**
     * Get the per_page value from the option table
     * 
     * @since 1.2.20
     * @return string $per_page The amount of stores to show per page
     */
    function get_per_page() {
        
        $user     = get_current_user_id();
        $screen   = get_current_screen();
       $option   = $screen->get_option( 'per_page', 'option' );

	 // echo $screen
      // echo $per_page;
	  $per_page=ITEM_PER_PAGE;
        if ( empty( $per_page ) || $per_page < 1 ) {
            $per_page = $screen->get_option( 'per_page', 'default' );
        }
       // echo $per_page;
        return $per_page;
    }
     
     /**
     * [REQUIRED] this is a default column renderer
     *
     * @param $item - row (key, value array)
     * @param $column_name - string (key)
     * @return HTML
     */
    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }
    
    /**
     * [OPTIONAL] this is example, how to render specific column
     *
     * method name must be like this: "column_[column_name]"
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
    
    /**
     * [OPTIONAL] this is example, how to render column with actions,
     * when you hover row "Edit | Delete" links showed
     *
     * @param $item - row (key, value array)
     * @return HTML
     */ 
	  public function get_column_info() {
          if ( ! isset( $this->_column_headers ) ) {
             $this->_column_headers = array(
                $this->get_columns(),
                array(),
                array(),
                'sl_id',
             );
          }

          return $this->_column_headers;
       }
	
    function column_email($item)
    {
        // links going to /admin.php?page=[your_plugin_page][&other_params]
        // notice how we used $_REQUEST['page'], so action will be done on curren page
        // also notice how we use $this->_args['singular'] so in this example it will
        // be something like &person=2
        
        $actions = array(
             'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete','lps_wp')),
        );

        return sprintf('%s %s',
            $item['user_email'],
            $this->row_actions($actions)
        );
        
    }
    
    /*function column_lastname($item)
    {
        return '<em>' . $item['lastname'] . '</em>';
    }*/
    
    
    function column_firstname($item)
    {
        return '<em>' . $item['firstname'] . '</em>';
    }
    
    /**
     * [REQUIRED] this is how checkbox column renders
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
	
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['payment_id']
        );
    }
    
    /**
     * [REQUIRED] This method return columns to display in table
     * you can skip columns that you do not want to show
     * like content, or description
     *
     * @return array
     */
    function get_columns()
    {	
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox insteadof text
          	'payment_id' => __('Payment ID', lps_wp),
			'uid' => __('User ID', lps_wp),			
			'payer_email' => __('Payer Email', lps_wp),
			'coursecategory' => __('Course Name', lps_wp),
			'txn_id' => __('Transaction ID', lps_wp),
			'ordertype' => __('Order Type', lps_wp),			
			
			'payment_gross' => __('Total Fees', lps_wp),
			'date' => __('Order Date', lps_wp),		
			'payment_status' => __('Order Status', lps_wp),
			'invoice' => __('View Invoice', lps_wp),
			
        );
        return   $columns ;
    }
    
    /**
     * [OPTIONAL] This method return columns that may be used to sort table
     * all strings in array - is column names
     * notice that true on name column means that its default sort
     *
     * @return array
     */
    function get_sortable_columns()
    {        
        $sortable_columns = array(
		'payment_id' => array('payment_id', true),
		'uid' => array('uid', true),
		'txn_id' => array('txn_id', true),
		'ordertype' => array('ordertype', true),
		
		'payment_gross' => array('payment_gross', true),
		'payer_email' => array('payer_email', false),			
		'coursecategory' => array('coursecategory', false),	
		'date' => array('date', false),
		'invoice' => array('invoice', false),
		'payment_status' => array('payment_status', false),
		
        );
        return $sortable_columns;
    }
    
    /**
     * [OPTIONAL] Return array of bult actions if has any
     *
     * @return array
     */
    function get_bulk_actions()
    {
			$actions = array(
			'users_excel' => 'Users Excel Report',
			'users_pdf' => 'Users PDF Report',
			'excel' => 'Payment Excel Report',
			'pdf' => 'Payment PDF Report',
			'send_reminder_payment_mail' => 'Send Pending Payment Email ',
			'completed' => 'Mark Completed',
			'pending' => 'Mark Pending',
			'processing' => 'Mark Processing',
            'delete' => 'Delete'
        );
        return $actions;
    }
    
    /**
     * [OPTIONAL] This method processes bulk actions
     * it can be outside of class
     * it can not use wp_redirect coz there is output already
     * in this example we are processing delete action
     * message about successful deletion will be shown on page in next part
     */
    function process_bulk_action()
    {
        global $wpdb;
        $table_name = INVOICE_TABLE; // do not forget about tables prefix

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("DELETE FROM $table_name WHERE payment_id IN($ids)");
            }
        }
		
		////////// Code Start for Sending Payment Reminder Email to Users ///////
		 if ('send_reminder_payment_mail' === $this->current_action()) {
			
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
			
			foreach($ids as $invoiceid)
			{
			
				$invoiceinfo = $wpdb->get_results("select * from ".INVOICE_TABLE." where payment_id='$invoiceid' ");
	
			 $data=array();
			 $uid=$invoiceinfo[0]->uid;
			 $schedule_course_id = $invoiceinfo[0]->item_number;
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
			$data['payment_status'] = '';
			send_payment_reminder_mail($to,$data);			
				
			}
			?><script> alert("Payment Reminder Email Send Successfully."); </script>
			<?php
			
        }
		
		
		 if ('completed' === $this->current_action()) {
			 $payment_status="Completed";
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("Update  $table_name set payment_status='$payment_status' WHERE payment_id IN($ids)");
            }
        }
		
		 if ('pending' === $this->current_action()) {
			 $payment_status="Pending";
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("Update  $table_name set payment_status='$payment_status' WHERE payment_id IN($ids)");
            }
        }
		 if ('processing' === $this->current_action()) {
			 $payment_status="Processing";
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("Update  $table_name set payment_status='$payment_status' WHERE payment_id IN($ids)");
            }
        }
				
		if('pdf' === $this->current_action()) {
			
			
		}
    }
    
    function get_store_list(){
         global $wpdb;
         $table_name = INVOICE_TABLE; // do not forget about tables prefix  
         $total_items = 0;
         //$per_page=5;
         //$this->_per_page = 5;
        $this->_per_page = $this->get_per_page();        
        /* Check if we need to run the search query or just show all the data */
		if($_REQUEST['startdate']!='')
		{
			$startdate="'".$_REQUEST['startdate']." 00:00:00'";
			$searchquery .=	"  date >=".$startdate." && ";
		}
		if($_REQUEST['enddate']!='')
		{
			$enddate="'".$_REQUEST['enddate']." 23:59:59'";

			$searchquery .=	"  date <=".$enddate." && ";
		}

        if ( isset( $_GET['s'] )  ) {
            $search = trim( $_GET['s'] ); //exit;
			
            $result = $wpdb->get_results( 
                            $wpdb->prepare( "SELECT * FROM $table_name  WHERE $searchquery ( payer_email LIKE %s OR coursecategory LIKE %s )", 
                               '%' . like_escape( $search ). '%', '%' . like_escape( $search ). '%'            ), ARRAY_A 
                            );
        } else {
            /* Order params */
            $orderby   = !empty ( $_GET["orderby"] ) ? esc_sql ( $_GET["orderby"] ) : 'payment_id';
            $order     = !empty ( $_GET["order"] ) ? esc_sql ( $_GET["order"] ) : 'DESC';
            $order_sql = $orderby.' '.$order;   

            // Pagination parameters 
            $total_items = $wpdb->get_var( "SELECT COUNT(*) AS count FROM $table_name" );
           
		   /*
		    $totalusers = count_users();
			$totalcustomers=$totalusers['avail_roles']['customer'];
			$total_items=$totalcustomers;
			*/
            $paged       = !empty ( $_GET["paged"] ) ? esc_sql ( $_GET["paged"] ) : '';
            
            if ( empty( $paged ) || !is_numeric( $paged ) || $paged <= 0 ) { 
                $paged = 1; 
            }

            //$totalpages = ceil( $total_items / $this->_per_page );
            //echo "test".$this->_per_page; exit; 
            if ( !empty( $paged ) && !empty( $this->_per_page ) ){
                $offset    = ( $paged - 1 ) * $this->_per_page;
                $limit_sql = (int)$offset.',' . (int)$this->_per_page;
            }
        
	
            $result = $wpdb->get_results( "SELECT * FROM $table_name  ORDER BY $order_sql LIMIT $limit_sql", ARRAY_A );    
            
            
        }
		$counter=0;
		$newdata=array();
        foreach($result  as $dataresult)
		{
			$newdata[$counter]	=$dataresult;
			
			if($dataresult['ordertype']=='cooperate')
			{
				$newdata[$counter]['ordertype']	="Cooperate<br><a target='_blank' href='".admin_url()."admin.php?page=manage_attendance&invoice_id=".$dataresult['payment_id']."'>View Partcipants(".$dataresult['total_participants'].")</a>";
			}elseif($dataresult['ordertype']=='single')
			{
					$newdata[$counter]['ordertype']="Single";
			}
			
			if($dataresult['date']!='')
			{
				$newdata[$counter]['date']	=date("d M,Y",strtotime($dataresult['date']));
			}
			if($dataresult['payment_status']=='Completed')
			{				
					$newdata[$counter]['payment_status']="<span style='color:green;'><strong>".$dataresult['payment_status']."</strong></span>";
			}elseif($dataresult['payment_status']=='Processing')
			{				
					$newdata[$counter]['payment_status']="<span style='color:orange;'><strong>".$dataresult['payment_status']."</strong></span>";
			}else
			{				
				$newdata[$counter]['payment_status']="<span style='color:red;'><strong>".$dataresult['payment_status']."</strong></span>";
			}
			
				$newdata[$counter]['invoice']="<a href='?page=lps-reports&action=view_invoice&invoiceid=".$dataresult['payment_id']."'>View Invoice</a> | <a href='?page=lps_receipt&invoiceid=".$dataresult['payment_id']."'>View Receipt</a>";
			$counter++;
		}
  
        $response = array(
            "data"  => stripslashes_deep( $newdata ),
            "count" => $total_items
        );
        
        
        return $response;
    }
    
    /**
     * [REQUIRED] This is the most important method
     *
     * It will get rows from database and prepare them to be showed in table
     */
    function prepare_items()
    {
		
        global $wpdb;
        $table_name = INVOICE_TABLE; // do not forget about tables prefix

        $user = get_current_user_id();
        // get the current admin screen
        $screen = get_current_screen();
		
        // retrieve the "per_page" option
        $screen_option = $screen->get_option('per_page', 'option');
        // retrieve the value of the option stored for the current user
       //$per_page = get_user_meta($user, $screen_option, true);
		 $per_page = ITEM_PER_PAGE;
		
        if ( empty ( $per_page) || $per_page < 1 ) {
            // get the default value if none is set
            $per_page = $screen->get_option( 'per_page', 'default' );
        } // constant, how much records will be shown per page

        $columns = $this->get_columns();
		
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();
        $response = $this->get_store_list(); 
      
        $current_page = $this->get_pagenum();
        $total_items  = $response['count'];
        
        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil( $total_items / $per_page ) 
        ) );

        $this->items = $response['data'];
        //$this->_column_headers = array( $columns, $hidden, $sortable );       
        
        // will be used in pagination settings
        
    }


}
?>