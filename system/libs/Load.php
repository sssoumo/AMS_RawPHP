<?php

class Load
{

    public function __construct() {}

    public function view($filename, $data = NULL)
    {
        include DIR_THEME . Session::get('theme') . '/' . 'header.php';
        include DIR_THEME . Session::get('theme') . '/' . $filename . '.php';
        include DIR_THEME . Session::get('theme') . '/' . 'footer.php';
    }

    public function view_naked($filename, $data = NULL)
    {
        //include DIR_THEME . Session::get('theme') . '/' . 'header.php';
        include DIR_THEME . Session::get('theme') . '/' . $filename . '.php';
        //include DIR_THEME . Session::get('theme') . '/' . 'footer.php';
    }




    public function model($modelName) {
        // TODO :: remove the '_' first then TitleCase the name attendee_model AttendeeModel
        $className = str_replace("_", "", ucwords($modelName, "_"));

        include DIR_MODEL . $modelName . '.php';
        return new $className();
    }

}