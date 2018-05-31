<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
 
include_once 'db.php';
include_once 'Office.php';

$year = date("Y");
$month = date("m");
$day = date("d");

if ( isset($_GET["year"]) ) {
	$year = $_GET["year"];
	$month = $_GET["month"];
	$day = $_GET["day"];
    
    $prev  = mktime(0, 0, 0, $month  , $day-1, $year);
        $py= date("Y",$prev);
        $pm= date("m",$prev);
        $pd= date("d",$prev);
    $next  = mktime(0, 0, 0, $month   , $day+1, $year);
      $is_next = mktime(0, 0, 0, date("m")  , date("d"), date("Y"))>$next;
        $ny= date("Y",$next);
        $nm= date("m",$next);
        $nd= date("d",$next);
    
    
} else {
    
    $prev  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
        $py= date("Y",$prev);
        $pm= date("m",$prev);
        $pd= date("d",$prev);
    $next  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
    $is_next = mktime(0, 0, 0, date("m")  , date("d"), date("Y"))>$next;
        $ny= date("Y",$next);
        $nm= date("m",$next);
        $nd= date("d",$next);
}

	
$o = new Office();
$o->year = $year;
$o->month = $month;
$o->day = $day;
	
$readings = $o->getDay();


?>
<!doctype html>
<html>
<head>
<title>IoT</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script>
'use strict';

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	redlight: 'rgb(255, 129, 162)',
	orange: 'rgb(255, 159, 64)',
	orangelight: 'rgb(255, 189, 94)',
	yellow: 'rgb(255, 205, 86)',
	yellowlight: 'rgb(255, 235, 116)',
	green: 'rgb(75, 192, 192)',
	greenlight: 'rgb(105, 222, 222)',
	blue: 'rgb(54, 162, 235)',
	bluelight: 'rgb(84, 192, 235)',
	purple: 'rgb(153, 102, 255)',
	purplelight: 'rgb(183, 132, 255)',
	grey: 'rgb(201, 203, 207)',
	greylight: 'rgb(231, 233, 237)'
};
</script>
<style>
canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}
body {margin:0; padding:0; }
</style>
</head>

<body>
    <h1>IoT - Ardunio sensors data collector v. 1.0.1</h1>
    <h2>Observations: <? echo( $year . "-" . $month . "-" . $day); ?></h2>
    <canvas width="1600" height="800" id="canvas"></canvas>
<script>
 var lineChartData = {
 labels: [ <?
 
 foreach ($readings as $d) {
  echo '"'.$d[1]."-".$d[2]."-".$d[3]." ".$d[4].":".$d[5].'",';
 }
 //load labels
 ?>], 
   datasets: [{
   label: "Motion",
    borderColor: window.chartColors.red, backgroundColor: window.chartColors.redlight,
    borderWidth:1.5,pointRadius:1.2, fill: false,
    fill: false,
    data: [<?
 foreach ($readings as $d) {
  echo $d[8].',';
 }
    
    ?>,], yAxisID: "y-axis-0",}, {
      label: "Light",
       borderColor: window.chartColors.blue, backgroundColor: window.chartColors.bluelight,
       borderWidth:1.5,pointRadius:1.2, fill: false,
       fill: false,
       data: [<?
 foreach ($readings as $d) {
  echo $d[6].',';
 }
       
       ?>], yAxisID: "y-axis-1",}, {
         label: "Sound",
          borderColor: window.chartColors.orange, backgroundColor: window.chartColors.orangelight,
          borderWidth:1.5,pointRadius:1.2, fill: false,
          fill: false,
          data: [ <?
 foreach ($readings as $d) {
  echo $d[7].',';
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
      position: "right", id: "y-axis-2", fontColor: window.chartColors.orange,
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
         
         <br/>
         
         <center>
         <form action="index.php" method="GET">
         
         <select name="year">
           <option value="2018">2018</option>
         </select>
         
                  <select name="month">
                    <option value="2">2</option>
                  </select>
                                    <select name="day">
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                    </select>
         <input type="submit" value="Submit">
         </form>
         
<?

?>
         
        <a href="index.php?year=<?=$py?>&month=<?=$pm?>&day=<?=$pd?>"> &lt; &lt; </a>
        <?if ($is_next) {?> 
        <a href="index.php?year=<?=$ny?>&month=<?=$nm?>&day=<?=$nd?>"> &gt; &gt; </a>
        <?}?>
        </center> 
         
         
     </body>
     
     </html>

 
 
 