<?php 

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
    <img id="header" src="/Assets/Website/SaseUoM.png">
</div>

<body>
    <div id="content">
        <div class="row">
            <div class="signIn-wrap">
                <form class="signIn-form">
                    <div class="signIn-header">
                    
                    </div>
                    
                    <div class="content-forms" id="1">
                        <input type="text" class="signIn-input" autocomplete="off" name="x500">
                        <input type="hidden" name="EID" value="EID">
                    </div>
                    
                    <div class="content-forms" id="2">
                        <input type="text" class="signIn-sub-input" placeholder="Name" autocomplete="off" name="Name">
                        <input type="text" class="signIn-sub-input" placeholder="Email" autocomplete="off" name="Email">
                        <input type="text" class="signIn-sub-input" placeholder="x500" autocomplete="off" name="x500">
                        <button class="signIn-button">Submit</button>
                    </div>
                    
                    <div class="content-forms" id="3">
                        <div class="signIn-input-wrapper">
                            <input class="signIn-programs" type="button" name="option" value="SASE Technical Committee" autocomplete="off"></input>
                            <input class="signIn-programs" type="button" name="option" value="Mentorship Program" autocomplete="off"></input>
                            <input class="signIn-programs" type="button" name="option" value="Volunteer Program" autocomplete="off"></input>
                            <input name="temp" type="hidden" value="true"></input>
                            <input id="tech" name="tech" type="hidden" value=0></input>
                            <input id="mentor" name="mentor" type="hidden" value=0></input>
                            <input id="volunteer" name="volunteer" type="hidden" value=0></input>
                            <button class="signIn-button">Done</button>
                            <button class="signIn-button">Free Spin</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>

</html>


<?php 
function x500(){
?>
    <input type="text" class="signIn-input" autocomplete="off" name="x500">
    <input type="hidden" value="EID">
<?php
}

function student(){
?>
    <input type="text" class="signIn-sub-input" placeholder="Name" autocomplete="off" name="Name">
    <input type="text" class="signIn-sub-input" placeholder="Email" autocomplete="off" name="Email">
    <input type="text" class="signIn-sub-input" placeholder="x500" autocomplete="off" name="x500">
    <button class="signIn-button">Submit</button>
<?php
}

function programs(){
    ?>
    <div class="signIn-input-wrapper">
        <input class="signIn-programs" type="button" name="option" value="SASE Technical Committee" autocomplete="off"></input>
        <input class="signIn-programs" type="button" name="option" placeholder="gg" value="Mentorship Program" autocomplete="off"></input>
        <input class="signIn-programs" type="button" name="option" placeholder="gg" value="Volunteer Program" autocomplete="off"></input>
        <input name="temp" type="hidden" value="true"></input>
        <input id="tech" name="tech" type="hidden" value=0></input>
        <input id="mentor" name="mentor" type="hidden" value=0></input>
        <input id="volunteer" name="volunteer" type="hidden" value=0></input>
        <button class="signIn-button">Done</button>
        <button class="signIn-button">Free Spin</button>
    </div>
    <?php
}


?>