<?php
require_once('../resources/autoload.php');

$auth = new Authenticate();

if($auth->validate_state()){
    header("Location: admin.php");
    return;
}
else if(isset($_POST['username']) && isset($_POST['password'])){
    $check = $auth->authenticate();
    if($check){
        header("Location: admin.php");
        return;
    }
    else {
        header("Location: login.php?error=invalid&check=".$check);
        return;
    }
}

$scaffold = new Scaffolding("login");

$scaffold->generate_header();
?>


<?php if(isset($_GET['error']) && $_GET['error'] === 'invalid') echo '<p class="error-message">Invalid username/password</p>'; ?>

<div class="form-center">
    <h4 class="form-title">Sign In</h4>
    <form action='login.php' method='post'>
        <fieldset>
            <legend>Username</legend>
            <input name='username' >
        </fieldset>
        <fieldset>
            <legend>Password</legend>
            <input name='password' type='password'>
        </fieldset>
        <input class='button' type='submit' value="Log In">
    </form>
</div>

<?php
$scaffold->generate_footer();
?>
