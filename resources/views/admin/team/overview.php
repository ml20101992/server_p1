<?php
require_once('../../../autoload.php');

$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];
if($role > 2) die("Insufficient permissions");


$scaffold = new Scaffolding('views');

$scaffold->generate_header();

if(isset($_GET['error'])){
    ?>
        <div class="error">
            <h3><?php
                $message = "";
                switch($_GET['error']){
                    case "deletion_failed": $message = "Team Delete Failed";
                        break;
                    case "modify_failed": $message = "Team Modify Failed";
                        break;
                    default: $message = "Unknown Error";
                        break; 
                }
                echo $message;
            ?></h3>
        </div>
    <?php
}

if(isset($_GET['status']) && $_GET['status'] === 'ok'){
    if($_GET['type'] === 'delete') echo '<p class="ok-message">Team Deleted.</p>';
    else if($_GET['type'] === 'modify') echo '<p class="ok-message">Team Modified.</p>';
}

?>
    <div id="main-content">

    </div>
    <script src="../../../../scripts/overview.js"></script>
<?php
$scaffold->generate_footer();
?>

