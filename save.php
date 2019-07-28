<?php 
	include 'Mysql.php';
	$mysql = new MysqlClass();
	$mysql->DBconnect();
	/*
	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$address = $_POST['address'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
*/
	$postData = file_get_contents("php://input");
	$r = json_decode($postData);
	$name = $r->name;
	$sex = $r->sex;
	$address = $r->address;
	$tel = $r->tel;
	$email = $r->email;
	$id = $r->id;
	$s = $_GET['s'];
	if($s == 0){
			$sql = "INSERT INTO dttest(
							name,
							sex,
							address,
							tel,
							email)
						values( 
							 '$name',
							 '$sex',
							 '$address',
							 '$tel',
							 '$email'
						)";
		    $result = $mysql->DBinsert($sql);
	}else{
			$sql = "UPDATE dttest set 
							 name = '$name',
							 sex = '$sex',
							 address = '$address',
							 tel = '$tel',
							 email = '$email'
					where id = '$id'";
		    $result = $mysql->DBupdate($sql);
	}

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