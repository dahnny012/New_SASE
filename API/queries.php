<?php 
    class Event_Query{
        public $query;
        public function __construct($get){
            
            $base = "Select * from Events Where ";
            
            
            if(isset($get["byMonth"])){
                $month = $get["byMonth"];
                $base .= "Month(Date) = $month";   
            }
            else if(isset($get["byYear"])){
                $year = $get["byYear"];
                $base .= "Year(Date) = $year";   
            }
            else if(isset($get["byDate"])){
                $date = $get["byDate"];
                if(!isset($get["timeframe"])){
                    $get["timeframe"] = "default";
                }
                switch($get["timeframe"]){
                    case "past":
                        $base .= "Date <= ";
                        break;
                    case "future":
                        $base .= "Date >= ";
                        break;
                    default:
                        $base .= "Date = ";
                }
                
                $base .= "\"$date\"";
            }
            else if(isset($get["byTime"])){
                $time = $get["byTime"];
                $base .= "Time = \"$time\"";
            }else{
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
            
            
            if(isset($get["byTitle"])){
                $title = "%".$get["byMonth"]."%";
                $base .= "Title Like = $title";   
            }
            else if(isset($get["byDate"])){
                $date = $get["byDate"];
                if(!isset($get["timeframe"])){
                    $get["timeframe"] = "default";
                }
                switch($get["timeframe"]){
                    case "past":
                        $base .= "Date <= ";
                        break;
                    case "future":
                        $base .= "Date >= ";
                        break;
                    default:
                        $base .= "Date = ";
                }
                
                $base .= "\"$date\"";
            }else{
                $base ="Select * from News ORDER BY NID DESC";
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
?>


