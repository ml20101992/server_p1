<?php
require_once('../../../autoload.php');
$session = new Session();
if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

$scaffold = new Scaffolding("views");
$scaffold->generate_header();

s

?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/season/add.php'>
            <h4 class="form-title">Add New Season</h4>
            <fieldset>
                <legend>Season Description</legend>
                <input name="description">
            </fieldset>

            <fieldset>
                <legend>Season Year</legend>
                <input name="year">
            </fieldset>
            <input type='submit' value='Add Season'>
        </form>
    </div>


<?php
$scaffold->generate_footer();
?>