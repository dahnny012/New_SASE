<?php 
ini_set('display_errors','1'); error_reporting(E_ALL);
if(!defined("ROOT")){
    define("ROOT",$_SERVER['DOCUMENT_ROOT']);
}
include_once ROOT."/API/mvc.php";
include_once ROOT."/API/time.php";
include_once ROOT."/API/queries.php";


    class Event_View extends View{
        public function __construct($data){
            parent::__construct($data);
        }
    }
    
    class Event_Model extends Model{
        public $db;
        public function __construct(){
            include ROOT."/API/connection.php";
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
            $insert = $insert->execute();
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
            $edit = $edit->execute();
            return status($edit,$event);
        }
        
        public function delete($event){
            $delete = $this->db->prepare("Delete from Events Where EID = ?");
            $delete->bindParam(1,$event["EID"]);
            $delete = $delete->execute();
            return status($delete);
        }
    }
    
    class Event_Controller extends Controller{
        public $log;
        public function __construct(){
            parent::__construct(new Event_Model());
        }
        
        public function run(){
            if(!empty($_GET)){
                $data = $this->fetch($_GET);
                $view = new Event_View($data);
                $view->render();
            }else if(!empty($_POST)){
                if(isset($_POST['Date'])){
                    $date = new Time($_POST['Date']);
                    $_POST['Date'] = $date->toDate(true);
                }
                $data = $this->fetch($_POST);
                $this->log = $data;
                $view = new Event_View($data);
                $view->render();
            }else{
                $view = new Event_View(message("error"));
                $view->render();
            }
        }
    }
    
?>