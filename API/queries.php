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
                $mode = true;
            }
            if(isset($get["byYear"])){
                $year = $get["byYear"];
                if($and){
                    $base .= " AND ";
                }
                $base .= "Year(Date) = $year";
                $and = true;
                $mode = true;
            }
            else if(isset($get["byDate"])){
                $date = $get["byDate"];
                if(!isset($get["timeframe"])){
                    $get["timeframe"] = "default";
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
            $mode = false;
            $lol = false;
            if(isset($get["byTitle"])){
                $title = "%".$get["byTitle"]."%";
                $base .= "Title Like = $title";
                $and = true;
            }
            if(isset($get["byMonth"])){
                $month = $get["byMonth"];
                $base .= "Month(Date) = $month";
                if($and){
                    $base .= " AND ";
                }
                $and = true; $mode = true; $lol = true;
            }
            if(isset($get["byYear"])){
                $year = $get["byYear"];
                if($and){
                    $base .= " AND ";
                }
                $base .= "Year(Date) = $year";
                
            }
            else if(isset($get["byDate"] && !$lol)){
                $date = $get["byDate"];
                if(!isset($get["timeframe"])){
                    $get["timeframe"] = "default";
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


