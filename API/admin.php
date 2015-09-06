<?php 
session_start();

if(isset($_POST["user"]) && isset($_POST["pass"])){
    if($_POST["user"] == "SOME USER" && $_POST["pass"] == "SOME PASS"){
        $_SESSION["admin"] = true;
    }
}

if(isset($_SESSION["admin"])){
    return true;
}else{
    if(!isset($noForm)){
    ?>
    <form action="" method="POST">
        <input type="text" placeholder="user" name="user">
        <br>
        <input type="text" placeholder="pass" name="pass">
        <br>
        <button>Submit</button>
    </form>
    <?php
    }
    return false;
}


?>