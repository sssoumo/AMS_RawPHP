<?php

class mModel {

    protected $db = array();

    public function __construct() {
        $arr_db_config = array("host"=>DB_HOST, "dbname"=>DB_NAME, "username"=>DB_USERNAME, "password"=>DB_PASSWORD);
        $this->db = new DBEngine($arr_db_config);
    }
}
