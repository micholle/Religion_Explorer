<?php
require_once "connection.php";

class ModelDiscussion {
    public function mdlGetAllTopics() {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("SELECT * FROM topics");
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
}
