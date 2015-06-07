<?php 

include "../queries.php";
function event_test(){
    $byMonth = function(){
        $data = array();
        $data["byMonth"] = 9;
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 1){
            throw("query failed");
        }
    };
    
    $byYear = function(){
        $data = array();
        $data["byYear"] = 2015;
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 1){
            throw("query failed");
        }
    };
    
    $byDate = function(){
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
    };
    
    $byTime = function(){
        $data = array();
        $data["byTime"] = "12:12:00";
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 1){
            die("time failed");
        }
    };
    
    $byMonthByYear = function(){
        $data = array();
        $data["byYear"] = 2015;
        $data["byMonth"] = 9;
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 2){
            die("query failed");
        }
    };
    
    $byDateByTime = function(){
        $data = array();
        $data["byDate"] = "2015-9-19";
        $data["byTime"] = "14:30:00";
        $query = new Event_Query($data);
        echo $query->parse();
        if($query->execute()->rowCount() < 1){
            die("query failed");
        }
    };
    $byMonth();
    $byYear();
    $byDate();
    $byTime();
    $byMonthByYear();
    $byDateByTime();
}


function news_test(){
    $byTitle=function(){
        
    };
    $byMonth=function(){
        
    };
    $byDate=function(){
        
    };
    $byMonthByYear=function(){
        
    };
    
    $byTitle();
    $byMonth();
    $byDate();
    $byMonthByYear();
}

event_test();
    


?>