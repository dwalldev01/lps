<?php  

require_once (TEMPLATEPATH . '/includes/pdf/dompdf_config.inc.php');

$strdata = "";

$row=6;
$row2=5;

$strdata2 .='<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
			@page {
        margin-top: 149px;
        margin-left: 2px;
        margin-bottom: 40px;
        margin-right: 2px;
        size: landscape;
        counter-increment: page;

     @bottom-right {
padding-right:20px;
        content: "Page " counter(page);
      }

    }
        </style></head>
    <body><header></header><footer>header code</footer>';
         
        $strdata .="<img src='".get_template_directory()."/images/logo-primary.png' width=300 /><br><br>";
$strdata .="<table border='1' width='100%'>

	 <tr align='center' ><td  colspan=$row style=background-color:#D5C9BB;font-size:16px;><strong>Payment  Details By Date</strong></td></tr>";
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
$strdata .="</table></body>
</html>";
 $data = "";
	
$data = $strdata;

$dompdf = new DOMPDF();



	$dompdf->load_html($data);
	$dompdf->set_paper('a4', 'landscape');
	$dompdf->render();
	 

	$time=time();
  $dompdf->stream("payment_report_".$time.".pdf", array("Attachment" => true));

  exit(0);

?>