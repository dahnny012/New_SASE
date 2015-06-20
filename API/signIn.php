<?php 
    include "mvc.php";
    class SignIn_Model extends Model{
        public function __construct(){
            
        }
        
        public function insert(){
            
        }
    }
    
    
    class SignIn_View extends View{
        public function __construct($data){
            parent::__construct($data);
        }
    }
    
    
    class SignIn_Controller extends Controller{
        public $log;
        public function __construct(){
            parent::__construct(new SignIn_Model());
        }
        
        public function run(){
            if(!empty($_GET)){
                $data = $this->fetch($_GET);
                $view = new SignIn_View($data);
                $view->render();
            }else if(!empty($_POST)){
                $data = $this->fetch($_POST);
                $this->log = $data;
                $view = new SignIn_View($data);
                $view->render();
            }else{
                $view = new SignIn_View(message("error"));
                $view->render();
            }
        }
    }
    
    
$controller = new SignIn_Controller();
$controller->run();
?>