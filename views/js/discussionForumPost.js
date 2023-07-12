$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#discussionForumPostSidebar").html(data);
        }
    });

    //NOT FINAL NOT FINAL NOT FINAL NOT FINAL//
    // Find all elements with the class "forumPostViewMainComment"
    const replyButtons = document.querySelectorAll('.forumPostViewMainComment');

    // Attach a click event listener to each reply button
    replyButtons.forEach((replyButton) => {
        replyButton.addEventListener('click', function() {
            // Create the HTML code for the content block
            const contentHTML = `
            <div class="forumPostViewComments">
                <div class="d-flex justify-content-start align-items-center flex-column">
                <img src="../assets/img/editProfile/lion.png">
                </div>
                <div class="forumPostViewContent">
                <div class="row">
                    <div class="col-12 d-flex flex-row">
                    <h2>[Placeholder User]</h2><h2>•</h2><h2>[Placeholder Time]</h2>
                    </div>
                </div>
                <div class="forumPostViewContentBox">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ultricies eros id malesuada porta. Sed id vulputate purus. Vestibulum non luctus nisi, vel tincidunt leo. Phasellus scelerisque metus sit amet est pulvinar, efficitur molestie elit laoreet.</p>
                    <div class="col-12 d-flex flex-row forumPostViewContentInt">
                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                        <img src="../assets/img/discussionForum/upvote.png">
                        <p class="forumPostViewMainCount forumPostViewMainVote">0</p>
                        <img src="../assets/img/discussionForum/downvote.png">
                    </div>
                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                        <img src="../assets/img/discussionForum/comments.png" class="commentIcon">
                        <p class="forumPostViewMainCount forumPostViewMainComment">Reply</p>
                    </div>
                    <div class="forumPostViewMainInt d-flex justify-content-center align-items-center flex-row">
                        <img src="../assets/img/discussionForum/report.png" class="commentIcon">
                        <p class="forumPostViewMainCount forumPostViewMainReport">Report</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            `;

            // Create a new reply container element
            const replyContainer = document.createElement('div');
            replyContainer.classList.add('forumPostViewComments');

            // Set the content of the reply container
            replyContainer.innerHTML = contentHTML;

            // Append the reply container to the forumPostViewCommentReply element
            const replyContainerWrapper = document.getElementById('forumPostViewCommentReply');
            replyContainerWrapper.appendChild(replyContainer);
        });
    });

});