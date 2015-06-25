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

// Event Loop
$(document).ready(function() {
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

    return {
        init: function() {
            toggle();
            message.set("Please enter a x500");
        },
        next: function() {
            switch (start) {
                case 0:
                    scrapeUMN().then(function(){
                        message.set("Complete the information") 
                    });
                    break;
                case 1:
                    sendForm().then(function(){
                        message.set("Would you be interested in any programs?")
                    });
 
                    break;
                case 2:
                    navHome();       
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
        // Collect data.
        // send form
    }
    
    function navHome(){
        window.location = "/SignIn/new";
    }
}


function signInData(current){
    var data = {};
    var inputs = current.find("input");
    
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

