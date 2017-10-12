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

$brows = array();
$nums = array();

if ($isbot == 'true'){
	$query = "	select count(`browser`), browser
				from `tracker`
				where `date` > '". $n_date ."'
				and `browser` not like '%Unknown%'
				group by `browser`
				order by count(`browser`) desc
				limit 5";
}
else {
	$query = "	select count(`browser`), browser
				from `tracker`
				where `date` > '". $n_date ."'
				and `browser` not like '%Unknown%'
				and `isbot` < 1
				group by `browser`
				order by count(`browser`) desc
				limit 5";
}
$result = mysqli_query($conn, $query);
echo ("<b>Browser Types</b>");
while ($row = mysqli_fetch_array($result)){
	array_push($brows,$row[1]);
	array_push($nums,$row[0]);
}
echo ("</br>");

$Browser = 	serialize($brows);
$Nums = 	serialize($nums);
echo ("<img src='image_browser.php?browser=".$Browser."&nums=".$Nums."'>");

?>