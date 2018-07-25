<?php  

require_once (TEMPLATEPATH . '/includes/pdf/dompdf_config.inc.php');

$strdata = "";

$row=5;
$row2=4;

	$startdate = $_REQUEST['startdate'];
	$enddate =    $_REQUEST['enddate'];



$strdata .="<table border='1' width='100%'>";
$strdata .="<tr  ><td  colspan=$row height=70><img src='".get_bloginfo('template_url')."/images/logo-primary.png'  width=300 /><br><br></td></tr>";
	$strdata .="<tr align='center' ><td  colspan=$row style=background-color:#D5C9BB;font-size:16px;><strong>Users Reports (Single or Cooperate)</strong></td></tr>";
	 
if($startdate!='' && $enddate!='' )
{	
$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Date</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".date("d<\s\up>S</\s\up> M, Y",strtotime($startdate))." to ".date("d<\s\up>S</\s\up> M, Y",strtotime($enddate))." </strong></td></tr>";
}
	$strdata .="<tr align='center' ><td  style=background-color:#D5C9BB;font-size:16px;><strong>S.No</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Name</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Email Address</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Date Registered</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Type</strong></td></tr>";

$i=0;  
$total=0; 

$allresults = get_users('role=lps_member&orderby=user_registered&order=DESC');
// Array of WP_User objects.

 $startdatefilter = $startdate." 00:00:00 ";
$enddatefilter = $enddate." 23:59:59 ";
$results=array();
if($startdate!='' || $enddate!='')	
		{
	foreach ($allresults as $user)
	{	if($startdate!='' && $enddate!='')	
		{
			if($startdatefilter<$user->user_registered && $enddatefilter>$user->user_registered )
			{			
				$results[]=$user;
			}
		}elseif($startdate!='')	
		{
			if($startdatefilter<$user->user_registered )
			{			
				$results[]=$user;
			}
		}elseif($enddate!='')	
		{
			if($enddatefilter>$user->user_registered )
			{			
				$results[]=$user;
			}
		}
	}	
}else
{
$results = $allresults;	
}
if($results)
{
foreach ($results as $user)
{	

	if($color == "#DCDEE5")
			$color = "#FFFFFF";
		else
			$color = "#DCDEE5";
	
			 $i++; 
		
			$strdata .= "<tr align='center'  >";
			
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $i . "</td>	";
		
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  ucwords($user->user_nicename) . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $user->user_email . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  date("d<\s\up>S</\s\up> M, Y",strtotime($user->user_registered)) . "</td>";
			
		if(get_user_meta($user->ID,'user_type',true)=='')
			{
				$strdata .= "<td style=background-color:".$color.";padding:3px; >Individual</td>";
			}else {
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  get_user_meta($user->ID,'user_type',true) . "</td>";
			}


		$strdata .="</tr>" ;

		 
}
}else
{	
	$strdata .="<tr><td colspan='5' align=center>Sorry no users found</td></tr>" ;
}	

$strdata .="</table></body>
</html>";
 $data = "";
	
	
$data = $strdata;


$time=time();
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=users_report_".$time.".xls");

header("Pragma: no-cache");

header("Expires: 0");

echo "$data";

exit;


?>