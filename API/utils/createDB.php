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
    ) ENGINE=INNODB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
    $create->execute();
    
    $drop = $db->prepare("DROP TABLE IF EXISTS News");
    $drop->execute();
    $create = $db->prepare("CREATE TABLE IF NOT EXISTS News (
     NID int(8) NOT NULL auto_increment,
     Title varchar(255) NOT NULL,
     Date Date NOT NULL,
     Content varchar(1000) NOT NULL,
     ImageSrc varchar(255),
     PRIMARY KEY (NID),
     UNIQUE KEY NID (NID)
    ) ENGINE=INNODB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
    $create->execute();
    
    
    $drop = $db->prepare("DROP TABLE IF EXISTS Members");
    $drop->execute();
    $create = $db->prepare("CREATE TABLE IF NOT EXISTS Members (
     Name varchar(32),
     x500 varchar(64) NOT NULL,
     Email varchar(64),
     PRIMARY KEY (x500),
     UNIQUE KEY x500 (x500)
    ) ENGINE=INNODB DEFAULT CHARSET=latin1");
    $create->execute();
    
    
    $drop = $db->prepare("DROP TABLE IF EXISTS SignIn");
    $drop->execute();
    $create = $db->prepare("CREATE TABLE IF NOT EXISTS SignIn (
     EID int(8) NOT NULL,
     x500 varchar(64) NOT NULL,
     PRIMARY KEY (EID,x500),
     FOREIGN KEY (EID) REFERENCES Events(EID),
     FOREIGN KEY (x500) REFERENCES Members(x500)
    ) ENGINE=INNODB DEFAULT CHARSET=latin1");
    $create->execute();
?>