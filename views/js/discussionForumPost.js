$(function() {
    $(document).ready(function() {
        // Retrieve the topic data from localStorage
        var topicData = JSON.parse(localStorage.getItem("topicData"));
      
        // Populate the elements with the topic data
        $("#topicTitle").text(topicData.topicTitle);
        $("#topicDetails").text("by " + topicData.username + " • " + topicData.topicDate);
        $("#topicContent").text(topicData.topicContent);
      
        // Clear the topic data from localStorage
        localStorage.removeItem("topicData");
      });
    
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#discussionForumPostSidebar").html(data);
        }
    });

    function initializeReplyButtons() {
        const replyButtons = document.querySelectorAll('.forumPostViewMainComment');
        const replyContainerWrapper = document.getElementById('forumPostViewCommentReplySubmit');
        let replyContainer = null; // Variable to store the reply container reference
    
        replyButtons.forEach((replyButton) => {
            replyButton.addEventListener('click', function() {
                const parentComment = replyButton.closest('.forumPostViewComments');
    
                if (parentComment === replyContainer) {
                    replyContainer.remove(); // Remove the reply container if it belongs to the clicked comment
                    replyContainer = null; // Reset the reference to null
                } else {
                    const contentHTML = `
                        <div class="threadReply" style="width: 100%;">
                            <div class="col-12 forumCommentMargin">
                                <div class="threadReplyLine">
                                <div class="forumCommentContainer">
                                    <div class="forumCommentContent">
                                    <form>
                                        <textarea placeholder="What are your thoughts?"></textarea>
                                        <div class="row">
                                        <div class="col-12 d-flex justify-content-end align-items-center flex-row">
                                            <button type="button" class="roundedButtonVariant" id="cancelReplyButton">Cancel</button>
                                            <button type="submit" class="roundedButton">Reply</button>
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    `;
    
                    // Remove the existing reply container if it exists
                    if (replyContainer) {
                        replyContainer.remove();
                    }
    
                    replyContainer = document.createElement('div');
                    replyContainer.classList.add('forumPostViewComments');
    
                    replyContainer.innerHTML = contentHTML;
    
                    parentComment.appendChild(replyContainer);
    
                    // Attach event listener to the cancel button
                    const cancelReplyButton = replyContainer.querySelector('#cancelReplyButton');
                    cancelReplyButton.addEventListener('click', function() {
                        replyContainer.remove(); // Remove the reply container when the cancel button is clicked
                        replyContainer = null; // Reset the reference to null
                    });
                }
            });
        });
    
        // Close reply container if clicking outside
        document.addEventListener('click', function(event) {
            const isOutsideContainer = !event.target.closest('.forumPostViewComments');
            if (isOutsideContainer && replyContainer) {
                replyContainer.remove();
                replyContainer = null;
            }
        });
    
        // Append the reply container wrapper to the document body
        document.body.appendChild(replyContainerWrapper);
    }
    
    


    // //NOT FINAL NOT FINAL NOT FINAL NOT FINAL//
    // // Find all elements with the class "forumPostViewMainComment"
    // const replyButtons = document.querySelectorAll('.forumPostViewMainComment');

    // // Attach a click event listener to each reply button
    // replyButtons.forEach((replyButton) => {
    //     replyButton.addEventListener('click', function() {
    //         // Create the HTML code for the content block
    //         const contentHTML = `
    //         <div class="forumPostViewComments">
    //             <div class="d-flex justify-content-start align-items-center flex-column">
    //             <img src="../assets/img/editProfile/lion.png">
    //             </div>
    //             <div class="forumPostViewContent">
    //             <div class="row">
    //                 <div class="col-12 d-flex flex-row">
    //                 <h2>[Placeholder User]</h2><h2>•</h2><h2>[Placeholder Time]</h2>
    //                 </div>
    //             </div>
    //             <div class="forumPostViewContentBox">
    //                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies eros id malesuada porta. Sed id vulputate purus. Vestibulum non luctus nisi, vel tincidunt leo. Phasellus scelerisque metus sit amet est pulvinar, efficitur molestie elit laoreet.</p>
    //                 <div class="col-12 d-flex flex-row forumPostViewContentInt">
    //                 <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
    //                     <img src="../assets/img/discussionForum/upvote.png">
    //                     <p class="forumPostViewMainCount forumPostViewMainVote">0</p>
    //                     <img src="../assets/img/discussionForum/downvote.png">
    //                 </div>
    //                 <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
    //                     <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
    //                     <p class="forumPostViewMainCount forumPostViewMainComment">Reply</p>
    //                 </div>
    //                 <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
    //                     <img src="../assets/img/discussionForum/report.png" class="commentIcon">
    //                     <p class="forumPostViewMainCount forumPostViewMainReport">Report</p>
    //                 </div>
    //                 </div>
    //             </div>
    //             </div>
    //         </div>
    //         `;

    //         // Create a new reply container element
    //         const replyContainer = document.createElement('div');
    //         replyContainer.classList.add('forumPostViewComments');

    //         // Set the content of the reply container
    //         replyContainer.innerHTML = contentHTML;

    //         // Append the reply container to the forumPostViewCommentReply element
    //         const replyContainerWrapper = document.getElementById('forumPostViewCommentReply');
    //         replyContainerWrapper.appendChild(replyContainer);
    //     });
    // });

    // Get the HTML element with the specific ID to display the upvotes
    var upvotesElement = document.getElementById("upvotes");

    // Retrieve the upvotes value from the data attribute
    var upvotes = parseInt(upvotesElement.getAttribute("data-upvotes"));

    // Set the shortened upvotes value using the 'shortenUpvotes' function
    upvotesElement.textContent = shortenUpvotes(upvotes);

    function shortenUpvotes(upvotes) {
    var SI_POSTFIXES = ["", "K", "M", "B", "T"];
    var tier = Math.log10(Math.abs(upvotes)) / 3 | 0;

    if (tier === 0) return upvotes;

    var postfix = SI_POSTFIXES[tier];
    var scale = Math.pow(10, tier * 3);
    var scaledNumber = upvotes / scale;

    // Remove decimal if the number is a whole number
    if (scaledNumber % 1 === 0) {
        scaledNumber = Math.floor(scaledNumber);
    }

    return scaledNumber.toFixed(0) + postfix;
    }

    $(document).ready(function() {
        getPosts("", $("#topicId").val());
    });

    $("form").submit(function(e) {
        e.preventDefault();
        createPost();
    });

    function createPost() {
        // Retrieve the form data
        var topicId = $("#topicId").val();
        var postContent = $("#postContent").val();
    
        // Create an object with the data
        var discussion = {
          topicId: topicId,
          postContent: postContent
        };
    
        // Make the AJAX request to create the topic
        $.ajax({
          url: "../../ajax/discussionPost.ajax.php",
          method: "POST",
          data: discussion,
          success: function(response) {
            if (response === "success") {
              // Topic created successfully
              alert("Post created successfully!");
              $("#postContent").val("");
              // Refresh the topics by calling the getTopics function
              getPosts("", $("#topicId").val());
            } else {
              // Error occurred while creating the topic
              alert("Error occurred while creating the post.");
            }
          },
          error: function() {
            // AJAX request failed
            alert("Error occurred while making the AJAX request.");
          }
        });
    }

    function getPosts(sortCriteria, topicId) {
        $.ajax({
            url: "../../ajax/discussionGetPosts.ajax.php",
            method: "GET",
            data: { sort: sortCriteria, topicId: topicId },
            success: function(data) {
                $("#postContainer").html(data);
                shortenUpvotes();
    
                // Call the initializeReplyButtons function after loading the AJAX response
                initializeReplyButtons();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }

    $("#top").click(function() {
        getTopics("top"); // Pass "top" as the sort criteria
      });
      
      $("#new").click(function() {
          getTopics("new"); // Pass "new" as the sort criteria
      });
});
