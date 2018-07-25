<?php
function send_enrolment_confirmation_mail($to,$data)
{
	if(!is_array($data))
	{
		$data = array(); 
	}
	
	$body=get_email_template('enrolment_confirmation');
	$emailbody=nl2br($body);
	$mailsubject = 'Enrolment Confirmation Mail';
	$templatevariables = array('##COURSE_TITLE##','##USERNAME##','##LOCATION##','##START_COURSE_DATE##','##START_COURSE_TIME##','##PAYMENT_STATUS##');
	$replacecontent = array($data['course_title'],$data['username'],$data['location'],$data['start_course_date'],$data['start_course_time'],$data['payment_status']);
	$message=str_replace($templatevariables,$replacecontent,$emailbody);
	
	
	wp_mail( $to, $mailsubject, $message);

}

function send_payment_reminder_mail($to,$data,$attachments)
{
	if(!is_array($data))
	{
		$data = array(); 
	}
	
	foreach($attachments as $attach){
	    
	   $filepath =  $attach;
	}
	
	
	  $headers .= "MIME-Version: 1.0" ;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit";
    $headers .= "This is a MIME encoded message.";
	
	$body=get_email_template('reminder_pending_payment');
	$emailbody=nl2br($body);
	$mailsubject = 'Reminder Pending Payment';
	$templatevariables = array('##COURSE_TITLE##','##USERNAME##','##LOCATION##','##START_COURSE_DATE##','##START_COURSE_TIME##','##PAYMENT_STATUS##');
	$replacecontent = array($data['course_title'],$data['username'],$data['location'],$data['start_course_date'],$data['start_course_time'],$data['payment_status']);
	$message.=str_replace($templatevariables,$replacecontent,$emailbody);
	$message.= "<a href=".$filepath."> Download Invoice Here </a>";



		
	wp_mail( $to, $mailsubject, $message,$attachments);
	
}

?>