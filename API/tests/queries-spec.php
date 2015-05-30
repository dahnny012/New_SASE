<?php 

include "../queries.php";

    function byMonth(){
        $data = array();
        $data["byMonth"] = 9;
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 1){
            throw("query failed");
        }
    }
    
    function byYear(){
        $data = array();
        $data["byYear"] = 2015;
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 1){
            throw("query failed");
        }
    }
    
    function byDate(){
        $byFuture = function($data){
            $data["timeframe"] = "future";
            $query = new Event_Query($data);
            echo $query->parse();
            if($query->execute()->rowCount() < 1){
                die("future failed");
            }
        };
        $byPast = function($data){
            $data["timeframe"] = "past";
            $query = new Event_Query($data);
            echo $query->parse();
            if($query->execute()->rowCount() < 1){
                die("past failed");
            }
        };
        // Default
        $data = array();
        $data["byDate"] = "2015-09-19";
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 1){
            die("default failed");
        }
        $byFuture($data);
        $byPast($data);  
    }
    
    function byTime(){
        $data = array();
        $data["byTime"] = "12:12:00";
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 1){
            die("time failed");
        }
    }
    
byMonth();
byYear();
byDate();
byTime();

?>