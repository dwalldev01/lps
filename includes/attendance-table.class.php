<?php
 global $wpdb;        

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if($_REQUEST['page']=='manage_attendance' && $_REQUEST['action']=='export_report' )
 {
		
	 require_once (TEMPLATEPATH . '/includes/participants-attendance-xls.php');
			exit;
	 
 }
 if($_REQUEST['page']=='manage_attendance' && $_REQUEST['action']=='export_report_pdf' )
 {
		
	 require_once (TEMPLATEPATH . '/includes/participants-attendance-pdf.php');
			exit;
	 
 }


class STUDENT_LIST_Table extends WP_List_Table
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
            $item['id']
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
          			
			'full_name' => __('Name', lps_wp),
			'user_email' => __('Email ID ', lps_wp),
			'mobile' => __('Mobile No', lps_wp),
			'course_id' => __('Course Name', lps_wp),
			
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
		'id' => array('id', true),		
		'full_name' => array('full_name', true),
		'user_email' => array('user_email', true),		
		'mobile' => array('mobile', false),
		'course_id' => array('course_id', true),
		
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
			'mark_attendance' => 'Mark Present',	
			'mark_absent' => 'Mark Absent',	
			'mark_mc' => 'Mark MC',	
			'mark_ul' => 'Mark UL',	
			'export_report' => 'Export Excel Report',	
			'export_report_pdf' => 'Export PDF Report',
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
        $table_name = STUDENT_INFO_TABLE; // do not forget about tables prefix

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
		
		////////// Code for Marking Attendance /////////////
		 if ('mark_attendance' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            
			foreach($ids as $id)
			{
				$uid=$id;
				$attendance_date=$_REQUEST['attendance_date'];
				$course_id=$_REQUEST['courseid'];
				$status = 'p';
				$dateadded=time();
			
			
				if($_REQUEST['attendance_date']!='')
				{
					
					///////// Code Start to Check already marked attendance /////
					$checkquery="select id from  ".ATTENDANCE_TABLE." where  uid='$uid' && attendance_date='$attendance_date' && course_id='$course_id'  ";
					$alreadyexistid=  $wpdb->get_var($checkquery);
					if($alreadyexistid)
					{
						$wpdb->query(" update ".ATTENDANCE_TABLE." set status='$status' where  uid='$uid' && attendance_date='$attendance_date' && course_id='$course_id' ");
					}else
					{
				
					 $wpdb->query("insert into ".ATTENDANCE_TABLE." set 
					 uid='$uid',
					 course_id='$course_id',
					 attendance_date='$attendance_date',
					 status='$status',
					 dateadded='$dateadded'
					 ");
					}
		 
				$_SESSION['message']="Attendance Marked Successfully.";
				}else
				{
					$_SESSION['message']="Please select date first.";	
					
				}
			}
        }
		//////// Code For Marking Absent in Attendance ///////////
		
		 if ('mark_absent' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            
			foreach($ids as $id)
			{
				$uid=$id;
				$attendance_date=$_REQUEST['attendance_date'];
				$course_id=$_REQUEST['courseid'];
				$status = 'a';
				$dateadded=time();
			if($_REQUEST['attendance_date']!='')
					{
				
					///////// Code Start to Check already marked attendance /////
					$checkquery="select id from  ".ATTENDANCE_TABLE." where  uid='$uid' && attendance_date='$attendance_date' && course_id='$course_id'  ";
					$alreadyexistid=  $wpdb->get_var($checkquery);
					if($alreadyexistid)
					{
						$wpdb->query(" update ".ATTENDANCE_TABLE." set status='$status' where  uid='$uid' && attendance_date='$attendance_date' && course_id='$course_id' ");
					}else
					{
					 $wpdb->query("insert into ".ATTENDANCE_TABLE." set 
					 uid='$uid',
					  course_id='$course_id',
					 attendance_date='$attendance_date',
					 status='$status',
					 dateadded='$dateadded'
					 ");
					} 
					$_SESSION['message']="Attendance Marked Successfully.";
					
					}else
					{
						$_SESSION['message']="Please select date first.";	
						
					}
			}
			
			
        }
		
		 ////// Code for Marking MC in Attendance ///////
		if ('mark_mc' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            
			foreach($ids as $id)
			{
				$uid=$id;
				$attendance_date=$_REQUEST['attendance_date'];
				$course_id=$_REQUEST['courseid'];
				$status = 'mc';
				$dateadded=time();
			if($_REQUEST['attendance_date']!='')
					{
				
					///////// Code Start to Check already marked attendance /////
					$checkquery="select id from  ".ATTENDANCE_TABLE." where  uid='$uid' && attendance_date='$attendance_date' && course_id='$course_id'  ";
					$alreadyexistid=  $wpdb->get_var($checkquery);
					if($alreadyexistid)
					{
						$wpdb->query(" update ".ATTENDANCE_TABLE." set status='$status' where  uid='$uid' && attendance_date='$attendance_date' && course_id='$course_id' ");
					}else
					{
					 $wpdb->query("insert into ".ATTENDANCE_TABLE." set 
					 uid='$uid',
					  course_id='$course_id',
					 attendance_date='$attendance_date',
					 status='$status',
					 dateadded='$dateadded'
					 ");
					} 
					$_SESSION['message']="Attendance Marked Successfully.";
					
					}else
					{
						$_SESSION['message']="Please select date first.";	
						
					}
			}
			
			
        }
		
		 /////// Code for Marking UL in Attendance //////		
		if ('mark_ul' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            
			foreach($ids as $id)
			{
				$uid=$id;
				$attendance_date=$_REQUEST['attendance_date'];
				$course_id=$_REQUEST['courseid'];
				$status = 'ul';
				$dateadded=time();
			if($_REQUEST['attendance_date']!='')
					{
				
					///////// Code Start to Check already marked Urgent Leave /////
					$checkquery="select id from  ".ATTENDANCE_TABLE." where  uid='$uid' && attendance_date='$attendance_date' && course_id='$course_id'  ";
					$alreadyexistid=  $wpdb->get_var($checkquery);
					if($alreadyexistid)
					{
						$wpdb->query(" update ".ATTENDANCE_TABLE." set status='$status' where  uid='$uid' && attendance_date='$attendance_date' && course_id='$course_id' ");
					}else
					{
					 $wpdb->query("insert into ".ATTENDANCE_TABLE." set 
					 uid='$uid',
					  course_id='$course_id',
					 attendance_date='$attendance_date',
					 status='$status',
					 dateadded='$dateadded'
					 ");
					} 
					$_SESSION['message']="Attendance Marked Successfully.";
					
					}else
					{
						$_SESSION['message']="Please select date first.";	
						
					}
			}
			
			
        }
		
    }
    
    function get_store_list(){
         global $wpdb;
         $table_name = STUDENT_INFO_TABLE; // do not forget about tables prefix  
         $total_items = 0;
         //$per_page=5;
         //$this->_per_page = 5;
        $this->_per_page = $this->get_per_page();        
        /* Check if we need to run the search query or just show all the data */

		if(isset($_REQUEST['courseid']) && $_REQUEST['courseid']!='' )
		{
			$course_id = $_REQUEST['courseid'];
			$searchquery=" where course_id='$course_id' ";			
		}
		
			if(isset($_REQUEST['invoice_id']) && $_REQUEST['invoice_id']!='' )
		{
			$invoice_id = $_REQUEST['invoice_id'];
			$searchquery=" where invoice_id='$invoice_id' ";			
		}
		
            /* Order params */
            $orderby   = !empty ( $_GET["orderby"] ) ? esc_sql ( $_GET["orderby"] ) : 'id';
            $order     = !empty ( $_GET["order"] ) ? esc_sql ( $_GET["order"] ) : 'DESC';
            $order_sql = $orderby.' '.$order;   

            // Pagination parameters 
            $total_items = $wpdb->get_var( "SELECT COUNT(*) AS count FROM $table_name $searchquery" );
           
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
        
		
            $result = $wpdb->get_results( "SELECT * FROM $table_name $searchquery  ORDER BY $order_sql LIMIT $limit_sql", ARRAY_A );    
            
     
		$counter=0;
		$newdata=array();
        foreach($result  as $dataresult)
		{			
			$newdata[$counter]	=$dataresult;
			if($dataresult['course_id']!='')
			{
				$postinfo = get_post($dataresult['course_id']);			
				$newdata[$counter]['course_id']	="<a href='".admin_url()."admin.php?page=manage_attendance&courseid=".$dataresult['course_id']."' >".$postinfo->post_title."</a>";
			}
			
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