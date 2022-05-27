<?php
function check_by_pattern($pattern, $str){
    return preg_match($pattern, $str);
}
function is_uid($uid){
    $pattern = "/^[0-9]{9,12}$/";
    return preg_match($pattern, $uid);
}

function is_username($username){
    $pattern = "/^([\w\._]+){6,32}$/";
    return preg_match($pattern, $username);
}

function is_password($password){
    $pattern = "/^([A-Z]){1}([\w\._!@#$%^&*()]+){5,31}$/";
    return preg_match($pattern, $password);
}

function is_fullname($fullname){
    $pattern = "/^[^0-9~!@#$%^&*()]{1,40}$/";
    #Không phải số hay ký tự đặc biệt là được
    return preg_match($pattern, $fullname);
}

function is_email($email){
    $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    //Ex:
    return preg_match($pattern, $email);
}

function return_alert($alert_name){
    global $alerts;
    if(isset($alerts[$alert_name])){
        return "<p class='alert'>{$alerts[$alert_name]}</p>";
    }
    return FALSE;
}

function return_error($err_name){
    global $errors;
    if(isset($errors[$err_name])){
        return "<p class='error'>{$errors[$err_name]}</p>";
    }
    return FALSE;
}

function return_val($val_name){
    global $$val_name;
    if(!empty($$val_name)){
        return $$val_name;
    }
    return FALSE;
}
?>