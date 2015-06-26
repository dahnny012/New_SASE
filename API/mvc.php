<?php 

    class Model{
        
        public function __construct(){
        }
        
        public function get($data){
            return status(false);
        }
        
        public function insert($data){
            return status(false);
        }
        
        public function edit($data){
            return status(false);
        }
        
        public function delete($data){
            return status(false);
        }
        
        public function docRoot(){
            return "/home/ubuntu/workspace";
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
    }
    
    
    class Controller{
        private $model;
        private $view;
        public function __construct($model){
            $this->model = $model;
        }
        
        public function run(){
            if(!empty($_GET)){
                $data = $controller->fetch($_GET);
                $view = new View($data);
                $view->render();
            }else if(!empty($_POST)){
                $data = $controller->fetch($_POST);
                $view = new View($data);
                $view->render();
            }else{
                $view = new View(message("error",$data));
                $view->render();
            }
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
                    return message("error",$data);
            }
        }
        public function authenticate($data){
            return true;
            // blah blah 
        }
    }
    
    function status($query,$data=null){
        $status;
        if(!$query){
            $status = message("error",$data);
        }else{
            $status = message("success",$data);
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