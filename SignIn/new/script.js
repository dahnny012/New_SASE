// Switches values and colors of the options.

$(document).on("click", ".signIn-programs", function() {
    console.log("herro");
    var val;
    switch ($(this).val()) {
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
    if (val == 0) {
        $(this).css({
            "background": "#125C8C",
            "color": "white"
        });
    }
    else {
        $(this).css({
            "background": "white",
            "color": "black"
        });
    }
});
$(window).load(function(){
    var signIn = signInBox();
    signIn.init();
    $(".signIn-form").submit(function(e) {
        e.preventDefault();
        signIn.next();
    });
    
    
    
});


/*
Interface for looping through the different forms.

*/


function messageBox(){
    var node = $(".signIn-header")[0];
    return {
        set:function(msg){
            node.innerText = msg;
        }
    }
}
function signInBox() {
    var start = 0;
    var forms = $(".content-forms");
    var message = messageBox();
    var member = {};
    return {
        init: function() {
            toggle();
            message.set("Please enter a x500");
        },
        next: function() {
            switch (start) {
                case 0:
                    scrapeUMN().then(function(){
                        message.set("Complete the information");
                    });
                    break;
                case 1:
                    sendForm().then(function(){
                        message.set("Would you be interested in any programs?");
                    });
                
                    $(".signIn-form").off("submit").on("submit",function(e){
                        e.preventDefault();
                    });
                    $("#done").on("click",function(){
                        navHome();
                    });
                    
            }

        }
    }

    function toggle() {
        $(forms[start]).toggle();
    }

    function scrapeUMN() {
        var x500 = signInData($(forms[start]));
        return $.get("/API/scraper.php",x500 , function(data) {
            toggle();
            start++;
            toggle();
            // Populate the form
            var inputs = $(forms[start]).find("input");
            inputs[0].value = data.name;
            inputs[1].value = data.email;
            inputs[2].value = x500.x500;
        })
    }
    
    function sendForm(){
        var data = signInData($(forms[start]));
        member.name = data.Name;
        member.email = data.Email;
        data.msg = "insert";
        return $.post("/API/signIn.php",data,function(msg){
            console.log(msg);
            toggle();
            start++;
            toggle();
        })
    }
    
    function navHome(){
        // Get programs
        var data = signInData($(forms[start],"input[type='hidden']"));
        data.name = member.name;
        data.email = member.email;
        data.msg = "programs";
        $.post("/API/signIn.php",data,function(msg){
            console.log(msg);
            window.location = "/SignIn/new/"
        });
        
    }
    
    function freespin(){
        
    }
}


function signInData(current,query){
    var data = {};
    if(query == undefined)
        query = "input";
    var inputs = current.find(query);
    
    inputs.each(function(i,v){
        data[v.name] = v.value;
    })
    return data;
}


function merge(src,dest){
    for(var prop in src){
        dest[prop] = src[prop];
    }
}


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

