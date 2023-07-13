$(function() {
    $(document).ready(function() {
        getTopics();
    });

    $("form").submit(function(e) {
        e.preventDefault();
        createDiscussion();
    });

    function createDiscussion() {
        // Retrieve the form data
        var topicTitle = $("#topicTitle").val();
        var topicContent = $("#topicContent").val();
    
        // Create an object with the data
        var discussion = {
          topicTitle: topicTitle,
          topicContent: topicContent
        };
    
        // Make the AJAX request to create the topic
        $.ajax({
          url: "../../ajax/discussionCreate.ajax.php",
          method: "POST",
          data: discussion,
          success: function(response) {
            if (response === "success") {
              // Topic created successfully
              alert("Topic created successfully!");
              $("#topicTitle").val("");
              $("#topicContent").val("");
              // Refresh the topics by calling the getTopics function
              getTopics();
            } else {
              // Error occurred while creating the topic
              alert("Error occurred while creating the topic.");
            }
          },
          error: function() {
            // AJAX request failed
            alert("Error occurred while making the AJAX request.");
          }
        });
    }

    function getTopics() {
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
    }

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
    
