<?php
	include("../class/SerialClass.php");
	$app->get('/serial/getSerial/{SerialNo}', function($request, $response) {
		 $SerialNo = $request->getAttribute('SerialNo');
		 $serialClass = new SerialClass();
		 $data = $serialClass->getSerial($SerialNo);
		 $response->withJson($data, 200);
		 return $response;
	});

	$app->post('/serial/updateSerial', function($request, $response) {
		 $body = json_decode($request->getBody());
		 $serialClass = new SerialClass();
		 $result = $serialClass->updateSerial($body);
		 $json = array(
		 	'massage'=>$result,
		 );
		 $response->withJson($json, 201);
		 return $response;
	});

// https://seegatesite.com/slim-framework-basic-tutorial-for-beginner-a-micro-framework-for-php/