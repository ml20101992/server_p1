<?php
class Session{
    public function __construct(){
        session_start();
    }


    /**
     * Checks if there is a valid session
     */
    public function check_if_valid(){
        if(isset($_SESSION['logged'])){
            if($_SESSION['logged'] === true) return true;
        }

        return false;
    }

    /**
     * Method used to create a new session
     */
    public function create_new_session($user){
        $data = [
            'username'      => $user->get_username(),
            'user_role'     => $user->get_role(),
            'user_team'     => $user->get_team(),
            'user_league'   => $user->get_league()
        ];
        $_SESSION['logged']         = true;
        $_SESSION['session_data']   = $data;
    }

    /**
     * Method used to close the session and purge session data
     */
    public function close_session(){
        unset($_SESSION['data']);
        $_SESSION['logged'] = false;

        session_destroy();
    }


}

?>