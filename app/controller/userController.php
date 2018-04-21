<?php

    class UserController extends mController
    {

        private $_model_user = '';


        public function __construct()
        {
            parent::__construct();

            $this->_model_user = $this->load->model("user_model");
        }

        /**
         * To get all user List from users table
         * Created by
         * Habibur Rahman
         * Sr. Software Engineer
         */
        public function userLists()
        {
            $this->document->headertitle("User List" );
            $data['users'] = $this->_model_user->get_all_user();
            $this->load->view("v_userList", $data);

        }

        public function users($id = 0)
        {

            Session::checkSession();

            $this->document->title("Attendee List :: RF Attendance System" );
            $this->document->headertitle("User Management" );

            $this->document->js(array(
                DIR_VIEW . 'vendor/js/dataTables.bootstrap.min.js',
                DIR_VIEW . 'vendor/js/jquery.dataTables.min.js',
                DIR_VIEW . 'theme/gray/js/data_table.js',
            ));

            $this->document->css(array(
                DIR_VIEW . 'vendor/css/tables.css',
            ));


            if (!$id)    // New
            {
                $data['users'] = $this->_model_user->get_all_user();

                $data['id'] = 0;
                $data['user_name'] = "";
                $data['user_first_name'] = "";
                $data['user_last_name'] = "";
                $data['user_dob'] = "";
                $data['user_phone'] = "";
                $data['user_sex'] = "";
                $data['user_address'] = "";
                $data['user_rfid'] = "";
                $data['user_email'] = "";
                $data['ref_user_role_id'] = "";

                $data['btn_action'] = "Submit";
            }
            else      // Edit
            {
                $users = $this->_model_user->get_user_by_id($id);

                $data['id'] = $id;
                $data['user_name'] = $users['user_name'];
                $data['user_first_name'] = $users['user_first_name'];
                $data['user_last_name'] = $users['user_last_name'];
                $data['user_dob'] = $users['user_dob'];
                $data['user_phone'] = $users['user_phone'];
                $data['user_sex'] = $users['user_sex'];
                $data['user_address'] = $users['user_address'];
                $data['user_rfid'] = $users['user_rfid'];
                $data['user_email'] = $users['user_email'];
                $data['ref_user_role_id'] = $users['ref_user_role_id'];
                $data['users'] = $this->_model_user->get_all_user();

                $data['btn_action'] = "Update";
            }


            $this->load->view("v_userManagement", $data);

        }


        public function userDelete($id)
        {
            //var_dump($id);
            $this->_model_user->delete($id);
            //var_dump($id);
            //$this->load->view("v_userManagement");
            self::users();
        }

        /**
         * Insert method for Attendee Registration
         */
        public function put()
        {

            if (!$_POST['pid'])   // New
            {
                $this->_model_user->add_user($_POST);
            }
            else // Edit
            {
                $this->_model_user->update($_POST['pid'], $_POST);
            }

            $this->redirect('userController/users');
        }

        /*
         * Modified by
         * Habibur Rahman
         * Sr. Software Engineer
         */
        public function dashboard()
        {
            $users['users'] = $this->_model_user->getAllUsersWithTotalRows();
            $data=array();
            foreach ($users['users'] as $value)
            {
                $data['totalUsers']=$value;

            }
            if (Session::get("login") == true) {
                $this->load->view("v_home", $data);
            } else{
                $this->redirect('userController/login');
            }
        }

        public function login()
        {
            if (Session::get("login") == true) {
                $this->redirect('userController/dashboard');
            }
            else {
                $this->document->title("Login :: RF Attendance System" );
                $this->load->view_naked("v_login");
            }

        }

        public function loginAuth()
        {
            $isExistsUser = $this->_model_user->is_exists_user($_POST);

            if ($isExistsUser)
            {
                Session::set("login", true);
                Session::set("user_first_name", $isExistsUser[0]['user_first_name']);
                Session::set("ref_user_id", $isExistsUser[0]['ref_user_id']);

                $this->redirect('userController/dashboard');
            }
            else {
                $this->redirect('userController/login');
            }
        }

        public function logOut()
        {
            Session::destroy();
            $this->redirect('userController/login');
        }

        public function userProfile($id)
        {
            Session::checkSession();
            $this->document->title("User Profile :: RF Attendance System" );
            $this->document->headertitle("User Profile" );
            $this->document->js(array(
                DIR_VIEW . 'vendor/js/dataTables.bootstrap.min.js',
                DIR_VIEW . 'vendor/js/jquery.dataTables.min.js',
                DIR_VIEW . 'theme/gray/js/data_table.js',
            ));

            $this->document->css(array(
                DIR_VIEW . 'vendor/css/tables.css',
            ));
            $data = $this->_model_user->get_user_by_id($id);

            //var_dump($id);
            $this->load->view("v_userProfile", $data);
        }

        public function forgotPassword(){
            $this->load->view_naked("v_forgotPassword");

        }

        public function userAuth(){

            $text = "THEQUICKBROWNFOXJUMPSOVERTHELAZYDOGthequic";

            $shuffledText=str_shuffle($text);
            $data= "http://localhost/RFAttendanceSystem/index.php?url=userController/changePassword/".$shuffledText;

            $data2 = $this->_model_user->userAuth($shuffledText);
            if ($data2){

                $this->load->view_naked("v_confirmationMail", $data);

            }else{
                $this->load->view_naked("v_confirmationMail");
            }

        }

        public function confirmationMail(){
            $this->load->view_naked("v_confirmationMail");
        }

        public function changePassword($id){
            $data=$id;
            $this->load->view_naked("v_changePassword", $data);
        }

        public function passwordUpdate($id){
            $data = $this->_model_user->updatePassword($id);
            if ($data){
                $this->redirect('userController/login');
            }
        }

    }
