
<?php

class Session
{
    public static function init(){
        if(!isset($_SESSION)) session_start();
    }

    public static function set($key, $val){
        self::init();
        $_SESSION[$key]=$val;
    }

    public static function get($key){
        self::init();
        if (isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else {
            return false;
        }
    }

    public static function checkSession(){
        self::init();
        if (self::get("login")== false){
            self::destroy();
            //$this->load->view("v_login");
            header("Location: " . BASE_URL . "index.php?url=home/login");
        }
    }

    public static function destroy()
    {
        // N.B. self:init() will not work as we've added some session variable in the $_SESSION array when logged in.
        session_start();
        session_destroy();
        session_unset();
    }

}