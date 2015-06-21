<?php
session_start();
mainPage();
/*
$currentTime = new DateTime();
if(isset($_SESSION['timeAlive']) && $currentTime->getTimestamp() - $_SESSION['timeAlive'] >=  (3600 * 12)) // 12 hours
{
   session_destroy(); 
   echo'Your session has ended';
}
if(isset($_SESSION['EvtAdmin']) && $_SESSION['EvtAdmin'] == 'EvtAdmin')
{
	
}
else if(!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['Evt']))
{
   $pass = 'Kiki942014';
   $user = 'KikiThePanda';
  
   if($_POST['pass'] == $pass && $_POST['user'] == $user)
   {
      $time = new DateTime();
      $_SESSION['EvtAdmin'] = 'EvtAdmin';
      $date = date("Y.m.d");
      $_SESSION['Evt'] = "[$date] ".$_SESSION['Evt'];
      $_SESSION['timeAlive'] = $time->getTimestamp();
      addToMaster();
      ?> <script> setTimeout("location.href= 'signIn.php';",100); </script> <?php
      

   }
   else
   {
      loginForm();
   }
}
else
{
	loginForm();
}*/

/*
function addToMaster()
{
include 'connection.php';
$add = $db->prepare("UPDATE `Admin`
   SET vars = Concat(vars,?)
   WHERE user = 'Evt_master'");
   $concat = '~'.$_SESSION['Evt'];
   $add->bindParam(1,$concat);
   $add->execute();
}
*/

function loginForm()
{
?>
	<div>
	<form action="signIn.php" method="POST">
		<input type="text" name="user"> </input> Username
      <br>
		<input type="password" name="pass"> </input> Password
      <br>
      <input type="text" name="Evt"> </input>What is the new event name?(dates no longer needed)
      <br>
		<input type="submit"  name="submit" value="login"></input>
	</form>
	<?php
}


function mainPage()
{
?>


<?php 
}
?>

