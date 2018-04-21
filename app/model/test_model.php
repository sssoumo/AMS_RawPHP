<?php

class TestModel extends mModel {

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
    public function get() {

        $this->db->count( $this->_table, 'user_name="admin"' );
        $this->db->show_query();
    }

}
