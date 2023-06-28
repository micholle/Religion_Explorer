<?php
require_once "../views/assets/data/calendarEvents.php";

class calendarModel{
    //Get data for calendar
	static public function mdlGetCalendarData(){
        $events = (new calendarData) -> getEvents();
        $allEvents = [];

        foreach ($events as $event) {
            $data = [
                "religion" => $event["religion"],
                "date" => $event["date"]
            ];

            $allEvents += [$event["event"] => $data];
        }

        $jsonData = json_encode($allEvents);
        header('Content-Type: application/json');
        echo $jsonData;
	}

}

?>