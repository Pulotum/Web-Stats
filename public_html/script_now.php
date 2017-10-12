<?php

require "../../../library/connect.php";
$conn = server_connect("pulotum_tracker");

$value = $_POST['value'];
$isbot = $_POST['isbot'];

$date = date("Y-m-d H:i:s");

echo ("<b>Last Updated</b>");
echo ("</br>");
echo ($date);
echo ("</br>");
echo (date('T P'));
?>