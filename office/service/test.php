<?php
	$app->get('/test/testConnect', function($request, $response) {
		 $sqlServer = new SqlServerClass();
		 $data = array(
		 	'massage'=>$sqlServer->testConnect(),
		 ); 
		 $response->withJson($data, 200);
		 // $response->getBody()->write($data);
		 return $response;
	});
