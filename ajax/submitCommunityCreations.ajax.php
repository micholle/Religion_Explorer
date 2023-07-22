<?php
require_once "../controllers/community.controller.php";

class communityAjax {
  public $creationid;
  public $accountid;
  public $title;
  public $religion;
  public $description;
  public $filedata;
  public $filename;
  public $filetype;
  public $filesize;
  public $status;
  public $date;

  public function ajaxSubmitCreation() {
    $creationid = $this->creationid;
    $accountid = $this->accountid;
    $title = $this->title;
    $religion = $this->religion;
    $description = $this->description;
    $filedata = $this->filedata;
    $filename = $this->filename;
    $filetype = $this->filetype;
    $filesize = $this->filesize;
    $status = $this->status;
    $date = $this->date;

    $data = array(
      "creationid" => $creationid,
      "accountid" => $accountid,
      "title" => $title,
      "religion" => $religion,
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

$creationid = "CC" . uniqid();
$tname = $_FILES["filedata"]["tmp_name"];
$directory = "../views/assets/data/community";
$filepath = $directory . "/" . $creationid . "." . pathinfo($_FILES["filedata"]["name"], PATHINFO_EXTENSION);
move_uploaded_file($tname, $filepath);

$submitCreation = new communityAjax();
$submitCreation->creationid = $creationid;
$submitCreation->accountid = $_POST["accountid"];
$submitCreation->title = $_POST["title"];
$submitCreation->religion = $_POST["religion"];
$submitCreation->description = $_POST["description"];
// $submitCreation->filedata = file_get_contents($_FILES["filedata"]["tmp_name"]);
$submitCreation->filedata = $filepath;
$submitCreation->filename = $_POST["filename"];
$submitCreation->filetype = $_POST["filetype"];
$submitCreation->filesize = $_POST["filesize"];
$submitCreation->status = $_POST["status"];
$submitCreation->date = $_POST["date"];

$submitCreation->ajaxSubmitCreation();
?>