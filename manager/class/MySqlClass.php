<?php
	class MySqlClass{
		var $mysqli;
		var $result;
		var $row;
		var $db = array(
			"host" => "localhost",  
			"user" => "root", 
			"pass" => '', 
			"dbname" => "overtest", 
			"charset" => "utf8" 
		);

		// function __construct($sql){
		// 	$this->DBconnect();
		// 	$this->result =  $this->mysqli->query($sql);
		// }

		public function MySqlClass() {
			// $this->DBconnect();
		}	

		function DBconnect(){
			$this->mysqli =  new mysqli($this->db['host'],$this->db['user'],$this->db['pass'],$this->db['dbname']);
			if ($this->mysqli->connect_errno) {
				echo $this->mysqli->connect_error;
				exit;
			}
			$this->mysqli->set_charset($this->db['charset']);
			$this->mysqli->query("SET NAMES UTF8");
		}
		function testConnect(){
			$this->mysqli =  new mysqli($this->db['host'],$this->db['user'],$this->db['pass'],$this->db['dbname']);
			$this->mysqli->set_charset($this->db['charset']);
			$this->mysqli->query("SET NAMES UTF8");
			if ($this->mysqli->connect_errno) {
				return "เชื่อมต่อฐานข้อมูลไม่ได้";
			}else{
				return "เชื่อมต่อฐานข้อมูลได้ ";
			}
		}
		function DBquery($sql){
			$this->result =  $this->mysqli->query($sql);	
		}

		function DBfields(){
			return $this->result->fetch_field();
		}
		function countFields(){
			return $this->result->field_count;
		}
		function countRows(){
			return $this->result->num_rows;
		}
		function DBresult(){
			return $this->result;
		}
		function DBquery1sql($sql){
			$this->result =  $this->mysqli->query($sql);
			$this->row = $this->result->fetch_array();
			return $this->row;	
			
		}
		function fetchArray(){
			$this->row = $this->result->fetch_array();
			return $this->row;
			
		}
		function fetchAssoc(){
			$this->row = $this->result->fetch_assoc();
			return $this->row;
			
		}

		function DBclose(){
			$this->mysqli->close();
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
