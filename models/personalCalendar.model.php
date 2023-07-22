<?php
session_start();
require_once "connection.php";

class personalCalendarModel{
	static public function mdlGetPersonalCalendarData($accountid) {
        $db = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("SELECT * FROM personalcalendar WHERE accountid = :accountid");
            $stmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
            $stmt->execute();
            $eventsResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $personalEvents = [];
    
            foreach ($eventsResults as $event) {
                $dateFormat = DateTime::createFromFormat('Y-m-d', $event["date"]);
                $formattedDate = $dateFormat->format('m-d-Y');
    
                $data = [
                    "accountid" => $event["accountid"],
                    "personaleventid" => $event["personaleventid"],
                    "religion" => $event["religion"],
                    "date" => $formattedDate
                ];
    
                $personalEvents += [$event["event"] => $data];
            }
    
            $jsonData = json_encode($personalEvents);
            header('Content-Type: application/json');
            echo $jsonData;
            return "success";
        } catch (Exception $e) {
            return "error";
        }
	}

    static public function mdlAddToPersonalCalendar($data) {
        $db = new Connection();
        $pdo = $db->connect();
        $personaleventid = "PC" . uniqid();

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
        
            $stmt = $pdo->prepare("INSERT INTO personalCalendar(personaleventid, accountid, event, religion, date) VALUES (:personaleventid, :accountid, :event, :religion, :date)");
            $stmt->bindParam(":personaleventid", $personaleventid, PDO::PARAM_STR);
            $stmt->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt->bindParam(":event", $data["event"], PDO::PARAM_STR);
            $stmt->bindParam(":religion", $data["religion"], PDO::PARAM_STR);
            $stmt->bindParam(":date", $data["date"], PDO::PARAM_STR);
            $stmt->execute();
    
            $stmt3 = $pdo->prepare("INSERT INTO notifications(accountid, personaleventid, notificationSource, notificationDate) VALUES (:accountid, :personaleventid, :notificationSource, :notificationDate)");
            $stmt3->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt3->bindParam(":personaleventid", $personaleventid, PDO::PARAM_STR);
            $stmt3->bindValue(":notificationSource", "Calendar", PDO::PARAM_STR);
            $stmt3->bindParam(":notificationDate", $data["date"], PDO::PARAM_STR);
            $stmt3->execute();
    
            $pdo->commit();
            echo $data["event"];
            return "ok";
        } catch (Exception $e) {
            $pdo->rollBack();
            return "error";
        }
        $pdo = null;
        $stmt = null;
    }    

    static public function mdlRemoveFromPersonalCalendar($personaleventid) {
        $db = new Connection();
        $pdo = $db->connect();
    
        try {
            $stmt3 = $pdo->prepare("DELETE FROM notifications WHERE personaleventid = :personaleventid");
            $stmt3->bindParam(":personaleventid", $personaleventid, PDO::PARAM_STR);
            $stmt3->execute();

            $stmt = $pdo->prepare("SELECT event FROM personalcalendar WHERE personaleventid = :personaleventid");
            $stmt->bindParam(":personaleventid", $personaleventid, PDO::PARAM_STR);
            $stmt->execute();
            $event = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt2 = $pdo->prepare("DELETE FROM personalcalendar WHERE personaleventid = :personaleventid");
            $stmt2->bindParam(":personaleventid", $personaleventid, PDO::PARAM_STR);
            $stmt2->execute();

            echo $event["event"];

            return "success";
        } catch (Exception $e) {
            return "error";
        }
    }    
}

?>