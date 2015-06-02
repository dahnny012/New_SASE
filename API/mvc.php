<?php 

    class Model{
        
        public function __construct(){
        }
        
        public function get($data){
        }
        
        public function insert($data){
        }
        
        public function edit($data){
        }
        
        public function delete($data){
        }
    }



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
    
    
    class Controller{
        private $model;
        private $view;
        public function __construct($model){
            $this->model = $model;
        }
        public function fetch($data=["msg"=>""]){
            if(empty($data["msg"])){
                return message("error");
            }
            if($data["msg"] == "query"){
                return $this->model->get($data);   
            }
            if(!$this->authenticate($data)){
                return message("error");
            }
            //formatDate($data);
            switch($data["msg"]){
                case "edit":
                    return $this->model->edit($data);
                case "delete":
                    return $this->model->delete($data);
                case "insert":
                    return $this->model->insert($data);
                    
                default:
                    return message("error");
            }
        }
        public function authenticate($data){
            return true;
            // blah blah 
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