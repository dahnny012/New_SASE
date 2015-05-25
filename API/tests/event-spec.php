<?php 
    ini_set('display_errors','1'); error_reporting(E_ALL);
    include "../event.php";
    
    
    // Tests able to make a Controller and Model
    // Compare the same data. Should always work
    function initTest(){
        $controller = new Event_Controller() or die("Could not instantiate controller");
        $data = $controller->fetch();
        
        if($data == null){
            die("Null data");
        }
        
        $view = new Event_View($data);
        $result = json_decode($view->log(),true);
        if(compare($result,$result)){
            die("same arrays not matching");
        }
    }
    
    function simpleGetTest(){
        $_GET["msg"] = "query";
        $controller = new Event_Controller() or die("Could not instantiate controller");
        $data = $controller->fetch();
        if($data == null){
            die("Null data");
        }
        $view = new Event_View($data);
        $result = json_decode($view->log(),true);
        var_dump($result);
        $_GET["msg"] = null;
    }
    
    
    function compare($arr,$arr2){
        $err = false;
        foreach($arr as $key => $value){
            if($value != $arr2[$key]){
                echo "Error: $key $value <br>";
                $err = true;
            }
        }
        return $err;
    }

    initTest();
    simpleGetTest();
?>