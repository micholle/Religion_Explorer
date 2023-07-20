$(function() {
    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#discussionForumPostSidebar").html(data);
        }
    });
    
    //report content modal
    $("#reportPostBtn").click(function(){
        $('#reportContentModal').modal();
        $('#reportContentModal').show();
    });

    $(document).on('click', '#reportCommentBtn', function() {
        $('#reportContentModal').modal('show');
    });

    $('#submitReportContent').click(function() {
        var modalBody = $('#reportContentModal');
      
        modalBody.html(`
        <div class="modal-dialog modal-xs modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                                <img src="../assets/img/verification-check.png" height="80px" width="80px">
                                <h5 class="modal-title w-100">Report Received</h5>
                                <p>The team will review your complaint. Please expect a notification in 3-5 business days.</p>
                                <button type="button" id="" class="roundedButton" data-dismiss="modal">Thanks!</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `);
    });

    function initializeReplyButtons() {
        const replyButtons = document.querySelectorAll('.forumPostViewMainComment');
      
        replyButtons.forEach((replyButton) => {
            replyButton.addEventListener('click', function () {
                const parentComment = replyButton.closest('.forumPostViewComments');
                const postId = $(this).attr('value'); // Get the post ID from the data attribute
                const replyContainer = parentComment.querySelector('.threadReply');
          
                if (replyContainer) {
                    replyContainer.remove(); // Remove the reply container if it exists
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
          
                    const replyContainer = document.createElement('div');
                    replyContainer.classList.add('threadReply');
                    replyContainer.innerHTML = contentHTML;
          
                    parentComment.appendChild(replyContainer);
          
                    const cancelReplyButton = replyContainer.querySelector('#cancelReplyButton');
                    cancelReplyButton.addEventListener('click', function () {
                        replyContainer.remove();
                    });
          
                    const replyForm = replyContainer.querySelector('form');
                    replyForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        const replyContent = replyForm.querySelector('textarea').value;
                        createReply(postId, replyContent); // Pass the postId and replyContent to createReply function
                    });
                }
            });
        });
    }

    // Create a new reply
    function createReply(postId, replyContent) {
        const postData = {
            postId: postId,
            replyContent: replyContent
        };

        $.ajax({
            url: "../../ajax/discussionReply.ajax.php",
            method: "POST",
            data: postData,
            success: function(response) {
                if (response === "success") {
                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
                    getPosts("", $("#topicId").val());
                } else {
                    alert("Error occurred while creating the reply.");
                }
            },
            error: function() {
                alert("Error occurred while making the AJAX request.");
            }
        });
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
                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
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
                // Call the initializeReplyButtons function after loading the AJAX response
                initializeReplyButtons();
                attachDeleteButtonListeners();
                initializeEditButtons();
                shortenUpvotes();
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

    $(document).on('click', '#forumDeleteComment', function() {
        $('#confirmDeleteModalComment').modal('show');
    });

    //delete

    function attachDeleteButtonListeners() {
        $(document).off('click', '.forumPostViewMainDelete').on('click', '.forumPostViewMainDelete', function() {
            const topicId = $(this).attr('value');
            $('#confirmDeleteModal').modal('show');
            $('#confirmDeleteModal').find('#confirmDelete').off('click').on('click', function() {
                deleteTopic(topicId);
            });
        });

        // Delete post
        $(document).off('click', '.forumPostViewMainDeletePost').on('click', '.forumPostViewMainDeletePost', function() {
            const postId = $(this).attr('value');
            $('#confirmDeleteModal').modal('show');
            $('#confirmDeleteModal').find('#confirmDelete').off('click').on('click', function() {
                deletePost(postId);
            });
        });
    
        // Delete reply
        $(document).off('click', '.forumPostViewMainDeleteReply').on('click', '.forumPostViewMainDeleteReply', function() {
            const replyId = $(this).attr('value');
            $('#confirmDeleteModal').modal('show');
            $('#confirmDeleteModal').find('#confirmDelete').off('click').on('click', function() {
                deleteReply(replyId);
            });
        });
    }
    
    // Delete a post
    function deletePost(postId) {
        $.ajax({
            url: "../../ajax/discussionDelete.ajax.php",
            method: "POST",
            data: { postId: postId },
            success: function(response) {
                if (response === "success") {
                    getPosts("", $("#topicId").val());
                    $('#confirmDeleteModal').modal('hide');
                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    alert("Error occurred while deleting the post.");
                }
            },
            error: function() {
                alert("Error occurred while making the AJAX request.");
            }
        });
    }
    
    // Delete a reply
    function deleteReply(replyId) {
        $.ajax({
            url: "../../ajax/discussionDelete.ajax.php",
            method: "POST",
            data: { replyId: replyId },
            success: function(response) {
                if (response === "success") {
                    getPosts("", $("#topicId").val());
                    $('#confirmDeleteModal').modal('hide');
                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    alert("Error occurred while deleting the reply.");
                }
            },
            error: function() {
                alert("Error occurred while making the AJAX request.");
            }
        });
    }

    function deleteTopic(topicId) {
        $.ajax({
            url: "../../ajax/discussionDelete.ajax.php",
            method: "POST",
            data: { topicId: topicId },
            success: function(response) {
                if (response === "success") {
                    window.location.href = 'discussionForum.php';
                    $('#confirmDeleteModal').modal('hide');
                    const message = {
                        type: 'topicDelete'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    alert("Error occurred while deleting the reply.");
                }
            },
            error: function() {
                alert("Error occurred while making the AJAX request.");
            }
        });
    }

    //edit

    $(document).on('click', '#editButton', function() {
        const topicTitle = $('#topicTitle');
        const topicContent = $('#topicContent');
        const editButton = $(this);
    
        if (topicTitle.attr('contenteditable') === 'false' && topicContent.attr('contenteditable') === 'false') {
            topicTitle.attr('contenteditable', 'true');
            topicContent.attr('contenteditable', 'true');
            editButton.text('Save');
        } else {
            topicTitle.attr('contenteditable', 'false');
            topicContent.attr('contenteditable', 'false');
            editButton.text('Edit');
    
            const updatedTitle = topicTitle.text().trim();
            const updatedContent = topicContent.text().trim();
            const topicId = $('#topicId').val();
    
            // Make an AJAX request to update the post title and content
            updateTopic(topicId, updatedTitle, updatedContent);
        }
    });
    
    function updateTopic(topicId, updatedTitle, updatedContent) {
        $.ajax({
            url: '../../ajax/discussionUpdateTopic.ajax.php', // Replace with the actual path to your updateTopic PHP file
            method: 'POST',
            data: {
                topicId: topicId,
                updatedTitle: updatedTitle,
                updatedContent: updatedContent
            },
            success: function(response) {
                if (response === 'success') {
                    // Topic updated successfully
                    alert('Topic updated successfully');
                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    // Error occurred while updating the topic
                    alert('Error occurred while updating the topic');
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    }

    //edit post or reply

    // ...

    function initializeEditButtons() {
        // ...
        // Edit post or reply
        $(document).off('click', '.editButton').on('click', '.editButton', function() {
            const targetElement = $(this);
            const type = targetElement.closest('.forumPostViewComments').hasClass('forumPostViewCommentReply') ? 'reply' : 'post';
            const id = $(this).attr('value');
            const contentElement = targetElement.closest('.forumPostViewComments').find('.contentEditable');
            
            if (contentElement.attr('contenteditable') === 'false') {
                contentElement.attr('contenteditable', 'true');
                targetElement.text('Save');
            } else {
                contentElement.attr('contenteditable', 'false');
                targetElement.text('Edit');
                
                const updatedContent = contentElement.text().trim();
                
                // Make an AJAX request to update the content
                updateContent(type, id, updatedContent);
            }
        });

    }

    // ...

    function updateContent(type, id, content) {
        $.ajax({
            url: "../../ajax/discussionUpdate.ajax.php",
            method: "POST",
            data: { type: type, id: id, content: content },
            success: function(response) {
                if (response === "success") {
                    // Content updated successfully
                    getPosts("", $("#topicId").val());
                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    // Error occurred while updating the content
                    alert("Error occurred while updating the content");
                }
            },
            error: function() {
                // AJAX request failed
                alert("Error occurred while making the AJAX request.");
            }
        });
    }


    //upvotes or downvotes

    $(document).off('click', '.upvoteButton, .downvoteButton').on('click', '.upvoteButton, .downvoteButton', function() {
        const targetElement = $(this);
        const type = targetElement.data('type');
        const id = targetElement.data('id');
        const isUpvote = targetElement.hasClass('upvoteButton');
        const isDownvote = targetElement.hasClass('downvoteButton');
    
        // Determine the vote action based on the clicked button
        let voteAction = '';
        if (isUpvote) {
            voteAction = 'upvote';
        } else if (isDownvote) {
            voteAction = 'downvote';
        }
    
        // Make an AJAX request to update the vote count
        updateVoteCount(type, id, voteAction, function(response) {
            if (response === 'success') {
                // Vote count updated successfully
                
                // Update the vote count display
                if (isUpvote) {
                    targetElement.attr('src', '../assets/img/discussionForum/upvote-active.png');
                    targetElement.addClass('upvoted');
                } else if (isDownvote) {
                    targetElement.attr('src', '../assets/img/discussionForum/downvote-active.png');
                    targetElement.addClass('downvoted');
                }
                getPosts("", $("#topicId").val());
                const message = {
                    type: 'discussion'
                };
                ws.send(JSON.stringify(message));
    
                // Disable the clicked button to prevent multiple votes
                targetElement.prop('disabled', true);
            } else {
                // Error occurred while updating the vote count
                alert('Error occurred while updating the vote count');
            }
        });
    });
    
    
    // Function to update the vote count
    function updateVoteCount(type, id, voteAction, callback) {
        $.ajax({
            url: '../../ajax/discussionVote.ajax.php',
            method: 'POST',
            data: { type, id, voteAction },
            success: function(response) {
                callback(response);
            },
            error: function() {
                // AJAX request failed
                alert('Error occurred while updating the vote count');
            }
        });
    }


    function shortenUpvotes() {
        $(".upvotes").each(function() {
            var upvotes = $(this).text().trim();
            var upvotesShort = shortenNumber(upvotes);
            $(this).text(upvotesShort);
        });
      }
  
      function shortenNumber(number) {
        var SI_POSTFIXES = ["", "K", "M", "B", "T"];
        var tier = Math.log10(Math.abs(number)) / 3 | 0;
      
        if (tier === 0) return number;
      
        var postfix = SI_POSTFIXES[tier];
        var scale = Math.pow(10, tier * 3);
        var scaledNumber = number / scale;
      
        // Remove decimal if the number is a whole number
        if (scaledNumber % 1 === 0) {
          scaledNumber = Math.floor(scaledNumber);
        }
      
        return scaledNumber.toFixed(0) + postfix;
      }


      //search
      $("#forumSearch").on("input", function() {
        var searchQuery = $(this).val(); // Retrieve search query
        searchPosts(searchQuery); // Call the searchPosts function
      });

      function searchPosts(searchQuery) {
        $.ajax({
          url: "../../ajax/discussionSearchPosts.ajax.php", // Update URL to the PHP file handling the search functionality
          method: "GET",
          data: { query: searchQuery }, // Pass search query as data
          success: function(data) {
            $("#postContainer").html(data);
            // Call the initializeReplyButtons function after loading the AJAX response
            initializeReplyButtons();
            attachDeleteButtonListeners();
            initializeEditButtons();
            shortenUpvotes();
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(error);
          }
        });
      }

      //Reommendations
  
        $.ajax({
            url: "../../ajax/discussionGetTopics.ajax.php",
            method: "GET",
            success: function(data) {
                console.log(data);
                $("#forumPostRecoContainer").html(data);
                shortenUpvotes();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        });

        // websocket
        const ws = new WebSocket('ws://localhost:8080');

        ws.onmessage = function (event) {
            const data = JSON.parse(event.data);

            switch (data.type) {
                case 'discussion':
                    getPosts("", $("#topicId").val());
                    break;
                case 'topicDelete':
                    window.location.href = "discussionForum.php"; // Redirect to the desired page when 'topicDelete' is received
                    break;    
                default:
                    break;
            }
        };


});
