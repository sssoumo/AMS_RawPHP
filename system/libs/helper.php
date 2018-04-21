<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sanitize($var) {
    return filter_var($var, FILTER_SANITIZE_URL);
}
function get_url($url){
    return BASE_URL . $url;
}
