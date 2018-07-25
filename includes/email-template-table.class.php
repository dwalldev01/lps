<?php
 global $wpdb;        
define("EMAIL_TEMPLATE_TABLE_NAME",$wpdb->prefix."email_template");

if(isset($_REQUEST['action']) && $_REQUEST['action']=='viewtemplate' )
{
	$templateid=$_REQUEST['id'];
	$updatelink= admin_url()."?page=lps-email-template&template_id=".$templateid;	
	$results = $wpdb->get_row("select * from ".EMAIL_TEMPLATE_TABLE_NAME." where id = '$templateid' ");
	_e(($results->email_body));
	_e("<br>");
	_e("<a href='$updatelink' >Update Template</a>");
	exit;
}


 
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class EMAIL_TEMPLATE_LIST_Table extends WP_List_Table
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
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
          	'id' => __('ID', lps_wp),
			'template_for' => __('Email Template Title', lps_wp),	
			'email_subject' => __('Email Subject', lps_wp),					
			'status' => __('Status', lps_wp),
			'templateview' => __('View Template', lps_wp),
			'type' => __('Email Type', lps_wp),
			'action_update' => __('Action', lps_wp),
				
			
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
		'template_for' => array('template_for', true),
		'email_subject' => array('email_subject', true),
			'type' => array('type', true),
		'status' => array('status', true),
		
		
		
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
			'active' => 'Mark Active',
			'deactive' => 'Mark Deactive',
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
        $table_name = EMAIL_TEMPLATE_TABLE_NAME; // do not forget about tables prefix

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
		if ('active' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query(" Update $table_name set status='active' WHERE id IN($ids)");
            }
        }
		
		if ('deactive' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {				
                $wpdb->query(" Update $table_name set status='deactive' WHERE id IN($ids)");
            }
        }
		
		if('pdf' === $this->current_action()) {
			
			
		}
    }
    
    function get_store_list(){
         global $wpdb;
         $table_name = EMAIL_TEMPLATE_TABLE_NAME; // do not forget about tables prefix  
         $total_items = 0;
         //$per_page=5;
         //$this->_per_page = 5;
        $this->_per_page = $this->get_per_page();        
        /* Check if we need to run the search query or just show all the data */
		
		
	
		
        if ( isset( $_GET['s'] )  ) {
            $search = trim( $_GET['s'] ); //exit;
			
            $result = $wpdb->get_results( 
                            $wpdb->prepare( "SELECT * FROM $table_name  WHERE type LIKE '%" . like_escape( $search ). "%' || email_subject LIKE '%" . like_escape( $search ). "%' ||  template_for LIKE '%" . like_escape( $search ). "%' ",''), ARRAY_A 
                            );
        } else {
            /* Order params */
            $orderby   = !empty ( $_GET["orderby"] ) ? esc_sql ( $_GET["orderby"] ) : 'id';
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
		if(!is_array($result))
		{
			$result = array();
		}
		
        foreach($result  as $dataresult)
		{
			$newdata[$counter]	=$dataresult;
						
					$newdata[$counter]['type']="<strong>".ucfirst($dataresult['type'])."</strong>";
			
			if($dataresult['status']=='active')
			{				
					$newdata[$counter]['status']="<span style='color:green;'><strong>".ucfirst($dataresult['status'])."</strong></span>";
			}elseif($dataresult['status']=='deactive')
			{				
				$newdata[$counter]['status']="<span style='color:red;'><strong>".ucfirst($dataresult['status'])."</strong></span>";
			}
			$templateid = $dataresult['id'];
			$newdata[$counter]['action_update']="<a class='button-primary' href='".admin_url()."?page=lps-email-template&template_id=$templateid'>Edit</a>";
			
			$templatelink = admin_url()."?action=viewtemplate&id=".$templateid;
			
			$newdata[$counter]['templateview']="<strong><a href='".$templatelink."' target='_blank'>View Template</a></strong>";
			
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
        $table_name = NEWSLETTER_SUBSCRIBER_TABLE_NAME; // do not forget about tables prefix

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