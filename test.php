<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('resources/autoload.php');

// $user = new User();
// $user->setValues("test","test123",1,null,null);

// $db_ops = new DatabaseOperations();

// $db_ops->add($user);

$user_controller = new UserController();

$user = new User();
$user->setValues("mateo","mateo123",1,null,null);
$user_controller->modify_user($user,'test');

$user = $user_controller->get_user_by_username('mateo');
var_dump($user);

