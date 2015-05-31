<?php 
    class View{
        private $data;
        public function __construct($data){
            $this->data = $data;
        }
        
        public function render(){
            echo json_encode($this->data);
        }
        
        public function log(){
            var_dump($this->data);
            return $this->data;
        }
        
        public function foo(){
            echo "GG";
        }
    }
    
    class Model{
        public $db;
        public function __construct(){
            include "connection.php";
            $this->db = $db;
        }
    }
    
    
    
    class Controller{
        private $model;
        private $view;
        public function __construct(){
            
        }
        
        public function fetch($data=["msg"=>""]){
            
        }
        
        public function authenticate($data){
            
        }
    }
    
    function status($query,$data=null){
        $status;
        if(!$query->rowCount()){
            $status = message("error");
        }else{
            $status = message("success");
        }
        return $status;
    }
    
     function message($status,$data=null){
        $msg = array();
        $msg["status"] = $status;
        $msg["data"] = $data;
        return $msg;
    }
?>