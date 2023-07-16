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
            $orderBy = 'topicId DESC';
        }
    
        try {
            $stmt = $pdo->prepare("SELECT topics.*, accounts.username,
                                        (SELECT COUNT(*) FROM posts WHERE posts.topicId = topics.topicId) AS postCount,
                                        (SELECT postCount + COUNT(*) FROM reply JOIN posts ON reply.postId = posts.postId WHERE posts.topicId = topics.topicId) AS commentCount
                                   FROM topics 
                                   INNER JOIN accounts ON topics.accountid = accounts.accountid
                                   ORDER BY $orderBy");
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
    

    public function mdlCreateDiscussion($data) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            // Generate a unique topicId
            $topicId = $this->generateTopicId();
    
            // Prepare and execute the SQL statement
            $stmt = $pdo->prepare("INSERT INTO topics (topicId, topicTitle, accountid, topicDate, topicContent) VALUES (:topicId, :topicTitle, :accountid, NOW(), :topicContent)");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->bindParam(":topicTitle", $data["topicTitle"], PDO::PARAM_STR);
            $stmt->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt->bindParam(":topicContent", $data["topicContent"], PDO::PARAM_STR);
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
            $orderBy = 'postId DESC';
        }
    
        try {
            $stmt = $pdo->prepare("SELECT posts.*, accounts.username, posts.postDate,
                                        (SELECT COUNT(*) FROM reply WHERE reply.postId = posts.postId) AS replyCount
                                   FROM posts 
                                   INNER JOIN accounts ON posts.accountid = accounts.accountid
                                   INNER JOIN topics ON posts.topicId = topics.topicId
                                   WHERE topics.topicId = :topicId
                                   ORDER BY $orderBy");
            $stmt->bindParam(':topicId', $topicId, PDO::PARAM_INT);
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
            $topicId = mt_rand(10000000, 99999999);
    
            // Check if the generated topicId already exists in the database
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE postId = :postId");
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
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
            $stmt = $pdo->prepare("SELECT r.*, a.username 
                                   FROM reply AS r
                                   INNER JOIN accounts AS a ON r.accountid = a.accountid
                                   WHERE r.postId = :postId");
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
            // Delete the post
            $stmt = $pdo->prepare("DELETE FROM posts WHERE postId = :postId");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
            
            // Delete the associated replies
            $stmt = $pdo->prepare("DELETE FROM reply WHERE postId = :postId");
            $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true; // Post deleted successfully
        } catch (Exception $e) {
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
    
            return true; // Topic, posts, and replies deleted successfully
        } catch (Exception $e) {
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
            $stmt = $pdo->prepare("DELETE FROM reply WHERE replyId = :replyId");
            $stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true; // Reply deleted successfully
        } catch (Exception $e) {
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
            $stmt = $pdo->prepare("UPDATE topics SET topicTitle = :updatedTitle, topicContent = :updatedContent WHERE topicId = :topicId");
            $stmt->bindParam(":updatedTitle", $updatedTitle, PDO::PARAM_STR);
            $stmt->bindParam(":updatedContent", $updatedContent, PDO::PARAM_STR);
            $stmt->bindParam(":topicId", $topicId, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Topic updated successfully
        } catch (Exception $e) {
            return false; // Error occurred while updating the topic
        } finally {
            $pdo = null;
            $stmt = null;
        }
    }
    
    
}
