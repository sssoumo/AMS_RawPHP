<?php

class Home extends mController
{

    /*public function __construct()
    {
        parent::__construct();
        Session::checkSession();

    }*/

    public function theme($theme)
    {
        if ( !empty($theme) )
            Session::set('theme', $theme );
        else
            Session::set('theme', 'default' );

        // TODO :: Need to change the url to the current location.
        $this->redirect('userController/dashboard');
    }

    public function login()
    {
        $this->redirect('userController/login');
    }

    public function index()
    {
        if (Session::get("login") == true) {
            $this->load->view("v_home", null);
        } else {
            $this->redirect('userController/login');
        }
    }
}
