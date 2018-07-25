<?php 

$referer= $_REQUEST['referer'];

	if(isset($_REQUEST['user_email']) && $_REQUEST['user_email']!='')
	{
		$feedback_title = $_REQUEST['feedback_title'];
		$user_name = $_REQUEST['user_name'];
		$user_email = $_REQUEST['user_email'];
		$user_message = stripslashes($_REQUEST['user_message']);
		$to = get_option('admin_contact_email');
		// $to='dwalldev01@gmail.com';
		$subject="New Feedback Submitted at LPS Training Services Website";
		$message="Dear admin,<br><br> A New Feedback Submitted at your website (".get_option('siteurl').")<br><br>";
		$message.="Feedback Title : ".$feedback_title;
		$message.="<br><br>Name : ".$user_name;
		$message.="<br><br>Email ID : ".$user_email;
		$message.="<br><br>Message: ".$user_message;
		
		
		wp_mail( $to, $subject, $message);
		wp_redirect($referer."?response=feedback_success");
		exit;		
	} 


?>