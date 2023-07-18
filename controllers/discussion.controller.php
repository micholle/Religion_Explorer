<?php
require_once "../models/discussion.model.php";

class ControllerDiscussion {
  public function ctrGetAllTopics($sortCriteria) {
    $topics = (new ModelDiscussion)->mdlGetAllTopics($sortCriteria);
    return $topics;
  }

  public function ctrGetProfileTopics() {
    $topics = (new ModelDiscussion)->mdlGetProfileTopics();
    return $topics;
  }

  public function ctrGetProfilePosts() {
    $topics = (new ModelDiscussion)->mdlGetProfilePosts();
    return $topics;
  }

  public function ctrCreateDiscussion($data) {
    $result = (new ModelDiscussion)->mdlCreateDiscussion($data);
    return $result;
  }

  //posts

  public function ctrGetAllPosts($sortCriteria, $topicId) {
    $posts = (new ModelDiscussion)->mdlGetAllPosts($sortCriteria, $topicId);
    return $posts;
  }

  public function ctrCreatePost($data) {
    $result = (new ModelDiscussion)->mdlCreatePost($data);
    return $result;
  }

  //reply

  public function ctrCreateReply($data) {
    $result = (new ModelDiscussion)->mdlCreateReply($data);
    return $result;
  }

  public function ctrGetRepliesByPostId($postId) {
      $result = (new ModelDiscussion)->mdlGetRepliesByPostId($postId);
      return $result;
  }

  //delete

  public function ctrDeletePost($postId) {
    $result = (new ModelDiscussion)->mdlDeletePost($postId);
    return $result;
  }

  public function ctrDeleteTopic($topicId) {
    $result = (new ModelDiscussion)->mdlDeleteTopic($topicId);
    return $result;
  }

  public function ctrDeleteReply($replyId) {
      $result = (new ModelDiscussion)->mdlDeleteReply($replyId);
      return $result;
  }


  //edit

  public function ctrUpdateTopic($topicId, $updatedTitle, $updatedContent) {
    $result = (new ModelDiscussion)->mdlUpdateTopic($topicId, $updatedTitle, $updatedContent);
    return $result;
  }

  public function ctrUpdatePost($postId, $updatedContent) {
    $result = (new ModelDiscussion)->mdlUpdatePost($postId, $updatedContent);
    return $result;
  }

  public function ctrUpdateReply($replyId, $updatedContent) {
    $result = (new ModelDiscussion)->mdlUpdateReply($replyId, $updatedContent);
    return $result;
  }

  //vote

  public function ctrUpdateVoteCount($type, $id, $voteAction) {
    $modelDiscussion = new ModelDiscussion();
    $accountId = $_SESSION['accountid'];

    switch ($type) {
        case 'post':
            return $this->ctrUpdateVoteCountForPost($id, $voteAction, $accountId, $modelDiscussion);
        case 'reply':
            return $this->ctrUpdateVoteCountForReply($id, $voteAction, $accountId, $modelDiscussion);
        default:
            return false;
    }
}

private function ctrUpdateVoteCountForPost($postId, $voteAction, $accountId, $modelDiscussion) {
    $currentVote = $modelDiscussion->mdlGetPostVoteByUser($postId, $accountId);

    if ($currentVote === 'upvote') {
        if ($voteAction === 'upvote') {
            // Remove the upvote
            $modelDiscussion->mdlRemovePostUpvote($postId, $accountId);
            $modelDiscussion->mdlUpdatePostUpvotes($postId, -1); // Decrease upvote count
        } elseif ($voteAction === 'downvote') {
            // Change the upvote to a downvote
            $modelDiscussion->mdlRemovePostUpvote($postId, $accountId);
            $modelDiscussion->mdlAddPostDownvote($postId, $accountId);
            $modelDiscussion->mdlUpdatePostUpvotes($postId, -1); // Decrease upvote count
            $modelDiscussion->mdlUpdatePostDownvotes($postId, 1); // Increase downvote count
        }
    } elseif ($currentVote === 'downvote') {
        if ($voteAction === 'upvote') {
            // Change the downvote to an upvote
            $modelDiscussion->mdlRemovePostDownvote($postId, $accountId);
            $modelDiscussion->mdlAddPostUpvote($postId, $accountId);
            $modelDiscussion->mdlUpdatePostUpvotes($postId, 1); // Increase upvote count
            $modelDiscussion->mdlUpdatePostDownvotes($postId, -1); // Decrease downvote count
        } elseif ($voteAction === 'downvote') {
            // Remove the downvote
            $modelDiscussion->mdlRemovePostDownvote($postId, $accountId);
            $modelDiscussion->mdlUpdatePostDownvotes($postId, -1); // Decrease downvote count
        }
    } else {
        if ($voteAction === 'upvote') {
            // Add an upvote
            $modelDiscussion->mdlAddPostUpvote($postId, $accountId);
            $modelDiscussion->mdlUpdatePostUpvotes($postId, 1); // Increase upvote count
        } elseif ($voteAction === 'downvote') {
            // Add a downvote
            $modelDiscussion->mdlAddPostDownvote($postId, $accountId);
            $modelDiscussion->mdlUpdatePostDownvotes($postId, 1); // Increase downvote count
        }
    }

    return true; // Vote count updated successfully
    }

    private function ctrUpdateVoteCountForReply($replyId, $voteAction, $accountId, $modelDiscussion) {
        $currentVote = $modelDiscussion->mdlGetReplyVoteByUser($replyId, $accountId);

        if ($currentVote === 'upvote') {
            if ($voteAction === 'upvote') {
                // Remove the upvote
                $modelDiscussion->mdlRemoveReplyUpvote($replyId, $accountId);
                $modelDiscussion->mdlUpdateReplyUpvotes($replyId, -1); // Decrease upvote count
            } elseif ($voteAction === 'downvote') {
                // Change the upvote to a downvote
                $modelDiscussion->mdlRemoveReplyUpvote($replyId, $accountId);
                $modelDiscussion->mdlAddReplyDownvote($replyId, $accountId);
                $modelDiscussion->mdlUpdateReplyUpvotes($replyId, -1); // Decrease upvote count
                $modelDiscussion->mdlUpdateReplyDownvotes($replyId, 1); // Increase downvote count
            }
        } elseif ($currentVote === 'downvote') {
            if ($voteAction === 'upvote') {
                // Change the downvote to an upvote
                $modelDiscussion->mdlRemoveReplyDownvote($replyId, $accountId);
                $modelDiscussion->mdlAddReplyUpvote($replyId, $accountId);
                $modelDiscussion->mdlUpdateReplyUpvotes($replyId, 1); // Increase upvote count
                $modelDiscussion->mdlUpdateReplyDownvotes($replyId, -1); // Decrease downvote count
            } elseif ($voteAction === 'downvote') {
                // Remove the downvote
                $modelDiscussion->mdlRemoveReplyDownvote($replyId, $accountId);
                $modelDiscussion->mdlUpdateReplyDownvotes($replyId, -1); // Decrease downvote count
            }
        } else {
            if ($voteAction === 'upvote') {
                // Add an upvote
                $modelDiscussion->mdlAddReplyUpvote($replyId, $accountId);
                $modelDiscussion->mdlUpdateReplyUpvotes($replyId, 1); // Increase upvote count
            } elseif ($voteAction === 'downvote') {
                // Add a downvote
                $modelDiscussion->mdlAddReplyDownvote($replyId, $accountId);
                $modelDiscussion->mdlUpdateReplyDownvotes($replyId, 1); // Increase downvote count
            }
        }

        return true; // Vote count updated successfully
    }

    public function ctrUpdateVoteCountForTopic($topicId, $voteAction) {
      $modelDiscussion = new ModelDiscussion();
      $accountId = $_SESSION['accountid'];
      $currentVote = $modelDiscussion->mdlGetTopicVoteByUser($topicId, $accountId); // check
  
      if ($currentVote === 'upvote') {
          if ($voteAction === 'upvote') {
              // Remove the upvote
              $modelDiscussion->mdlRemoveTopicUpvote($topicId, $accountId); // check
              $modelDiscussion->mdlUpdateTopicUpvotes($topicId, -1); // Decrease upvote count
          } elseif ($voteAction === 'downvote') {
              // Change the upvote to a downvote
              $modelDiscussion->mdlRemoveTopicUpvote($topicId, $accountId); // check
              $modelDiscussion->mdlAddTopicDownvote($topicId, $accountId); // check
              $modelDiscussion->mdlUpdateTopicUpvotes($topicId, -1); // Decrease upvote count
              $modelDiscussion->mdlUpdateTopicDownvotes($topicId, 1); // Increase downvote count
          }
      } elseif ($currentVote === 'downvote') {
          if ($voteAction === 'upvote') {
              // Change the downvote to an upvote
              $modelDiscussion->mdlRemoveTopicDownvote($topicId, $accountId);
              $modelDiscussion->mdlAddTopicUpvote($topicId, $accountId); // check
              $modelDiscussion->mdlUpdateTopicUpvotes($topicId, 1); // Increase upvote count
              $modelDiscussion->mdlUpdateTopicDownvotes($topicId, -1); // Decrease downvote count
          } elseif ($voteAction === 'downvote') {
              // Remove the downvote
              $modelDiscussion->mdlRemoveTopicDownvote($topicId, $accountId);
              $modelDiscussion->mdlUpdateTopicDownvotes($topicId, -1); // Decrease downvote count
          }
      } else {
          if ($voteAction === 'upvote') {
              // Add an upvote
              $modelDiscussion->mdlAddTopicUpvote($topicId, $accountId); // check
              $modelDiscussion->mdlUpdateTopicUpvotes($topicId, 1); // Increase upvote count
          } elseif ($voteAction === 'downvote') {
              // Add a downvote
              $modelDiscussion->mdlAddTopicDownvote($topicId, $accountId); // check
              $modelDiscussion->mdlUpdateTopicDownvotes($topicId, 1); // Increase downvote count
          }
      }
  
      return true; // Vote count updated successfully
  }
  


    public function ctrGetPostVoteByUser($postId, $accountId) {
      $model = new ModelDiscussion();
      return $model->mdlGetPostVoteByUser($postId, $accountId);
    }

    public function ctrGetReplyVoteByUser($replyId, $accountId) {
      $model = new ModelDiscussion();
      return $model->mdlGetReplyVoteByUser($replyId, $accountId);
    }

    public function ctrGetTopicVoteByUser($topicId, $accountId) {
      $model = new ModelDiscussion();
      return $model->mdlGetTopicVoteByUser($topicId, $accountId);
    }

    //search
    public function ctrSearchPosts($query) {
        $posts = (new ModelDiscussion)->mdlSearchPosts($query);
        return $posts;
      }
    
    public function ctrSearchTopics($query) {
        $topics = (new ModelDiscussion)->mdlSearchTopics($query);
        return $topics;
    }


    //recommendations
    public function ctrGetTopics() {
        $topics = (new ModelDiscussion)->mdlGetTopics();
        return $topics;
      }
      
      
}
