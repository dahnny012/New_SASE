<?php
    

    
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
            $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($query);
        }
        
        public function insert($_POST){
            $insert = $this->db->prepare("Insert into Events (Name,Date,Time,Location,Description,FB) VALUES (?,?,?,?,?,?)");
            $insert->bindParam(1,$event->name);
            $insert->bindParam(2,$event->date);
            $insert->bindParam(3,$event->time);
            $insert->bindParam(4,$event->location);
            $insert->bindParam(5,$event->description);
            $insert->bindParam(6,$event->fb);
            $insert->execute();
            echo $this->status($insert);
        }
        
        public function edit($_POST){
            $edit = $this->db->prepare("Update Events Set Name = ?, Date = ?, Time = ? ,Location = ?, Description = ?,FB = ? WHERE EID = ?");
            $edit->bindParam(1,$event->name);
            $edit->bindParam(2,$event->date);
            $edit->bindParam(3,$event->time);
            $edit->bindParam(4,$event->location);
            $edit->bindParam(5,$event->description);
            $edit->bindParam(6,$event->fb);
            $edit->bindParam(7,$event->id);
            $this->status($insert);
            echo $this->status($edit);
        }
        
        public function delete($_POST){
            $delete = $this->db->prepare("Delete from Events Where EID = ?");
            $delete->bindParam(1,$_POST["eid"]);
            echo $this->status($delete)
        }
        // Sugar 
        private function status($query){
            $status = ["status":""];
            if(!$insert->rowCount()){
                $status["status"] = "error";
            }else{
                $status["status"] = "success";
            }
            return json_encode($status);
        }
    }
    
        class Event_Controller{
        private $model = new Event_Model();
        public function route(){
            if(!empty($_GET)){
                switch($_GET["msg"]){
                    case:"query":
                        $this->model->get();
                    default:
                        $this->model->get();
                }
            }else if(!empty($_POST)){
                if(!$this->authenticate($_POST))
                    return;
                    
                switch($_POST["msg"]){
                    case "edit":
                        $this->model->edit($_POST);
                        break;
                    case "delete":
                        $this->model->delete($_POST);
                        break;
                    case "insert":
                        $this->model->insert($_POST);
                        break;
                }
            }
        }
        public function authenticate($_POST){
            return true;
            // blah blah 
        }
    }
?>