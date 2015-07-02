<?php

ini_set('display_errors','1'); error_reporting(E_ALL);

if(!defined("ROOT")){
    define("ROOT",$_SERVER['DOCUMENT_ROOT']);
}
    session_start();

    $currentTime = new DateTime();
    if(isset($_SESSION['timeAlive']) && $currentTime->getTimestamp() - $_SESSION['timeAlive'] >=  (3600 * 12)) // 12 hours
    {
       session_destroy();
    }
    
    if(isset($_SESSION["EID"])){
        header('Location: signIn.php');
    }
    
    if(!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['Evt']))
    {
       $user = 'saseumn';
       $pass = 'kikipanda123';
      
       if($_POST['pass'] == $pass && $_POST['user'] == $user)
       {
          $time = new DateTime();
          $_SESSION['EvtAdmin'] = 'EvtAdmin';
          $date = date("Y.m.d");
          $_SESSION['EID'] = "[$date] ".$_SESSION['EID'];
          $_SESSION['timeAlive'] = $time->getTimestamp();
          header('Location: signIn.php');
       }
       else
       {
          loginForm();
       }
    }
    else
    {
    	loginForm();
    }


function loginForm()
{
?>
	<form action="index.php" method="POST">
		<input type="text" name="user"> </input> Username
      <br>
		<input type="password" name="pass"> </input> Password
      <br>
      <Select name="Evt">
      <?php
        getEvents(); 
      ?>
      </Select>
      <br>
		<input type="submit"  name="submit" value="login"></input>
	</form>
	<?php
}



function getEvents(){
    $base = function($id,$name){
        ?>
          <option value=<?php echo $id; ?>><?php echo $name; ?></option>
        <?php 
    };
    
    include ROOT."/API/modules/event-module.php";
    $event = new Event_Model();
    $query = array();
    $result = $event->get($query);

    foreach($result as $event){
        $base($event["EID"],$event["Name"]."(".$event["Date"].")");
    }
}



?>