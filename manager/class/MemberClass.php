<?php
		use Ahc\Jwt\JWT;
		function getUserIP() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}


	class MemberClass {
		var $mysql;
		var $jwt;
        
        function __construct(){
            $this->mysql = new MySqlClass();
            $this->mysql->DBconnect();
            $this->jwt = new JWT('secret');
        }
        
		public function MemberClass() {
	       	   $this->mysql = new MySqlClass();
			   $this->mysql->DBconnect();
			   $this->jwt = new JWT('secret');
		}
    
		function getMember($userData){
			$sql = "SELECT  
						*
					FROM 
						tb_member ";
		    if($userData['user_level'] == 0){
		    	
			}else if($userData['user_level'] == 1){
				$sql = $sql . " WHERE id = ".$userData['id']." OR user_level = 2";
			}else{
				$sql = $sql . " WHERE id = ".$userData['id'];
			}
			$this->mysql->DBquery($sql);
			$json = array();
			while($result = $this->mysql->fetchArray()){
				$jsonData = array(					
					'id'=> $result['id'],
					'user_level'=> $result['user_level'],					
					'fname'=> $result['fname'],
					'lname'=> $result['lname'],
					'tel'=> $result['tel'],
					'email'=> $result['email'],
					'address'=> $result['address'],
					'ref_code'=> $result['ref_code'],
					'ref_remark'=> $result['ref_remark'],
					'remark'=> $result['remark'],
				);				
				array_push($json,$jsonData);			
			}

			$data = $json;
			return $data;
		}
		function doLogin($loginData){
			$sql = "SELECT * from tb_member where username = '". $loginData->username ."' and password = '". $loginData->password. "'";
		    $this->mysql->DBquery($sql);
			$result = $this->mysql->fetchAssoc();
			if($result != null){
				$jsonData = array(					
					'id'=>$result['id'],
					'user_level'=>$result['user_level'],					
					'fname'=>$result['fname'],
					'lname'=>$result['lname'],
					'tel'=>$result['tel'],
					'email'=>$result['email'],
					'address'=>$result['address'],
					'ref_code'=>$result['ref_code'],
					'ref_remark'=>$result['ref_remark'],
					'remark'=>$result['remark'],
				);	
				$token = $this->jwt->encode($jsonData);
				$jsonData['token'] = $token;


				$sql = "INSERT INTO tb_login_log (username,log_flag,ip_address) VALUES ('".$loginData->username."',0,'". getUserIP()."')";
				$result = $this->mysql->DBinsert($sql);
				return $jsonData;
			}else{
				$sql = "INSERT INTO tb_login_log (username,log_flag,ip_address) VALUES ('".$loginData->username."',1,'". getUserIP()."')";
				$result = $this->mysql->DBinsert($sql);
				return null;
			}
			
		}
		
		function addMember($memberData){
			$sql = "SELECT
						* 
					FROM
						tb_member 
					WHERE
						username = '".$memberData->username."'
					OR
					(
						fname = '".$memberData->fname."'
					AND
						lname = '".$memberData->lname."'
					)
					OR
						tel = '".$memberData->tel."'
					OR
						email = '".$memberData->email."'";
			$this->mysql->DBquery($sql);
			
			$jsonData = array(
				"isUsername" => '',
				"isName" => '',
				"isTel" => '',
				"isEmail" => '',
			);
            
			while($result = $this->mysql->fetchArray()){
				if($memberData->username == $result['username']){
					$jsonData['isUsername'] = 'มี Username นี้แล้ว';
				}

				if($memberData->fname == $result['fname'] AND $memberData->lname == $result['lname']){
					$jsonData['isName'] = 'มี ชื่่อ-นานสกุลนี้แล้ว';
				}

				if($memberData->tel == $result['tel']){
					$jsonData['isTel'] = 'มี เบอร์นี้แล้ว';
				}

				if($memberData->email == $result['email']){
					$jsonData['isEmail'] = 'มี อีเมลนี้แล้ว';
				}					
			}
			if($jsonData['isUsername'] == '' and $jsonData['isName'] == '' and $jsonData['isTel'] == '' and $jsonData['isEmail'] == ''){
				$sql = "INSERT INTO tb_member ( username, password, user_level, fname, lname, tel, email, address, ref_code, ref_remark, remark )
				VALUES
					(
						'".$memberData->username."',
						'".$memberData->password."',
						2,
						'".$memberData->fname."',
						'".$memberData->lname."',
						'".$memberData->tel."',
						'".$memberData->email."',
						'".$memberData->address."',
						'".$memberData->ref_code."',
						'".$memberData->ref_remark."',
						'".$memberData->remark."'
					)";
					$result = $this->mysql->DBinsert($sql);
					if($result){
						$json = array(
							'massage'=> "ok",
							'data' => 'บันทึกข้อมูลแล้ว'
						);
						return $json;
					}else{
						$json = array(
							'massage'=> "ok",
							'data' => 'บันทึกข้อมูล ไม่สำเร็จ'
						);
						return $json;
					}
			}else{
				return array(
					'massage'=> "on",
					'data' => $jsonData
				);
				
			}
		}
	    function updateMember($memberData){
			$sql = "UPDATE tb_member SET 
						user_level = ".$memberData->user_level.",
						fname = '".$memberData->fname."',
						lname = '".$memberData->lname."',
						tel = '".$memberData->tel."',
						email = '".$memberData->email."',
						address = '".$memberData->address."',
						ref_code = '".$memberData->ref_code."',
						ref_remark = '".$memberData->ref_remark."',
						remark = '".$memberData->remark."'
						WHERE id = ".$memberData->id;

				$result = $this->mysql->DBupdate($sql);
				if($result){
					return "บันทึกการแก้ไขข้อมูลแล้ว";
				}else{
					return "บันทึกการแก้ไขข้อมูล ไม่สำเร็จ";
				}
		}

		function deleteMember($memberData){
			$sql = "DELETE FROM  tb_member
					WHERE id = ".$memberData->id;

			$result = $this->mysql->DBupdate($sql);
			if($result){
				return "ลบข้อมูลแล้ว";
			}else{
				return "ลบข้อมูล ไม่สำเร็จ";
			}
	}
	}
