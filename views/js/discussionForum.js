$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#discussionForumSidebar").html(data);
        }
    });

    $(".forumContent").click(function(){
        window.location.href = "discussionForumPost.php";
    });
});