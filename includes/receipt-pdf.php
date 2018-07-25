<?php  

require_once (TEMPLATEPATH . '/includes/pdf/dompdf_config.inc.php');


$receiptid = $_REQUEST['receiptid'];
ob_start();
 view_receipt($receiptid);

$strdata=ob_get_contents();
ob_end_clean();
 $data = "";
	
$data = $strdata;

$dompdf = new DOMPDF();



	$dompdf->load_html($data);
	$dompdf->set_paper('a4', 'landscape');
	$dompdf->render();
	 

	$time=time();
  $dompdf->stream("user_receipt_".$receiptid.".pdf", array("Attachment" => true));

  exit(0);

?>