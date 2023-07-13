<?php
require_once "connection.php";

class ModelDiscussion {
    public function mdlGetAllTopics() {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt = $pdo->prepare("SELECT t.*, a.username 
                                  FROM topics t
                                  JOIN accounts a ON t.accountid = a.accountid");
            $stmt->execute();
            $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $topics;
        } catch (Exception $e) {
            return array(); // Return an empty array if an error occurs
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
    
}
