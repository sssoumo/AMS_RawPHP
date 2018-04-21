<?php

class UserModel extends mModel {

    private $_table = '';       // This is the primary table of this module
    private $_dTable = '';      // Secondary or detail table if any
    private $_select = array(); // The select field list array to use in select() or update() function
    private $_where = array();  // where array to use in Database function
    private $_other = '';       // other string to use in database function

    public function __construct() {
        parent::__construct();

        $this->_table = 'users';
        $this->_dTable = 'user_details';
        $this->_select = array('*');
        $this->_where = array('user_status' => 1);
        $this->_other = 'order by id desc';
    }

    /**
     * accessing users and user_details database to select all the attendee list
     */
    public function get_all_user() {
        //$this->_select = array('user_name', 'user_email');
        //$this->_where = array('user_status'=>1);
        //$this->_other = 'order by id desc';
        //return $this->db->select($this->_table, $this->_select, $this->_where, $this->_other)->results();

        $strSQL = "SELECT u.id AS id, user_name, user_email, user_first_name, user_last_name FROM " . $this->_table . " u INNER JOIN " . $this->_dTable . " ud ON u.id=ud.ref_user_id  ORDER BY id DESC;";

        return $this->db->query("$strSQL",null, null, " ORDER BY id DESC")->results();
    }

    /**
     * To get total users and used in dashboard
     * Created by
     * Habibur Rahman
     * Sr. Software Engineer
     */
    public function getAllUsersWithTotalRows()
    {
        $sql =
                '
                    SELECT COUNT(id) as totalUsers
                    FROM users;
                ';
        return $this->db->query("$sql")->result();
    }

    /**
     * accessing user database to insert all the attendee list
     */
    public function add_user() {

        //$form_status = $_POST['form_status'];
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_address = $_POST['user_address'];
        $user_phone = $_POST['user_phone'];
        $user_dob = $_POST['user_dob'];
        $user_name = $_POST['user_name'];
        $user_sex = $_POST['user_sex'];
        $user_rfid = $_POST['user_rfid'];
        $user_email = $_POST['user_email'];
        $ref_user_role_id = $_POST['ref_user_role_id'];

        $data1 = array(
            'user_name' => $user_name,
            'user_password' => $this->get_hashed_password(),
            'user_rfid' => $user_rfid,
            'user_email' => $user_email,
            'ref_user_role_id' => $ref_user_role_id
        );


        $pID = $this->db->insert($this->_table, $data1)->get_last_insert_id();


        $data2 = array(
            'ref_user_id' => $pID,
            'user_first_name' => $user_first_name,
            'user_last_name' => $user_last_name,
            'user_phone' => $user_phone,
            'user_dob' => $user_dob,
            'user_sex' => $user_sex,
            'user_address' => $user_address
        );



        return $this->db->insert($this->_dTable, $data2)->get_last_insert_id();

    }

    public function update($id)
    {
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_address = $_POST['user_address'];
        $user_phone = $_POST['user_phone'];
        $user_dob = $_POST['user_dob'];
        $user_name = $_POST['user_name'];
        $user_sex = $_POST['user_sex'];
        $user_rfid = $_POST['user_rfid'];
        $user_email = $_POST['user_email'];
        $ref_user_role_id = $_POST['ref_user_role_id'];

        $data1 = array(
            'user_name' => $user_name,
            'user_password' => $this->get_hashed_password(),
            'user_rfid' => $user_rfid,
            'user_email' => $user_email,
            'ref_user_role_id' => $ref_user_role_id
        );

        $data2 = array(
            'ref_user_id' => $id,
            'user_first_name' => $user_first_name,
            'user_last_name' => $user_last_name,
            'user_phone' => $user_phone,
            'user_dob' => $user_dob,
            'user_sex' => $user_sex,
            'user_address' => $user_address
        );

        // update array data


        // where condition array
        $arrWhere1 = array('id' => $id);
        $arrWhere2 = array('ref_user_id' => $id);

        // call update function
        $result1 = $this->db->update($this->_table, $data1, $arrWhere1);
        $result2 = $this->db->update($this->_dTable, $data2, $arrWhere2);
        return true;
    }

    public function delete($id){
        $this->_where = array('id' => $id);
        $this->db->delete($this->_table, $this->_where);
        $this->_where = array('ref_user_id' => $id);
        $this->db->delete($this->_dTable, $this->_where);
    }

    public function is_exists_user()
    {
        $user_name = $_POST['login_username'];
        $user_password = $_POST['login_password'];


        $sql = "SELECT u.user_name, ud.user_first_name, ud.user_last_name, ur.user_role_name
                FROM users u, user_details ud, user_roles ur
                WHERE u.user_name='$user_name', AND u.user_password='$user_password' AND u.id=ud.ref_user_id AND u.ref_user_role_id=ur.id;";

        $strCrt = "user_name = '$user_name' AND user_password = '$user_password'";

        $result = $this->db->count($this->_table, $strCrt);
        if ($result){
            $this->_select = array('id' );
            $this->_where = array('user_name'=>$user_name, 'user_password'=>$user_password);
            $id= $this->db->select($this->_table, $this->_select, $this->_where)->results();

            $this->_select = array('ref_user_id','user_first_name', 'user_last_name', 'user_phone', 'user_dob', 'user_sex', 'user_address' );
            $this->_where = array('ref_user_id'=>$id[0]['id']);

            return $this->db->select($this->_dTable, $this->_select, $this->_where," ORDER BY id DESC")->results();

        }

    }

    /**
     * @return array|DBEngine
     */

    public function get_hashed_password() {
        return '123456';
    }

    public function get_user_by_id($id){
       /* $this->_where = array('ref_user_id'=>$id);
        $this->_select = array('user_first_name', 'user_last_name', 'user_phone', 'user_dob', 'user_sex', 'user_address' );
        return $this->db->select($this->_dTable, $this->_select, $this->_where)->results(); */

        $this->_where = array('u.id'=>$id);

        $strSQL = "SELECT u.id AS id,ref_user_role_id, user_name, user_email, user_first_name, user_last_name, user_phone, user_dob, user_sex, user_address, user_rfid FROM " . $this->_table . "  u, " . $this->_dTable . " AS ud WHERE u.id=$id AND u.id=ud.ref_user_id;";

        $hello = $this->db->query("$strSQL")->result();
        return $hello;

    }

    public function userAuth($shuffledText)
    {

        $forgot_email = $_POST['forgot_email'];

        $dataArray = array('user_forgot_code'=>$shuffledText);
        $this->_where = array('user_email' => $forgot_email);
        $this->db->update($this->_table, $dataArray, $this->_where)->affected_rows();

        $this->_select = array('user_email');

        $user_email = $this->db->select($this->_table, $this->_select, $this->_where)->result();

        if ($user_email) {
            return $user_email;
        }
    }

    public function updatePassword($id){

            $new_password = $_POST['new_password'];
            $confirm_new_password = $_POST['confirm_new_password'];
            if($new_password==$confirm_new_password){
                $dataArray = array('user_password'=>$new_password);
                $aWhere = array('user_forgot_code'=>$id);
                $data = $this->db->update($this->_table, $dataArray, $aWhere)->affected_rows();
                return $data;
            }


        }





}
