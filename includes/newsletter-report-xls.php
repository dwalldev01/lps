<?php  

$strdata = "";

$row=4;
$row2=3;
$strdata .="<table border='1' width='100%'>";


$strdata .="<tr  ><td  colspan=$row height=70><img src='".get_bloginfo('template_url')."/images/logo-primary.png'  width=300 /><br><br></td></tr>";
	$strdata .=" <tr align='center' ><td  colspan=$row style=background-color:#D5C9BB;font-size:16px;><strong>Newsletter Subscriber List</strong></td></tr>";
	 if($_REQUEST['startdate']!='')
{
$strdata .="<tr  ><td align='center'>Start Date</td><td  colspan=$row2 style=background-color:#D5C9BB;font-size:16px;><strong>&nbsp; ".date('d M, Y',strtotime($_REQUEST['startdate']))." </strong></td></tr>";
}
 if($_REQUEST['enddate']!='')
{
$strdata .="<tr  ><td align='center'> End Date Date</td><td  colspan=$row2 style=background-color:#D5C9BB;font-size:16px;><strong>&nbsp; ".date('d M, Y',strtotime($_REQUEST['enddate']))."</strong></td></tr>";
}	
	$strdata .="<tr align='center' ><td  style=background-color:#D5C9BB;font-size:16px;><strong>S.No</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Email</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Status</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Date</strong></td>
	
	</tr>";
	$i=0;
global $wpdb;	

$table_name=NEWSLETTER_SUBSCRIBER_TABLE_NAME;
$searchkeyword=$_REQUEST['s'];


$searchquery=" where 1=1 ";
if($_REQUEST['startdate']!='')
{
	$startdate=strtotime($_REQUEST['startdate']. "00:00:00");
	$searchquery .=	" &&  dateadded >=".$startdate." ";
}
if($_REQUEST['enddate']!='')
{
	$enddate=strtotime($_REQUEST['enddate']. "23:59:59");

	$searchquery .=	" && dateadded <=".$enddate." ";
}

if($searchkeyword!='')
{
	
	// $searchquery .=	" &&  ( `user_email` LIKE '%$searchkeyword%')";
}
 
$results = $wpdb->get_results( "SELECT * FROM $table_name $searchquery order by id desc ", ARRAY_A );    
 $i=0;  
$total=0; 
foreach ($results as $result)
{
	
	if($color == "#DCDEE5")
			$color = "#FFFFFF";
		else
			$color = "#DCDEE5";
	
			 $i++; 
		
			$strdata .= "<tr align='center'  >";
			
		
			
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $result['id']  . "</td>	";
		
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $result['user_email'] . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  ucfirst($result['status']) . "</td>";
		
	$strdata .= "<td align='center' style=background-color:".$color.";padding:3px; > ".date("d M, Y h:i:s", ($result['dateadded']))."</td>";

		$strdata .="</tr>" ;

		 
}		   

$strdata .="</table>";

$data = "";



$data = $strdata;


$time=time();
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=newsletter_subscriber_list_".$time.".xls");

header("Pragma: no-cache");

header("Expires: 0");

echo "$data";

exit;
?>