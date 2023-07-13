$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#discussionForumPostSidebar").html(data);
        }
    });

    $("#forumDeletePost").click(function(){
        $('#confirmDeleteModalPost').modal();
        $('#confirmDeleteModalPost').show();
    });

    $("#forumDeleteComment").click(function(){
        $('#confirmDeleteModalComment').modal();
        $('#confirmDeleteModalComment').show();
    });
    
    const replyButtons = document.querySelectorAll('.forumPostViewMainComment');
    replyButtons.forEach((replyButton) => {
        let replyContainer = null; // Variable to store the reply container reference

        replyButton.addEventListener('click', function() {
            if (replyContainer) {
            replyContainer.remove(); // Remove the existing reply container if it exists
            replyContainer = null; // Set the reference to null
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

            replyContainer = document.createElement('div');
            replyContainer.classList.add('forumPostViewComments');

            replyContainer.innerHTML = contentHTML;

            const replyContainerWrapper = document.getElementById('forumPostViewCommentReplySubmit');
            replyContainerWrapper.appendChild(replyContainer);

            // Attach event listener to the cancel button
            const cancelReplyButton = replyContainer.querySelector('#cancelReplyButton');
            cancelReplyButton.addEventListener('click', function() {
                replyContainer.remove(); // Remove the reply container when the cancel button is clicked
                replyContainer = null; // Reset the reference to null
            });
            }
        });
    });


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

});