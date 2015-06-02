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
    public function __construct(){
        include "connection.php";
        $this->db = $db;
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
        return status($insert);
    }
    
    public function edit($news){
        $edit = $this->db->prepare("Update News Set Title = ?, Date = ?, Content = ?, ImageSrc = ? WHERE NID = ?");
        $edit->bindParam(1,$news["Title"]);
        $edit->bindParam(2,$news["Date"]);
        $edit->bindParam(3,$news["Content"]);
        $edit->bindParam(4,$news["ImageSrc"]);
        $edit->bindParam(5,$news["NID"]);
        $edit->execute();
        return status($edit);
    }
    
    public function delete($news){
        $delete = $this->db->prepare("Delete from News Where NID = ?");
        $delete->bindParam(1,$news["NID"]);
        $delete->execute();
        return status($delete);
    }
}


class News_Controller extends Controller{
    public function __construct(){
        parent::__construct(new News_Model());
    }
    
    public function run(){
        if(!empty($_GET)){
            $data = $this->fetch($_GET);
            $view = new News_View($data);
            $view->render();
        }else if(!empty($_POST)){
            $data = $this->fetch($_POST);
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