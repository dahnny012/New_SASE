<?php 
ini_set('display_errors','1'); error_reporting(E_ALL);
include "time.php";
include "queries.php";

class News_View extends View{
    public function __construct($data){
        parent::__construct($data);
    }
}


class News_Model extends Model{
    public function __construct(){
        parent::__construct($data);
    }
    
    public function get($data){
        return;
        $restCall = new News_Query($data);
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
        $edit = $this->db->prepare("Update Events Set Title = ?, Date = ?, Content = ?, ImageSrc = ? WHERE NID = ?");
        $edit->bindParam(1,$news["Title"]);
        $edit->bindParam(2,$news["Date"]);
        $edit->bindParam(3,$news["Content"]);
        $edit->bindParam(4,$news["ImageSrc"]);
        $edit->bindParam(5,$news["NID"]);
        $edit->execute();
        return status($edit);
    }
    
    public function delete($event){
        $delete = $this->db->prepare("Delete from Events Where NID = ?");
        $delete->bindParam(1,$event["NID"]);
        $delete->execute();
        return status($delete);
    }
}


class News_Controller extends Controller{
    public function __contruct(){
        parent::__construct($data);
    }
}



?>