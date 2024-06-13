<?php
require_once("../lib/phpchartdir.php");

# The data for the line chart
$data = array(30, 28, 40, 55, 75, 68, 54, 60, 50, 62, 75, 65, 75, 91, 60, 55, 53, 35,
    50, 66, 56, 48, 52, 65, 62);

# The labels for the line chart
$labels = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12",
    "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24");

# Create a XYChart object of size 300 x 280 pixels
$c = new XYChart(300, 280);

# Set the plotarea at (45, 30) and of size 200 x 200 pixels
$c->setPlotArea(45, 30, 200, 200);

# Add a title to the chart using 12 pts Arial Bold Italic font
$c->addTitle("Daily Server Utilization", "arialbi.ttf", 12);

# Add a title to the y axis
$c->yAxis->setTitle("MBytes");

# Add a title to the x axis
$c->xAxis->setTitle("June 12, 2001");

# Add a blue (0x6666ff) 3D line chart layer using the give data
$lineLayerObj = $c->addLineLayer($data, 0x6666ff);
$lineLayerObj->set3D();

# Set the labels on the x axis.
$c->xAxis->setLabels($labels);

# Display 1 out of 3 labels on the x-axis.
$c->xAxis->setLabelStep(3);

# Output the chart
header("Content-type: image/png");
print($c->makeChart2(PNG));
?>
