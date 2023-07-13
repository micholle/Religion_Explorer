$(function() {
    $.ajax({
        url: "../../ajax/showAdminSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#contentForReviewSidebar").html(data);
        }
    });
});
