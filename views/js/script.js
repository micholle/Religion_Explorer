$(function() {

    //show sidebar
    $("#showSidebar").click(function(){
        document.getElementById("sidebar").style.display = "block";
        document.getElementById("main").style.marginLeft = "20%";
        document.getElementById("showSidebar").style.display = "none";
    });

    //close sidebar
    $("#closeSidebar").click(function(){
        document.getElementById("sidebar").style.display = "none";
        document.getElementById("main").style.marginLeft = "0px";
        document.getElementById("showSidebar").style.display = "block";
    });

    // var point = '<path height="100" width="100"><circle cx="50" cy="50" r="40" stroke="black" stroke-width="3" fill="red" /></path>';
    // var point = "<span class='dot'></span>"
    $(point).appendTo('#Philippines');
    console.log(document.getElementById("Philippines"));
    
})