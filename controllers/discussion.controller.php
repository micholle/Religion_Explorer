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
}
