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

if(isset($_GET['error'])){
    ?>
        <div class="error">
            <h3><?php
                $message = "";
                switch($_GET['error']){
                    case "deletion_failed": $message = "Sport Delete Failed";
                        break;
                    default: "Unknown error";
                        break; 
                }
                echo $message;
            ?></h3>
        </div>
    <?php
}

if(isset($_GET['status']) && $_GET['status'] === 'ok'){
    if($_GET['type'] === 'delete') echo '<p class="ok-message">Sport Deleted.</p>';
    else if($_GET['type'] === 'modify') echo '<p class="ok-message">Sport Modified.</p>';
}

?>
    <div id="main-content">

    </div>
    <script src="../../../../scripts/overview.js"></script>
<?php
$scaffold->generate_footer();
?>

