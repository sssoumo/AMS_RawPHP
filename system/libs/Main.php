<?php

class Main {

    public $url;
    public $controllerName = DEFAULT_CONTROLLER;
    public $methodName = DEFAULT_ROUTE;
    public $controllerPath = DIR_CONTROLLER;
    public $controller;

    public function __construct() {
        $this->get_url();
        $this->load_controller();
        $this->call_method();
    }

    public function get_url() {
        $this->url = isset($_GET['url']) ? $_GET['url'] : NULL;

        if ($this->url != NULL) {
            $this->url = rtrim($this->url, '/'); // stripped the end slash i.e. http://localhost/rf/admin/ the last slash will be remove
            $this->url = explode("/", filter_var($this->url, FILTER_SANITIZE_URL));
        } else {
            unset($this->url);
        }
    }

    public function load_controller()
    {
        if (!isset($this->url[0]))
        {
            require_once $this->controllerPath . $this->controllerName . ".php";
            $this->controller = new $this->controllerName();
        } else {
            $this->controllerName = $this->url[0];
            $fileName = $this->controllerPath . $this->controllerName . ".php";
            if (file_exists($fileName)) {
                require_once $fileName;
                if (class_exists($this->controllerName)) {
                    $this->controller = new $this->controllerName;
                } else {

                    require_once 'error_handler.php';
                    $error = new ErrorHandler();
                    $error->notFound();
                }
            } else {

                require_once 'error_handler.php';
                $error = new ErrorHandler();
                $error->notFound();
            }
        }
    }

    public function call_method() {
        if (isset($this->url[2])) {
            $this->methodName = $this->url[1];
            if (method_exists($this->controller, $this->methodName)) {
                $this->controller->{$this->methodName}($this->url[2]);
            } else {

                require_once 'error_handler.php';
                $error = new ErrorHandler();
                $error->notFound();
            }
        } else {
            if (isset($this->url[1])) {
                $this->methodName = $this->url[1];
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {

                    require_once 'error_handler.php';
                    $error = new ErrorHandler();
                    $error->notFound();
                }
            } else {
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {

                    require_once 'error_handler.php';
                    $error = new ErrorHandler();
                    $error->notFound();
                }
            }
        }
    }

}
