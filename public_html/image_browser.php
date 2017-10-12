<?php 

$Browser = 	$_GET['browser'];
$Nums = 	$_GET['nums'];

$Browser = 	unserialize($Browser);
$Nums = 	unserialize($Nums);

$colors = array();

foreach($Browser as $val){
	$color = sprintf('#%06X', mt_rand(0,0xFFFFFF));
	array_push($colors, $color);
}

// content="text/plain; charset=utf-8"
require_once ('JPgraph/jpgraph.php');
require_once ('JPgraph/jpgraph_bar.php');

$data1y=$Nums;

// Create the graph. These two calls are always required
$graph = new Graph(1000,300,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($Browser);

// Create the bar plots
$b1plot = new BarPlot($data1y);

// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot));
// ...and add it to the graPH
$graph->Add($gbplot);


$b1plot->SetColor("white");
$b1plot->SetFillColor($colors);

// Display the graph
$graph->Stroke();
?>