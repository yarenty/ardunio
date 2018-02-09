<?php
class Office {

	var $id;
	var $year;
	var $month;
	var $day;
	var $hour;
	var $minute;
	var $light;
	var $sound;
	var $motion;
	
	
	function load() {
		$db  = new db();
		$out = $db->getRow("select
			id, 
			year,
			month,
			day,
			hour,
			minute,
			light,
			sound,
			motion
		from ".$db->prefix."office  where id = ".$this->id."");

		if ($out!=null) {
			$this->id = $out[0];
			$this->year_id= $out[1];
			$this->month= $out[2];
			$this->day= $out[3];
			$this->hour= $out[4];
			$this->minute= $out[5];
			$this->light= $out[6];
			$this->sound= $out[7];
			$this->motion= $out[8];
		}
	}


	function save() {
		$db  = new db();
		$sql = "insert into ".$db->prefix."office (
			year,
			month,
			day,
			hour,
			minute,
			light,
			sound,
			motion
			) values ('".
		$this->year."','".
		$this->month."','".
		$this->day."','".
		$this->hour."','".
		$this->minute."','".
		$this->light."','".
		$this->sound."','".
		$this->motion."') ";
		
		$out = $db->insertRow( $sql);

		$this->id = $out;
		return $out;
			
	}

	
	
	
	function getDay(){
		$db  = new db();
		$sql = "select
			id, 
			year,
			month,
			day,
			hour,
			minute,
			light,
			sound,
			motion
		from ".$db->prefix."office where year= ".$this->year." 
				and month = '".$this->month."' 
				and day ='".$this->day."' order by hour,minute";
		$out = $db->getRowSet($sql);
	
		return $out;
	}
	

	
}
?>