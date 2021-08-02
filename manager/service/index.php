<?php
require '../vendor/autoload.php';
include("../class/MySqlClass.php");

$app = new \Slim\App;

include("member.php");
include("test.php");


$app->run();
