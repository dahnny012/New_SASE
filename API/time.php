<?php 
class Time{
    public $data;
    public function __construct($data){
        $this->data = $data;
    }
    public function toDate($model=false){
        $data = strtotime($this->data);
        if($model)
            return date("Y-m-d",$data);
        return date("F d, Y",$data);
        
    }
    public function toTime($model=false){
        if($model)
            return $this->timeDataToModel();
        return $this->timeModelToData();
    }
    
    function timeModelToData(){
        // Split the time
        $split = preg_split("/:/",$this->data);
        $hours = intval($split[0]);
        $meridian = "AM";
        if($hours / 12 > 1){
            $meridian = "PM";
            $hours -= 12;
        }
        return "$hours:".$split[1]." $meridian";
    }
    
    function timeDataToModel(){
        // Split the time
        $split = preg_split("/:| /",$this->data);
        $hours = $split[0];
        if($split[2] == "PM"){
            $hours = intval($split[0]);
            $hours += 12;
        }
        
        return "$hours:".$split[1].":00";
    }
}
?>