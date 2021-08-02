<?php
require '../vendor/autoload.php';
include("../class/SqlServerClass.php");

$app = new \Slim\App;

include("serial.php");
include("test.php");


$app->run();
