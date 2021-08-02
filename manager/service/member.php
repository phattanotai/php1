<?php
    use Ahc\Jwt\JWT;
	include("../class/MemberClass.php");
	
	$app->get('/member/getMember', function($request, $response) {
		$jwt = new JWT('secret');
		$token = getallheaders()['Authorization'] or $request->getHeader("Authorization");
		if($token){
			try {
				$decoded = $jwt->decode($token);
			    $memberClass = new MemberClass();
				$data = $memberClass->getMember($decoded);
			    $json = array(
			   	'massage'=> 'ok',
			   	'data'=> $data,
			   );
			   return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
			   //  $response->withJson($json, 200);
			   //  return $response;
			  }catch(Exception $e) {
				    $json = array(
						'massage'=> 'error',
						'data'=> $e->getMessage(),
					);
					return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
			  }
		}else{
			$json = array(
				'massage'=> 'ไม่มีสิทธิ',
			);
		   return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
		}
		
	});

	$app->post('/member/deleteMember', function($request, $response) {
		$body = json_decode($request->getBody());
		$jwt = new JWT('secret');
		$token = getallheaders()['Authorization'] or $request->getHeader("Authorization");
		if($token){
			try {
				$decoded = $jwt->decode($token);
				if($decoded['user_level'] == 0 or $decoded['user_level'] == 1){
					$memberClass = new MemberClass();
					$data = $memberClass->deleteMember($body);
					$json = array(
					   'massage'=> 'ok',
					   'data'=> $data,
				   );
				   return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
				}else{
					$json = array(
						'massage'=> 'ok',
						'data'=> 'ไม่สามารถลบได้',
					);
					return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
				}
			   
			  }catch(Exception $e) {
				    $json = array(
						'massage'=> 'error',
						'data'=> $e->getMessage(),
					);
					return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
			  }
		}else{
			$json = array(
				'massage'=> 'ไม่มีสิทธิ',
			);
		   return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
		}
		
	});

	$app->post('/member/updateMember', function($request, $response) {
		 $body = json_decode($request->getBody());
		 $memberClass = new MemberClass();
		 $result = $memberClass->updateMember($body);
		 $json = array(
		 	'massage'=> $result,
		 );
		return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
	});

	$app->post('/member/addMember', function($request, $response) {
               try{
                       $body = json_decode($request->getBody());
                       $memberClass = new MemberClass();
                       $result = $memberClass->addMember($body);
//                       print_r($memberClass);

                       return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($result));
               }catch(Exception $e) {
                     $json = array(
                       'massage'=> 'error',
                       'data'=> $e->getMessage(),
                    );
                    return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
         }
               
   });

	$app->post('/member/doLogin', function($request, $response) {
		$memberClass = new MemberClass();
		// $loginData = array("username"=> 'test', "password" => 'test');
		$loginData = json_decode($request->getBody());
		$data = $memberClass->doLogin($loginData);
		$json = array(
		   'massage'=> 'ok',
		   'data'=> $data,
	   );
	   return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
   });

   $app->post('/member/doRegister', function($request, $response) {
	$body = json_decode($request->getBody());
	$memberClass = new MemberClass();
	$result = $memberClass->doRegister($body);
	$json = array(
		'massage'=>$result,
	);
	return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(json_encode($json));
});
// https://seegatesite.com/slim-framework-basic-tutorial-for-beginner-a-micro-framework-for-php/
