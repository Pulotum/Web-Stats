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

if ($isbot == 'true'){
	$query = "	select distinct `ip`
				from `tracker`
				where `date` > '". $n_date ."'";
}
else {
	$query = "	select distinct `ip`
				from `tracker`
				where `date` > '". $n_date ."'
				and `isbot` < 1";
}
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);

echo ("<b>Unique Visits</b>");
echo ("</br>");
echo ($rows . " unique view(s)");

?>