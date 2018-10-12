<?php
require_once('../../../autoload.php');
$session = new Session();
if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

$scaffold = new Scaffolding("views");
$scaffold->generate_header();

$sport_id = "";

if(isset($_GET['id'])){
    $sport_id = Sanitizer::sanitize($_GET['id'],'select_int');
}

if($sport_id === "") die("Unknown error");

$sport_ctrl = new SportController();
$sport = $sport_ctrl->get_sport_by_id($sport_id);

if(isset($_GET['error'])){
    $message = "";

    switch ($_GET['error']){
        case "name-not-set":{
            $message = "Name Not Set";
        }break;
        case "name-taken": $message = "Sport Already Exists";
            break;
        default: $message = 'Unknown error';
            break;
    }

    echo '<p class="error-message">'.$message.'</p>';
}

if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">Sport Created.</p>';

?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/sport/modify.php'>
            <h4 class="form-title">Add New Sport</h4>
            <input name='id' type='hidden' value= "<?php echo $sport->get_id() ?>">
            <fieldset>
                <legend>Sport Name</legend>
                <input name="name" value="<?php echo $sport->get_name() ?>">
            </fieldset>
            <input type='submit' value='Modify Sport'>
        </form>
    </div>


<?php
$scaffold->generate_footer();
?>