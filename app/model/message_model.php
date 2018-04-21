<?php


    class MessageModel extends mModel
    {

        private $_table = '';       // This is the primary table of this module
        private $_dTable = '';
        private $_fTable = '';// Secondary or detail table if any
        private $_select = array(); // The select field list array to use in select() or update() function
        private $_where = array();  // where array to use in Database function
        private $_other = '';       // other string to use in database function

        public function __construct()
        {
            parent::__construct();

            $this->_table = 'messages';
            $this->_dTable = 'user_details';
            $this->_uTable = 'users';
            $this->_select = array('*');
            $this->_where = array('user_status' => 1);
            $this->_other = 'order by id desc';

        }

        public function insert_message()
        {
            $ref_from_user_id = $_SESSION['ref_user_id'];
            $ref_to_user_id = $_POST['ref_to_user_id'];
            $message_subject = $_POST['message_subject'];

            $message_detail = $_POST['message_detail'];


            $data = array('ref_from_user_id' => $ref_from_user_id, 'ref_to_user_id' => $ref_to_user_id, 'message_subject' => $message_subject, 'message_detail' => $message_detail

            );
            $insMessage = $this->db->insert($this->_table, $data);
            //print_r($data);
        }

        public function show_message()
        {


            $ref_to_user_id = $_SESSION['ref_user_id'];

            $strSQL = "SELECT m.id,ref_to_user_id, ref_from_user_id, message_subject, message_detail,message_doc, user_last_name, user_first_name FROM " . $this->_table . " m INNER JOIN " . $this->_dTable . " ud ON ref_from_user_id=ud.ref_user_id WHERE ref_to_user_id=" . $ref_to_user_id;

            $hello = $this->db->query("$strSQL", null, null, " ORDER BY id ASC")->results();

            return $hello;
        }

        public function delete($id)
        {
            $this->_where = array('id' => $id);
            $this->db->delete($this->_table, $this->_where);

        }

        public function userList()
        {
            $ref_this_user_id = $_SESSION['ref_user_id'];

            $strSQL = "SELECT ref_user_id, user_first_name, user_last_name FROM " . $this->_dTable . "  WHERE NOT ref_user_id=" . $ref_this_user_id;

            $hello = $this->db->query("$strSQL", null, null, " ORDER BY id ASC")->results();

            return $hello;
        }

        public function sentMessage(){
            $ref_from_user_id = $_SESSION['ref_user_id'];

            $strSQL = "SELECT m.id,ref_to_user_id, ref_from_user_id, message_subject, message_detail,message_doc, user_last_name, user_first_name FROM " . $this->_table . " m INNER JOIN " . $this->_dTable . " ud ON ref_to_user_id=ud.ref_user_id WHERE ref_from_user_id=" . $ref_from_user_id;

            $hello = $this->db->query("$strSQL", null, null, " ORDER BY id ASC")->results();

            return $hello;
        }

        public function show_full_message($id)
        {


            $ref_to_user_id = $_SESSION['ref_user_id'];

            $strSQL = "SELECT m.id,ref_to_user_id, ref_from_user_id, message_subject, message_detail,message_doc, user_last_name, user_first_name FROM " . $this->_table . " m INNER JOIN " . $this->_dTable . " ud ON ref_from_user_id=ud.ref_user_id WHERE m.id=" . $id;

            $hello = $this->db->query("$strSQL", null, null, " ORDER BY id ASC")->results();

            return $hello;
        }

       public function reply_message($id){
           $ref_from_user_id = $_SESSION['ref_user_id'];
           $ref_to_user_id = $_POST['ref_to_user_id'];
           $message_subject = $_POST['message_subject'];
           $message_detail = $_POST['message_detail'];


           $data = array('ref_from_user_id' => $ref_from_user_id, 'ref_to_user_id' => $ref_to_user_id, 'message_subject' => $message_subject, 'message_detail' => $message_detail

           );

           $insMessage = $this->db->insert($this->_table, $data);
       }
    }















