<?php
include("../API/modules/event-module.php");
include("../API/modules/news-module.php");

$currentDate = date("Y-d-m");
$currentMonth = date("F");
$currentMonthNumber = date("n");
$eventsModel = new Event_Model();
$newsModel = new News_Model();
$params = ["byDate"=>$currentDate,
          "timeframe"=>"future",
          "byMonth"=>$currentMonthNumber
          ];
$eventParams = ["byDate"=>$currentDate,
          "timeframe"=>"future",
          "byMonth"=>$currentMonthNumber
          ];
$newsParams = ["byDate"=>$currentDate,
          "timeframe"=>"past",
          "byMonth"=>$currentMonthNumber
          ];
          
// Make API calls to get Events and News active this month
$events = $eventsModel->get($eventParams);
$news = $newsModel->get($newsParams);




function weekTable($events){
  function getWeek($date){
    $getDate = function($format,$str){
      return date($format,strtotime($str));
    };
    // First check if its a sunday then + 1
    $weekNum = $getDate("W",$date);
    
    if($getDate("w",$date) == "0"){
      $weekNum++;
    }
    return $weekNum;
  }
  
  $current = 0;
  $table = array();
  $i = -1;
  foreach($events as $event){
    $weekNum= getWeek($event["Date"]);
    if($weekNum > $current){
      array_push($table,array($event));
      $i++;
      $current = $weekNum;
    }else{
      array_push($table[$i],$event);
    }
  }
  return $table;
}

function eventBox($event,$hideDescription=false){
  
// Convert the time
$time = new Time($event["Time"]);
$event["Time"] = $time->toTime(true);

// Strip year
$event["Date"] = date("l, F j",strtotime($event["Date"]));

?>
<div class="col sl2 offset-l3 m12 l6">
  <div class="card">
    <div class="card-content white-text">
      <div class="card-title sase-blue center-align" style="padding-left:10px"><?php echo $event["Name"]; ?></div>
      <div class="sase-blue-text">
         <i class="material-icons sase-icon">today</i>
        <?php echo $event["Date"]?>
        <i class="material-icons sase-icon">schedule</i>
        <?php echo $event["Time"]; ?></div>
      <div class="sase-blue-text">
        <i class="material-icons sase-icon">location_on</i>
        <?php echo $event["Location"]; ?></div>
      <p class="sase-blue-text">
        <i class="material-icons sase-icon">info</i>
        <?php echo $event["Description"]; ?></p>
    </div>
    <div class="card-action">
      <a class="sase-blue-text" href="<?php echo $event["FB"]; ?>"><img src="assets/fb-colored.png"></a>
    </div>
  </div>
</div>
<?php
}

function newsBox($news){
// Strip year
$event["Date"] = date("F N",strtotime($news["Date"]));

?>
<div class="col sl2 offset-l3 m12 l6">
  <div class="card">
    <div class="card-content white-text">
      <div class="card-title sase-blue center-align" style="padding-left:10px"><?php echo $news["Title"]; ?></div>
      <div class="sase-blue-text">
         <i class="material-icons sase-icon">today</i>
        <?php echo $news["Date"]?>
      <p class="sase-blue-text">
        <i class="material-icons sase-icon">info</i>
        <?php echo $news["Content"]; ?></p>
    </div>
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
  <title>SASE UMN</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <div class="navbar-fixed">
  <nav class="sase-blue" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo">SASE UMN</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Home</a></li>
        <li><a href="#events" style="color:white">Events</a></li>
        <li><a href="#news" style="color:white">News</a></li>
        <li><a href="#">About Us</a></li>
        <li><a id="program-dropdown" href='#' class='dropdown-button' data-activates='Programs'>Programs</a>
      </ul>

      <ul id='Programs' class='dropdown-content sase-blue'>
        <li><a href="#!" style="color:white">Volunteering</a></li>
        <li><a href="#!" style="color:white">Tech Commitee</a></li>
        <li class="divider "></li>
        <li><a href="#!" style="color:white">Pilots in Progress</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav sase-blue">
        <li><a href="#">Home</a></li>
        <li><a href="#events" style="color:white">Events</a></li>
        <li><a href="#news" style="color:white">News</a></li>
        <li class="divider "></li>
        <li><a href="#!" style="color:white">Volunteering</a></li>
        <li><a href="#!" style="color:white">Tech Commitee</a></li>
        <li><a href="#!" style="color:white">Pilots in Progress</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse white-text"><i class="mdi-navigation-menu"></i></a>
    </div>
  </nav>
  </div>

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


  <div class="container" id="events">
    <div class="section">
      <div class="row">
        <div class="col s12">
          <div class="icon-block">
            <h2 class="center brown-text"><img src="assets/events.png"></h2>
            <h5 class="center">Upcoming Event</h5>
            <div class="row">
              <?php 
              if(count($events) > 0)
                eventBox($events[0]);
                unset($events[0]);
              ?>
            </div>
            <h5 class="center">Later This Month</h5>
            <h5 class="center"><?php
            ?></h5>
            <div class="row">
              <div class="col s12">
                <ul class="tabs">
                  <!-- Tab headers !-->
                  <?php
                  $weekTable= weekTable($events);
                  $numTabs = count($weekTable);
                  $currentTab = 0;
                  function tab($numTabs){
                    $tabText = "";
                    if($numTabs == 0){
                      $tabText= "Soon";
                    }else{
                      $tabText = "Next";
                    }
                    $id = "tab-id-".$numTabs;
                    echo "<li class='col s3 white tab flow-text truncate'><a class='sase-blue-text' href=#$id>$tabText</a></li>";
                  }
                  for($currentTab = 0; $currentTab < $numTabs; $currentTab++){
                    tab($currentTab);
                  }
                  ?>
                </ul>
              </div>
              <!-- Data -->
              <?php 
              $numTabs = count($weekTable);
              for($currentTab = 0; $currentTab < $numTabs; $currentTab++){
                 $id = "tab-id-".$currentTab;
                 echo "<div id=$id>";
                 // Tabbed Content
                foreach($weekTable[$currentTab] as $event){
                  eventBox($event);
                }
                echo "</div>";
              }
              ?>
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

  <div class="container" id="news">
    <div class="section">

       <div class="row">
        <div class="col s12">
          <div class="icon-block">
            <h2 class="center brown-text"><img src="assets/news.png"></h2>
            <h5 class="center">News Annoucements</h5>

            <div class="row">
              <?php   
                foreach($news as $new){
                  newsBox($new);
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
