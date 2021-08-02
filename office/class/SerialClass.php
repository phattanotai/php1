<?php
	class SerialClass {
		var $sqlServer;
		public function SerialClass() {
	       	$this->sqlServer = new SqlServerClass();
	       	$this->sqlServer->DBconnect();
	    }	
		function getSerial($SerialNo){
			$sql = "SELECT TOP (50) 
						ProdID,
						SKUId,
						SerialNo
					FROM 
						T_StkBalSerial ";

		    if($SerialNo === "all"){
		    	$query  =  $this->sqlServer->query($sql);
			}else{
				$params = array($SerialNo.'%');	
				$sql = $sql . "WHERE SerialNo LIKE ?";
				$query  =  $this->sqlServer->queryParams($sql,$params);
			}
		  	
			$json = array();
			while($result = $this->sqlServer->fetchArray()){
					$jsonData = array(					
						'ProdID'=>$result['ProdID'],
						'SKUId'=>$result['SKUId'],					
						'SerialNo'=>$result['SerialNo']
					);			
					array_push($json,$jsonData);			
			}

			$data = $json;
			return $data;
		}
	    function updateSerial($data){
				$sql = "UPDATE T_StkBalSerial
						SET ProdID = ?, SKUId = ?
						WHERE SerialNo = ? ";

				$sql1 = "UPDATE T_StkInSerial
						SET ProdID = ?, SKUId = ?
						WHERE SerialNo = ? ";

				$sql2 = "UPDATE T_StkMove
						SET ProdID = ?, SKUId = ?,BarCode = ?
						WHERE SerialNo = ? ";

				$params1 = array($data->ProdID,$data->SKUId,$data->SerialNo);
			  	$query1  =  $this->sqlServer->queryParams($sql,$params1);

			  	$params2 = array($data->ProdID,$data->SKUId,$data->SerialNo);
			  	$query2  =  $this->sqlServer->queryParams($sql1,$params2);

			  	// $params3 = array($data->ProdID,$data->SKUId,$data->ProdID,$data->SerialNo);
			  	// $query3  =  $this->sqlServer->queryParams($sql2,$params3);

				if( $query1  === false && $query2  === false ) {
					return "บันทึกข้อมูลไม่ได้";
				}else{
					return "บันทึกข้อมูลสำเร็จ";
				}
				
		}

	}