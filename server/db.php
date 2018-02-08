<?php
class db {


	
	function insertRow($sql) {
		$connection = @mysql_connect($this->server, $this->user,$this->pass,$link,null);
		$result = @mysql_db_query($this->DB,$sql,$connection);
		
		if ($result != false ) {
			$id = mysql_insert_id($connection);
			@mysql_free_result($result);
			return $id;
		} else {
			return null;
		}
	}


		
	function update($sql) {
		$connection = @mysql_connect($this->server, $this->user,$this->pass,$link,null);
		$result = @mysql_db_query($this->DB,$sql,$connection);
		
		if ($result != false ) {
			$id = mysql_affected_rows($connection);
			@mysql_free_result($result);
			return $id;
		} else {
			return null;
		}
	}
	
	
	function getRow($sql) {
		$connection = @mysql_connect($this->server, $this->user,$this->pass,$link,null);
		$result = @mysql_db_query($this->DB, $sql,$connection);
		
		if ($result != false ) {
			$out = mysql_fetch_row($result);
			@mysql_free_result($result);
			return $out;
		} else {
			return null;
		}
	}


	function getRowSet($sql) {
		$connection = @mysql_connect($this->server, $this->user,$this->pass,null,null);
		$result = @mysql_db_query($this->DB,$sql,$connection);
		$i=0;
		while ($out[$i++] = mysql_fetch_array($result)) {
		}
		@mysql_free_result($result);
		return $out;
	}

}
?>