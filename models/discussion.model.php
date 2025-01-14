<?php
require_once "connection.php";

class ModelDiscussion {
    public function mdlGetAllTopics($sortCriteria) {
        $db = new Connection();
        $pdo = $db->connect();
    
        $orderBy = '';
    
        if ($sortCriteria === 'top') {
            $orderBy = 'upvotes DESC';
        } elseif ($sortCriteria === 'new') {
            $orderBy = 'topicDate DESC';
        } else {
            $orderBy = "CASE WHEN topics.accountid = :accountid THEN 0 ELSE 1 END, topicDate DESC";
        }
    
        try {
            $stmt = $pdo->prepare("SELECT topics.*, accounts.username, accounts.avatar, 'topic' AS itemType,
                                        (SELECT COUNT(*) FROM posts WHERE posts.topicId = topics.topicId) AS postCount,
                                        (SELECT postCount + COUNT(*) FROM reply JOIN posts ON reply.postId = posts.postId WHERE posts.topicId = topics.topicId) AS commentCount
                                   FROM topics 
                                   INNER JOIN accounts ON topics.accountid = accounts.accountid
                                   ORDER BY $orderBy");
    
            // Bind the accountid parameter if it's needed for the custom sort criteria
            if ($sortCriteria === 'user_priority') {
                $stmt->bindParam(":accountid", $_SESSION["accountid"], PDO::PARAM_STR);
            }
    
            $stmt->execute();
            $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $topics;
        } catch (Exception $e) {
            return array();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    

    public function mdlGetProfileTopics($accountid) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT topics.*, accounts.username, accounts.avatar, 'topic' AS itemType,
                               (SELECT COUNT(*) FROM posts WHERE posts.topicId = topics.topicId) AS postCount,
                               (SELECT postCount + COUNT(*) FROM reply JOIN posts ON reply.postId = posts.postId WHERE posts.topicId = topics.topicId) AS commentCount
                        FROM topics 
                        INNER JOIN accounts ON topics.accountid = accounts.accountid
                        WHERE topics.accountid = :accountid
                        ORDER BY topicDate DESC");
                        $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
                        $stmt->execute();
                        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $topics;
        } catch (Exception $e) {
            return array();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    static public function mdlGetProfilePosts($accountid) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT posts.*, topics.*, accounts.username, posts.upvotes AS postUpvotes, 'post' AS itemType
                                   FROM posts
                                   INNER JOIN topics ON posts.topicId = topics.topicId
                                   INNER JOIN accounts ON posts.accountid = accounts.accountid
                                   WHERE posts.accountid = :accountid
                                   ORDER BY postDate DESC");
            $stmt->bindParam(':accountid', $accountid, PDO::PARAM_STR);
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $posts;
        } catch (PDOException $e) {
            // Handle the exception or return an error message
            return [];
        } finally {
            // Close the connection and statement
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlCreateDiscussion($data) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Generate a unique topicId
            $topicId = $this->generateTopicId();
    
            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare("INSERT INTO topics (topicId, topicTitle, accountid, topicDate, topicContent, anonymous) VALUES (:topicId, :topicTitle, :accountid, NOW(), :topicContent, :anonymous)");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->bindParam(":topicTitle", $data["topicTitle"], PDO::PARAM_STR);
            $stmt->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt->bindParam(":topicContent", $data["topicContent"], PDO::PARAM_STR);
            $stmt->bindParam(":anonymous", $data["anonymous"], PDO::PARAM_INT); // Bind the anonymous value to the SQL statement
            $stmt->execute();

    
            return true; // Discussion created successfully
        } catch (Exception $e) {
            return false; // Error occurred while creating discussion
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    private function generateTopicId() {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Generate a random number
            $topicId = mt_rand(10000000, 99999999);
    
            // Check if the generated topicId already exists in the database
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM topics WHERE topicId = :topicId");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            // If the topicId already exists, generate a new one recursively
            if ($count > 0) {
                $topicId = $this->generateTopicId();
            }
    
            return $topicId;
        } catch (Exception $e) {
            // Handle the exception as per your application's requirements
            // For example, you can log the error or throw an exception
            return null;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    //Post

    public function mdlGetAllPosts($sortCriteria, $topicId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        $orderBy = '';
    
        if ($sortCriteria === 'top') {
            $orderBy = 'upvotes DESC';
        } elseif ($sortCriteria === 'new') {
            $orderBy = 'postDate DESC';
        } else {
            $orderBy = 'CASE WHEN topics.accountid = :accountid THEN 0 ELSE 1 END, topicDate DESC';
        }
    
        try {
            $stmt = $pdo->prepare("SELECT posts.*, accounts.username, posts.postDate, accounts.avatar,
                                        (SELECT COUNT(*) FROM reply WHERE reply.postId = posts.postId) AS replyCount
                                   FROM posts 
                                   INNER JOIN accounts ON posts.accountid = accounts.accountid
                                   INNER JOIN topics ON posts.topicId = topics.topicId
                                   WHERE topics.topicId = :topicId
                                   ORDER BY $orderBy");
            $stmt->bindParam(':topicId', $topicId, PDO::PARAM_INT);
            if ($sortCriteria === 'user_priority') {
                $stmt->bindParam(":accountid", $_SESSION["accountid"], PDO::PARAM_STR);
            }
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $posts;
        } catch (Exception $e) {
            return array();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlCreatePost($data) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Generate a unique topicId
            $postId = $this->generatePostId();
    
            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare("INSERT INTO posts (postId, accountid, postDate, postContent, topicId) VALUES (:postId, :accountid, NOW(), :postContent, :topicId)");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt->bindParam(":postContent", $data["postContent"], PDO::PARAM_STR);
            $stmt->bindParam(":topicId", $data["topicId"], PDO::PARAM_STR);
            $stmt->execute();

            //Notify owner of topic that someone posted a comment

            //get accountid of topic owner
            $topic_stmt = $pdo->prepare("SELECT accountid FROM topics WHERE topicId = :topicId");
            $topic_stmt->bindParam(":topicId", $data["topicId"], PDO::PARAM_STR);
            $topic_stmt->execute();
            $topicOwner = $topic_stmt->fetchColumn();
            
            if ($topicOwner != $data['accountid']){
            //add to notifications
                $notifications_stmt = $pdo->prepare("INSERT INTO notifications(accountid, postid, personInvolved, notificationSource, notificationDate) VALUES (:accountid, :postid, :personInvolved, :notificationSource, NOW())");
                $notifications_stmt->bindParam(":accountid", $topicOwner, PDO::PARAM_STR);
                $notifications_stmt->bindParam(":postid", $postId, PDO::PARAM_STR);
                $notifications_stmt->bindParam(":personInvolved", $data["accountid"], PDO::PARAM_STR);
                $notifications_stmt->bindValue(":notificationSource", "Discussion Forum Posts", PDO::PARAM_STR);
                $notifications_stmt->execute();
            }
    
            return true; // Discussion created successfully
        } catch (Exception $e) {
            return false; // Error occurred while creating discussion
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    private function generatePostId() {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Generate a random number
            $postId = mt_rand(10000000, 99999999);
    
            // Check if the generated topicId already exists in the database
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE postId = :postId");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            // If the topicId already exists, generate a new one recursively
            if ($count > 0) {
                $postId = $this->generatePostId();
            }
    
            return $postId;
        } catch (Exception $e) {
            // Handle the exception as per your application's requirements
            // For example, you can log the error or throw an exception
            return null;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    //reply

    public function mdlCreateReply($data) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Generate a unique replyId
            $replyId = $this->generateReplyId();
    
            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare("INSERT INTO reply (replyId, accountid, replyDate, replyContent, postId) VALUES (:replyId, :accountid, NOW(), :replyContent, :postId)");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt->bindParam(":replyContent", $data["replyContent"], PDO::PARAM_STR);
            $stmt->bindParam(":postId", $data["postId"], PDO::PARAM_STR);
            $stmt->execute();

            //Notify owner of topic that someone posted a reply to their comment

            //get accountid of post owner
            $post_stmt = $pdo->prepare("SELECT accountid FROM posts WHERE postId = :postId");
            $post_stmt->bindParam(":postId", $data["postId"], PDO::PARAM_STR);
            $post_stmt->execute();
            $postOwner = $post_stmt->fetchColumn();
            
            if ($postOwner != $data['accountid']){
            //add to notifications
                $notifications_stmt = $pdo->prepare("INSERT INTO notifications(accountid, replyid, personInvolved, notificationSource, notificationDate) VALUES (:accountid, :replyid, :personInvolved, :notificationSource, NOW())");
                $notifications_stmt->bindParam(":accountid", $postOwner, PDO::PARAM_STR);
                $notifications_stmt->bindParam(":replyid", $replyId, PDO::PARAM_STR);
                $notifications_stmt->bindParam(":personInvolved", $data["accountid"], PDO::PARAM_STR);
                $notifications_stmt->bindValue(":notificationSource", "Discussion Forum Replies", PDO::PARAM_STR);
                $notifications_stmt->execute();
            }
    
            return true; // Reply created successfully
        } catch (Exception $e) {
            return false; // Error occurred while creating reply
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlGetRepliesByPostId($postId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT r.*, a.username, a.avatar 
                                   FROM reply AS r
                                   INNER JOIN accounts AS a ON r.accountid = a.accountid
                                   WHERE r.postId = :postId
                                   ORDER BY replyDate ASC");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
    
            $replies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $replies;
        } catch (Exception $e) {
            return null;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    private function generateReplyId() {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Generate a random number
            $replyId = mt_rand(10000000, 99999999);
    
            // Check if the generated replyId already exists in the database
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM reply WHERE replyId = :replyId");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
    
            // If the replyId already exists, generate a new one recursively
            if ($count > 0) {
                $replyId = $this->generateReplyId();
            }
    
            return $replyId;
        } catch (Exception $e) {
            // Handle the exception as per your application's requirements
            // For example, you can log the error or throw an exception
            return null;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    

    //delete
    public function mdlDeletePost($postId) {
        $db = new Connection();
        $pdo = $db->connect();
        
        try {
            // Disable foreign key checks
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=0");
            $stmt->execute();

            // Delete post votes
            $stmt = $pdo->prepare("DELETE FROM post_votes WHERE postId = :postId");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
            
            // Delete the post
            $stmt = $pdo->prepare("DELETE FROM posts WHERE postId = :postId");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
            
            // Delete the associated replies
            $stmt = $pdo->prepare("DELETE FROM reply WHERE postId = :postId");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
            
            // Enable foreign key checks
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=1");
            $stmt->execute();

            // Delete from notifications
            $stmt = $pdo->prepare("DELETE FROM notifications WHERE postid = :postid");
            $stmt->bindParam(":postid", $postId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true; // Post deleted successfully
        } catch (Exception $e) {
            // Enable foreign key checks (in case of an error)
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=1");
            $stmt->execute();
            
            return false; // Error occurred while deleting the post
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlDeleteTopic($topicId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Disable foreign key checks
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=0");
            $stmt->execute();

            // Delete topic votes
            $stmt = $pdo->prepare("DELETE FROM topic_votes WHERE topicId = :topicId");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            // Delete the associated replies
            $stmt = $pdo->prepare("DELETE FROM reply WHERE postId IN (SELECT postId FROM posts WHERE topicId = :topicId)");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            // Delete the associated posts
            $stmt = $pdo->prepare("DELETE FROM posts WHERE topicId = :topicId");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            // Delete the topic
            $stmt = $pdo->prepare("DELETE FROM topics WHERE topicId = :topicId");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            // Enable foreign key checks
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=1");
            $stmt->execute();

            // Delete from notifications
            $stmt = $pdo->prepare("DELETE FROM notifications WHERE topicid = :topicid");
            $stmt->bindParam(":topicid", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Topic, posts, and replies deleted successfully
        } catch (Exception $e) {
            // Enable foreign key checks (in case of an error)
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=1");
            $stmt->execute();
    
            return false; // Error occurred while deleting the topic, posts, or replies
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }    
    
    public function mdlDeleteReply($replyId) {
        $db = new Connection();
        $pdo = $db->connect();
        
        try {
            // Disable foreign key checks
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=0");
            $stmt->execute();
            
            // Delete reply votes
            $stmt = $pdo->prepare("DELETE FROM reply_votes WHERE replyId = :replyId");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt = $pdo->prepare("DELETE FROM reply WHERE replyId = :replyId");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
            
            // Enable foreign key checks
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=1");
            $stmt->execute();

            // Delete from notifications
            $stmt = $pdo->prepare("DELETE FROM notifications WHERE replyid = :replyid");
            $stmt->bindParam(":replyid", $replyId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true; // Reply deleted successfully
        } catch (Exception $e) {
            // Enable foreign key checks (in case of an error)
            $stmt = $pdo->prepare("SET FOREIGN_KEY_CHECKS=1");
            $stmt->execute();
            
            return false; // Error occurred while deleting the reply
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    //edit

    public function mdlUpdateTopic($topicId, $updatedTitle, $updatedContent) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $pdo->beginTransaction();
    
            // Retrieve the current content
            $currentContent = $this->getCurrentTopicContent($pdo, $topicId);
    
            // Check if the content has changed
            if ($currentContent !== $updatedContent) {
                // Content has changed, so save it to topic_history
                $stmt = $pdo->prepare("INSERT INTO topic_history (topicId, topicContent, topicDate) VALUES (:topicId, :topicContent, NOW())");
                $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
                $stmt->bindParam(":topicContent", $currentContent, PDO::PARAM_STR);
                $stmt->execute();
            }
    
            // Update the topic in the topics table
            $stmt = $pdo->prepare("UPDATE topics SET topicTitle = :updatedTitle, topicContent = :updatedContent WHERE topicId = :topicId");
            $stmt->bindParam(":updatedTitle", $updatedTitle, PDO::PARAM_STR);
            $stmt->bindParam(":updatedContent", $updatedContent, PDO::PARAM_STR);
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            $pdo->commit();
    
            return true; // Topic updated successfully
        } catch (Exception $e) {
            $pdo->rollBack();
            return false; // Error occurred while updating the topic
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlUpdatePost($postId, $updatedContent) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $pdo->beginTransaction();
    
            // Retrieve the current post content
            $currentContent = $this->getCurrentPostContent($pdo, $postId);
    
            // Check if the content has changed
            if ($currentContent !== $updatedContent) {
                // Content has changed, so save it to post_history
                $stmt = $pdo->prepare("INSERT INTO post_history (postId, postContent, postDate) VALUES (:postId, :postContent, NOW())");
                $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
                $stmt->bindParam(":postContent", $currentContent, PDO::PARAM_STR);
                $stmt->execute();
            }
    
            // Update the post content in the posts table
            $stmt = $pdo->prepare("UPDATE posts SET postContent = :updatedContent WHERE postId = :postId");
            $stmt->bindParam(":updatedContent", $updatedContent, PDO::PARAM_STR);
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
    
            $pdo->commit();
    
            return true; // Post updated successfully
        } catch (Exception $e) {
            $pdo->rollBack();
            return false; // Error occurred while updating the post
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlUpdateReply($replyId, $updatedContent) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $pdo->beginTransaction();
    
            // Retrieve the current reply content
            $currentContent = $this->getCurrentReplyContent($pdo, $replyId);
    
            // Check if the content has changed
            if ($currentContent !== $updatedContent) {
                // Content has changed, so save it to reply_history
                $stmt = $pdo->prepare("INSERT INTO reply_history (replyId, replyContent, replyDate) VALUES (:replyId, :replyContent, NOW())");
                $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
                $stmt->bindParam(":replyContent", $currentContent, PDO::PARAM_STR);
                $stmt->execute();
            }
    
            // Update the reply content in the reply table
            $stmt = $pdo->prepare("UPDATE reply SET replyContent = :updatedContent WHERE replyId = :replyId");
            $stmt->bindParam(":updatedContent", $updatedContent, PDO::PARAM_STR);
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
    
            $pdo->commit();
    
            return true; // Reply updated successfully
        } catch (Exception $e) {
            $pdo->rollBack();
            return false; // Error occurred while updating the reply
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    private function getCurrentTopicContent($pdo, $topicId) {
        $stmt = $pdo->prepare("SELECT topicContent FROM topics WHERE topicId = :topicId");
        $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['topicContent'];
        }
    
        return "";
    }
    
    private function getCurrentPostContent($pdo, $postId) {
        $stmt = $pdo->prepare("SELECT postContent FROM posts WHERE postId = :postId");
        $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['postContent'];
        }
    
        return "";
    }
    
    private function getCurrentReplyContent($pdo, $replyId) {
        $stmt = $pdo->prepare("SELECT replyContent FROM reply WHERE replyId = :replyId");
        $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['replyContent'];
        }
    
        return "";
    }
    

    //vote
    public function mdlGetPostVoteByUser($postId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT voteType FROM post_votes WHERE postId = :postId AND accountId = :accountId");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return false; // Error occurred while retrieving the vote
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlGetReplyVoteByUser($replyId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT voteType FROM reply_votes WHERE replyId = :replyId AND accountId = :accountId");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return false; // Error occurred while retrieving the vote
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlAddPostUpvote($postId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("INSERT INTO post_votes (postId, accountid, voteType, postVoteDate) VALUES (:postId, :accountId, 'upvote', NOW())");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();

            //Notify owner of post that someone upvoted

            //get accountid of post owner
            $post_stmt = $pdo->prepare("SELECT accountid FROM posts WHERE postId = :postId");
            $post_stmt->bindParam(":postId", $postId, PDO::PARAM_STR);
            $post_stmt->execute();
            $postOwner = $post_stmt->fetchColumn();
            
            if ($postOwner != $accountId){
            //add to notifications
            $notifications_stmt = $pdo->prepare("INSERT INTO notifications(accountid, postid, personInvolved, notificationSource, notificationDate) VALUES (:accountid, :postid, :personInvolved, :notificationSource, NOW())");
            $notifications_stmt->bindParam(":accountid", $postOwner, PDO::PARAM_STR);
            $notifications_stmt->bindParam(":postid", $postId, PDO::PARAM_STR);
            $notifications_stmt->bindParam(":personInvolved", $accountId, PDO::PARAM_STR);
            $notifications_stmt->bindValue(":notificationSource", "Discussion Forum Posts Upvote", PDO::PARAM_STR);
            $notifications_stmt->execute();
            }
    
            return true; // Upvote added successfully
        } catch (Exception $e) {
            return "Error occurred while adding the upvote: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlAddPostDownvote($postId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("INSERT INTO post_votes (postId, accountid, voteType, postVoteDate) VALUES (:postId, :accountId, 'downvote', NOW())");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();
    
            return true; // Downvote added successfully
        } catch (Exception $e) {
            return "Error occurred while adding the downvote: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlAddReplyUpvote($replyId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("INSERT INTO reply_votes (replyId, accountid, voteType, replyVoteDate) VALUES (:replyId, :accountId, 'upvote', NOW())");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();

            //Notify owner of reply that someone upvoted

            //get accountid of reply owner
            $reply_stmt = $pdo->prepare("SELECT accountid FROM reply WHERE replyId = :replyId");
            $reply_stmt->bindParam(":replyId", $replyId, PDO::PARAM_STR);
            $reply_stmt->execute();
            $replyOwner = $reply_stmt->fetchColumn();
            
            if ($replyOwner != $accountId){
            //add to notifications
            $notifications_stmt = $pdo->prepare("INSERT INTO notifications(accountid, replyid, personInvolved, notificationSource, notificationDate) VALUES (:accountid, :replyid, :personInvolved, :notificationSource, NOW())");
            $notifications_stmt->bindParam(":accountid", $replyOwner, PDO::PARAM_STR);
            $notifications_stmt->bindParam(":replyid", $replyId, PDO::PARAM_STR);
            $notifications_stmt->bindParam(":personInvolved", $accountId, PDO::PARAM_STR);
            $notifications_stmt->bindValue(":notificationSource", "Discussion Forum Replies Upvote", PDO::PARAM_STR);
            $notifications_stmt->execute();
            }
    
            return true; // Upvote added successfully
        } catch (Exception $e) {
            return "Error occurred while adding the upvote: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlAddReplyDownvote($replyId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("INSERT INTO reply_votes (replyId, accountid, voteType, replyVoteDate) VALUES (:replyId, :accountId, 'downvote', NOW())");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();
    
            return true; // Downvote added successfully
        } catch (Exception $e) {
            return "Error occurred while adding the downvote: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlRemovePostUpvote($postId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("DELETE FROM post_votes WHERE postId = :postId AND accountid = :accountId AND voteType = 'upvote'");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();

            // Delete from notifications
            $stmt = $pdo->prepare("DELETE FROM notifications WHERE postid = :postid AND notificationSource = 'Discussion Forum Topics Upvote' ");
            $stmt->bindParam(":postid", $postId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Upvote removed successfully
        } catch (Exception $e) {
            return "Error occurred while removing the upvote: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlRemovePostDownvote($postId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("DELETE FROM post_votes WHERE postId = :postId AND accountid = :accountId AND voteType = 'downvote'");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();
    
            return true; // Downvote removed successfully
        } catch (Exception $e) {
            return "Error occurred while removing the downvote: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlRemoveReplyUpvote($replyId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("DELETE FROM reply_votes WHERE replyId = :replyId AND accountid = :accountId AND voteType = 'upvote'");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();

            // Delete from notifications
            $stmt = $pdo->prepare("DELETE FROM notifications WHERE replyid = :replyid AND notificationSource = 'Discussion Forum Replies Upvote' ");
            $stmt->bindParam(":replyid", $replyId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Upvote removed successfully
        } catch (Exception $e) {
            return "Error occurred while removing the upvote: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlRemoveReplyDownvote($replyId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("DELETE FROM reply_votes WHERE replyId = :replyId AND accountid = :accountId AND voteType = 'downvote'");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();
    
            return true; // Downvote removed successfully
        } catch (Exception $e) {
            return "Error occurred while removing the downvote: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlUpdatePostUpvotes($postId, $value) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("UPDATE posts SET upvotes = upvotes + :value WHERE postId = :postId");
            $stmt->bindParam(":value", $value, PDO::PARAM_INT);
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Upvotes updated successfully
        } catch (Exception $e) {
            return "Error occurred while updating the upvotes: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlUpdatePostDownvotes($postId, $value) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("UPDATE posts SET downvotes = downvotes + :value WHERE postId = :postId");
            $stmt->bindParam(":value", $value, PDO::PARAM_INT);
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Downvotes updated successfully
        } catch (Exception $e) {
            return "Error occurred while updating the downvotes: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlUpdateReplyUpvotes($replyId, $value) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("UPDATE reply SET upvotes = upvotes + :value WHERE replyId = :replyId");
            $stmt->bindParam(":value", $value, PDO::PARAM_INT);
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Upvotes updated successfully
        } catch (Exception $e) {
            return "Error occurred while updating the upvotes: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlUpdateReplyDownvotes($replyId, $value) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("UPDATE reply SET downvotes = downvotes + :value WHERE replyId = :replyId");
            $stmt->bindParam(":value", $value, PDO::PARAM_INT);
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Downvotes updated successfully
        } catch (Exception $e) {
            return "Error occurred while updating the downvotes: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlGetPostUpvoteCount($postId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM post_votes WHERE postId = :postId AND voteType = 'upvote'");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlGetPostDownvoteCount($postId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM post_votes WHERE postId = :postId AND voteType = 'downvote'");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlGetReplyUpvoteCount($replyId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM reply_votes WHERE replyId = :replyId AND voteType = 'upvote'");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    public function mdlGetReplyDownvoteCount($replyId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM reply_votes WHERE replyId = :replyId AND voteType = 'downvote'");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    //topics vote

    public function mdlAddTopicUpvote($topicId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("INSERT INTO topic_votes (topicId, accountid, voteType, topicVoteDate) VALUES (:topicId, :accountId, 'upvote', NOW())");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();

            //Notify owner of topic that someone upvoted

            //get accountid of topic owner
            $topic_stmt = $pdo->prepare("SELECT accountid FROM topics WHERE topicId = :topicId");
            $topic_stmt->bindParam(":topicId", $topicId, PDO::PARAM_STR);
            $topic_stmt->execute();
            $topicOwner = $topic_stmt->fetchColumn();
            
            if ($topicOwner != $accountId){
            //add to notifications
            $notifications_stmt = $pdo->prepare("INSERT INTO notifications(accountid, topicid, personInvolved, notificationSource, notificationDate) VALUES (:accountid, :topicid, :personInvolved, :notificationSource, NOW())");
            $notifications_stmt->bindParam(":accountid", $topicOwner, PDO::PARAM_STR);
            $notifications_stmt->bindParam(":topicid", $topicId, PDO::PARAM_STR);
            $notifications_stmt->bindParam(":personInvolved", $accountId, PDO::PARAM_STR);
            $notifications_stmt->bindValue(":notificationSource", "Discussion Forum Topics Upvote", PDO::PARAM_STR);
            $notifications_stmt->execute();
            }

            return true; // Upvote added successfully
        } catch (Exception $e) {
            return false; // Error occurred while adding the upvote
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlAddTopicDownvote($topicId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("INSERT INTO topic_votes (topicId, accountid, voteType, topicVoteDate) VALUES (:topicId, :accountId, 'downvote', NOW())");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();

            return true; // Downvote added successfully
        } catch (Exception $e) {
            return false; // Error occurred while adding the downvote
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlRemoveTopicUpvote($topicId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("DELETE FROM topic_votes WHERE topicId = :topicId AND accountid = :accountId");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();

            // Delete from notifications
            $stmt = $pdo->prepare("DELETE FROM notifications WHERE topicid = :topicid AND notificationSource = 'Discussion Forum Topics Upvote' ");
            $stmt->bindParam(":topicid", $topicId, PDO::PARAM_INT);
            $stmt->execute();

            return true; // Vote removed successfully
        } catch (Exception $e) {
            return false; // Error occurred while removing the vote
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlRemoveTopicDownvote($topicId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("DELETE FROM topic_votes WHERE topicId = :topicId AND accountid = :accountId");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
            $stmt->execute();

            return true; // Vote removed successfully
        } catch (Exception $e) {
            return false; // Error occurred while removing the vote
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlGetTopicVoteByUser($topicId, $accountId) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("SELECT voteType FROM topic_votes WHERE topicId = :topicId AND accountid = :accountId");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->bindParam(":accountId", $accountId, PDO::PARAM_STR);
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

    public function mdlGetTopicDownvoteCount($topicId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM topic_votes WHERE topicId = :topicId AND voteType = 'downvote'");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlGetTopicUpvoteCount($topicId) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM topic_votes WHERE topicId = :topicId AND voteType = 'upvote'");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlUpdateTopicDownvotes($topicId, $value) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("UPDATE topics SET downvotes = downvotes + :value WHERE topicId = :topicId");
            $stmt->bindParam(":value", $value, PDO::PARAM_INT);
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Downvotes updated successfully
        } catch (Exception $e) {
            return "Error occurred while updating the downvotes: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlUpdateTopicUpvotes($topicId, $value) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("UPDATE topics SET upvotes = upvotes + :value WHERE topicId = :topicId");
            $stmt->bindParam(":value", $value, PDO::PARAM_INT);
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();

            return true; // Upvotes updated successfully
        } catch (Exception $e) {
            return "Error occurred while updating the upvotes: " . $e->getMessage();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }


    //search 
    public function mdlSearchPosts($query) {
        $db = new Connection();
        $pdo = $db->connect();
      
        try {
          $stmt = $pdo->prepare("SELECT posts.*, accounts.username, posts.postDate, accounts.avatar,
                                        (SELECT COUNT(*) FROM reply WHERE reply.postId = posts.postId) AS replyCount
                                   FROM posts 
                                   INNER JOIN accounts ON posts.accountid = accounts.accountid
                                   INNER JOIN topics ON posts.topicId = topics.topicId
                                   WHERE posts.postContent LIKE :query
                                   ORDER BY postId DESC");
          $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
          $stmt->execute();
          $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
          return $posts;
        } catch (Exception $e) {
          return array();
        } finally {
          $pdo = null;
          $stmt = null;
        }
      }

      public function mdlSearchTopics($query) {
        $db = new Connection();
        $pdo = $db->connect();
      
        try {
          $stmt = $pdo->prepare("SELECT topics.*, accounts.username,
                                        (SELECT COUNT(*) FROM posts WHERE posts.topicId = topics.topicId) AS postCount,
                                        (SELECT postCount + COUNT(*) FROM reply JOIN posts ON reply.postId = posts.postId WHERE posts.topicId = topics.topicId) AS commentCount
                                   FROM topics 
                                   INNER JOIN accounts ON topics.accountid = accounts.accountid
                                   WHERE topics.topicTitle LIKE :query
                                   ORDER BY topicId DESC");
          $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
          $stmt->execute();
          $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
          return $topics;
        } catch (Exception $e) {
          return array();
        } finally {
          $pdo = null;
          $stmt = null;
        }
      }

      //recommended
      public function mdlGetTopics() {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT topics.*, accounts.username,
                                        (SELECT COUNT(*) FROM posts WHERE posts.topicId = topics.topicId) AS postCount,
                                        (SELECT postCount + COUNT(*) FROM reply JOIN posts ON reply.postId = posts.postId WHERE posts.topicId = topics.topicId) AS commentCount
                                   FROM topics 
                                   INNER JOIN accounts ON topics.accountid = accounts.accountid
                                   ORDER BY upvotes DESC");
            $stmt->execute();
            $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $topics;
        } catch (Exception $e) {
            return array();
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    // getting history
    public function mdlGetAllTopicHistory($topicId) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("SELECT th.topicContent, th.topicDate, a.username, a.avatar 
                FROM topic_history th
                JOIN topics t ON th.topicId = t.topicId
                JOIN accounts a ON t.accountId = a.accountid
                WHERE t.topicId = :topicId
                ORDER BY th.topicDate DESC");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            return null; // Error occurred while retrieving topic history
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlGetAllPostHistory($postId) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("SELECT ph.postContent, ph.postDate, a.username, a.avatar 
                FROM post_history ph
                JOIN posts p ON ph.postId = p.postId
                JOIN accounts a ON p.accountId = a.accountid
                WHERE p.postId = :postId
                ORDER BY ph.replyDate DESC");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            return null; // Error occurred while retrieving topic history
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    public function mdlGetAllReplyHistory($replyId) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("SELECT rh.replyContent, rh.replyDate, a.username, a.avatar 
                FROM reply_history rh
                JOIN reply r ON rh.replyId = r.replyId
                JOIN accounts a ON r.accountId = a.accountid
                WHERE r.replyId = :replyId
                ORDER BY rh.replyDate DESC");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            return null; // Error occurred while retrieving topic history
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }

    
    
}



