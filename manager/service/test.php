<?php
	$app->get('/test/testConnect', function($request, $response) {
		 $mySql = new MySqlClass();
		 $data = array(
		 	'massage'=>$mySql->testConnect(),
		 ); 
		 $response->withJson($data, 200);
		 // $response->getBody()->write($data);
		 return $response;
	});
