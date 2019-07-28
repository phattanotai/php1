<?php

class MysqlClass{

	var $mysqli;
	var $result;
	var $row;

	function DBconnect(){
		$db=array(
		    "host"=>"localhost",  
		    "user"=>"root", 
		    "pass"=>"root", 
		    "dbname"=>"test", 
			"charset"=>"utf8" 
		);

		$this->mysqli =  new mysqli($db['host'],$db['user'],$db['pass'],$db['dbname']);

		if ($this->mysqli->connect_errno) {
		    echo $this->mysqli->connect_error;
		    exit;
		}

		$this->mysqli->set_charset($db['charset]']);
		$this->mysqli->query("SET NAMES UTF8");
	}

	function DBquery($sql){
		$this->result =  $this->mysqli->query($sql);
		return $this->result;	

	}
	function fetchArray(){
		$this->row = $this->result->fetch_array();
		return $this->row;
		
	}
	function DBinsert($sql){
		$this->result = $this->mysqli->query($sql);

		return $this->result;

	}
	function DBupdate($sql){
		$this->result = $this->mysqli->query($sql);

		return $this->result;
	}
}

?>
