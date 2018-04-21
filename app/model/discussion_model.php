<?php

    class DiscussionModel extends mModel
    {

        private $_table = '';       // This is the primary table of this module
        private $_rTable = '';
        private $_cTable = '';// Secondary or detail table if any
        private $_select = array(); // The select field list array to use in select() or update() function
        private $_where = array();  // where array to use in Database function
        private $_other = '';       // other string to use in database function

        public function __construct()
        {
            parent::__construct();

            $this->_table = 'discussions';
            $this->_rTable = 'discussion_reply';
            $this->_cTable = 'discussion_category';
            $this->_dTable = 'user_details';

            $this->_select = array('*');
            $this->_where = array('user_status' => 1);
            $this->_other = 'order by id desc';

        }

        public function insert_discussion()
        {
            $ref_user_id = $_SESSION['ref_user_id'];
            $discussion_title = $_POST['discussion_title'];
            $discussion_post = $_POST['discussion_post'];
            $ref_category_id = $_POST['category_title'];

            $data = array('ref_user_id' => $ref_user_id, 'ref_category_id' => $ref_category_id, 'discussion_title' => $discussion_title, 'discussion_post' => $discussion_post);

            //var_dump($data);

            $pID = $this->db->insert($this->_table, $data)->get_last_insert_id();
        }

        public function show_discussion()
        {


            //$ref_user_id = $_SESSION['ref_user_id'];

            $strSQL = "SELECT d.id, d.ref_user_id, ref_category_id, discussion_title, discussion_post,discussion_doc, user_last_name, user_first_name FROM " . $this->_table . " d INNER JOIN " . $this->_dTable . " dc ON d.ref_user_id=dc.ref_user_id";

            $hello1 = $this->db->query("$strSQL", null, null, " ORDER BY id DESC")->results();





            foreach ($hello1 as $key => $value) {

                $strSQL2 = "SELECT r.id, r.ref_user_id, d.ref_user_id, ref_discussion_id, reply_text, user_first_name,(SELECT COUNT(id) FROM discussion_category WHERE ref_discussion_id = discussion_category.id) as comments FROM " . $this->_rTable . " r INNER JOIN " . $this->_dTable . " d ON r.ref_user_id=d.ref_user_id  WHERE ref_discussion_id=" .$value['id'] ;
                $hello2 = $this->db->query("$strSQL2", null, null, " ORDER BY id DESC")->results();
                //print_r($hello2);


                $all[$key]=array(
                    'id'=> $value['id'],
                    'ref_user_id'=>$value['ref_user_id'],
                    'ref_category_id'=>$value['ref_category_id'],
                    'discussion_title'=>$value['discussion_title'],
                    'discussion_post'=>$value['discussion_post'],
                    'discussion_doc'=>$value['discussion_doc'],
                    'user_last_name'=>$value['user_last_name'],
                    'user_first_name'=>$value['user_first_name'],
                    //'comments'=>$value['comments'],
                    'reply' => $hello2

                );


            }



            return $all;
        }

        public function show_replies($id)
        {

            $this->_select = array('reply_text');
            $this->_where = array('id' => $id);
            $discussion = $this->db->select($this->_table, $this->_select, $this->_where)->result();

            return $discussion;
        }

        public function insert_reply($id)
        {
            $ref_user_id = $_SESSION['ref_user_id'];
            $reply_text = $_POST['reply_text'];


            $data = array('ref_user_id' => $ref_user_id, 'ref_discussion_id' => $id, 'reply_text' => $reply_text);
            $insReply = $this->db->insert($this->_rTable, $data);

        }

        public function category_list(){
            $this->_select = array('category_title', 'id');

            $discussion = $this->db->select($this->_cTable, $this->_select)->results();
            return $discussion;
        }


    }