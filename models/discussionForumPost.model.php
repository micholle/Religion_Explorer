<?php
require_once "connection.php";

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
