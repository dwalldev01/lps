<?php  


$strdata = "";

$row=3;
$row2=2;

$courseid= $_REQUEST['courseid'];
$datequery="select attendance_date from ".ATTENDANCE_TABLE." where course_id='$courseid' group by attendance_date order by attendance_date asc";
$dateresults = $wpdb->get_results( $datequery, ARRAY_A ); 

$row = 3+count($dateresults);
$row2=2+count($dateresults);
$cm_course_id=get_post_meta($courseid,'_cm_course_id',true);
$venue =get_post_meta($courseid,'scheduled_course_settings_address',true);
$courseinfo = get_post($cm_course_id);
$startdate=get_post_meta($courseid,'scheduled_course_settings_start-date',true);
$enddate=get_post_meta($courseid,'scheduled_course_settings_end-date',true);

$searchquery=" where 1=1 ";

$searchquery .= " && item_number='$courseid'";
global $wpdb;	

$table_name=PAYMENT_TABLE_NAME;


 $coursecatname = $wpdb->get_var( "SELECT coursecategory FROM $table_name $searchquery limit 0,1 ");    


$strdata .="<table border='1' width='100%'>";
$strdata .="<tr  ><td  colspan=$row height=70><img src='".get_bloginfo('template_url')."/images/logo-primary.png'  width=300 /><br><br></td></tr>
	 <tr align='center' ><td  colspan=$row style=background-color:#D5C9BB;font-size:16px;><strong>Participants  Attendance</strong></td></tr>";
	 
$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Course Category</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".$coursecatname." </strong></td></tr>";

$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Enrolled Course</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".$courseinfo->post_title."</strong></td></tr>";
$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Venue</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".$venue."</strong></td></tr>";

$strdata .="<tr  ><td align='center' style='background-color:#D5C9BB;'>Course Date</td><td  colspan=$row2 style=font-size:16px;><strong>&nbsp; ".date("d<\s\up>S</\s\up> M, Y",strtotime($startdate))." to ".date("d<\s\up>S</\s\up> M, Y",strtotime($enddate))." </strong></td></tr>";	

	$strdata .="<tr align='center' ><td  style=background-color:#D5C9BB;font-size:16px;><strong>S.No</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Full Name</strong></td>
	<td  style=background-color:#D5C9BB;font-size:16px;><strong>Email</strong></td>";
	

foreach ($dateresults as $dateinfo)
{	
	$strdata .= "<td style=background-color:#D5C9BB;font-size:16px;><strong>Date:".date("d M Y",strtotime($dateinfo['attendance_date']))."</strong></td>";
}
	"</tr>";
	$i=0;

$searchquery=" where 1=1 ";

$searchquery .= " && course_id='$courseid'";

$results = $wpdb->get_results( "SELECT * FROM ".STUDENT_INFO_TABLE." $searchquery order by id desc ", ARRAY_A ); 
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
			
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $i . "</td>	";
		
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  ucwords($result['full_name']) . "</td>";
			$strdata .= "<td style=background-color:".$color.";padding:3px; >".  $result['user_email'] . "</td>";
			
			
	foreach ($dateresults as $dateinfo)
{	
		$strdata .= "<td>";
		$attendance_date = $dateinfo['attendance_date'];
		$uid= $result['id'];
		$attendancequery="select status from ".ATTENDANCE_TABLE." where uid='$uid' && attendance_date='$attendance_date'";
		$attendanceresults=$wpdb->get_results($attendancequery, ARRAY_A ); 
		foreach($attendanceresults as $attendance)
		{
			if($attendance['status']=='p')
			{
				$strdata .="<span style='color:green'><strong>Present </strong></span>";
			}elseif($attendance['status']=='a')
			{
				$strdata .="<span style='color:red'><strong>Absent </strong></span>";
			}elseif($attendance['status']=='mc')
			{
				$strdata .="<span style='color:orange'><strong>MC</strong></span>";
			}elseif($attendance['status']=='ul')
			{
				$strdata .="<span style='color:blue'><strong>UL</strong></span>";
			}
			//$strdata .=$attendance['status'];
			
		}
	
	$strdata .= "</td>";
}	


		$strdata .="</tr>" ;

		 
}		   

$strdata .="</table></body>
</html>";
 $data = "";
	
$data = $strdata;


$time=time();
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=participants_attendance_report_".$courseid."_".$time.".xls");

header("Pragma: no-cache");

header("Expires: 0");

echo "$data";

exit;

?>