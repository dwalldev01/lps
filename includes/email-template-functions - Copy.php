<?php
 require_once (TEMPLATEPATH . '/includes/email-template-table.class.php'); 
 
 class Email_Template {
	
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'lps_email_template_menu' ) );
		
	}
		public function lps_email_template_menu() {
		global $lps_email_page;
	
	$lps_email_page=add_menu_page('LPS Email Template', // page_title
			'Email Templates', // menu_title
			'manage_options', // capability
			'lps-email-template', // menu_slug
			array( $this, 'lps_email_menu_page' ), // function
			'dashicons-admin-site', // icon_url
			15 // position
			 );
	 
	}
	public function lps_email_menu_page()
	{		
	global $wpdb;
	if (isset( $_POST['action'] ) && $_POST['action']=='email_template_update'  &&  wp_verify_nonce( $_POST['email_template_form'], 'email_template_form'))
	{
		$id= $_REQUEST['id'];
		$template_for= $_REQUEST['template_for'];
		$email_subject= $_REQUEST['email_subject'];
		$email_body= $_REQUEST['email_template_body'];
		$email_help= $_REQUEST['email_help'];
		$status= $_REQUEST['status'];
		
		if($id!='' && $id !='new')
		{
			$query="update  ".EMAIL_TEMPLATE_TABLE_NAME." set  template_for='$template_for',email_subject='$email_subject',email_body='$email_body',email_help='$email_help',status='$status' where id='$id' ";
			
			$message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Email Template  "%s" updated', 'lps_wp'), $_REQUEST['template_for']) . '</p></div>';
		
		}else {
			$type= $_REQUEST['type'];
			$query="insert into  ".EMAIL_TEMPLATE_TABLE_NAME." set  template_for='$template_for',email_subject='$email_subject',email_body='$email_body',email_help='$email_help',type='$type',status='$status' ";	
			
			$message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Email Template  "%s" created', 'lps_wp'), $_REQUEST['template_for']) . '</p></div>';
		
		}
		$wpdb->query($query);
		
		
		_e($message);
		
	}
	
/////// Cdoe Starts for Creating Email Template List ////////
		if(isset($_REQUEST['template_id']) && $_REQUEST['template_id']!='' )
		{ 
	
	if($_REQUEST['template_id']=='new')
	{
		$template_id = $_REQUEST['template_id'];
		$template_for='';
		$email_subject='';
		$email_body='';
		$type= 'bulk';
		$status = '';
	}else { 
		$template_id = $_REQUEST['template_id'];
		$results = $wpdb->get_row("select * from ".EMAIL_TEMPLATE_TABLE_NAME." where id='$template_id'");
		$template_for=$results->template_for;
		$email_subject=$results->email_subject;
		$email_body=$results->email_body;
		$type= $results->type;
		$status = $results->status;
	}
	?>
		<div class="wrap">
   <div class="welcome-panel">
   <h1><?php _e("Update Email Template",'lps_wp'); ?></h1>
   
    <form method="post" action="<?php _e(admin_url());?>admin.php?page=<?php _e($_REQUEST['page']);?>" >
		<input type="hidden" value="<?php _e($template_id);?>" name="id" />
	<input type="hidden" value="email_template_update" name="action" />
       <?php wp_nonce_field( 'email_template_form', 'email_template_form' ); ?>
	  <input type="hidden" name="_wp_http_referer" value="<?php _e(admin_url());?>admin.php?page=<?php _e($_REQUEST['page']);?>" />   
	  <div class="postbox">
      
            <div class="inside">
          <div id="titlediv">
              <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method"><?php _e("Template Name :",'lps_wp'); ?></label>
                        </th>
                        <td>
                        <input type="text" id="title" <?php if($type=='auto') {?> readonly <?php } ?>  required  value="<?php _e($template_for);?>" name="template_for" >
                        </td>
                    </tr>
               </table>    
		  
		   <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method"><?php _e("Email Subject* :",'lps_wp'); ?></label>
                        </th>
                        <td>
                        <input type="text" id="title" required  value="<?php _e($email_subject);?>" name="email_subject" >
                        </td>
                    </tr>
               </table>
			   
		    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="payment_method"><?php _e("Email Body* :",'lps_wp'); ?></label>
                        </th>
                        <td>
                    <?php 
					$settings = array();
					wp_editor( $email_body, 'email_template_body', $settings ); ?> 
                        </td>
                    </tr>
               </table>
			    <table class="form-table">
                    <tr>
                     <th scope="row"><label for="firstname"><?php _e("Type* :",'lps_wp'); ?></label>
                        </th>
                        <td>
                         <select name="type" id="type" required <?php if($template_id!='new') { ?> readonly <?php } ?> >  
							<?php if($template_id!='new') { ?>
							<?php if($type=='auto') { ?>
							<option value="auto"  ><?php _e("Auto Email",'lps_wp'); ?></option>
							<?php } ?>
							<?php }?>
							<?php if($type=='bulk') { ?>  
							<option value="bulk" ><?php _e("Bulk Email",'lps_wp'); ?></option>
							<?php } ?>
                           </select>
                        </td>
                    </tr>
               </table>
           
			     <table class="form-table">
                    <tr>
                     <th scope="row"><label for="firstname"><?php _e("Status* :",'lps_wp'); ?></label>
                        </th>
                        <td>
                         <select name="status" id="status" required  >  
					
							<option value="deactive" <?php if($status=='deactive') { ?> selected <?php } ?> ><?php _e(" --- Deactive --- ",'lps_wp'); ?></option>
							<option value="active" <?php if($status=='active') { ?> selected <?php } ?>><?php _e(" --- Active --- ",'lps_wp'); ?></option>
                           </select>
                        </td>
                    </tr>
               </table>
           
               <p> <input class="button-primary" type="submit" name="settings_submit" value="Update Email Template">
                </p>
            </div>     
            </div>
      </div>
    </form>
  
	</div>
</div>
	
	
	
	<?php
		}else { 	
		$table = new EMAIL_TEMPLATE_LIST_Table();
    $table->prepare_items();
	 $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('%d Email template deleted. ', 'lps_wp'), count($_REQUEST['id'])) . '</p></div>';
    }
	?>
	<div class="wrap">
<a href='<?php _e(admin_url()."admin.php?page=lps-email-template&template_id=new");?>' class="button-primary" style="float:right"><?php _e("Add New Template");?></a>
<div class="clear"></div><br>
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
   
    <?php echo $message; 
	
	?>

    <form id="mlm-user-table" method="get">
	
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->search_box( 'search', 'search_id' );             ?>   
	 <?php $table->display(); ?>
    </form>

</div>
	
		<?php
		////// End of Code for Creating Email Template ////////
		}
		
	}
 }

if ( is_admin() )
	$lpsemail = new Email_Template();	 
?>