<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head> 
        <title>Religion Explorer: Calendar</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/calendar.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="calendarSidebar"></div>
        <!-- Calendar -->
        <div class="pageContainer">
            <div id="accountidPlaceholder" hidden><?php echo $_SESSION['accountid']; ?></div>
            <div id="calendarDatePlaceHolder" hidden></div>
            <div id="calendarContainer" class="calendarContainer"></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="calendarEventModal">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title w-100" id="calendarEvent"></h5>
                    </div>
                    <div class="modal-body" id="calendarEventContent">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>