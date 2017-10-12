<?php 

$Cons = 	$_GET['cons'];
$Nums = 	$_GET['nums'];

$Cons = 	unserialize($Cons);
$Nums = 	unserialize($Nums);

$colors = array();

foreach($Cons as $val){
	$color = sprintf('#%06X', mt_rand(0,0xFFFFFF));
	array_push($colors, $color);
}

// content="text/plain; charset=utf-8"
require_once ('JPgraph/jpgraph.php');
require_once ('JPgraph/jpgraph_pie.php');
// Some data
$data = $Nums;
$labels = $Cons;

$graph = new PieGraph(500,300);
$graph->SetShadow();

$p1 = new PiePlot($data);
$p1->SetCenter(0.4);
$graph->Add($p1);

$p1->SetLegends($labels);
$p1->SetSliceColors($colors);


$graph->Stroke();
 
?>