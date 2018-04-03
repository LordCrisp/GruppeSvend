<?php

class auth
{
    /* - GLOBAL VARIABLES - */
    private $db;

    public $auth_user_name;
    public $auth_password;
    public $auth_user_id;
    public $login_path;
    public $logout;

    /* - CLASS CONSTANTS - */
    const ISLOGGEDIN = 1;
    const ERR_NOUSERFOUND = 1;
    const ERR_NOSESSIONFOUND = 2;

    /* - CREATE GLOBAL DATABASE ID - */
    public function __construct()
    {
        //Call Database
        global $db;
        $this->db = $db;
        //Start Session
        session_start();
        //Set User Name & Password from POST variables
        $this->auth_user_name = filter_input(INPUT_POST, "login_user_name", FILTER_SANITIZE_STRING);
        $this->auth_password = filter_input(INPUT_POST, "login_password", FILTER_SANITIZE_STRING);
        $this->logout = filter_input(INPUT_GET, "logout", FILTER_SANITIZE_STRING);
        $this->login_path = DOCROOT . "admin/incl/login.php";
        //Unset POST login variables
        unset($_POST['login_user_name']);
        unset($_POST['login_password']);
    }

    // - START LOGIN & AUTHENTICATE SESSION
    public function authenticate() {
        //If username and password is set in POST, start Login method
        if ($this->logout) {
            $this->logout();
        }

        if ($this->auth_user_name && $this->auth_password){
            $this->login();
        }
        //Otherwise check if still logged in
        else {
            if (!$this->check_session()){
                echo $this->login_form();
                exit();
            }
        }
    }
    /**-----------------------------------------------------------------------
     *---------------------------LOGIN AREA (start)-------------------------*/

    // - INITIATE USER LOGIN
    private function login() {
        //Look for this username in the database
        $params = array($this->auth_user_name);
        $sql = "SELECT id, password, salt 
                FROM user 
                WHERE user_name = ? 
                AND deleted = 0 
                AND suspended = 0";
        //If theres a User with this name
        if ($row = $this->db->fetch_array($sql, $params)) {
            //And if password matches
            if (password_verify($this->auth_password.$row[0] ['salt'], $row[0] ['password'])) {
                $params = array(
                            $row[0] ['id'],     //User ID
                            session_id(),       //Session ID
                            self::ISLOGGEDIN,   //Login Status
                            time()              //Timestamp for last action
                );
                $sql = "INSERT INTO user_session (user_id, session_id, logged_in, last_action) 
                        VALUES (?,?,?,?)";
                $this->db->query($sql, $params);
                //User now officially logged in
            }
            //If password doesn't match
            else {
                //Send user back to login with error
                echo $this->login_form(self::ERR_NOUSERFOUND);
            }
        }
        //If there isn't a User with this name
        else {
            //Send user back to login with error
            echo $this->login_form(self::ERR_NOUSERFOUND);
        }
    }

    // - LOGOUT
    private function logout() {
        $params = array(session_id());
        $sql = "UPDATE user_session
                SET logged_in = 0
                WHERE session_id = ?";
        $this->db->query($sql, $params);
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
    }


    /**---------------------------LOGIN AREA (end)----------------------------
     * -----------------------------------------------------------------------
     *--------------------------CHECKUP AREA (start)------------------------*/

    // - CHECK IF SESSION IS STILL LOGGED IN
    private function check_session() {
        $params = array(session_id());
        $sql = "SELECT user_id, last_action 
                FROM user_session 
                WHERE session_id = ? 
                AND logged_in = 1";

        if ($row = $this->db->fetch_array($sql, $params)) {
            $this->auth_user_id = $row [0] ['user_id'];
            return $this->auth_user_id;
        }
        else {
            $this->logout();
        }
    }


    /**--------------------------CHECKUP AREA (end)---------------------------
     * -----------------------------------------------------------------------
     *---------------------------ERROR AREA (start)-------------------------*/

    // - REDIRECT TO THE LOGIN SITE
    public function login_form($errCode = 0)
    {
        ob_start();
        include_once $this->login_path;
        $str_buffer = ob_get_clean();
        $str_error_msg = self::get_error($errCode);
        // Replaces the @ERRORMSG@ written in the login.php, with the error message or nothing
        $str_buffer = str_replace("@ERRORMSG@", $str_error_msg, $str_buffer);
        return $str_buffer;
    }

    // - ERROR DESCRIPTIONS
    public function get_error($int)
    {
        switch ($int) {
            default:
                $str_error = "";
                break;

            case self::ERR_NOUSERFOUND:
                $str_error = "Username or Password is not correct";
                break;

            case self::ERR_NOSESSIONFOUND:
                $str_error = "No session found";
                break;
        }
        return $str_error;
}
    /**---------------------------ERROR AREA (end)----------------------------
     * ---------------------------------------------------------------------*/

}