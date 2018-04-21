<?php

    class MessageController extends mController
    {

        private $_model_message = '';


        public function __construct()
        {
            parent::__construct();

            $this->_model_message = $this->load->model("message_model");
        }

        public function message()
        {


            $this->document->title("Messages Compose :: RF Attendance System" );
            $this->document->headertitle("Compose" );
            //$this->document->css( array( DIR_VIEW . 'vendor/css/calender.css', DIR_VIEW . 'vendor/css/colorpicker.css' ) );
            //$this->document->js( array( DIR_VIEW . 'vendor/js/assignment.js', DIR_VIEW . 'vendor/js/collapse.js') );



            $data = $this->_model_message->userList();

            $this->load->view("v_message", $data);

        }

        public function inbox(){
            $this->document->title("Messages Inbox :: RF Attendance System" );
            $this->document->headertitle("Inbox" );

            $data = $this->_model_message->show_message();
            $this->load->view("v_messageInbox", $data);
        }


        public function insert()
        {
            $this->_model_message->insert_message($_POST);
            self::message();

        }

        public function messageDelete($id)
        {
            $this->_model_message->delete($id);
            self::message();

        }

        public function sentMessage(){
            $this->document->title("Messages Sent Items :: RF Attendance System" );
            $this->document->headertitle("Sent Items" );
            $data = $this->_model_message->sentMessage();
            $this->load->view("v_sentMessage", $data);
        }

        public function fullMessage($id){
            $this->document->title("Full Message :: RF Attendance System" );
            $this->document->headertitle("Full Message" );
            $data = $this->_model_message->show_full_message($id);
            $this->load->view("v_fullMessage", $data);
        }

        public function replyMessage($id){
            $this->_model_message->reply_message($_POST);
            self::sentMessage();
        }
    }