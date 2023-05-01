<?php

function isSession(){
    $CI=get_instance();
    if($CI->session->userdata('email')){
        return true;
    }
    else{
        return false;
    }
    

}
function userId(){
    $CI=get_instance();
    $CI->load->library('session');
    if($CI->session->userdata('id')){
       return $CI->session->userdata('id'); 
    }   else{
        return false;
    }
}
function userName(){
    $CI=get_instance();
    $CI->load->library('session');
    if($CI->session->userdata('name')){
       return $CI->session->userdata('name'); 
    }   else{
        return false;
    }
}
function userEmail(){
    $CI=get_instance();
    $CI->load->library('session');
    if($CI->session->userdata('email')){
       return $CI->session->userdata('email'); 
    }   else{
        return false;
    }
}

?>