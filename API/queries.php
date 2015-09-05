<?php 
    class Event_Query{
        public $query;
        public function __construct($get){
            
            $base = "Select * from Events Where ";
            $and = false;
            $mod = false;
            
            if(isset($get["byMonth"])){
                $month = $get["byMonth"];
                $base .= "Month(Date) = $month";
                $and = true;
                $mod = true;
            }
            if(isset($get["byYear"])){
                $year = $get["byYear"];
                if($and){
                    $base .= " AND ";
                }
                $base .= "Year(Date) = $year";
                $and = true;
                $mod = true;
            }
            if(isset($get["byDate"])){
                $date = $get["byDate"];
                if(!isset($get["timeframe"])){
                    $get["timeframe"] = "default";
                }
                if($and){
                    $base .= " AND ";
                }
                switch($get["timeframe"]){
                    case "past":
                        $base .= "Date(Date) <= ";
                        break;
                    case "future":
                        $base .= "Date(Date) >= ";
                        break;
                    default:
                        $base .= "Date(Date) = ";
                }
                
                $base .= "\"$date\"";
                $and = true;
                $mod = true;
            }
            if(isset($get["byTime"])){
                $time = $get["byTime"];
                if($and){
                    $base .= " AND ";
                }
                $base .= "Time(Time) = \"$time\"";
                $mod = true;
            }
            if(!$mod){
                $base ="Select * from Events ORDER BY EID DESC";
            }
            
            $this->query = $base;
        }
        
        public function parse(){
            return $this->query;
        }
        
        public function execute(){
            include "../connection.php";
            $query = $db->prepare($this->query);
            $query->execute();
            return $query;
        }
    }
    
    class News_Query{
        public $query;
        public function __construct($get){
            
            $base = "Select * from News Where ";
            $and = false;
            $mod = false;
            $lol = false;
            if(isset($get["byTitle"])){
                $title = "\"%".html_entity_decode($get["byTitle"])."%\"";
                $base .= "Title Like $title";
                $and = true; $mod = true;
            }
            if(isset($get["byMonth"])){
                $month = $get["byMonth"];
                $base .= "Month(Date) = $month";
                if($and){
                    $base .= " AND ";
                }
                $and = true; $mod = true; $lol = true;
            }
            if(isset($get["byYear"])){
                $year = $get["byYear"];
                if($and){
                    $base .= " AND ";
                }
                $base .= "Year(Date) = $year";
                $mod = true;
            }
            if(isset($get["byDate"])){
                $date = $get["byDate"];
                if(!isset($get["timeframe"])){
                    $get["timeframe"] = "default";
                }
                
                if($and){
                    $base .= " AND ";
                }
                switch($get["timeframe"]){
                    case "past":
                        $base .= "Date(Date) <= ";
                        break;
                    case "future":
                        $base .= "Date(Date) >= ";
                        break;
                    default:
                        $base .= "Date(Date) = ";
                }
                
                $base .= "\"$date\"";
                $mod = true;
            }
            if(!$mod){
                $base ="Select * from News ORDER BY Date DESC";
            }
            $this->query = $base;
        }
        
        public function parse(){
            return $this->query;
        }
        
        public function execute(){
            include "../connection.php";
            $query = $db->prepare($this->query);
            $query->execute();
            return $query;
        }
    }
    
    class SignIn_Query{
        
        
    }
?>


