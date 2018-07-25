<?php  

require_once (TEMPLATEPATH . '/includes/pdf/dompdf_config.inc.php');

$strdata = "";

$row=7;
$row2=6;

	global $wpdb;

$searchquery=" where 1=1 && meta_key='scheduled_course_settings_start-date' ";
$startcourse=array();
$endcourse=array();

if($_REQUEST['startdate']!='')
{
	$startdate=$_REQUEST['startdate'];
	$searchquery .=" && meta_value  >='".$startdate."' ";
	
}

if($_REQUEST['enddate']!='')
{
	$enddate=$_REQUEST['enddate'];
	$searchquery .=" && meta_value  <='".$enddate."' ";
}
	
		

$startresults = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}postmeta  $searchquery ", OBJECT );

	foreach($startresults as $result )
	{
		$startcourse[]=$result->post_id;
		
	}
	

$postsinfos= array();
$postsinfos = $startcourse;
         
        $strdata .="<img src='".get_template_directory()."/images/logo-primary.png' width=300 /><br><br>";
$strdata .="<table border='1' width='100%'>

	 <tr align='center' ><td  colspan=$row style=background-color:#D5C9BB;font-size:16px;><strong>COURSE SCHEDULE MANAGEMENT</strong></td></tr>";
	 
 if($_REQUEST['startdate']!='')
	{
		$strdata .="<tr  ><td align='center'>Start Date</td><td  colspan=$row2 style=background-color:#D5C9BB;font-size:16px;><strong>&nbsp; ".date('d M, Y',strtotime($_REQUEST['startdate']))." </strong></td></tr>";
	}
 if($_REQUEST['enddate']!='')
	{
		$strdata .="<tr  ><td align='center'> End Date Date</td><td  colspan=$row2 style=background-color:#D5C9BB;font-size:16px;><strong>&nbsp; ".date('d M, Y',strtotime($_REQUEST['enddate']))."</strong></td></tr>";
	}
	$strdata .="<tr align='center' ><td  style=background-color:#D5C9BB;font-size:16px;><strong>S.No</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Course Category</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Scheduled Course</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Venue</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Start Date</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>End Date</strong></td>
		<td  style=background-color:#D5C9BB;font-size:16px;><strong>Remark</strong></td>
	
	</tr>";
	$i=0;
						//$currentcourseid= $_REQUEST['courseid'];
						// cm_get_dropdown_scheduled_course($currentcourseid);
						// exit;

 $i=0;  
$total=0; 
foreach ($postsinfos as $postid)
{	

$course_category_id = get_post_meta($postid,'_cm_course_category',true);

$args = array(
    'taxonomy'               => 'course_category',
    'orderby'                => 'name',
    'order'                  => 'ASC',
    'hide_empty'             => false,
);
$the_query = new WP_Term_Query($args);
foreach($the_query->get_terms() as $term){ 

	if($term->term_id==$course_category_id)
	{		
		$course_category_name= $term->name;
	}
}

$courseid = get_post_meta($postid,'_cm_course_id',true);
$courseinfo = get_post($courseid);


	
$venue=get_post_meta($postid,'scheduled_course_settings_address',true);
$startdate=get_post_meta($postid,'scheduled_course_settings_start-date',true);
$enddate=get_post_meta($postid,'scheduled_course_settings_end-date',true);

	if($color == "#DCDEE5")
			$color = "#FFFFFF";
		else
			$color = "#DCDEE5";
	
			 $i++; 
		
			$strdata .= "<tr align='center'  >";
		
		$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $i . "</td>	";
	$strdata .= "<td style=background-color:".$color.";padding:3px; >". $course_category_name . "</td>";
		$strdata .= "<td style=background-color:".$color.";padding:3px; >". $courseinfo->post_title . "</td>";
		$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $venue . "</td>";
		$strdata .= "<td style=background-color:".$color.";padding:3px; >". date('d M, Y',strtotime($startdate))."</td>";
		$strdata .= "<td style=background-color:".$color.";padding:3px; >". date('d M, Y',strtotime($enddate))."</td>";

$strdata .= "<td style=background-color:".$color.";padding:3px; ></td>	";
		$strdata .="</tr>" ;

		 
}		   

$strdata .="</table></body>
</html>";
 $data = "";
	
 $data = $strdata;

$dompdf = new DOMPDF();



	$dompdf->load_html($data);
	$dompdf->set_paper('a4', 'landscape');
	$dompdf->render();
	 

	$time=time();
  $dompdf->stream("course_management_report_".$time.".pdf", array("Attachment" => true));

  exit(0);

?>