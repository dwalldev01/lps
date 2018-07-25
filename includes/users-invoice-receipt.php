<?php 

function view_invoice($invoiceid)
{
	
global $wpdb;
$tableprfix = $wpdb->prefix;
$invoicequery="select * from ".INVOICE_TABLE." where payment_id='$invoiceid' ";
$invoiceinfo = $wpdb->get_row($invoicequery);	
/*
echo "<pre>";
print_r($invoiceinfo);
exit; */
$unit=1;

$courseinfo = get_post($invoiceinfo->item_number);
//print_r($courseinfo);
	?>

	<div class="wrap">

 <div id="invoice">
    <head>
   
         <style type="text/css">
        body {      
            font-family: Verdana;
        }
         
        div.invoice {
        border:1px solid #ccc;
        padding:10px;
        height:auto;
        width:600pt;
		margin: 0 auto;
        }
 
        div.company-address {
           
            float:left;
            width:200pt;
        }
         
        div.invoice-details {
           
            float:right;
            width:200pt;
        }
         
        div.customer-address {
        
           
            margin-bottom:50px;
            margin-top:10px;
            width:200pt;
        }
         
        div.clear-fix {
            clear:both;
            float:none;
        }
         
        table {
            width:100%;
        }
         
        th {
            text-align: left;
			padding-left:10px;
        }
         
        td {
        }
         
		table tbody td {
    padding: 5px 10px;
}
        .text-left {
            text-align:left;
        }
         
        .text-center {
            text-align:center;
        }
         
        .text-right {
            text-align:right;
        }
         
        </style>
    </head>
 
    <body>
	
    <div class="invoice" id="invoice">
	 <table border='0' cellspacing='0'>
	 <tr>
	  <td width="70%">  
	  <?php if($_REQUEST['action']=='download_invoice') { ?>
<img src='<?php _e(get_template_directory()); ?>/images/invoice_logo.png'  />
<?php }else { ?>
	 <img src="<?php bloginfo('template_url');?>/images/invoice_logo.png" >
<?php } ?><br /> 
<strong>Address :</strong> <?php _e(get_option('cm_address'));?><br />
<strong>Tell Off:</strong> <?php _e(get_option('cm_invoice_contact'));?><br />

<strong>Email :</strong> <?php _e(get_option('invoice_contact_email'));?><br />
<strong>Website :</strong> <?php _e(get_option('cm_website'));?>

		</td>
	
	  <td valign="top">  
	   <h1><strong><?php _e("Invoice"); ?> </strong></h1>
	  <strong>UEN :</strong> <?php _e(get_option('cm_company_registration_number'));?><br />
			<strong>GST :</strong> <?php _e(get_option('cm_tax_registration_number'));?><br />
			

	 </td>
	 </tr>
	
	 </table><div style="border: 1px solid #000;margin-top:30px;">
   <table border='0' cellspacing='0'>
	 <tr>
	  <td  >  
			
           <span style="float:left"><strong> Invoice No:</strong> <?php _e($invoiceinfo->payment_id);?></span></td>
		   <td align="right">
           
  <span style="float:right"> <strong>Invoice Date:</strong> <?php _e(date('d M, Y'),strtotime($invoiceinfo->date));?></span>
	 </td>
	 </tr>
	
	 </table></div>
		 <div class="clear-fix"></div>
       
         <hr>
 <div class="clear-fix"></div>
              
	   <div class="customer-address">
            To:
            <br />
			
			<?php if($invoiceinfo->full_name!='') { ?>
            <?php _e($invoiceinfo->full_name);?><br />
			<?php } ?>
			
			<?php if($invoiceinfo->mobile!='') { ?>
            <?php _e($invoiceinfo->mobile);?><br />
			<?php } ?>
			
			<?php if($invoiceinfo->payer_email!='') { ?>
            <?php _e($invoiceinfo->payer_email);?><br />
			<?php } ?>
			
        </div>
          <br/>
        <div class="clear-fix"></div>
                
            <table border='1' cellspacing='0'>
                <tr>
                    <th width=250>Description</th>
                    <th width=80>Qty</th>
                    <th width=100>Unit price</th>
                    <th width=100>Total price</th>
                </tr>
 
            <tr><td><?php _e($courseinfo->post_title);?></td><td class='text-center'><?php _e($unit);?></td><td class='text-right'><?php _e(get_option('cm_currency'));?><?php _e(number_format(get_post_meta($courseinfo->ID,'scheduled_course_settings_full-payment',true),2));?></td><td class='text-right'><?php _e(get_option('cm_currency'));?><?php _e(number_format(get_post_meta($courseinfo->ID,'scheduled_course_settings_full-payment',true),2));?></td></tr>
			
			<tr><td colspan='3' class='text-right'>Sub total</td><td class='text-right'><?php _e(get_option('cm_currency'));?><?php _e(number_format(get_post_meta($courseinfo->ID,'scheduled_course_settings_full-payment',true),2));?></td></tr>
			<?php if(get_option('cm_singapore_tax')) { ?>
			<tr><td colspan='3' class='text-right'>Tax(<?php _e(get_option('cm_singapore_tax'));?>%)</td><td class='text-right'><?php _e(get_option('cm_currency'));?>
			<?php 
			$totaltax=number_format(get_post_meta($courseinfo->ID,'scheduled_course_settings_full-payment',true)/100*get_option('cm_singapore_tax'),2);
			_e($totaltax);?>
			
			</td></tr>
			<?php } ?>
			<tr><td colspan='3' class='text-right'><b>GRAND TOTAL</b></td><td class='text-right'><b><?php _e(get_option('cm_currency'));?> <?php _e(number_format(get_post_meta($courseinfo->ID,'scheduled_course_settings_full-payment',true)+$totaltax,2));?></b></td></tr>

            </table><br><br>
			<strong>Terms & Condition</strong><br>
Payment should be made to “LPS TRAINING SERVICES” and write the invoice number behind the cheque and deliver or send to the above address.<br>
Please send the payment with in 15 days or as per-contract, of receiving the invoice. 

                    </div>
    </body>
 </div>
</div>

	<?php
	
}
function view_receipt($receiptid)
{	
global $wpdb;
$tableprfix = $wpdb->prefix;
$receiptquery="select * from ".RECEIPT_TABLE." where id='$receiptid' ";
$receiptinfo = $wpdb->get_row($receiptquery);	
$invoiceid= $receiptinfo->invoice_id;
$invoicequery="select * from ".INVOICE_TABLE." where payment_id='$invoiceid' ";
$invoiceinfo = $wpdb->get_row($invoicequery);	

/*
echo "<pre>";
print_r($invoiceinfo);
exit; */
$unit=1;

$courseinfo = get_post($invoiceinfo->item_number);
//print_r($courseinfo);
	?>

	<div class="wrap">

 <div id="invoice">
    <head>
   
         <style type="text/css">
        body {      
            font-family: Verdana;
        }
         
        div.invoice {
        border:1px solid #ccc;
        padding:10px;
        height:auto;
        width:600pt;
		margin: 0 auto;
        }
 
        div.company-address {
           
            float:left;
            width:200pt;
        }
         
        div.invoice-details {
           
            float:right;
            width:200pt;
        }
         
        div.customer-address {
        
           
            margin-bottom:50px;
            margin-top:10px;
            width:200pt;
        }
         
        div.clear-fix {
            clear:both;
            float:none;
        }
         
        table {
            width:100%;
        }
         
        th {
            text-align: left;
			padding-left:10px;
        }
         
        td {
        }
         
		table tbody td {
    padding: 5px 10px;
}
        .text-left {
            text-align:left;
        }
         
        .text-center {
            text-align:center;
        }
         
        .text-right {
            text-align:right;
        }
         
        </style>
    </head>
 
    <body>
	
    <div class="invoice" id="invoice">
	 <table border='0' cellspacing='0'>
	 <tr>
	  <td width="70%">  
	  <?php if($_REQUEST['action']=='download_receipt') { ?>
<img src='<?php _e(get_template_directory()); ?>/images/invoice_logo.png'  />
<?php }else { ?>
	 <img src="<?php bloginfo('template_url');?>/images/invoice_logo.png" />
<?php } ?><br /> 
<strong>Address :</strong> <?php _e(get_option('cm_address'));?><br />
<strong>Tell Off:</strong> <?php _e(get_option('cm_invoice_contact'));?><br />

<strong>Email :</strong> <?php _e(get_option('invoice_contact_email'));?><br />
<strong>Website :</strong> <?php _e(get_option('cm_website'));?>

		</td>
	
	  <td valign="top">  
	   <h1><strong><?php _e("Receipt"); ?> </strong></h1>
	  <strong>UEN :</strong> <?php _e(get_option('cm_company_registration_number'));?><br />
	  <strong>GST :</strong> <?php _e(get_option('cm_tax_registration_number'));?><br />
			

	 </td>
	 </tr>
	
	 </table><div style="border: 1px solid #000;margin-top:30px;">
   <table border='0' cellspacing='0'>
	 <tr>
	  <td  >  
			
           <span style="float:left"><strong> Receipt No:</strong> <?php _e($receiptinfo->id);?></span></td>
		   <td align="right">
           
  <span style="float:right"> <strong>Receipt Date:</strong> <?php _e(date('d M, Y'),strtotime($receiptinfo->dateadded));?></span>
	 </td>
	 </tr>
	
	 </table></div>
		 <div class="clear-fix"></div>
       
         <hr>
 <div class="clear-fix"></div>
              
	   <div class="customer-address">
            To:
            <br />
			
			<?php if($invoiceinfo->full_name!='') { ?>
            <?php _e($invoiceinfo->full_name);?><br />
			<?php } ?>
			
			<?php if($invoiceinfo->mobile!='') { ?>
            <?php _e($invoiceinfo->mobile);?><br />
			<?php } ?>
			
			<?php if($invoiceinfo->payer_email!='') { ?>
            <?php _e($invoiceinfo->payer_email);?><br />
			<?php } ?>
			
        </div>        
        <div class="clear-fix"></div>
                
            <table border='1' cellspacing='0'>
                <tr>
                    <th>Description</th>
                    <th>Invoice No</th>
                   
                    <th>Total Amount</th>
                </tr>
 
            <tr><td><?php _e($courseinfo->post_title);?></td>
			<td class='text-center'><?php _e($receiptinfo->invoice_id);?></td>
			
			
			<td class='text-right'><?php _e(get_option('cm_currency'));?><?php _e(number_format($receiptinfo->total_amount,2));?></td></tr>
			<tr><td colspan='2' class='text-right'><b>Payment Method</b></td><td class='text-right'><b><?php _e(ucfirst($receiptinfo->payment_method));?> </b></td></tr>
			<?php if($receiptinfo->payment_method=='online') { ?>
			<tr><td colspan='2' class='text-right'><b>Transaction ID</b></td><td class='text-right'><b><?php _e($receiptinfo->txn_id);?> </b></td></tr>
			<?php } ?>
			<?php if($receiptinfo->payment_method=='cheque') { ?>
			<tr><td colspan='2' class='text-right'><b>Cheque No</b></td><td class='text-right'><b><?php _e($receiptinfo->cheque_number);?> </b></td></tr>
			<tr><td colspan='2' class='text-right'><b>Cheque Date</b></td><td class='text-right'><b><?php _e(date("d M, Y",strtotime($receiptinfo->cheque_date)));?> </b></td></tr>
			<?php } ?>
			<tr><td colspan='2' class='text-right'><b>GRAND TOTAL</b></td><td class='text-right'><b><?php _e(get_option('cm_currency'));?> <?php _e(number_format($receiptinfo->total_amount,2));?></b></td></tr>

            </table><br><br>
			<br>
<p align="center"><strong>Thank for choosing LPS Training Services</strong></p>

                    </div>
    </body>
 </div>
</div>

	<?php
	
}
?>