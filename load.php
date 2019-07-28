<?php
	include 'Mysql.php';
	$mysql = new MysqlClass();
	$mysql->DBconnect();

	$pd = file_get_contents('php://input');
	$r = json_decode($pd);
	$n = $r->n;
	$p = $r->p;

	$sql = "SELECT * from dttest where id between '$p' and '$n' ";
	    	$mysql->DBquery($sql);
			$json = array();
			while($row = $mysql->fetchArray()){
					$json[] = array(
						'id'=>$row[0],
						'name'=>$row[1],
						'sex'=>$row[2],
						'address'=>$row[3],
						'tel'=>$row[4],
						'email'=>$row[5],
					);			
					//array_push($json,$jsonData);			
			}
	$data = json_encode($json);
	echo $data;
?>