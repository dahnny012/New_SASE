<?php 

$_POST['FF'] = "GG";

var_dump($_POST);

unset($_POST);

if(isset($_POST['FF'])){
    echo "GG";
}
?>