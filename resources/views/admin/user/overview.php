<?php
require_once('../../../autoload.php');

$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];

$scaffold = new Scaffolding('views');

$scaffold->generate_header();
?>

    <script src="../../../../scripts/overview.js">
<?php
$scaffold->generate_footer();
?>

