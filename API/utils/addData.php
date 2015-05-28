<?php 
    include_once "../connection.php";
    $json = file_get_contents("../events.json");
    $data = json_decode($json)->events;
    foreach($data as $event){
         $insert = $db->prepare("INSERT INTO Events (Name,Date,Time,Location,Description,FB) VALUES (?,?,?,?,?,?)");
         $insert->bindParam(1,$event->Name);
         $insert->bindParam(2,$event->Date);
         $insert->bindParam(3,$event->Time);
         $insert->bindParam(4,$event->Location);
         $insert->bindParam(5,$event->Description);
         $insert->bindParam(6,$event->FB);
         $insert->execute();
         if(!$insert->rowCount()){
             echo "Insert Failed <br>";
         }
    }
?>