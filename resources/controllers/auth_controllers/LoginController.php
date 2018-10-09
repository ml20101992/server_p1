<?php
class LoginController{
    private $user_controller;


    public function __construct(){
        $this->user_controller = new UserController();
    }

    /**
     * Method performs authentication checks for login credentials
     * Returns user if credentials are valid, returns false if they are not
     */
    public function validate_credentials($username, $password){
        $user = $this->user_controller->get_user_by_username($username);

        if($user === false) return false;

        $pw_hash = $user->get_pw_hash();

        $pw_valid = password_verify($password,$pw_hash);

        if($pw_valid) return $user;
        else return false;
    }
}