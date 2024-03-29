<?php

class QuoteModel extends DbModel {
  public $sanitized = array();
  
  public function __construct(){
    $this->sanitized = array();
  }
   
  public function sanitize_str($str) {
    $str = trim($str);
    $str = strip_tags($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
      
    $str = $this->open_link()->real_escape_string($str);    
    $this->close_link();
    
    return $str;
  }
    
  public function sanitize_post($route) {
    $this->sanitized = array();      
    
    foreach ($_POST as $key => $value) {
      $value = trim($value);
      $value = strip_tags($value);
      $value = stripslashes($value);
      $value = htmlspecialchars($value);
      
      $this->sanitized[$key] = $this->open_link()->real_escape_string($value);      
    }
    $this->close_link();
    $this->error_check($route);
    
    return $this->sanitized;
  }
  
  # Error check method
  protected function error_check($route) {
    if (isset($_SESSION["error"]) && count($_SESSION["error"]) > 0) {
      error_log("Error validating form", 0);
      redirect($route);
    }
  }
  
}

?>