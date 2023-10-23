$(function() {
    $(document).ready(function() {
        $('#dropdownMenu').on('click', function(event) {
            event.stopPropagation();
            $('#dropdownContent').toggle();
        });

        $(window).on('click', function(event) {
            if (!event.target.matches('#dropdownMenu')) {
                $('#dropdownContent').hide();
            }
        });
    });

    $(document).ready(function() {
        var openDropdown = null;
    
        $(document).on('click', '.forumPostViewMainInt', function(event) {
            event.stopPropagation();
            var dropdownContent = $(this).closest('.forumPostViewComments').find('.dropdown-content');
    
            // Check if the clicked element is not the "Reply" button
            if (!$(event.target).hasClass('forumPostViewMainComment')) {
                if (openDropdown && openDropdown[0] !== dropdownContent[0]) {
                    openDropdown.hide();
                }
                dropdownContent.toggle();
                openDropdown = dropdownContent;
            }
        });
    
        // Handle clicks outside of the dropdowns
        $(document).on('click', function(event) {
            if (openDropdown && !$(event.target).is('.forumPostViewMainInt')) {
                openDropdown.hide();
                openDropdown = null;
            }
        });
    });
    
    
    
    
    //view edit history
    $(document).on('click', '#forumViewHistory', function() {
        $('#viewHistoryModal').modal('show');
    });
    
    const pusher = new Pusher('a314fc475591f42fbafc', {
        cluster: 'ap1',
        // Add any other options you might need
      });

    $.ajax({
        url: "../../ajax/showSidebar.ajax.php",
        method: "POST",
        success: function(data) {
            $("#discussionForumPostSidebar").html(data);
            var currentPage = window.location.pathname.split("/").pop();
    
            $("#discussionForumPostSidebar li a").each(function() {
                var tabPage = $(this).attr("href");
                
                if (currentPage.includes("discussionForum") || tabPage === currentPage) {
                    $("#sidebarForum").css({
                        "background-color": "#EAF7F0",
                        "border": "solid #75C884 2px",
                        "font-weight": "600",
                    });
                }
            });
        }
    });

    $(document).on('click', '#reportCommentBtn', function() {
        $('#reportContentModal').modal('show');
    });

    $('#submitReportContent').click(function(event) {
        event.preventDefault();
        
        var contentViolationsArray = []; 
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                contentViolationsArray.push(checkbox.value);
            }
        });
    
        if ($("#contentOthers").val() != "") {
            contentViolationsArray.push($("#contentOthers").val());
        }
    
        if (contentViolationsArray.length != 0) {
            var reportedContentid = $("#reportContentid").text();
            var additionalContext = $("#reportContentAdditional").val();
            var reportedBy = $("#accountidPlaceholder").text();
            
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = String(currentDate.getMonth() + 1).padStart(2, '0');
            var day = String(currentDate.getDate()).padStart(2, '0');
            var reportedOn = `${year}-${month}-${day}`;
            var contentViolations = contentViolationsArray.join(', ');

            reportData = new FormData();
            reportData.append("contentid" , reportedContentid);
            reportData.append("contentViolations" , contentViolations);
            reportData.append("additionalContext", additionalContext);
            reportData.append("reportedOn", reportedOn);
            reportData.append("reportedBy", reportedBy);
    
            $.ajax({
                url: "../../ajax/submitReportContent.ajax.php",
                method: "POST",
                data: reportData,
                dataType: "text",
                processData: false,
                contentType: false,
                success: function() {
                    $("#reportContentIcon").attr("src", "../assets/img/verification-check.png");
                    $("#reportContentStatus").text("Report Received");
                    $("#reportContentMessage").text("The team will review your complaint. Please expect a notification in 3-5 business days.");
                },
                error: function() {
                    $("#reportContentIcon").attr("src", "../assets/img/verification-error.png");
                    $("#reportContentStatus").text("Error");
                    $("#reportContentMessage").text("There was an error processing your request. Please try again later.");
                    $("#reportContentNoticeButton").css("background-color", "#E04F5F");
                },
                complete: function() {
                    $("#reportContentModal").removeClass("fade").modal("hide");
                    $("#reportContentModal").modal("dispose");
            
                    $("#reportContentNotice").modal();
                    $("#reportContentNotice").show();

                    $("#reportContentForm")[0].reset();
                    $("#reportContentAdditional").val("");
                }
            });
        } else {
            $("#toast").html("Please fill out all required fields.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
        
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
        }
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
    async function createReply(postId, replyContent) {
        if (replyContent.trim() === '') {
            $("#toast").html("Content is empty. Please provide content for your comment.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
        
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
            return
        }

        const postData = {
            postId: postId,
            replyContent: replyContent
        };

        var contentEvaluationReply = await checkContent(replyContent);

        if (contentEvaluationReply == "nsfw") {
            $("#reportContentIcon").attr("src", "../assets/img/verification-error.png");
            $("#reportContentStatus").text("Error");
            $("#reportContentMessage").text("Your content has been blocked due to a violation of our community standards. We take these standards seriously to maintain a positive and respectful environment for all users. If you believe this action was taken in error, please reach out to our support team with further details. Thank you for your understanding and cooperation in upholding our community guidelines.");
            $("#reportContentNoticeButton").css("display", "none");

            $("#reportContentNotice").modal();
            $("#reportContentNotice").show();

        } else {
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
                        getPosts("user_priority", $("#topicId").val());
                    } else {
                        $("#toast").html("Error occurred while creating the reply.")
                        $("#toast").css("background-color", "#E04F5F");
                        $("#toast").addClass('show');
                    
                        setTimeout(function() {
                            $("#toast").removeClass('show');
                        }, 2000);
                    }
                },
                error: function() {
                    $("#toast").html("Error occurred while making the AJAX request.")
                    $("#toast").css("background-color", "#E04F5F");
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                }
            });
        }
    }
    $(document).ready(function() {
        var currentSort = "user_priority";
        getPosts(currentSort, $("#topicId").val());

        $("#top").click(function() {
            if (currentSort === "top") {
                currentSort = "user_priority";
                $(this).blur(); // Remove focus and highlight from the clicked button
            } else {
                currentSort = "top";
            }
            getPosts(currentSort, $("#topicId").val());
        });

        $("#new").click(function() {
            if (currentSort === "new") {
                currentSort = "user_priority";
                $(this).blur(); // Remove focus and highlight from the clicked button
            } else {
                currentSort = "new";
            }
            getPosts(currentSort, $("#topicId").val());
        });
    });

    $("form").submit(function(e) {
        e.preventDefault();
        createPost();
    });

    async function createPost() {
        // Retrieve the form data
        var topicId = $("#topicId").val();
        var postContent = $("#postContent").val();

        if (postContent.trim() === '') {
            $("#toast").html("Content is empty. Please provide content for your comment.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
        
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
            return
        }
    
        // Create an object with the data
        var discussion = {
            topicId: topicId,
            postContent: postContent
        };

        var contentEvaluationPost = await checkContent(postContent);
    
        if (contentEvaluationPost == "nsfw") {
            $("#reportContentIcon").attr("src", "../assets/img/verification-error.png");
            $("#reportContentStatus").text("Error");
            $("#reportContentMessage").text("Your content has been blocked due to a violation of our community standards. We take these standards seriously to maintain a positive and respectful environment for all users. If you believe this action was taken in error, please reach out to our support team with further details. Thank you for your understanding and cooperation in upholding our community guidelines.");
            $("#reportContentNoticeButton").css("display", "none");

            $("#reportContentNotice").modal();
            $("#reportContentNotice").show();

            $("#postContent").val("");
        } else {
            $.ajax({
                url: "../../ajax/discussionPost.ajax.php",
                method: "POST",
                data: discussion,
                success: function(response) {
                    if (response === "success") {
                        $("#postContent").val("");
                        $("#toast").html("Comment posted.")
                        $("#toast").css("background-color", "");
                        $("#toast").addClass('show');
                    
                        setTimeout(function() {
                            $("#toast").removeClass('show');
                        }, 2000);
                        const message = {
                            type: 'discussion'
                        };
                        ws.send(JSON.stringify(message));
                        getPosts("user_priority", $("#topicId").val());
                    } else {
                        // Error occurred while creating the topic
                        $("#toast").html("Error occurred while creating the post.")
                        $("#toast").css("background-color", "#E04F5F");
                        $("#toast").addClass('show');
                    
                        setTimeout(function() {
                            $("#toast").removeClass('show');
                        }, 2000);
                    }
                },
                error: function() {
                    // AJAX request failed
                    $("#toast").html("Error occurred while making the AJAX request.")
                    $("#toast").css("background-color", "#E04F5F");
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                }
            });
        }
    }
    
    
    function getPosts(sortCriteria, topicId) {
        var userTimezoneOffsetMinutes = new Date().getTimezoneOffset();
        $.ajax({
            url: "../../ajax/discussionGetPosts.ajax.php",
            method: "GET",
            data: { sort: sortCriteria, topicId: topicId, userTimezoneOffsetMinutes: userTimezoneOffsetMinutes  },
            success: function(data) {
                $("#postContainer").html(data);
                // Call the initializeReplyButtons function after loading the AJAX response
                initializeReplyButtons();
                attachDeleteButtonListeners();
                initializeEditButtons();
                shortenUpvotes();
                attachProfilePictureListeners();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }

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
                    getPosts("user_priority", $("#topicId").val());
                    $("#toast").html("Comment deleted.")
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                    $('#confirmDeleteModal').modal('hide');
                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    $("#toast").html("Error occurred while deleting the post.")
                    $("#toast").css("background-color", "#E04F5F");
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                }
            },
            error: function() {
                $("#toast").html("Error occurred while making the AJAX request.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');
            
                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
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
                    getPosts("user_priority", $("#topicId").val());
                    $("#toast").html("Comment deleted.")
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                    $('#confirmDeleteModal').modal('hide');
                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    $("#toast").html("Error occurred while deleting the reply.")
                    $("#toast").css("background-color", "#E04F5F");
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                }
            },
            error: function() {
                $("#toast").html("Error occurred while making the AJAX request.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');
            
                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
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
                    $("#toast").html("Topic deleted.")
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                    $('#confirmDeleteModal').modal('hide');
                    const message = {
                        type: 'topicDelete'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    $("#toast").html("Error occurred while deleting the reply.")
                    $("#toast").css("background-color", "#E04F5F");
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                }
            },
            error: function() {
                $("#toast").html("Error occurred while making the AJAX request.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');
            
                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
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
                    $("#toast").html("Topic updated successfully.")
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);

                    const message = {
                        type: 'discussion'
                    };
                    ws.send(JSON.stringify(message));
                } else {
                    // Error occurred while updating the topic
                    $("#toast").html("Error occurred while updating the topic.")
                    $("#toast").css("background-color", "#E04F5F");
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
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

    async function updateContent(type, id, content) {
        const updateContent = {
            type: type,
            id: id,
            content: content
        };
        var contentEvaluationContent = await checkContent(content);

        if (contentEvaluationContent == "nsfw") {
            $("#reportContentIcon").attr("src", "../assets/img/verification-error.png");
            $("#reportContentStatus").text("Error");
            $("#reportContentMessage").text("Your content has been blocked due to a violation of our community standards. We take these standards seriously to maintain a positive and respectful environment for all users. If you believe this action was taken in error, please reach out to our support team with further details. Thank you for your understanding and cooperation in upholding our community guidelines.");
            $("#reportContentNoticeButton").css("display", "none");

            $("#reportContentNotice").modal();
            $("#reportContentNotice").show();
            getPosts("user_priority", $("#topicId").val());
        } else {
            $.ajax({
                url: "../../ajax/discussionUpdate.ajax.php",
                method: "POST",
                data: updateContent,
                success: function(response) {
                    if (response === "success") {
                        // Content updated successfully
                        getPosts("user_priority", $("#topicId").val());
                        $("#toast").html("Comment edited successfully.")
                        $("#toast").addClass('show');
                    
                        setTimeout(function() {
                            $("#toast").removeClass('show');
                        }, 2000);
                        const message = {
                            type: 'discussion'
                        };
                        ws.send(JSON.stringify(message));
                    } else {
                        // Error occurred while updating the content
                        $("#toast").html("Error occurred while updating the content.")
                        $("#toast").css("background-color", "#E04F5F");
                        $("#toast").addClass('show');
                    
                        setTimeout(function() {
                            $("#toast").removeClass('show');
                        }, 2000);
                    }
                },
                error: function() {
                    // AJAX request failed
                    $("#toast").html("Error occurred while making the AJAX request.")
                    $("#toast").css("background-color", "#E04F5F");
                    $("#toast").addClass('show');
                
                    setTimeout(function() {
                        $("#toast").removeClass('show');
                    }, 2000);
                }
            });
        }
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
                getPosts("user_priority", $("#topicId").val());
                const message = {
                    type: 'discussion'
                };
                ws.send(JSON.stringify(message));
    
                // Disable the clicked button to prevent multiple votes
                targetElement.prop('disabled', true);
            } else {
                // Error occurred while updating the vote count
                $("#toast").html("Error occurred while updating the vote count.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');
            
                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
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
                $("#toast").html("Error occurred while updating the vote count.")
                $("#toast").css("background-color", "#E04F5F");
                $("#toast").addClass('show');
            
                setTimeout(function() {
                    $("#toast").removeClass('show');
                }, 2000);
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
                // console.log(data);
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
        // const ws = new WebSocket('ws://localhost:8080');

        // ws.onmessage = function (event) {
        //     const data = JSON.parse(event.data);

        //     switch (data.type) {
        //         case 'discussion':
        //             getPosts("", $("#topicId").val());
        //             break;
        //         case 'topicDelete':
        //             window.location.href = "discussionForum.php"; // Redirect to the desired page when 'topicDelete' is received
        //             break;    
        //         default:
        //             break;
        //     }
        // };

        const channel = pusher.subscribe('religionExplorer');

        channel.bind('new-post-event', function (data) {
            // Run the getPosts() function when the event is received
            getPosts("user_priority", $("#topicId").val());
          });


          //visit profile of user
          function attachProfilePictureListeners() {
            // Click event for user profile pictures in posts
            $(document).off('click', '.discussionForumAvatarComment').on('click', '.discussionForumAvatarComment', function() {
                const accountId = $(this).data('accountid');
                // Redirect to viewUserProfile.php with the accountId
                window.location.href = 'viewUserProfile.php?accountid=' + accountId;
            });
            $(document).off('click', '.discussionForumUsernameComment').on('click', '.discussionForumUsernameComment', function() {
                const accountId = $(this).data('accountid');
                // Redirect to viewUserProfile.php with the accountId
                window.location.href = 'viewUserProfile.php?accountid=' + accountId;
            });
        }   
        function convertToLocalTime() {
            const postDateElements = document.querySelectorAll(".postDate");
    
            postDateElements.forEach(function(element) {
                const postDate = new Date(element.getAttribute("data-postdate"));
                const userTimezoneOffset = new Date().getTimezoneOffset() * 60000;
                const localTime = new Date(postDate - userTimezoneOffset).toLocaleString();
    
                element.textContent = localTime;
            });
        }
    
        // Call the function to convert date and time on page load
        window.addEventListener("load", convertToLocalTime);
});

function reportContent(contentid) {
    $("#reportContentid").text(contentid);
    $('#reportContentModal').modal();
    $('#reportContentModal').show();
}

function checkContent(content) {
    const API_KEY = 'AIzaSyAMS69pJZVhNROCjcqryJNbhoQokBXPgNo';
    const DISCOVERY_URL = 'https://commentanalyzer.googleapis.com/$discovery/rest?version=v1alpha1';
  
    return new Promise((resolve, reject) => {
      function onGAPILoad() {
        gapi.client.load(DISCOVERY_URL)
          .then(() => {
            const analyzeRequest = {
              comment: {
                text: content,
              },
              requestedAttributes: {
                TOXICITY: {},
                SEVERE_TOXICITY: {},
                IDENTITY_ATTACK: {},
                INSULT: {},
                PROFANITY: {},
                THREAT: {}
              }
            };
  
            gapi.client.commentanalyzer.comments.analyze({
              key: API_KEY,
              resource: analyzeRequest,
            })
              .then(response => {
                const toxicity_score = response.result.attributeScores.TOXICITY.summaryScore.value;
                const severe_toxicity_score = response.result.attributeScores.SEVERE_TOXICITY.summaryScore.value;
                const indentity_atttack_score = response.result.attributeScores.IDENTITY_ATTACK.summaryScore.value;
                const insult_score = response.result.attributeScores.INSULT.summaryScore.value;
                const profanity_score = response.result.attributeScores.PROFANITY.summaryScore.value;
                const threat_score = response.result.attributeScores.THREAT.summaryScore.value;

                if (toxicity_score > 0.5 || severe_toxicity_score > 0.5 || indentity_atttack_score > 0.5 || insult_score > 0.5 || profanity_score > 0.5 || threat_score > 0.5) {
                  resolve("nsfw");
                } else {
                  resolve("safe");
                }
              })
              .catch(err => {
                resolve("safe");
              });
          })
          .catch(err => {
            reject(err);
          });
      }
  
      gapi.load('client', onGAPILoad);
    });
} 