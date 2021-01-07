<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/header.php'); ?>

<style type="text/css">
#calendar {
	border-collapse:collapse;
}

.today {
	font-weight:bold;
	color:#990000;
}
	
#calendar td {
	height:75px;
	width: 105px;
	border:1px solid #333;
	text-align:left;
	vertical-align:top;
}

div.rightCorner {
	text-align:right;
	width:100%;
	background-color:#CCC;
}

.desc {
	font-size:10px;
	padding: 2px;
}
</style>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
		
	$("#calendar td").hover(
		function () { 
			$(this).addClass('lowlight');
		}, 
		function () {
			$(this).removeClass('lowlight');
		}
	);
	
	//$('#calendar td').click( function() {
		//alert('hey');
	//});
});
</script>
<center>
<?php
// BEGIN: get date information for calendar at hand
if (isset($_GET['month']) && isset($_GET['year'])) {

	// validate url info is alpha-numeric and is the proper length
	$cleanArray = array();
	$message = 'There was an error processing your request. Please hit your back button and retry.';
	 	
	if (ctype_alnum($_GET['month']) && ctype_alnum($_GET['year'])) {
		if (strlen($_GET['month']) == 2 && strlen($_GET['year']) == 4) {
			$cleanArray['month'] = $_GET['month']; 
			$cleanArray['year'] = $_GET['year']; 
		}
		else { echo $message; exit(); }	 
	}
	else { 	echo $message; exit(); }
	
	$thisDate = $cleanArray['year'].'-'.$cleanArray['month'].'-1';  
	$month = date ("m", strtotime($thisDate));
	$mName = date('F', strtotime($thisDate));
	$year = date('Y', strtotime($thisDate));
	$mNoDays = date('t', strtotime($thisDate));
	
}
else {
	$month = date('m');	
	$mName = date('F');
	$year = date('Y');
	$mNoDays = date('t');
}
// END: get date information for calendar at hand

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/calendar.php');

// get an array of dates
$include_path = '../includes/';
$dateClass = new dates;
$dateArray = $dateClass->getAnnualDates($month,$include_path);

// BEGIN: set information for previous months
$firstDate = $year.'-'.$month.'-'.'1';  

$prevMName = date ("M", strtotime ("-1 month", strtotime($firstDate)));
$prevMonth = date ("m", strtotime ("-1 month", strtotime($firstDate))); 
$prevYear =  date ("Y", strtotime ("-1 month", strtotime($firstDate)));

$nextMName = date ("M", strtotime ("+1 month", strtotime($firstDate)));
$nextMonth = date ("m", strtotime ("+1 month", strtotime($firstDate))); 
$nextYear = date ("Y", strtotime ("+1 month", strtotime($firstDate)));  
// END: set information for previous months



echo '	<a href="index.php?month='.$prevMonth.'&year='.$prevYear.'">&laquo;'.$prevMName.'</a>&nbsp;
		<span class="headline">'.$mName.' '.$year.'</span>&nbsp;'.'
		<a href="index.php?month='.$nextMonth.'&year='.$nextYear.'">'.$nextMName.'&raquo;</a>
		<br /><br />';

echo '<table id="calendar" cellspacing="0">
		<thead>
			<tr>
				<th>Sunday</th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
				<th>Saturday</th>
			</tr>
		</thead>
		<tfoot />';
// loop throught the entire month
for ($day=1; $day <= $mNoDays; $day++) {
	
	$today = $year.'-'.$month.'-'.$day; // the hypothetical date of the day that it is currently in 
	$dow = date ("w", strtotime ($today)); 
	
	// first week does not begin on Sunday, fill it with blank <td>'s
	if ($day == 1 && $dow !== 0) { 
		echo '<tr>'; 
		$prevMDays = date ("t", strtotime ("-1 month", strtotime($firstDate)));
		$j = $dow-1; // $j is the difference that needs to be subtracted to obtain the date
		for ($i=0; $i < $dow; $i++ ) {
			$prevDay = $prevMDays - $j; 
			echo '	<td style="color:#999;">'.$prevDay.'</td>';
		$j--; // decrement the difference
		}
	}
	
	
	if ($dow == 0) { echo '<tr>' ; }
	//exit($today);
	if ($today == date('Y-m-d')) { $thisClass = ' class="today"'; }
	else { $thisClass = ''; }
	
	// echo the main calendar cells
	echo '<td'.$thisClass.'>';
	echo $day;
	if  (isset($dateArray[$day])) {
		echo '<div class="desc">'.$dateArray[$day].'</div>';	
	}
	echo '</td>'; 
		
	if ($dow == 6) echo '</tr>';
	
	// last week does not end on Saturday, fill it with <td>'s
	if ($day == $mNoDays && $dow !== 6) { 
		//$nextMDays = date ("t", strtotime ("+1 month", strtotime($firstDate)));
		$nextDay = 1; // since we'll never show all of next months dates on this page, use 1 as first date to show and increment
		for ($i=$dow; $i<6; $i++ ) {
			echo '	<td style="color:#999;">'.$nextDay.'</td>';
		$nextDay++;
		}
		echo '</tr>';
	}

}

echo '</table>';

?>
</center>






<?php 

/* DUMP
$start_date = date('Y-m-d'); 
$check_date = $start_date; 
$end_date = '2008-03-14'; 

$i = 0; 

while ($check_date != $end_date) { 
    $check_date = date ("Y-m-d", strtotime ("+1 day", strtotime($check_date))); 
    echo $check_date . '<br>'; 

    $i++; 
    if ($i > 31) { die ('Error!'); } 
}  
*/

include($_SERVER['DOCUMENT_ROOT']."/lib/includes/footer.php"); ?>
