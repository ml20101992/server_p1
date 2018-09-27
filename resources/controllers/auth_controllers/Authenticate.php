<?php
class Authenticate{
    private $session;
    
    public function __construct(){
        $this->session = new Session();
    }

    public function validate_state(){
        return $this->session->check_if_valid();
    }


    /**
     * Method used to authenticate and log in the user
     */
    public function authenticate(){
        $credentials = $this->sanitize_credentials();

        $user = $this->perform_login($credentials['username'],$credentials['password']);
        if($user === false) return false;

        $this->session -> create_new_session($user);
        return true;
    }

    private function perform_login($username, $password){
        $login = new LoginController();
        
        $user = $login->validate_credentials($username,$password);
        return $user;
    }

    private function sanitize_credentials(){
        // $sanitized_username = Sanitizer::sanitize($_POST['username'],'username');
        // $sanitized_password = Sanitizer::sanitize($_POST['password'],'password');

        // if($sanitized_username === false || $sanitized_password === false) return false;

        // return ['username' => $sanitized_username, 'password' => $sanitized_password];
        return ['username' => $_POST['username'], 'password' => $_POST['password']];
    }



}
?>