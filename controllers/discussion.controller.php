<?php
require_once "../models/discussion.model.php";

class ControllerDiscussion {
  public function ctrGetAllTopics() {
    $topics = (new ModelDiscussion)->mdlGetAllTopics();
    return $topics;
  }

  public function ctrCreateDiscussion($data) {
    $result = (new ModelDiscussion)->mdlCreateDiscussion($data);
    return $result;
  }
}
