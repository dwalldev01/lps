<?php  

$strdata = "";

$row=7;
$row2=6;


	global $wpdb;

$searchquery=" where 1=1 ";
$startcourse=array();
$endcourse=array();
if($_REQUEST['startdate']!='')
{
	$startdate=$_REQUEST['startdate'];
	$searchquery .=	" && meta_key='scheduled_course_settings_start-date' &&  meta_value >='".$startdate."' ";
	
$startresults = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}postmeta  $searchquery ", OBJECT );

	foreach($startresults as $result )
	{
		$startcourse[]=$result->post_id;
		
	}
	
}
$searchendquery=" where 1=1 ";
if($_REQUEST['enddate']!='')
{
	$enddate=$_REQUEST['enddate'];

	//$searchendquery .=	" && meta_value <=".$enddate." ";
	$searchendquery .=	" && meta_key='scheduled_course_settings_end-date' && meta_value <='".$enddate."' ";

$endresults = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}postmeta  $searchendquery ", OBJECT );
	foreach($endresults as $endresult )
	{
		$endcourse[]=$endresult->post_id;		
	}
}


$postsinfos= array();
$postsinfos = array_unique(array_merge($startcourse,$endcourse));
         
        $strdata .="";
$strdata .="<table border='1' width='100%'>
<tr  ><td  colspan=$row height=70><img src='".get_bloginfo('template_url')."/images/logo-primary.png'  width=300 /><br><br></td></tr>
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
$time=time();
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=course_management_report_".$time.".xls");

header("Pragma: no-cache");

header("Expires: 0");

echo "$data";

exit;

?>