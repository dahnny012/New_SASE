<?php 
    include_once "../connection.php";
    $json = file_get_contents("../events.json");
    $data = json_decode($json)->events;
    foreach($data as $event){
         $insert = $db->prepare("INSERT INTO Events (Name,Date,Time,Location,Description,FB) VALUES (?,?,?,?,?,?)");
         $insert->bindParam(1,$event->name);
         $insert->bindParam(2,$event->date);
         $insert->bindParam(3,$event->time);
         $insert->bindParam(4,$event->location);
         $insert->bindParam(5,$event->description);
         $insert->bindParam(6,$event->fb);
         $insert->execute();
         if(!$insert->rowCount()){
             echo "Insert Failed <br>";
         }
    }
?>