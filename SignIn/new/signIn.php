<?php 

session_start();

if(empty($_SESSION["EID"])){
    header('Location: index.php');
}

    $msg = "Please enter your x500";

?>

<html>

<head>
    <title>Sign In</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="style.css">
</head>
<div class="header-wrap">
    <a href="" ><img id="header" src="/Assets/Website/SaseUoM.png"></a>
</div>

<body>
    <div class="gearWrapper">
        <img class="gearFiles" src="/Assets/SignIn/gear01.png"> </img>
        <img class="gearFiles" src="/Assets/SignIn/gear02.png"> </img>
        <img class="gearFiles" src="/Assets/SignIn/gear05.png"> </img>
        <img class="gearFiles" src="/Assets/SignIn/gear12.png"> </img>
        <img class="gearFiles" src="/Assets/SignIn/gear14.png"> </img>
        <img class="gearFiles" src="/Assets/SignIn/gear17.png"> </img>
        <img class="gearFiles" src="/Assets/SignIn/gear18.png"> </img>
        <img class="gearFiles" src="/Assets/SignIn/gear19.png"> </img>
        <img class="gearFiles" src="/Assets/SignIn/gear20.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear21.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear22.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear23.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear24.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear25.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear26.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear27.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear28.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear29.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear30.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear31.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear32.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear33.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear34.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear35.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear36.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear37.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear38.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear39.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear41.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear45.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear46.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear49.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear50.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear51.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear52.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear53.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear54.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear55.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear56.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear57.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear58.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear59.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear60.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear61.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear62.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear63.png"></img>
        <img class="gearFiles" src="/Assets/SignIn/gear64.png"></img>
        </img>
    </div>


    <div id="win" class="gameText">
        Congratulations you are a winner!
    </div>
    <div id="lose" class="gameText">
        Sorry you did not win.
    </div>
    <div id="randWrapper">


    </div>
    <div id="content">
        <div class="row">
            <div class="signIn-wrap">
                <form class="signIn-form">
                    <div class="signIn-header">
                    
                    </div>
                    
                    <div class="content-forms" id="1">
                        <input type="text" class="signIn-input" autocomplete="off" name="x500">
                    </div>
                    
                    <div class="content-forms" id="2">
                        <input type="text" class="signIn-sub-input" placeholder="Name" autocomplete="off" name="Name">
                        <input type="text" class="signIn-sub-input" placeholder="Email" autocomplete="off" name="Email">
                        <input type="text" class="signIn-sub-input" placeholder="x500" autocomplete="off" name="x500">
                        <input type="hidden" name="EID" value="<?php echo $_SESSION["EID"] ?>">
                        <button class="signIn-button">Submit</button>
                    </div>
                    
                    <div class="content-forms" id="3">
                        <div class="signIn-input-wrapper">
                            <input class="signIn-programs" type="button" name="option" value="SASE Technical Committee"></input>
                            <input class="signIn-programs" type="button" name="option" value="Mentorship Program"></input>
                            <input class="signIn-programs" type="button" name="option" value="Volunteer Program"></input>
                            <input id="tech" name="tech" type="hidden" value=0></input>
                            <input id="mentor" name="mentor" type="hidden" value=0></input>
                            <input id="volunteer" name="volunteer" type="hidden" value=0></input>
                            <button id="done" class="signIn-button">Done</button>
                            <button id="rand" class="signIn-button" id=>Free Spin</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>

</html>