<?php

class Quote extends Controller {
  
  protected $output;
    
  public function __construct($controller, $method) {
    parent::__construct($controller, $method);
        
    session_start();
            
    # Any models required to interact with this controller should be loaded here    
    $this->load_model("QuoteModel");
    $this->load_model("EmailModel");
    
    $this->output = new PageView();
        
    $request = $_SERVER["REQUEST_METHOD"];    
    if ($request !== "POST") {
      $this->not_found();
      exit();
    }
    
  }
  
  # Each method will request the model to present the local resource
  # Ajax endpoint
  public function ajax() {
    # The form will reach this point and this should return a JSON response
  }
      
  # Not found handler
  public function not_found() {    
    # Not valid request    
    $mess = array(
      "error" => "Bad request",
    );
    
    $json = json_encode($mess);    
    $this->output->render($json);
    exit();
  }
  
  protected function get_emailbody($emailtemp) {    
    $html_src = $this->get_model("EmailModel")->get_emailtemp($emailtemp);    
    $html = $this->output->replace_localizations($html_src);
    
    return $html;
  }
  
}

?>