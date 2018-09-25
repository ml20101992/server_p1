<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('resources/autoload.php');

$user = new User();
$user->setValues("test","test123",1,null,null);

$db_ops = new DatabaseOperations();

$db_ops->add($user);