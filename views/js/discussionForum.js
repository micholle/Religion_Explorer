$(function() {
    const pusher = new Pusher('a314fc475591f42fbafc', {
        cluster: 'ap1',
        // Add any other options you might need
      });

    // JavaScript code
    $(document).ready(function() {
        var currentSort = "user_priority";
        getTopics(currentSort);

        $("#top").click(function() {
            if (currentSort === "top") {
                currentSort = "user_priority";
                $(this).blur(); // Remove focus and highlight from the clicked button
            } else {
                currentSort = "top";
            }
            getTopics(currentSort);
        });

        $("#new").click(function() {
            if (currentSort === "new") {
                currentSort = "user_priority";
                $(this).blur(); // Remove focus and highlight from the clicked button
            } else {
                currentSort = "new";
            }
            getTopics(currentSort);
        });
    });


    $("form").submit(function(e) {
        e.preventDefault();
        createDiscussion();
    });

    var blockDuration = 60 * 1000;
    var violationCount = 0;
    
    function createDiscussion() {
        try {
            var storedBlockTime = localStorage.getItem("blockTime");
            if (storedBlockTime) {
                var currentTime = new Date().getTime();
                var timeSinceBlock = currentTime - parseInt(storedBlockTime);
                if (timeSinceBlock < blockDuration) {
                    var remainingTime = blockDuration - timeSinceBlock;
    
                    $("#modalIcon").attr("src", "../assets/img/verification-error.png");
                    $("#modalHeader").text("Error");
                    $("#modalContent").text("You are blocked from posting due to too many violations. Please try again in " + Math.ceil(remainingTime / 1000) + " seconds.");
    
                    var countdownInterval = setInterval(function() {
                        remainingTime -= 1000;

                        if (remainingTime <= 0) {
                          clearInterval(countdownInterval);
                          $("#topicCreatedModal").modal("hide");
                          localStorage.removeItem("blockTime");
                        } else {
                          $("#modalContent").text("You are blocked from posting due to too many violations. Please try again in " + Math.ceil(remainingTime / 1000) + " seconds.");
                        }
                    }, 1000);

                    $("#closeTopicCreatedModal").css("display", "none");
    
                    $("#topicCreatedModal").modal();
                    $("#topicCreatedModal").show();
                    
                    return;
                }
            }
    
            if (violationCount >= 5) {
                var currentTime = new Date().getTime();
                localStorage.setItem("blockTime", currentTime.toString());
                violationCount = 0;
    
                $("#modalIcon").attr("src", "../assets/img/verification-error.png");
                $("#modalHeader").text("Error");
                $("#modalContent").text("You are blocked from posting due to too many violations. Please try again later.");
                $("#closeTopicCreatedModal").css("display", "none");
    
                $("#topicCreatedModal").modal();
                $("#topicCreatedModal").show();
            } else {
                attemptPost();
            }
        } catch (error) {
            $("#toast").html("Something went wrong. Please try again later.")
            $("#toast").css("background-color", "#E04F5F");
            $("#toast").addClass('show');
    
            setTimeout(function() {
                $("#toast").removeClass('show');
            }, 2000);
        }
    }    

    async function attemptPost() {
      var topicTitle = $("#topicTitle").val();
      var topicContent = $("#topicContent").val();
      var anonymous = $("#anonymousCheckbox").is(":checked") ? 1 : 0;

      if (topicTitle.trim() === '') {
          $("#toast").html("Title is empty. Please provide a title for your topic.")
          $("#toast").css("background-color", "#E04F5F");
          $("#toast").addClass('show');
      
          setTimeout(function() {
              $("#toast").removeClass('show');
          }, 2000);
          return;
      } else if (topicContent.trim() === '') {
          $("#toast").html("Content is empty. Please provide content for your topic.")
          $("#toast").css("background-color", "#E04F5F");
          $("#toast").addClass('show');
      
          setTimeout(function() {
              $("#toast").removeClass('show');
          }, 2000);
          return
      }
      
      // Create an object with the data
      var discussion = {
          topicTitle: topicTitle,
          topicContent: topicContent,
          anonymous: anonymous // Add the anonymous value to the object
      };

      var contentEvaluationTitle = await checkContent(topicTitle);
      var contentEvaluationContent = await checkContent(topicContent);

      if (contentEvaluationTitle == "nsfw" || contentEvaluationContent == "nsfw") {
          $("#modalIcon").attr("src", "../assets/img/verification-error.png");
          $("#modalHeader").text("Error");
          $("#modalContent").text("Your content has been blocked due to a violation of our community standards. We take these standards seriously to maintain a positive and respectful environment for all users. If you believe this action was taken in error, please reach out to our support team with further details. Thank you for your understanding and cooperation in upholding our community guidelines.");
          $("#closeTopicCreatedModal").css("display", "none");

          $("#topicCreatedModal").modal();
          $("#topicCreatedModal").show();

          violationCount++;
          
          if (violationCount == 5) {
            blockTime = new Date().getTime();
          }
      } else {
        // Make the AJAX request to create the topic
        $.ajax({
            url: "../../ajax/discussionCreate.ajax.php",
            method: "POST",
            data: discussion,
            success: function(response) {
                if (response === "success") {
                    // Topic created successfully
                        $("#toast").html("Topic created.")
                        $("#toast").css("background-color", "");
                        $("#toast").addClass('show');
                    
                        setTimeout(function() {
                            $("#toast").removeClass('show');
                        }, 2000);
                    $("#topicTitle").val("");
                    $("#topicContent").val("");
                    // Refresh the topics by calling the getTopics function
                    getTopics('user_priority');
                    const message = {
                        type: 'topics'
                    };

                    //add explorer points: discussion forum create topic               
                    var accountid = $("#accountidPlaceholder").text();
                    var currentDateTime = new Date();
                    var unixTimestamp = currentDateTime.getTime() / 1000;
                    
                    var explorerPoint = new FormData();
                    explorerPoint.append("accountid", accountid);
                    explorerPoint.append("pointsource", accountid + "_forum_topic_" + unixTimestamp);
                    explorerPoint.append("points", 3);

                    $.ajax({
                        url: '../../ajax/addExplorerPoints.ajax.php',
                        method: "POST",
                        data: explorerPoint,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "text"
                    });
                } else {
                    // Error occurred while creating the topic
                    $("#toast").html("Error occurred while creating the topic.")
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

    function getTopics(sortCriteria) {
      $.ajax({
          url: "../../ajax/discussionTopics.ajax.php",
          method: "GET",
          data: { sort: sortCriteria }, // Pass the sort criteria to the server
          success: function(data) {
            //   console.log(data);
              $("#topicsContainer").html(data);
              shortenUpvotes();
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
            var currentPage = window.location.pathname.split("/").pop();

            $("#discussionForumSidebar li a").each(function() {
                var tabPage = $(this).attr("href");
                if (tabPage === currentPage) {
                    $(this).addClass("active");
                }
            });
        }
    });

    $(document).on("click", ".forumContent", function() {
      var topicId = $(this).find("#topicId").val();
      window.location.href = "discussionForumPost.php?topicId=" + topicId;
    });

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

    //vote

    $(document).off('click', '.upvoteButton, .downvoteButton').on('click', '.upvoteButton, .downvoteButton', function() {
      const targetElement = $(this);
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
      updateVoteCount(id, voteAction, function(response) {
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
              getTopics('user_priority');
              const message = {
                type: 'topics'
            };
  
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
  
  function updateVoteCount(id, voteAction, callback) {
      $.ajax({
          url: '../../ajax/discussionTopicVote.ajax.php',
          method: 'POST',
          data: { id: id, voteAction: voteAction },
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

  //search
  $("#forumSearch").on("input", function() {
    var searchQuery = $(this).val(); // Retrieve search query
    searchPosts(searchQuery); // Call the searchPosts function
  });

  function searchPosts(searchQuery) {
    $.ajax({
      url: "../../ajax/discussionSearchTopics.ajax.php", // Update URL to the PHP file handling the search functionality
      method: "GET",
      data: { query: searchQuery }, // Pass search query as data
      success: function(data) {
        $("#topicsContainer").html(data);
        // Call the initializeReplyButtons function after loading the AJAX response
        shortenUpvotes();
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        console.log(status);
        console.log(error);
      }
    });
  }

 const channel = pusher.subscribe('religionExplorer');

        channel.bind('new-post-event', function (data) {
            // Run the getPosts() function when the event is received
            getTopics('user_priority');
          });
  
});

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