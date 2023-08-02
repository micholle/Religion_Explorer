<?php
// getEngagementData.php

// Assuming you have a database connection established
require_once "connection.php";

$connection = new Connection();
$db = $connection->connect();

// Assuming $_POST['username'] contains the username of the main user
$mainUsername = $_POST['username'];

$stmt = $db->prepare("SELECT accountid FROM accounts WHERE username = ?");
$stmt->execute([$mainUsername]);
$mainUserId = $stmt->fetchColumn();

// Get the selected date range option
$engagementDate = $_POST['engagementDate'];

if ($engagementDate === 'week') {
    $endDate = '1 WEEK'; // Use INTERVAL directly as a string, without quotes
} elseif ($engagementDate === 'month') {
    $endDate = '1 MONTH';
} elseif ($engagementDate === 'year') {
    $endDate = '1 YEAR';
} elseif ($engagementDate === 'all'){
    $endDate = ''; // Empty string to fetch all records without limiting by date
}

// Retrieve the religions of users who upvoted or downvoted the topics of the main user within the selected date range
$stmt = $db->prepare("SELECT a.religion 
                     FROM topic_votes tv
                     INNER JOIN accounts a ON tv.accountid = a.accountid
                     WHERE tv.topicId IN (
                         SELECT topicId FROM topics WHERE accountid = ?
                     ) AND tv.topicVoteDate >= DATE_SUB(NOW(), INTERVAL $endDate)");
$stmt->execute([$mainUserId]);
$topicReligions = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Retrieve the religions of users who upvoted or downvoted the posts of the main user within the selected date range
$stmt = $db->prepare("SELECT a.religion 
                     FROM post_votes pv
                     INNER JOIN accounts a ON pv.accountid = a.accountid
                     WHERE pv.postId IN (
                         SELECT postId FROM posts WHERE accountid = ?
                     ) AND pv.postVoteDate >= DATE_SUB(NOW(), INTERVAL $endDate)");
$stmt->execute([$mainUserId]);
$postReligions = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Retrieve the religions of users who upvoted or downvoted the replies of the main user within the selected date range
$stmt = $db->prepare("SELECT a.religion 
                     FROM reply_votes rv
                     INNER JOIN accounts a ON rv.accountid = a.accountid
                     WHERE rv.replyId IN (
                         SELECT replyId FROM reply WHERE accountid = ?
                     ) AND rv.replyVoteDate >= DATE_SUB(NOW(), INTERVAL $endDate)");
$stmt->execute([$mainUserId]);
$replyReligions = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Retrieve the religions of users who have posted on the main user's topics within the selected date range
$stmt = $db->prepare("SELECT a.religion 
                     FROM posts p
                     INNER JOIN accounts a ON p.accountid = a.accountid
                     WHERE p.topicId IN (
                         SELECT topicId FROM topics WHERE accountid = ?
                     ) AND p.postDate >= DATE_SUB(NOW(), INTERVAL $endDate)");
$stmt->execute([$mainUserId]);
$topicPostReligions = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Retrieve the religions of users who have replied to the main user's posts within the selected date range
$stmt = $db->prepare("SELECT a.religion 
                     FROM reply r
                     INNER JOIN accounts a ON r.accountid = a.accountid
                     WHERE r.postId IN (
                         SELECT postId FROM posts WHERE accountid = ?
                     ) AND r.replyDate >= DATE_SUB(NOW(), INTERVAL $endDate)");
$stmt->execute([$mainUserId]);
$postReplyReligions = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Count the occurrences of each religion in the combined array
$allReligions = array_merge($topicReligions, $postReligions, $replyReligions, $postReplyReligions, $topicPostReligions);
$religionCount = array_count_values($allReligions);

// Initialize an array to hold the counts of each religion in the desired order
$religionCountsOrdered = array_fill_keys(['Buddhism', 'Christianity', 'Hinduism', 'Islam', 'Judaism', 'Other Religions', 'Non-Religious'], 0);

// Initialize counters for total post replies and topic posts
$totalPostReplies = count($postReplyReligions);
$totalTopicPosts = count($topicPostReligions);

$totalUpvotes = 0;
$totalDownvotes = 0;

// Retrieve the counts for upvotes and downvotes for topics
$stmt = $db->prepare("SELECT voteType, COUNT(*) as count FROM topic_votes WHERE topicId IN (SELECT topicId FROM topics WHERE accountid = ?) AND topicVoteDate >= DATE_SUB(NOW(), INTERVAL $endDate) GROUP BY voteType");
$stmt->execute([$mainUserId]);
$topicVotesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retrieve the counts for upvotes and downvotes for posts
$stmt = $db->prepare("SELECT voteType, COUNT(*) as count FROM post_votes WHERE postId IN (SELECT postId FROM posts WHERE accountid = ?) AND postVoteDate >= DATE_SUB(NOW(), INTERVAL $endDate) GROUP BY voteType");
$stmt->execute([$mainUserId]);
$postVotesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retrieve the counts for upvotes and downvotes for replies
$stmt = $db->prepare("SELECT voteType, COUNT(*) as count FROM reply_votes WHERE replyId IN (SELECT replyId FROM reply WHERE accountid = ?) AND replyVoteDate >= DATE_SUB(NOW(), INTERVAL $endDate) GROUP BY voteType");
$stmt->execute([$mainUserId]);
$replyVotesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process the counts for upvotes and downvotes for topics, posts, and replies
foreach ($topicVotesData as $voteData) {
    $voteType = $voteData['voteType'];
    $count = $voteData['count'];
    if ($voteType === 'upvote') {
        $totalUpvotes += $count;
    } elseif ($voteType === 'downvote') {
        $totalDownvotes += $count;
    }
}

foreach ($postVotesData as $voteData) {
    $voteType = $voteData['voteType'];
    $count = $voteData['count'];
    if ($voteType === 'upvote') {
        $totalUpvotes += $count;
    } elseif ($voteType === 'downvote') {
        $totalDownvotes += $count;
    }
}

foreach ($replyVotesData as $voteData) {
    $voteType = $voteData['voteType'];
    $count = $voteData['count'];
    if ($voteType === 'upvote') {
        $totalUpvotes += $count;
    } elseif ($voteType === 'downvote') {
        $totalDownvotes += $count;
    }
}

// Iterate through the counted religions and place them in the ordered array
foreach ($religionCount as $religion => $count) {
    $religionCountsOrdered[$religion] = $count;
}

// Convert the ordered array to a simple array of counts
$engagementData = array_values($religionCountsOrdered);

// Prepare the data to send back to the JavaScript
$responseData = [
    'success' => true,
    'engagementData' => $engagementData,
    'totalUpvotes' => $totalUpvotes,
    'totalDownvotes' => $totalDownvotes,
    'totalPostReplies' => $totalPostReplies,
    'totalTopicPosts' => $totalTopicPosts,
];

header('Content-Type: application/json');
echo json_encode($responseData);
