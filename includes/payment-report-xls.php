<?php  

$strdata = "";

$row=6;
$row2=5;

$strdata .="<table border='1' width='100%'>";

$strdata .="<tr  ><td  colspan=$row height=70><img src='".get_bloginfo('template_url')."/images/logo-primary.png'  width=300 /><br><br></td></tr>";
	 $strdata .="<tr align='center' ><td  colspan=$row style=background-color:#D5C9BB;font-size:16px;><strong>Payment  Details By Date</strong></td></tr>";
	 if($_REQUEST['startdate']!='')
{
$strdata .="<tr  ><td align='center'>Start Date</td><td  colspan=$row2 style=background-color:#D5C9BB;font-size:16px;><strong>&nbsp; ".date('d M, Y',strtotime($_REQUEST['startdate']))." </strong></td></tr>";
}
 if($_REQUEST['enddate']!='')
{
$strdata .="<tr  ><td align='center'> End Date Date</td><td  colspan=$row2 style=background-color:#D5C9BB;font-size:16px;><strong>&nbsp; ".date('d M, Y',strtotime($_REQUEST['enddate']))."</strong></td></tr>";
}	
	$strdata .="<tr align='center' ><td  style=background-color:#D5C9BB;font-size:16px;><strong>S.No</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Name</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Invoice No</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Status</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Amount</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Payment Date</strong></td>
	</tr>";
	$i=0;
global $wpdb;	

$table_name=PAYMENT_TABLE_NAME;
$searchkeyword=$_REQUEST['s'];


$searchquery=" where 1=1 ";
if($_REQUEST['startdate']!='')
{
	$startdate="'".$_REQUEST['startdate']." 00:00:00'";
	$searchquery .=	" &&  date >=".$startdate." ";
}
if($_REQUEST['enddate']!='')
{
	$enddate="'".$_REQUEST['enddate']." 23:59:59'";

	$searchquery .=	" && date <=".$enddate." ";
}

if($searchkeyword!='')
{
	
	// $searchquery .=	" &&  ( coursecategory LIKE '%$searchkeyword%' OR `payer_email` LIKE '%$searchkeyword%')";
}

$results = $wpdb->get_results( "SELECT * FROM $table_name $searchquery order by payment_id desc ", ARRAY_A );    
 $i=0;  
$total=0; 
foreach ($results as $result)
{
	$total= $total+ $result['payment_gross'];
	if($color == "#DCDEE5")
			$color = "#FFFFFF";
		else
			$color = "#DCDEE5";
	
			 $i++; 
		
			$strdata .= "<tr align='center'  >";
			
		
			
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $i . "</td>	";
		
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  ucwords($result['full_name']) . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $result['payment_id'] . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $result['payment_status'] . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >$".   $result['payment_gross'] . "</td>";
	$strdata .= "<td align='center' style=background-color:".$color.";padding:3px; > ".date("d M, Y",strtotime($result['date']))."</td>";

		$strdata .="</tr>" ;

		 
}		   
$strdata .="<tr align='center' ><td colspan=4 align='right'  style=background-color:#D5C9BB;font-size:16px;><strong>Total&nbsp;&nbsp;&nbsp;</strong></td>
	
	
	<td colspan=2 align='left'  style=background-color:#D5C9BB;font-size:16px;><strong>&nbsp;&nbsp;&nbsp;$".$total."</strong></td>
	</tr>";
$strdata .="</table>";

$data = "";



$data = $strdata;

$time=time();
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=payment_report_".$time.".xls");

header("Pragma: no-cache");

header("Expires: 0");

echo "$data";

exit;

?>