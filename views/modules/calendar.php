<!doctype html>
<html lang="en">
    <head> 
        <title>Religion Explorer: Calendar</title>
        <link rel="icon" type="image/x-icon" href="../assets/images/applogo.png">
        <script type="text/javascript" src="../assets/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/calendar.js"></script>

        <link type="text/css" rel="stylesheet" href="../assets/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div id="calendarSidebar"></div>
        
        <!-- Modal -->
        <div class="modal fade" id="calendarEventModal">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 text-center">
                        <h5 class="modal-title w-100" id="calendarEvent"></h5>
                    </div>
                    <div class="modal-body flex-row">
                        <button type="button" class="calendarButton">Add to Personal Calendar</button>
                        <button type="button" class="calendarButton learnMoreButton">Learn More</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="pageContainer">
            <!-- Calendar -->
            <?php
            function generateCalendar($date) {
                class Calendar {

                    private $active_year, $active_month, $active_day;
                    private $events = [];
    
                    public function __construct($date = null) {
                        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
                        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
                        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
                    }
    
                    public function __toString() {
                        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
                        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
                        $days = [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'];
                        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
                        
                        $html = '<div class="calendar">';
                        $html .= '<div class="header">';
                        $html .= '<div class="month-year">';
                        $html .= '<div class="calendarMonth">' . date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day)) . '</div>';
                       
                        // Filter
                        $html .=
                        '<div class="calendarFilter">
                            <span class="calendarReligion" id="buddhismEvents" style="background:#BAA400">Buddhism</span>
                            <span class="calendarReligion" id="christianityEvents" style="background:#56097A">Christianity</span>
                            <span class="calendarReligion" id="hinduismEvents" style="background:#A81315">Hinduism</span>
                            <span class="calendarReligion" id="islamEvents" style="background:#018744">Islam</span>
                            <span class="calendarReligion" id="judaismEvents" style="background:#1334A8">Judaism</span>
                        </div>';
                       
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '<div class="days">';
    
                        foreach ($days as $day) {
                            $html .= '
                                <div class="day_name">
                                    ' . $day . '
                                </div>
                            ';
                        }
                        for ($i = $first_day_of_week; $i > 0; $i--) {
                            $html .= '
                                <div class="day_num ignore">
                                    ' . ($num_days_last_month-$i+1) . '
                                </div>
                            ';
                        }
                        for ($i = 1; $i <= $num_days; $i++) {
                            $selected = '';
                            if ($i == $this->active_day) {
                                $selected = ' selected';
                            }
                            $html .= '<div class="day_num' . $selected . '" id="' . $this->active_month . '-' . $i . '-' . $this->active_year .'">';
                            $html .= '<span>' . $i . '</span>';
                            foreach ($this->events as $event) {
                                for ($d = 0; $d <= ($event[2]-1); $d++) {
                                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                                        $html .= '<div class="calendarEvent' . $event[3] . '" data-religion="' . $event[3] .'" onclick="viewEvent(' . "'" . $event[0] . "'" . ')">';
                                        $html .= $event[0];
                                        $html .= '</div>';
                                    }
                                }
                            }
                            $html .= '</div>';
                        }
                        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
                            $html .= '
                                <div class="day_num ignore">
                                    ' . $i . '
                                </div>
                            ';
                        }
                        $html .= '</div>';
                        $html .= '</div>';
                        return $html;
                    }
                }

                $calendar = new Calendar($date);
                echo $calendar;
            }

            $date = isset($_GET['date']) ? $_GET['date'] : null;
            generateCalendar($date);
        ?>
        </div>
    </body>
</html>