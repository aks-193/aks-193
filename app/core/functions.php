<?php

# Helper functions

function randomstr($length) {  
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function snake_case($str) {
  return str_replace("-", "_", $str);
}

function is_controller($str) {
  if (file_exists(ROOT . DS . "controllers" . DS . strtolower($str) . ".php")){
    return true;
  }
  else {
    return false;
  }
}

function redirect($page) {
  header ("Location: " . SITE_ROOT . $page);  
  exit();
}

function is_valid_language($str) {
  $languages = array(
    "en-us",
    "es-la",
  );
  
  if (in_array($str, $languages)){
    return true;
  }
  else {
    return false;
  }
}

?>