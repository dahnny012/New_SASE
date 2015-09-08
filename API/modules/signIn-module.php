<?php     

ini_set('display_errors','1'); error_reporting(E_ALL);
if(!defined("ROOT")){
    define("ROOT",$_SERVER['DOCUMENT_ROOT']);
}
include_once ROOT."/API/mvc.php";
    
class SignIn_Model extends Model{
    private $db;
    public function __construct(){
        include ROOT."/API/connection.php";
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
    
    public function insertPrograms($post){
        $logs = [];
        $logs["tech"] = fopen(ROOT."/SignIn/logs/tech.txt","a");
        $logs["volunteer"] = fopen(ROOT."/SignIn/logs/volunteer.txt","a");
        $logs["mentor"] = fopen(ROOT."/SignIn/logs/mentor.txt","a");
        
        foreach($post as $key => $value){
            if($value){
                if(isset($logs[$key])){
                    fwrite($logs[$key],$post["name"]." : ".$post["email"]."\n");
                    fclose($logs[$key]);
                }
            }
        }
    }
    
    public function getAll(){
        $query = "Select * from SignIn S,Events E WHERE S.EID = E.EID";
        $getAll = $this->db->prepare($query);
        $getAll->execute();
    }
    
    private function makeMember($student){
        if(!$this->getMember($student)){
            if($student){
                $insert = $this->db->prepare("Insert into Members (Name,Email,x500) Values (?,?,?)");
                $insert->bindParam(1,$student["Name"]);
                $insert->bindParam(2,$student["Email"]);
                $insert->bindParam(3,$student["x500"]);
                $insert->execute();
            }
        }
    }
    
    private function getMember($student){
        $get = $this->db->prepare("Select * from Members where x500 = ?");
        $get->bindParam(1,$student["x500"]);
        if(!$get->execute() && !$get->rowCount()){
            return false;
        }
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
    public $model;
    public function __construct(){
        $this->model = new SignIn_Model();
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
    
    public function fetch($data=["msg"=>""]){
        if(empty($data["msg"])){
            return message("error");
        }
        if(!$this->authenticate){
            return message("error","Not authenticated");
        }
        switch($data["msg"]){
            case "insert":
                return $this->model->insert($data);
            case "programs":
                return $this->model->insertPrograms($data);
            case "getAll":
                return $this->model->getAll();
            default:
                return message("error",$data);
        }
    }
    
    function authenticate(){
        session_start();
        return isset($_SESSION["EvtAdmin"]) || isset($_SESSION["admin"]);
    }
}

?>