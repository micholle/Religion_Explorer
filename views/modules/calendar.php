<!doctype html>
<html lang="en">
    <head> 
        <title>Religion Explorer: Calendar</title>
        <link rel="icon" type="image/x-icon" href="../assets/images/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar" style="display:block">
            <a href="" class="app-logo"><img src="../assets/images/logo.png" alt="Religion Explorer Logo"></a>
            <a href="" class="menu" id="sidebarProfile"><img src="../assets/images/user.png" alt="Profile Icon"><p>Profile</p></a>
            <a href="map.php" class="menu" id="sidebarMap"><img src="../assets/images/feat-worldwide.png" alt="World Map Icon"><p>World Map</p></a>
            <a href="" class="menu" id="sidebarLibrary"><img src="../assets/images/feat-book-stack.png" alt="Library of Resources Icon"><p>Library of Resources</p></a>
            <a href="" class="menu" id="sidebarForum"><img src="../assets/images/feat-chat.png" alt="Discussion Forum Icon"><p>Discussion Forum</p></a>
            <a href="calendar.php" class="menu" id="sidebarCalendar"><img src="../assets/images/feat-calendar.png" alt="Calendar Icon"><p>Calendar</p></a>
            <a href="" class="menu"><img src="../assets/images/logout.png" alt="Logout Icon"><p>Logout</p></a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="calendarEventModal" style="font-family:'Lexend Deca'">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Ascension Day</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalContent">
                            <span class="badge badge-pill badge-primary" style="background:#56097A">Christianity</span>
                            <p>
                                One of the earliest Christian festivals, Ascension Day marks the end of the Easter season. This event is celebrated primarily by Catholics and Anglican Christians; most Protestant churches do not follow this tradition anymore. The date, too, differs in different geographic locations. Western Churches prefer to use the Gregorian calendar for calculating this date, while many Eastern Orthodox Churches calculate this date according to the Julian calendar. As a result, their celebrations occur at a later date than the Western event.
                                <br><br>As per the New Testament in the Bible, after Jesus Christ’s crucifixion on Good Friday, he was resurrected from the dead in three days, on the day we know as Easter Sunday. For 40 days after this, he stayed with his Apostles (the primary disciples of Christ) to instruct them on how to carry out his teachings. As the Bible says, at the end of day 40, Jesus Christ and his disciples went to Mount Olivet (or the Mount of Olives), near Jerusalem. After asking them to stay, Christ then ascended to heaven to take his seat at the right hand of God, under the gaze of his disciples. To Christians, the ascension signifies that Christ completed his work on Earth and allowed him to prepare a place for his followers in heaven.
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" style="padding: 5px 10px 5px 10px; background:#000000; color:#FFFFFF; border-radius:15px; cursor:pointer">Add Event to Personal Calendar</button>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left:20%">
            <!-- Filter -->
            <div class="calendarFilter" style="display:flex; justify-content: flex-end">
                <span class="badge badge-pill badge-primary" style="cursor:pointer; margin:0 5px 0 0; background:#BAA400">Buddhism</span>
                <span class="badge badge-pill badge-primary" style="cursor:pointer; margin:0 5px 0 0; background:#56097A">Christianity</span>
                <span class="badge badge-pill badge-primary" style="cursor:pointer; margin:0 5px 0 0; background:#A81315">Hinduism</span>
                <span class="badge badge-pill badge-primary" style="cursor:pointer; margin:0 5px 0 0; background:#018744">Islam</span>
                <span class="badge badge-pill badge-primary" style="cursor:pointer; background:#1334A8">Judaism</span>
            </div>

            <!-- Calendar -->
            <iframe id="open-web-calendar"
                src="https://open-web-calendar.hosted.quelltext.eu/calendar.html?url=https%3A%2F%2Fcalendar.google.com%2Fcalendar%2Fical%2Fen.christian%2523holiday%2540group.v.calendar.google.com%2Fpublic%2Fbasic.ics&amp;url=https%3A%2F%2Fcalendar.google.com%2Fcalendar%2Fical%2Fen.hinduism%2523holiday%2540group.v.calendar.google.com%2Fpublic%2Fbasic.ics&amp;url=https%3A%2F%2Fcalendar.google.com%2Fcalendar%2Fical%2Fen.judaism%2523holiday%2540group.v.calendar.google.com%2Fpublic%2Fbasic.ics&amp;url=https%3A%2F%2Fcalendar.google.com%2Fcalendar%2Fical%2Fen.islamic%2523holiday%2540group.v.calendar.google.com%2Fpublic%2Fbasic.ics&amp;url=https://www.calendarlabs.com/ical-calendar/ics/38/Buddhist_Holidays.ics&amp;title=Religion%20Explorer&amp;css=.event%2C%20.dhx_cal_tab.active%2C%20.dhx_cal_tab.active%3Ahover%20%7Bbackground-color%3A%20%23000000%3B%7D%20.dhx_month_head%2C%20.dhx_cal_tab%2C%20.dhx_cal_today_button%20%7Bcolor%3A%20%23000000%3B%7D%20.dhx_cal_tab%2C%20.dhx_cal_tab.active%20%7Bborder-color%3A%20%23000000%3B%7D%0A"
                sandbox="allow-scripts allow-same-origin allow-top-navigation"
                allowTransparency="true" scrolling="no"frameborder="0" height="600px" width="100%">
            </iframe>
        </div>
    </body>
</html>