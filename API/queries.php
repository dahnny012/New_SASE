<?php 
    class Event_Query{
        public $query;
        public function __construct($get){
            
            $base = "Select * from Events Where ";
            
            
            if($get["byMonth"]){
                $month = $get["byMonth"];
                $base .= "Month(Date) = $month";   
            }
            else if($get["byYear"]){
                $month = $get["byYear"];
                $base .= "Year(Date) = $year";   
            }
            else if($get["byDate"]){
                $date = $get["byDate"];
                switch($get["timeframe"]){
                    case "past":
                        $base .= "Date < ";
                        break;
                    case "future":
                        $base .= "Date > ";
                        break;
                    default:
                        $base .= "Date = ";
                }
                
                $base .= $date;
            }
            else if($get["byTime"]){
                $time = $get["byTime"];
                $base .= "Time = $time";
            }else{
                $base ="Select * from Events";
            }
            
            $this->query = $base;
        }
        
        public function parse(){
            return $this->query;
        }
    }
?>