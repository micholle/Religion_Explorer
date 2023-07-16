<?php
require_once "../models/discussion.model.php";

class ControllerDiscussion {
  public function ctrGetAllTopics($sortCriteria) {
    $topics = (new ModelDiscussion)->mdlGetAllTopics($sortCriteria);
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


}
