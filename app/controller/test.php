<?php

class Test extends mController {

    private $_model_test = '';

    public function __construct() {
        parent::__construct();
        $this->_model_test = $this->load->model("test_model");
    }
    public function test_data(){
        print_r( $this->_model_test->get() );
    }

}
