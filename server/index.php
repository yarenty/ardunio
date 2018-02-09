<?php

if ( isset($_GET["year"]) ) {
	$year = $_GET["year"];
	$month = $_GET["month"];
	$day = $_GET["day"];
	

	
	$o = new Office();
	$o->year = $year;
	$o->month = $month;
	$o->day = $day;
	
	$d =  $o->getDay();


?>
<!doctype html>
<html>
<head>
    <title>IoT</title>
    <script src="Chart.bundle.js"></script>
    <script src="utils.js"></script>
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>

<body>
    <canvas width="2400" height="800" id="canvas"></canvas>
<script>
 var lineChartData = {
 labels: [ <?
 
 for (i = 0 to $d.length) {
  echo '"'.$d[i][1]."-".$d[i][2]."-".$d[i][3]." ".$d[i][4].":".$d[i][5].'",';
 }
 //load labels
 ?>], 
   datasets: [{
   label: "Motion",
    borderColor: window.chartColors.red, backgroundColor: window.chartColors.redlight,
    borderWidth:1.5,pointRadius:1.2, fill: false,
    fill: false,
    data: [<?
 for (i = 0 to $d.length) {
  echo $d[i][8].',';
 }
    
    ?>,], yAxisID: "y-axis-0",}, {
      label: "Light",
       borderColor: window.chartColors.blue, backgroundColor: window.chartColors.bluelight,
       borderWidth:1.5,pointRadius:1.2, fill: false,
       fill: false,
       data: [<?
 for (i = 0 to $d.length) {
  echo $d[i][6].',';
 }
       
       ?>], yAxisID: "y-axis-1",}, {
         label: "Sound",
          borderColor: window.chartColors.orange, backgroundColor: window.chartColors.orangelight,
          borderWidth:1.5,pointRadius:1.2, fill: false,
          fill: false,
          data: [ <?
 for (i = 0 to $d.length) {
  echo $d[i][7].',';
 }
          
          ?>], yAxisID: "y-axis-2",}
     ]}; 
       window.onload = function() {
             var ctx = document.getElementById("canvas").getContext("2d");
             window.myLine = Chart.Line(ctx, {
                 data: lineChartData,
                 options: {
                     responsive: false,
                     hoverMode: 'index',
                     stacked: false,
                     title:{
                         display: true,
                         text:'IoT'
                     },
                    legend: {
                         labels: {
                            usePointStyle: true 
                         }
                     },
                     elements: {
                             point: {
                                 pointStyle: 'circle'
                             }
                     },
                     scales: {
                       xAxes: [{
                             display: true,
                             scaleLabel: {
                                 display: true,
                                 labelString: 'Time'
                             }
                         }],
      yAxes: [{type: "linear", display: true,
      position: "left", id: "y-axis-0", ticks:{min:0.0, max:1.0 },
      scaleLabel: {
        display: true,
        fontColor:window.chartColors.red,
        labelString: 'Motion'
      }
     },
         
     {type: "linear", display: true,
      position: "right", id: "y-axis-1", fontColor: window.chartColors.blue, ticks:{min:0.0, max:1024.0 },
      gridLines: {  drawOnChartArea: false,},
      scaleLabel: {
       fontColor:window.chartColors.blue,
       display: true,
       labelString: 'Light'
       }
     },
         
     {type: "linear", display: true,
      position: "right", id: "y-axis-2", fontColor: window.chartColors.orange,ticks:{min:0.0, max:1024.0 },
      gridLines: {  drawOnChartArea: false,},
      scaleLabel: {
       fontColor:window.chartColors.orange,
       display: true,
       labelString: 'Sound'
       }
     }       
     
     ],
                     }
                 }
             });
         };
     
         </script>
     </body>
     
     </html>

 
 
 