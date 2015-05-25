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
        $result = $view->log();
        test($result["status"],"error");
    }
    
    function simpleGetTest(){
        clear();
        logg("Get Test: ");
        $_GET["msg"] = "query";
        $controller = new Event_Controller() or die("Could not instantiate controller");
        $data = $controller->fetch($_GET);
        if($data == null){
            die("Null data");
        }
        $view = new Event_View($data);
        $result = $view->log();
        test(count($result),3);
        unset($_GET);
        clear();
    }
    
    function simpleDelTest(){
        logg("Del Test:");
        clear();
        $_POST["msg"] = "delete";
        $_POST["eid"] = 1;
        $controller = new Event_Controller() or die("Could not instantiate controller");
        $data = $controller->fetch($_POST);
        if($data == null){
            die("Null data");
        }
        $view = new Event_View($data);
        $result = $view->log();
        test($result["status"],"success");
        unset($_POST);
        clear();
    }
    
    function simpleInsertTest(){
        logg("Insert Test:");
        clear();
        $_POST["msg"] = "insert";
        $_POST["name"] = "InsertTest";
        $_POST["date"] = "2015-05-25";
        $_POST["time"] = "05-06-00";
        $_POST["location"] = "Danhs House";
        $_POST["description"] = "Test Insertion Test";
        $_POST["fb"] = "https://example.com";
        $controller = new Event_Controller() or die("Could not instantiate controller");
        $data = $controller->fetch($_POST);
        if($data == null){
            die("Null data");
        }
        $view = new Event_View($data);
        $result = $view->log();
        test($result["status"],"success");
        unset($_POST);
        clear();
    }
    
    function simpleEditTest(){
        logg("Edit Test:");
        clear();
        $_POST["msg"] = "edit";
        $_POST["name"] = "InsertTest";
        $_POST["date"] = "2015-05-25";
        $_POST["time"] = "05-06-00";
        $_POST["location"] = "Danhs House";
        $_POST["description"] = "Test Insertion Test";
        $_POST["fb"] = "https://example.com";
        $_POST["id"] = 1;
        $controller = new Event_Controller() or die("Could not instantiate controller");
        $data = $controller->fetch($_POST);
        if($data == null){
            die("Null data");
        }
        $view = new Event_View($data);
        $result = $view->log();
        test($result["status"],"success");
        unset($_POST);
        clear();
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
    
    function test($a,$b)
    {
        if($a != $b){
            die("$a does not equal $b \n");
        }
    }
    
    function clear(){
        include "../connection.php";
        include "../utils/createDB.php";
        include "../utils/addData.php";
    }
    
    function logg($msg){
        echo "$msg \n";
    }

    initTest();
    simpleGetTest();
    simpleDelTest();
    simpleInsertTest();
    simpleEditTest();
?>