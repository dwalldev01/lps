<?php  

require_once (TEMPLATEPATH . '/includes/pdf/dompdf_config.inc.php');

$strdata = "";

$row=6;
$row2=5;

$courseid= $_REQUEST['schedulecourse'];


$cm_course_id=get_post_meta($courseid,'_cm_course_id',true);
$venue =get_post_meta($courseid,'scheduled_course_settings_address',true);
$courseinfo = get_post($cm_course_id);
$startdate=get_post_meta($courseid,'scheduled_course_settings_start-date',true);

$searchquery=" where 1=1 ";

$searchquery .= " && item_number='$courseid'";
global $wpdb;	

$table_name=PAYMENT_TABLE_NAME;


 $coursecatname = $wpdb->get_var( "SELECT coursecategory FROM $table_name $searchquery limit 0,1 ");    


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

	 <tr align='center' ><td  colspan=$row style=background-color:#D5C9BB;font-size:16px;><strong>Payment Details By Course</strong></td></tr>";
	 
$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Course Category</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".$coursecatname." </strong></td></tr>";

$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Enrolled Course</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".$courseinfo->post_title."</strong></td></tr>";
$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Venue</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".$venue."</strong></td></tr>";

$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Course Start Date</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".date("d<\s\up>S</\s\up> M, Y",strtotime($startdate))."</strong></td></tr>";
		
	$strdata .="<tr align='center' ><td  style=background-color:#D5C9BB;font-size:16px;><strong>S.No</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Full Name</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Invoice No.</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Payment Status</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Amount</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Payment Date</strong></td>
	
	</tr>";
	$i=0;

$searchquery=" where 1=1 && rcpt.invoice_id=inv.payment_id ";

$searchquery .= " && inv.item_number='$courseid'";




$results = $wpdb->get_results( "SELECT rcpt.*,inv.full_name FROM ".RECEIPT_TABLE." rcpt,".INVOICE_TABLE." inv $searchquery order by payment_id desc ", ARRAY_A );    
 $i=0;  
$total=0; 
foreach ($results as $result)
{	
	$total= $total+ $result['total_amount'];
	if($color == "#DCDEE5")
			$color = "#FFFFFF";
		else
			$color = "#DCDEE5";
	
			 $i++; 
		
			$strdata .= "<tr align='center'  >";
			
		$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $i . "</td>	";
		
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  ucwords($result['full_name']) . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $result['invoice_id'] . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $result['payment_status'] . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".get_option('cm_currency').   $result['total_amount'] . "</td>";
	$strdata .= "<td align='center' style=background-color:".$color.";padding:3px; > ".date("d M, Y",$result['dateadded'])."</td>";

		$strdata .="</tr>" ;

		 
}		   
$strdata .="<tr align='center' ><td colspan=4 align='right'  style=background-color:#D5C9BB;font-size:16px;><strong>Total&nbsp;&nbsp;&nbsp;</strong></td>
	
	
	<td colspan=2 align='left'  style=background-color:#D5C9BB;font-size:16px;><strong>&nbsp;&nbsp;&nbsp;".get_option('cm_currency').$total."</strong></td>
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
  $dompdf->stream("payment_report_".$courseid."_".$time.".pdf", array("Attachment" => true));

  exit(0);

?>