<?php
include("../API/modules/event-module.php");
include("../API/modules/news-module.php");

$currentMonth = date("F");
$currentMonthNumber = date("n");
$eventsModel = new Event_Model();
$newsModel = new News_Model();
$params = ["byMonth"=>
          $currentMonthNumber]; 
          
// Make API calls to get Events and News active this month
$events = $eventsModel->get($params);
$news = $newsModel->get($params);




function eventBox($event){
  
// Convert the time
$time = new Time($event["Time"]);
$event["Time"] = $time->toTime(true);
?>
<div class="col s12">
  <div class="card sase-blue">
    <div class="card-content white-text">
      <span class="card-title"><?php echo $event["Name"]; ?></span>
      <div><?php echo $event["Date"]." ".$event["Time"]." ".$event["Location"]; ?></div>
      <p><?php echo $event["Description"] ?></p>
    </div>
    <div class="card-action">
      <a href="<?php echo $event["FB"]; ?>"><img src="assets/fb.png"></a>
    </div>
  </div>
</div>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
  <title>Parallax Template - Materialize</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <nav class="sase-blue" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo">SASE UMN</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a id="program-dropdown" href='#' class='dropdown-button' data-activates='Programs'>Programs</a>
      </ul>

      <ul id='Programs' class='dropdown-content sase-blue'>
        <li><a href="#!" style="color:white">Volunteering</a></li>
        <li><a href="#!" style="color:white">Tech Commitee</a></li>
        <li class="divider "></li>
        <li><a href="#!" style="color:white">Pilots in Progress</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    </div>
  </nav>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br>
        <br>
        <! <h1 class="header center teal-text text-lighten-2"></h1>
        <div class="row center">
          <h5 class="header col s12 light"></h5>
        </div>
        <div class="row center">
          
          </a>
        </div>
        <br>
        <br>

      </div>
    </div>
    <div class="parallax desktop"><img src="assets/words-cropped2.png" alt="Unsplashed background img 2"></div>
    <div class="parallax mobile"><img src="assets/words-cropped-small.png" alt="Unsplashed background img 2"></div>
  </div>


  <div class="container">
    <div class="section">
      <div class="row">
        <div class="col s12">
          <div class="icon-block">
            <h2 class="center brown-text"><img src="assets/events.png"></h2>
            <h5 class="center">Upcoming Events</h5>
            <h5><?php
            // Prints the current month;
            echo $currentMonth;
            ?></h5>
            <div class="row">
              <?php   
                foreach($events as $event){
                  eventBox($event);
                }
              ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
        </div>
      </div>
    </div>
    <div class="parallax"><img src="assets/Board_Picture.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
    <div class="section">

       <div class="row">
        <div class="col s12">
          <div class="icon-block">
            <h2 class="center brown-text"><img src="assets/news.png"></h2>
            <h5 class="center">News Annoucements</h5>

            <div class="row">
              <div class="col s12">
                <div class="card sase-blue">
                  <div class="card-content white-text">
                    <span class="card-title">News Title</span>
                    <div>Date Written</div>
                    <p>News Content</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
        </div>
      </div>
    </div>
    <div class="parallax"><img src="assets/sase.jpg" alt="Unsplashed background img 3"></div>
  </div>

  <footer class="page-footer sase-blue">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">About Us</h5>
          <p class="grey-text text-lighten-4">The Society of Asian Scientists and Engineers - University of Minnesota chapter (SASE-UMN) was established during the summer of 2011 to promote the development of Asians in science and engineering at the University and the surrounding community.
          </p>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li>
              <a class="white-text" href="#!"><img src="assets/fb.png"></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">

    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>

</html>
