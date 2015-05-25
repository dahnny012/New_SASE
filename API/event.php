<?php
ini_set('display_errors','1'); error_reporting(E_ALL);

    class Event_View{
        private $data;
        public function __construct($data){
            $this->data = $data;
        }
        public function render(){
            echo $this->data;
        }
        
        public function log(){
            return $this->data;
        }
    }
    
    class Event_Model{
        public $db;
        public function __construct(){
            include "../connection.php";
            $this->db = $db;
        }
        
        public function get(){
            // To test React-Ajax connection.
            $query = $this->db->prepare("Select * from Events");
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($rows);
        }
        
        public function insert($data){
            $insert = $this->db->prepare("Insert into Events (Name,Date,Time,Location,Description,FB) VALUES (?,?,?,?,?,?)");
            $insert->bindParam(1,$event->name);
            $insert->bindParam(2,$event->date);
            $insert->bindParam(3,$event->time);
            $insert->bindParam(4,$event->location);
            $insert->bindParam(5,$event->description);
            $insert->bindParam(6,$event->fb);
            $insert->execute();
            return status($insert);
        }
        
        public function edit($data){
            $edit = $this->db->prepare("Update Events Set Name = ?, Date = ?, Time = ? ,Location = ?, Description = ?,FB = ? WHERE EID = ?");
            $edit->bindParam(1,$event->name);
            $edit->bindParam(2,$event->date);
            $edit->bindParam(3,$event->time);
            $edit->bindParam(4,$event->location);
            $edit->bindParam(5,$event->description);
            $edit->bindParam(6,$event->fb);
            $edit->bindParam(7,$event->id);
            $this->status($insert);
            return status($edit);
        }
        
        public function delete($data){
            $delete = $this->db->prepare("Delete from Events Where EID = ?");
            $delete->bindParam(1,$data["eid"]);
            return status($delete);
        }
    }
    
    class Event_Controller{
        private $model;
        private $view;
        public function __construct(){
            $this->model = new Event_Model();
        }
        public function fetch(){
            if(!empty($_GET)){
                switch($_GET["msg"]){
                    case "query":
                        return $this->model->get();
                    default:
                        return $this->model->get();
                }
            }else if(!empty($data)){
                if(!$this->authenticate($data))
                    return message("error");
                    
                switch($data["msg"]){
                    case "edit":
                        return $this->model->edit($data);
                        break;
                    case "delete":
                        return $this->model->delete($data);
                        break;
                    case "insert":
                        return $this->model->insert($data);
                        break;
                }
            }else{
                return message("success");
            }
        }
        public function authenticate($data){
            return true;
            // blah blah 
        }
    }
    
    // Psuedo-Class i dont want to deal with serialization
    function status($query,$data=null){
        $status;
        if(!$insert->rowCount()){
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
        return json_encode($msg);
    }
    
    
        
    
?>