$(function() {

    //show sidebar
    $("#showSidebar").click(function(){
        document.getElementById("sidebar").style.display = "block";
        document.getElementById("main").style.marginLeft = "20%";

    });

    //close sidebar
    $("#closeSidebar").click(function(){
        document.getElementById("sidebar").style.display = "none";
        document.getElementById("main").style.marginLeft = "0px";
    });

})