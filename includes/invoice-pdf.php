<?php  

require_once (TEMPLATEPATH . '/includes/pdf/dompdf_config.inc.php');


$invoiceid = $_REQUEST['invoiceid'];
ob_start();
 view_invoice($invoiceid);

$strdata=ob_get_contents();
ob_end_clean();
 $data = "";
	
$data = $strdata;

$dompdf = new DOMPDF();



	$dompdf->load_html($data);
	$dompdf->set_paper('a4', 'landscape');
	$dompdf->render();
	 
            
	$time=time();
  $dompdf->stream("user_invoice_".$invoiceid.".pdf", array("Attachment" => true));

  exit(0);

?>