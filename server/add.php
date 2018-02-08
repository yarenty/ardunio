<?php

$out=0;
if ( isset($_GET["year"]) ) {
	$year = $_GET["year"];
	$month = $_GET["month"];
	$day = $_GET["day"];
	$hour = $_GET["hour"];
	$minute = $_GET["minute"];
	$light = $_GET["light"];
	$sound = $_GET["sound"];
	$motion = $_GET["motion"];
	

function addRecord($year, $month, $day, $hour, $minute, $light, $sound,$motion) {
	
	$o = new Office();
	$o->year = $year;
	$o->month = $month;
	$o->day = $day;
	$o->hour = $hour;
	$o->minute = $minute;
	$o->light = $light;
	$o->sound = $sound;
	$o->motion = $motion;
	
	return $o->save();
}



header("content-type:application/json");

//date_default_timezone_set($user->timezone);

$out = addRecord($year, $month, $day, $hour, $minute, $light, $sound, $motion);
//phpinfo();

// echo "<br/> and ??<br/>";
//  echo "POST::<pre>";
//  print_r($_POST);
//  echo "</pre>";
// echo "So setting done:".$id;
// echo "<br/>";
// echo "for user:".$uid."<br/>";

}

echo json_encode($out);

//echo json_encode($_POST."");

?>