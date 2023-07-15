<?php
require_once "../controllers/community.controller.php";

class communityAjax {
  public $username;
  public $title;
  public $religion;
  public $topics;
  public $description;
  public $filedata;
  public $filename;
  public $filetype;
  public $filesize;
  public $status;
  public $date;

  public function ajaxSubmitCreation() {
    $username = $this->username;
    $title = $this->title;
    $religion = $this->religion;
    $topics = $this->topics;
    $description = $this->description;
    $filedata = $this->filedata;
    $filename = $this->filename;
    $filetype = $this->filetype;
    $filesize = $this->filesize;
    $status = $this->status;
    $date = $this->date;

    $data = array(
      "username" => $username,
      "title" => $title,
      "religion" => $religion,
      "topics" => $topics,
      "description" => $description,
      "filedata" => $filedata,
      "filename" => $filename,
      "filetype" => $filetype,
      "filesize" => $filesize,
      "status" => $status,
      "date" => $date
    );

    $answer = (new communityController)->ctrSubmitCreation($data);
  }
}

$submitCreation = new communityAjax();
$submitCreation->username = $_POST["username"];
$submitCreation->title = $_POST["title"];
$submitCreation->religion = $_POST["religion"];
$submitCreation->topics = $_POST["topics"];
$submitCreation->description = $_POST["description"];
$submitCreation->filedata = file_get_contents($_FILES["filedata"]["tmp_name"]);
$submitCreation->filename = $_POST["filename"];
$submitCreation->filetype = $_POST["filetype"];
$submitCreation->filesize = $_POST["filesize"];
$submitCreation->status = $_POST["status"];
$submitCreation->date = $_POST["date"];

$submitCreation->ajaxSubmitCreation();
?>