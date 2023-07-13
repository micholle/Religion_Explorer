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
            $stmt = $pdo->prepare("SELECT topics.*, accounts.username 
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
            $stmt = $pdo->prepare("SELECT posts.*, accounts.username, posts.postDate
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
    
}
