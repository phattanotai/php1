<?php
	class SqlServerClass{
	    var $conn;
		var $result;
		var $row;
		var $serverName = "localhost"; 
		var $connectionInfo = array(
			    "Database" => "wgtNoVat",
			    "UID" => "wgtOffice",
			    "PWD" => "P@ssw0rd",
			    "MultipleActiveResultSets"=>true
			);

		public function SqlServerClass() {
	        // $this->DBconnect();
	    }	

		function DBconnect(){
			$this->conn = sqlsrv_connect( $this->serverName, $this->connectionInfo);
		}
		function testConnect(){
			$this->conn = sqlsrv_connect( $this->serverName, $this->connectionInfo);
			if ($this->conn) {
			    return "เชื่อมต่อฐานข้อมูล ".$this->connectionInfo['Database']." ได้ ";
			} else {
			    return "เชื่อมต่อฐานข้อมูล ".$this->connectionInfo['Database']." ไม่ได้";
			}
		}
	    function query($sql){
			$this->result =  sqlsrv_query($this->conn, $sql);
		}

	    function queryParams($sql,$params){
			$this->result =  sqlsrv_query($this->conn,$sql,$params);
		}
		function fetchArray(){
			$this->row = sqlsrv_fetch_array($this->result, SQLSRV_FETCH_ASSOC);
			return $this->row;
		}
		function fetchAssoc(){
			$this->row = sqlsrv_fetch_array($this->result, SQLSRV_FETCH_ASSOC);
			return $this->row;
		}
	}

