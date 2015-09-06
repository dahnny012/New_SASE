<?php 
session_start();
if(!include "../API/admin.php"){
   return;
};
?>
<html>

<head>
   <title>Submitting an Event</title>
   <script src="https://fb.me/react-0.13.3.js"></script>
   <script src="https://fb.me/JSXTransformer-0.13.3.js"></script>
   <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
   <script type="text/jsx" src="script.js"></script>
   <link rel="stylesheet" href="style.css">
</head>
<div>
   <nav>
      <div class="nav-wrapper blue darken-3">
         <a href="#" class="brand-logo">Admin</a>
         <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="https://new-sase-dahnny012.c9.io/Event/">Events</a>
            </li>
            <li><a href="components.html">News</a>
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
               Events </h1>
            </div>
            <div class="row">
               <Modal class="col s12" id="Modal">
            </div>
         </div>
        <EventList id="events"/>
         </div>
   </body>

</html>
<script>
</script>