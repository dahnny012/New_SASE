<?php 
include "libs/simple_html_dom.php";

class Converter{
    public static function email($x500){
        if(strpos($x500,"@") === false){
            $x500 = $x500."@umn.edu";
        }
        return $x500;
    }  
    
    public static function name($name,&$student){
        $names = preg_split('/ /',$name);
        if(count($names) < 2){
            return false;
        }
        $student["first"] = $names[0];
        $student["last"] = end($names);
        return true;
    }
}


class Scraper {
    public static function getStudent($x500){
        $url = Scraper::makeUrl($x500);
        $contents = file_get_html($url);
        $student = array();
        $student["name"] = $contents->find("h2")[0]->plaintext;
        if(!Converter::name($student["name"],$student)){
            return false;
        }
        $student["email"] = Converter::email($x500);
        return $student;
    }
    
    private static function makeUrl($student){
        return "https://umn.edu/lookup?SET_INSTITUTION=&type=Internet+ID&CN=$student&campus=t&role=stu";
    }
}



// Main
/*
if(isset($_GET["x500"])){
    $student = Scraper::getStudent($_GET["x500"]);
    if(!$student){
        $student = [];
    }
    header('Content-Type: application/json');
    echo json_encode($student);
}
*/
function logg($str){
    echo $tr."<br>";
}
?>

