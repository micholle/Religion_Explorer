<?php
require_once "connection.php";
session_start();
// Retrieve the topic ID from the query parameter
$topicId = isset($_GET['topicId']) ? $_GET['topicId'] : '';

// Create a new instance of the Connection class
$connection = new Connection();

// Establish a database connection
$db = $connection->connect();
// Fetch the topic data from the database based on the topic ID
try {
  $stmt = $db->prepare("SELECT t.*, a.username,
                            (SELECT COUNT(*) FROM posts WHERE posts.topicId = t.topicId) AS postCount,
                            (SELECT postCount + COUNT(*) FROM reply JOIN posts ON reply.postId = posts.postId WHERE posts.topicId = t.topicId) AS commentCount
                       FROM topics t
                       INNER JOIN accounts a ON t.accountId = a.accountId
                       WHERE t.topicId = :topicId");
  $stmt->bindValue(':topicId', $topicId);
  $stmt->execute();
  $topicData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Error occurred while fetching topic data: " . $e->getMessage());
}

// Check if the topic data exists
if ($topicData) {
  $accountid = $topicData['accountid'];
  $topicId = $topicData['topicId'];
  $topicTitle = $topicData['topicTitle'];
  $username = $topicData['username'];
  $topicDate = $topicData['topicDate'];
  $topicContent = $topicData['topicContent'];
  $upvotes = $topicData['upvotes'];
  $commentCount = $topicData['commentCount'];
} else {
  // Handle the case when the topic data does not exist
  $topicTitle = 'Topic Not Found';
  $username = 'Anonymous';
  $topicDate = '';
  $topicContent = 'The requested topic could not be found.';
  $upvotes = 0;
}

function mdlGetTopicVoteByUser($topicId, $accountId) {
  $db = new Connection();
  $pdo = $db->connect();

  try {
      $stmt = $pdo->prepare("SELECT voteType FROM topic_votes WHERE topicId = :topicId AND accountid = :accountId");
      $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
      $stmt->bindParam(":accountId", $accountId, PDO::PARAM_INT);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result) {
          return $result['voteType'];
      } else {
          return ''; // User has not voted on the topic
      }
  } catch (Exception $e) {
      return ''; // Error occurred while fetching the vote
  } finally {
      $pdo = null;
      $stmt = null;
  }
}

$hasUpvotedTopic = mdlGetTopicVoteByUser($topicId, $_SESSION['accountid']) === 'upvote';
$hasDownvotedTopic = mdlGetTopicVoteByUser($topicId, $_SESSION['accountid']) === 'downvote';
