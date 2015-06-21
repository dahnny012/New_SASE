

$(document).one("click","#rand",
	function(){
		
		$(".gearWrapper").toggle();
		var start = 0;
		var end =$($(".gearFiles")).length;
		var stop = setInterval(function(){
		console.log(start);
		if(start == 0){
		$($(".gearFiles")[0]).toggle();
		start++;
		}
		else if(start == 46)
		{
			randomDraw();
			$($(".gearFiles")[start-1]).toggle();
			$($(".gearFiles")[start]).toggle();
			clearInterval(stop);
			$(document).on("click",".gearWrapper",
				function(){
					$(this).hide();
					$(".gameText").hide();
				}
			);
		}
		else{
		$($(".gearFiles")[start-1]).toggle();
		$($(".gearFiles")[start]).toggle();
		start++;
		}
			}, 60);
	}
);



function randomDraw()
{
	var rando = Math.floor(Math.random() * 100) + 1;
	console.log("random draw " + rando);
	if(rando > 70){
		$("#win").show();
	}
	else{
		$("#lose").show();
	}
}



// Switches values and colors of the options.
$(document).on("click","#programs",function(){

   var val
   switch ($(this).val())
   {
      case 'SASE Technical Committee':
         val = $("#tech").val();
         console.log("tech" + val);
         $("#tech").val(1 - val);
         console.log("tech after " + $("#tech").val());
      break;
      
      case 'Mentorship Program':
         val = $("#mentor").val();
         console.log("mentor" + val);
         $("#mentor").val(1 - val);
         console.log("mentor after " + $("#mentor").val());
      break;
      
      case 'Volunteer Program':
        val = $("#volunteer").val();
        console.log("volun" + val);
        $("#volunteer").val(1 - val);
        console.log("volun after " + $("#volunteer").val());
      break;

   }
   
   if(val == 0)
   {
      $(this).css({"background":"#125C8C",
      "color":"white"});
   }
   else
   {
      $(this).css({"background":"white",
      "color":"black"});
   }
});

