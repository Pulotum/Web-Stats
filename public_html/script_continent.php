<?php

require "../../../library/connect.php";
$conn = server_connect("pulotum_tracker");

if(!$conn){
	die("nope");
}

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


$cons = array();
$nums = array();

if ($isbot == 'true'){
	$query1 = "	select count(`continent`), `continent`
				from `tracker`
				where `date` > '". $n_date ."'
				and `continent` not like ''
				group by `continent`
				order by `continent`";
	$query2 = "	select count(`country`)as 'count', `country`
				from `tracker`
				where `date` > '". $n_date ."'
				and `country` not like ''
				group by `country`
				order by `count` desc
				limit 10";
}
else {
	$query1 = "	select count(`continent`), `continent`
				from `tracker`
				where `date` > '". $n_date ."'
				and `continent` not like ''
				and `isbot` < 1
				group by `continent`
				order by `continent`";
	$query2 = "	select count(`country`)as 'count', `country`
				from `tracker`
				where `date` > '". $n_date ."'
				and `country` not like ''
				and `isbot` < 1
				group by `country`
				order by `count` desc
				limit 10";
}
$result = mysqli_query($conn, $query1);
echo ("<b>Continent Popularity</b>");
while ($row = mysqli_fetch_array($result)){
	array_push($cons,$row[1]);
	array_push($nums,$row[0]);
}
echo ("</br>");

$Cons = 	serialize($cons);
$Nums = 	serialize($nums);
echo ("<img src='image_continent.php?cons=".$Cons."&nums=".$Nums."'>");
echo ("</br>");

$result = mysqli_query($conn,$query2);
echo ("<b>Top Countries</b>");
echo ("<table border style='margin:auto;'>");
echo ("<tr>");
echo ("<td><b>Country</b></td>");
echo ("<td><b>Views</b></td>");
echo ("</tr>");

while ($row = mysqli_fetch_array($result)){
	echo ("<tr>");
	echo ("<td>".$row[1]."</td>");
	echo ("<td>".$row[0]."</td>");
	echo ("</tr>");
}

echo ("</table>");

?>