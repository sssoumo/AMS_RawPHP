<?php

class ErrorHandler {

    public function __construct() {

    }

    public function notFound() {
        include 'app/view/v_404.php';
    }

}
