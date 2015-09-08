<?php 
    include_once "../connection.php";
    $json = file_get_contents("../test-data/events.json");
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
    
    $json = file_get_contents("../test-data/news.json");
    $data = json_decode($json)->news;
    foreach($data as $news){
         $insert = $db->prepare("INSERT INTO News (Title,Date,Content,ImageSrc) VALUES (?,?,?,?)");
         $insert->bindParam(1,$news->Title);
         $insert->bindParam(2,$news->Date);
         $insert->bindParam(3,$news->Content);
         $insert->bindParam(4,$news->ImageSrc);
         $insert->execute();
         if(!$insert->rowCount()){
             echo "Insert Failed <br>";
         }
    }
    
    $json = file_get_contents("../test-data/signIn.json");
    $data = json_decode($json)->members;
    foreach($data as $member){
         $insert = $db->prepare("INSERT INTO Members (Name,x500) VALUES (?,?)");
         $insert->bindParam(1,$member->Name);
         $insert->bindParam(2,$member->x500);
         $insert->execute();
         
         $signIn = $db->prepare("Insert INTO SignIn(EID,x500) VALUES (?,?)");
         $signIn->bindParam(1,$member->EID);
         $signIn->bindParam(2,$member->x500);
         $signIn->execute();
    }
?>