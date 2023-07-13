$(function() {
    $(document).ready(function() {
        $.ajax({
            url: "../../ajax/discussionTopics.ajax.php",
            method: "GET",
            success: function(data) {
                console.log(data);
                $("#topicsContainer").html(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        });
      });

    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#discussionForumSidebar").html(data);
        }
    });

    $(document).on("click", ".forumContent", function(){
        window.location.href = "discussionForumPost.php";
    });
});
