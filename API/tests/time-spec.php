<?php

include "../time.php";


function test($a,$b)
{
    if($a != $b){
        die("$a does not equal $b \n");
    }
}

function toReadable(){
    $sampleDate = "2015-03-12";
    $sampleTime = "03:30:00";
    $testDate = new Time($sampleDate);
    $testDate = $testDate->toDate();
    $testTime = new Time($sampleTime);
    $testTime = $testTime->toTime();
    test($testDate,"March 12, 2015");
    test($testTime,"3:30 AM");
}

function toModel(){
    $sampleDate = "10 May, 2015";
    $sampleTime = "5:30 PM";
    $testDate = new Time($sampleDate);
    $testDate = $testDate->toDate(true);
    $testTime = new Time($sampleTime);
    $testTime = $testTime->toTime(true);
    test($testDate,"2015-05-10");
    test($testTime,"17:30:00");
}


toReadable();
toModel();

?>