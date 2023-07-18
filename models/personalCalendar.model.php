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
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
        
            $stmt = $pdo->prepare("INSERT INTO personalCalendar(accountid, event, religion, date) VALUES (:accountid, :event, :religion, :date)");
            $stmt->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt->bindParam(":event", $data["event"], PDO::PARAM_STR);
            $stmt->bindParam(":religion", $data["religion"], PDO::PARAM_STR);
            $stmt->bindParam(":date", $data["date"], PDO::PARAM_STR);
            $stmt->execute();
    
            $stmt2 = $pdo->prepare("SELECT username FROM accounts WHERE accountid = :accountid");
            $stmt2->bindParam(":accountid", $data["accountid"], PDO::PARAM_STR);
            $stmt2->execute();
            $username = $stmt2->fetchColumn();
    
            $stmt3 = $pdo->prepare("INSERT INTO notifications(username, calendarEvent, notificationSource, notificationDate) VALUES (:username, :calendarEvent, :notificationSource, :notificationDate)");
            $stmt3->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt3->bindParam(":calendarEvent", $data["event"], PDO::PARAM_STR);
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
            $stmt = $pdo->prepare("SELECT event FROM personalcalendar WHERE personaleventid = :personaleventid");
            $stmt->bindParam(":personaleventid", $personaleventid, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            echo $row["event"];            

            $stmt2 = $pdo->prepare("DELETE FROM personalcalendar WHERE personaleventid = :personaleventid");
            $stmt2->bindParam(":personaleventid", $personaleventid, PDO::PARAM_INT);
            $stmt2->execute();

            $stmt3 = $pdo->prepare("DELETE FROM notifications WHERE calendarEvent = :calendarEvent");
            $stmt3->bindParam(":calendarEvent", $row["event"], PDO::PARAM_INT);
            $stmt3->execute();

            return "success";
        } catch (Exception $e) {
            return "error";
        }
    }    
}

?>