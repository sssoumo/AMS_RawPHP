<?php


    class DiscussionController extends mController
    {

        private $_model_discussion = '';


        public function __construct()
        {
            parent::__construct();

            $this->_model_discussion = $this->load->model("discussion_model");
        }

        public function discussion()
        {
            $this->document->title("Discussion :: RF Attendance System" );
            $this->document->headertitle("Discussions" );
            $data = $this->_model_discussion->show_discussion();
            $this->load->view("v_discussion", $data);


        }

        public function insert()
        {

            $this->_model_discussion->insert_discussion($_POST);
            self::discussion();
        }


        public function post_discussion(){
            $this->document->title("Discussion Post :: RF Attendance System" );
            $this->document->headertitle("Post Discussion" );
            $data=$this->_model_discussion->category_list();
            $this->load->view("v_postDiscussion", $data);
        }

        public function reply($id)
        {

            $this->_model_discussion->insert_reply($id, $_POST);
            self::discussion();
        }

    }