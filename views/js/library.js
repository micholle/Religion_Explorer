$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#librarySidebar").html(data);
        }
    });

    $("#buddhismBasicInfoBox").click(function(){
        $('#libraryBasicInfoModal').modal();
    });

    $("#christianityBasicInfoBox").click(function(){
        $('#libraryBasicInfoModal').modal();
    });

    $("#hinduismBasicInfoBox").click(function(){
        $('#libraryBasicInfoModal').modal();
    });

    $("#islamBasicInfoBox").click(function(){
        $('#libraryBasicInfoModal').modal();
    });

    $("#judaismBasicInfoBox").click(function(){
        $('#libraryBasicInfoModal').modal();
    });
});