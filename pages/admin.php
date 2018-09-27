<?php
require_once('../resources/autoload.php');
$session = new Session();

if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

$scaffold = new Scaffolding("admin");
$admin_config = new AdminConfig(1);


$scaffold->generate_header();
$scaffold->generate_navigation('mateo',1);

$admin_config->init_content();

$scaffold->generate_footer();
