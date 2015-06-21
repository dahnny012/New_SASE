<?php 

    $msg = "Is this Correct?";
?>
<html>

<head>
    <title>Sign In</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/jsx" src="script.js"></script>
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
                        <?php echo $msg; ?>
                    </div>
                    
                    
                    
                    <?php //form(); ?>
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

function student(){
?>
    
<?php
}

}


?>