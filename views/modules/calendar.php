<!doctype html>
<html lang="en">
    <head> 
        <title>Religion Explorer: Calendar</title>
        <link rel="icon" type="image/x-icon" href="../assets/images/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar" style="display:block">
            <a href="" class="app-logo"><img src="../assets/images/logo.png" alt="Religion Explorer Logo"></a>
            <a href="" class="menu" id="sidebarProfile"><img src="../assets/images/rabbit.png" alt="Profile Icon"><p>Profile</p></a>
            <a href="map.php" class="menu" id="sidebarMap"><img src="../assets/images/feat-worldwide.png" alt="World Map Icon"><p>World Map</p></a>
            <a href="" class="menu" id="sidebarLibrary"><img src="../assets/images/feat-book-stack.png" alt="Library of Resources Icon"><p>Library of Resources</p></a>
            <a href="" class="menu" id="sidebarForum"><img src="../assets/images/feat-chat.png" alt="Discussion Forum Icon"><p>Discussion Forum</p></a>
            <a href="calendar.php" class="menu" id="sidebarCalendar"><img src="../assets/images/feat-calendar.png" alt="Calendar Icon"><p>Calendar</p></a>
            <a href="" class="menu" id="sidebarNotifications"><img src="../assets/images/bell.png" alt="Notifications Icon"><p>Notifications</p></a>
            <a href="" class="menu"><img src="../assets/images/logout.png" alt="Logout Icon"><p>Logout</p></a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="calendarEventModal" style="font-family:'Lexend Deca'">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Ascension Day</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
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