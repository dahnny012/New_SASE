<?php 
    include "mvc.php";
    include "signIn.php";
    
    class SignIn_Model extends Model{
        public function __construct(){
            include "connection.php";
            $this->db = $db;
        }
        
        public function insert($post){
            // Exists in DB add in Members
            $this->makeMember($post);
            // Insert Into SignIns using the x500
            $signIn = $this->db->prepare("Insert into SignIn (EID,x500) Values (?,?)");
            $signIn->bindParam(1,$post["EID"]);
            $signIn->bindParam(2,$post["x500"]);
            $status = $signIn->execute();
            return status($status);
        }
        
        private function makeMember($post){
            if(!$this->get($post)){
                // Doesnt exist query UMN
                $student = Scraper::getStudent($post["x500"]);
                // Insert into Members
                $insert;
                if($student){
                    $insert = $this->db->prepare("Insert into Members (First,Last,Name,Email,x500) Values (?,?,?,?,?)");
                    $insert->bindParam(1,$student["First"]);
                    $insert->bindParam(2,$student["Last"]);
                    $insert->bindParam(3,$student["Name"]);
                    $insert->bindParam(4,$student["Email"]);
                    $insert->bindParam(5,$student["x500"]);
                }else{
                    $insert = $this->db->prepare("Insert into Members (x500) Values (?)");
                    $insert->bindParam(1,$post["x500"]);
                }
                $insert->execute();
            }
        }
        
        private function get($student){
            $get = $this->prepare("Select from Members where x500 = ?");
            $get->bindParam(1,$student["x500"]);
            if(!$get->execute())
                return false;
            $row = $get->fetch(PDO::FETCH_ASSOC);
            return $row;
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