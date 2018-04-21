<?php

class Document
{
    /**
     * It's available in global scope in this APP using $this->title
     * @var string
     */
    public static $title = "RF Attendance System";
    public static $headertitle = "Dashboard";
    public static $css = array();
    public static $js = array();

    public function __construct() {}

    /**
     * When the param is empty it'll return the previous stetted title
     * else this will set the new title
     *
     * @param string $title
     * @return string
     */
    public function title($title=""){
        if(empty($title))
            return self::title;
        self::$title = $title;
    }

    public function headertitle($headertitle=""){
        if(empty($headertitle))
            return self::headertitle;
        self::$headertitle = $headertitle;
    }

    public function css($css=NULL){
        if($css) self::$css = $css;
        else return self::css;
    }

    public function js($js=NULL){
        if($js) self::$js = $js;
        else return self::css;
    }
}
