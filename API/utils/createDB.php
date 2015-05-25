<?php 
    include_once "../connection.php";
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $drop = $db->prepare("DROP TABLE IF EXISTS Events");
    $drop->execute();
    $create = $db->prepare("CREATE TABLE IF NOT EXISTS Events (
     EID int(8) NOT NULL auto_increment,
     Name varchar(255) NOT NULL,
     Date Date NOT NULL,
     Time Time NOT NULL,
     Location varchar(50) NOT NULL,
     Description varchar(1000) NOT NULL,
     FB varchar(100) NOT NULL,
     PRIMARY KEY (EID),
     UNIQUE KEY EID (EID)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
    $create->execute();
?>