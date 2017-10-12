<?php

require "../../../library/connect.php";
$conn = server_connect("pulotum_tracker");

$value = $_POST['value'];
$isbot = $_POST['isbot'];

$date = date("Y-m-d H:i:s");

if ($value == 0){
	$unix = strtotime("-1 day");
}
else if ($value == 1){
	$unix = strtotime("-7 day");
}
else if ($value == 2){
	$unix = strtotime("-14 day");
}
else if ($value == 3){
	$unix = strtotime("-6 month");
}
else if ($value == 4){
	$unix = strtotime("-12 month");
}

$n_date = date("Y-m-d H:i:s",$unix);

$timed = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

if ($isbot == 'true'){
	$query = "	select `date`
				from `tracker`
				where `date` > '". $n_date ."'";
}
else {
	$query = "	select `date`
				from `tracker`
				where `date` > '". $n_date ."'
				and `isbot` < 1";
}

$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)){
	$hour = ltrim(substr($row[0], 11, 2), '0');
	if ($hour == ''){
		$hour = 0;
	}
	$timed[$hour] = $timed[$hour] + 1;
}
echo ("<b>Most Popular Time</b>");
echo ("</br>");

$master = serialize($timed);
echo ("<img src='image_time.php?string=".$master."'>");

?>