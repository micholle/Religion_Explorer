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
      var anonymous = $("#anonymousCheckbox").is(":checked") ? 1 : 0;
      
      // Create an object with the data
      var discussion = {
          topicTitle: topicTitle,
          topicContent: topicContent,
          anonymous: anonymous // Add the anonymous value to the object
      };
  
      // Make the AJAX request to create the topic
      $.ajax({
          url: "../../ajax/discussionCreate.ajax.php",
          method: "POST",
          data: discussion,
          success: function(response) {
              if (response === "success") {
                  // Topic created successfully
                  $("#topicTitle").val("");
                  $("#topicContent").val("");
                  // Refresh the topics by calling the getTopics function
                  getTopics();
                  const message = {
                    type: 'topics'
                  };
                  ws.send(JSON.stringify(message));
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

    function getTopics(sortCriteria) {
      $.ajax({
          url: "../../ajax/discussionTopics.ajax.php",
          method: "GET",
          data: { sort: sortCriteria }, // Pass the sort criteria to the server
          success: function(data) {
              console.log(data);
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
        }
    });

    $(document).on("click", ".forumContent", function() {
      var topicId = $(this).find("#topicId").val();
      window.location.href = "discussionForumPost.php?topicId=" + topicId;
    });


    $("#top").click(function() {
      getTopics("top"); // Pass "top" as the sort criteria
    });
    
    $("#new").click(function() {
        getTopics("new"); // Pass "new" as the sort criteria
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
              getTopics();
              const message = {
                type: 'topics'
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
              alert('Error occurred while updating the vote count');
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

 //websocket
 const ws = new WebSocket('ws://localhost:8080');
        
 ws.onmessage = function (event) {
     const data = JSON.parse(event.data);
 
     // Handle the received WebSocket message and update the UI
     switch (data.type) {
         case 'topics':
             // Handle new post
             getTopics();
             break;
         default:
             break;
     }
 };
  
});
    
