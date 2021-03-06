<?php
 global $wpdb;        

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

 if($_REQUEST['page']=='lps_receipt' && $_REQUEST['receiptid']!='' && $_REQUEST['action']=='download_receipt' )
 {
			require_once (TEMPLATEPATH . '/includes/receipt-pdf.php');
			exit;
	 
 }


class RECEIPT_LIST_Table extends WP_List_Table
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
          	'id' => __('Receipt ID', lps_wp),
			'uid' => __('User ID', lps_wp),	
			'invoice_id' => __('Invoice ID', lps_wp),
			'total_amount' => __('Amount ', lps_wp),
			'txn_id' => __('Transaction ID', lps_wp),
			'payment_method' => __('Payment Method', lps_wp),
			'payment_status' => __('Payment Status', lps_wp),		
			'date' => __('Date', lps_wp),					
			'invoice' => __('View Receipt', lps_wp),
			
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
		'uid' => array('uid', true),
		'txn_id' => array('txn_id', true),
		'total_amount' => array('total_amount', true),
		
		'date' => array('date', false),
		'invoice' => array('invoice', false),		
		'payment_method' => array('payment_method', false),	
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
        $table_name = RECEIPT_TABLE; // do not forget about tables prefix

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
		
		 if ('completed' === $this->current_action()) {
			 $payment_status="Completed";
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);
	
            if (!empty($ids)) {				
                $wpdb->query("Update  $table_name set payment_status='$payment_status' WHERE id IN($ids)");
            }
        }
		
		 if ('pending' === $this->current_action()) {
			 $payment_status="Pending";
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("Update  $table_name set payment_status='$payment_status' WHERE id IN($ids)");
            }
        }
		 if ('processing' === $this->current_action()) {
			 $payment_status="Processing";
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("Update  $table_name set payment_status='$payment_status' WHERE id IN($ids)");
            }
        }
				
	
    }
    
    function get_store_list(){
         global $wpdb;
         $table_name = RECEIPT_TABLE; // do not forget about tables prefix  
         $total_items = 0;
         //$per_page=5;
         //$this->_per_page = 5;
        $this->_per_page = $this->get_per_page();        
        /* Check if we need to run the search query or just show all the data */
		/*
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
		*/
		if($_REQUEST['invoiceid']!='')
		{
			$invoiceid=$_REQUEST['invoiceid'];

			$searchquery .=	" where  invoice_id =".$invoiceid."  ";
		}
        if ( isset( $_GET['s'] )  ) {
            $search = trim( $_GET['s'] ); //exit;
			
            $result = $wpdb->get_results( 
                            $wpdb->prepare( "SELECT * FROM $table_name  $searchquery ", 
                               '%' . like_escape( $search ). '%', '%' . like_escape( $search ). '%'            ), ARRAY_A 
                            );
        } else {
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
            
            
        }
		$counter=0;
		$newdata=array();
        foreach($result  as $dataresult)
		{			
			$newdata[$counter]	=$dataresult;
			if($dataresult['invoice_id']!='')
			{
				$newdata[$counter]['invoice_id']	="<a href='".admin_url()."admin.php?page=lps-reports&action=view_invoice&invoiceid=".$dataresult['invoice_id']."' target='_blank'>".$dataresult['invoice_id']."</a>";
			}
			
			if($dataresult['total_amount']!='')
			{
				$newdata[$counter]['total_amount']	=get_option('cm_currency').number_format($dataresult['total_amount'],2);
			}
			if($dataresult['dateadded']!='')
			{
				$newdata[$counter]['date']	=date("d M,Y",$dataresult['dateadded']);
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
			
				$newdata[$counter]['invoice']=" <a href='?page=lps_receipt&action=view_receipt&receiptid=".$dataresult['id']."'>Download Receipt</a>";
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