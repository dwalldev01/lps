<?php 
global $wpdb;
$referer = $_REQUEST['referer'];
$user_email=$_REQUEST['user_email'];
$dateadded = time();
$query="select user_email from ".$wpdb->prefix."newsletter where  user_email='$user_email'";
$oldmail=$wpdb->get_var($query);
if($oldmail=='')
{
	$_SESSION['message']='<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Congratulation! </strong> You have successfully subscribe to our newsletter.
</div>';
 $insertquery="insert into ".$wpdb->prefix."newsletter set user_email='$user_email', status='active', dateadded='$dateadded'  ";

$wpdb->query($insertquery);	
$referer.="?response=true";
}else
{
	$_SESSION['message']='<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong> </strong> Your email is already registered in our newsletter subscriber list.
</div>';
$referer.="?response=false";
}
wp_redirect($referer);

exit;
?>