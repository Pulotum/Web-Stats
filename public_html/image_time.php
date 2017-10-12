<?php 

$master = $_GET['string'];
$timed = unserialize($master);
$colors = array();

foreach($timed as $val){
	$color = sprintf('#%06X', mt_rand(0,0xFFFFFF));
	array_push($colors, $color);
}

// content="text/plain; charset=utf-8"
require_once ('JPgraph/jpgraph.php');
require_once ('JPgraph/jpgraph_bar.php');

$data1y=$timed;

// Create the graph. These two calls are always required
$graph = new Graph(1000,300,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array(	'12am','1am','2am','3am','4am','5am','6am','7am','8am','9am','10am','11am',
									'12pm','1pm','2pm','3pm','4pm','5pm','6pm','7pm','8pm','9pm','10pm','11pm'));

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