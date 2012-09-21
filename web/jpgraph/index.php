<?php
include("src/jpgraph.php");
include("src/jpgraph_pie.php");
$datos = array(9, 5, 12, 11, 6,40);
$grafico = new PieGraph(400, 300, "auto");
$grafico->SetScale("textlin");
$pieplot = new PiePlot($datos);
$grafico->Add($pieplot);
$grafico->Stroke();
?>
