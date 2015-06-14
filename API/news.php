<?php 
ini_set('display_errors','1'); error_reporting(E_ALL);
include "time.php";
include "queries.php";
include "mvc.php";

class News_View extends View{
    public function __construct($data){
        parent::__construct($data);
    }
}


class News_Model extends Model{
    public $db;
    private $root;
    private $docRoot;
    public function __construct(){
        include "connection.php";
        $this->db = $db;
        $this->root = "/Assets/News/";
        $this->docRoot = "/home/ubuntu/workspace";
    }
    
    public function get($data){
        $restCall = new News_Query($data);
        $query = $this->db->prepare($restCall->parse());
        $query->execute();
        $rows = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $date = new Time($row['Date']);
            $row['Date'] = $date->toDate();
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function insert($news){
        $insert = $this->db->prepare("Insert into News (Title,Date,Content,ImageSrc) VALUES (?,?,?,?)");
        $insert->bindParam(1,$news["Title"]);
        $insert->bindParam(2,$news["Date"]);
        $insert->bindParam(3,$news["Content"]);
        $insert->bindParam(4,$news["ImageSrc"]);
        $insert->execute();
        
        
        $id= $this->db->lastInsertID();
        $status = status($insert);
        if($status["status"] == "success" && !empty($_FILES['file']['name'])){
            $this->uploadHandler($id);
        }
        return $status;
    }
    
    public function edit($news){
        $edit = $this->db->prepare("Update News Set Title = ?, Date = ?, Content = ?, ImageSrc = ? WHERE NID = ?");
        $edit->bindParam(1,$news["Title"]);
        $edit->bindParam(2,$news["Date"]);
        $edit->bindParam(3,$news["Content"]);
        $edit->bindParam(4,$news["ImageSrc"]);
        $edit->bindParam(5,$news["NID"]);
        
        $id= $this->db->lastInsertID();
        $status = status($edit);
        if($status["status"] == "success" && !empty($_FILES['file']['name'])){
            $this->uploadHandler($id);
        }
        $edit->execute();
        return $status;
    }
    
    public function delete($news){
        
        $imageSrc = $this->fetchImageSrc($new["NID"]);
        
        $delete = $this->db->prepare("Delete from News Where NID = ?");
        $delete->bindParam(1,$news["NID"]);
        $delete->execute();
        
        
        $status = status($delete);
        if($status["status"] == "success" && !empty($imageSrc)){
            unlink($this->docRoot.$imageSrc);
        }
        return $status;
    }
    
    private function uploadHandler($id){
        // MD5 the title
        $hashedID = md5($_FILES['file']['name']);
        // Find a unique md5
        while(file_exists($this->docRoot.$this->root.$hashedID.".jpg")){
            $hashedID = md5($hashedID);
        }
        $hashedID = substr($hashedID, 0, 8);
        $file = $this->root.$hashedID.".jpg";
        move_uploaded_file ($_FILES['file']['tmp_name'] , $this->docRoot.$file);
        $update = $this->db->prepare("Update News Set ImageSrc = ? Where NID  = ?");
        $update->bindParam(1,$file);
        $update->bindParam(2,$id);
        $update->execute();
    }
    
    private function fetchImageSrc($id){
        $file = $this->db->prepare("Select ImageSrc from News where NID = ?");
        $file->bindParam(1,$id);
        $row=$fetchFile->fetch(PDO::FETCH_ASSOC);
        $fileLocation = $row['ImageSrc'];
        return $fileLocation;
    }
}


class News_Controller extends Controller{
    public $log;
    public function __construct(){
        parent::__construct(new News_Model());
    }
    
    public function run(){
        if(!empty($_GET)){
            $data = $this->fetch($_GET);
            $view = new News_View($data);
            $view->render();
        }else if(!empty($_POST)){
            if(isset($_POST['Date'])){
                $date = new Time($_POST['Date']);
                $_POST['Date'] = $date->toDate(true);
            }
            $data = $this->fetch($_POST);
            $this->log = $data;
            $view = new News_View($data);
            $view->render();
        }else{
            $view = new News_View(message("error"));
            $view->render();
        }
    }
}

$controller = new News_Controller();
$controller->run();


?>