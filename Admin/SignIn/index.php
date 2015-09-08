<?php
if(!include "../../API/admin.php"){
   return;
};

$title=  "Looking at SASE sign ins.";
?>

<html>
   <head>
      <title><?php echo $title; ?></title>
      <script src="https://fb.me/react-0.13.3.js"></script>
      <script src="https://fb.me/JSXTransformer-0.13.3.js"></script>
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
      <script type="text/jsx" src="script.js"></script>
      <link rel="stylesheet" href="style.css">
   </head>
   <div>
      <nav>
         <div class="nav-wrapper blue darken-3">
            <a href="#" class="brand-logo">Admin</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
               <li><a href="../News/index.php">News</a>
               </li>
               <li><a href="../Event/index.php">Events</a>
               </li>
            </ul>
         </div>
      </nav>
   </div>
   <body>
      <div id="content" class="container">
         <div class="row">
            <div class="col s4">
               <h2 class="header">
               <?php echo $title; ?> </h1>
            </div>
            <div class="row">
               <!-- Whatever for member info --->
            </div>
         </div>
      </div>
   </body>
</html>