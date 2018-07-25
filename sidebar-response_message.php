<?php
if(isset($_GET['response']))
{
	if($_GET['response']=='true')
	{
		global $successmessage;	
		_e($successmessage);
	}
	if($_GET['response']=='false')
	{	
		global $errormessage;
		_e($errormessage);		
	}
	if($_GET['response']=='feedback_success')
	{	
		global $feedbacksuccessmsg;
		_e($feedbacksuccessmsg);		
	}
	if($_GET['response']=='checkmail')
	{	
		global $registrationmessagesuccess;
		_e($registrationmessagesuccess);		
	}
	
	
}



?>