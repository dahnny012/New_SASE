<?php
ini_set('display_errors','1'); error_reporting(E_ALL);
include "time.php";
include "queries.php";
include "generics.php";

    class Event_View extends View{
        public function __construct($data){
            parent::__construct($data);
        }
    }
    
    class Event_Model{
        public $db;
        public function __construct(){
            include "connection.php";
            $this->db = $db;
        }
        
        public function get($data){
            $restCall = new Event_Query($data);
            $query = $this->db->prepare($restCall->parse());
            $query->execute();
            $rows = [];
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $date = new Time($row['Date']);
                $time = new Time($row['Time']);
                $row['Date'] = $date->toDate();
                $row['Time'] = $time->toTime();
                $rows[] = $row;
            }
            return $rows;
        }
        
        public function insert($event){
            $insert = $this->db->prepare("Insert into Events (Name,Date,Time,Location,Description,FB) VALUES (?,?,?,?,?,?)");
            $insert->bindParam(1,$event["Name"]);
            $insert->bindParam(2,$event["Date"]);
            $insert->bindParam(3,$event["Time"]);
            $insert->bindParam(4,$event["Location"]);
            $insert->bindParam(5,$event["Description"]);
            $insert->bindParam(6,$event["FB"]);
            $insert->execute();
            return status($insert);
        }
        
        public function edit($event){
            $edit = $this->db->prepare("Update Events Set Name = ?, Date = ?, Time = ? ,Location = ?, Description = ?,FB = ? WHERE EID = ?");
            $edit->bindParam(1,$event["Name"]);
            $edit->bindParam(2,$event["Date"]);
            $edit->bindParam(3,$event["Time"]);
            $edit->bindParam(4,$event["Location"]);
            $edit->bindParam(5,$event["Description"]);
            $edit->bindParam(6,$event["FB"]);
            $edit->bindParam(7,$event["EID"]);
            $edit->execute();
            return status($edit);
        }
        
        public function delete($event){
            $delete = $this->db->prepare("Delete from Events Where EID = ?");
            $delete->bindParam(1,$event["EID"]);
            $delete->execute();
            return status($delete);
        }
    }
    
    class Event_Controller{
        private $model;
        private $view;
        public function __construct(){
            $this->model = new Event_Model();
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
    
   
    
$controller = new Event_Controller();
if(!empty($_GET)){
    $data = $controller->fetch($_GET);
    $view = new Event_View($data);
    $view->render();
}else if(!empty($_POST)){
    $data = $controller->fetch($_POST);
    $view = new Event_View($data);
    $view->render();
}else{
    $view = new Event_View(message("error"));
    $view->render();
}

    
    
        
    
?>