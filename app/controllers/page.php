<?php

class Page extends Controller {
  
  protected $output;
    
  public function __construct($controller, $method) {
    parent::__construct($controller, $method);
        
    session_start();
            
    # Any models required to interact with this controller should be loaded here
    $this->load_model("PageModel");
    $this->load_model("EmailModel");
    
    # Instantiate custom view output
    $this->output = new PageView();    
  }
  
  # Each method will request the model to present the local resource
  
  # Landing page method
  public function index() {
  
     $service_list = $this->get_service_name();
     $options = '';
     foreach ($service_list as $key => $value) {
      $options .= "<option value=".$value['id'].">".$value['service_name']."</option>";
     }
    # Tokens array
     $locales = array(
      "service_list" => $options
     );



     $this->output->add_localearray($locales);
     $this->build_page("home");
  }
      
  # Not found handler
  public function not_found() {    
    # 404 page
    # Some method here to build a "Not found" page
     $this->build_page("404");

  }
  
  # Controller/Model/View link
  protected function build_page($page_name) {    
    $html_src = $this->get_model("PageModel")->get_page($page_name);    
    $html = $this->output->replace_localizations($html_src);
    
    $this->output->render($html);
  }
  
  protected function get_emailbody($emailtemp) {    
    $html_src = $this->get_model("EmailModel")->get_emailtemp($emailtemp);    
    $html = $this->output->replace_localizations($html_src);
    
    return $html;
  }

  //get service name
  public function get_service_name(){
     $service_list = $this->get_model("PageModel")->get_serviceList(); 
     return $service_list;

  }

  //get cost
  public function get_cost_by_service_id(){
    
    $service_id = $_POST['service_id'];
    $cost = $this->get_model("PageModel")->get_costByServiceId($service_id); 
    echo $cost[0]['cost'];
    exit;

  }

  
  
}

?>