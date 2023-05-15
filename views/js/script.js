$(function() {

    //show sidebar
    $("#showSidebar").click(function(){
        $("#sidebar").css("display", "block");
        $("#main").css("margin-left", "20%");
        $("#showSidebar").css("display", "none");
    });

    //close sidebar
    $("#closeSidebar").click(function(){
        $("#sidebar").css("display", "none");
        $("#main").css("margin-left", "0");
        $("#showSidebar").css("display", "block");
    });

    //timeline overlays
    $("#timelineOverlay").click(function(){
        $("#timelineOverlay").css("display", "none");
    });

    var timelineYear = "2000";
    $("#sliderOptions").click(function(){
        var timelineYears = document.getElementsByName("timelineValue");

        for (i = 0; i < timelineYears.length; i++) {
            if (timelineYears[i].checked){
                if(timelineYears[i].value != timelineYear){
                    timelineYear = timelineYears[i].value;
                    $("#timelineOverlayYear").text(timelineYear);
                    $("#timelineOverlay").css("display", "block");
                }
            }
        }
    });

    // var point = '<path height="100" width="100"><circle cx="50" cy="50" r="40" stroke="black" stroke-width="3" fill="red" /></path>';
    // var point = "<span class='dot'></span>"
    // $(point).appendTo('#Philippines');
    // console.log(document.getElementById("Philippines"));
})