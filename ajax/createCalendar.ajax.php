<?php

class calendarAjax {
    public $calendarDate;

    public function ajaxCreateCalendar() {
        $calendarDate = $this->calendarDate;

        function generateCalendar($date) {
            date_default_timezone_set('Asia/Manila');

            class Calendar {
                private $active_year, $active_month, $active_day;
                private $events = [];

                public function __construct($date = null) {
                    $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
                    $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
                    $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
                }

                public function __toString() {
                    $num_days = date('t', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
                    $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day)));
                    $days = [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'];
                    $first_day_of_week = date('w', strtotime($this->active_year . '-' . $this->active_month . '-01'));

                    $html = '<div class="calendar">';
                    $html .= '<div class="header">';
                    $html .= '<div class="month-year">';
                    $html .= '<div class="calendarMonth"> <a id="prevMonthButton" class="monthButton" onclick="prevMonth(' . $this->active_month . "- 1" . ',' . $this->active_day . ')">&#8249; &nbsp;</a>' . date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-01')) . '<a id="nextMonthButton" class="monthButton" onclick="nextMonth(' . $this->active_month . "+ 1" . ',' . $this->active_day . ')">&nbsp; &#8250; &nbsp;</a> </div>';

                    // Filter
                    $html .= '<div class="calendarFilter">
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
                        $html .= '<div class="day_name">' . $day . '</div>';
                    }

                    for ($i = ($first_day_of_week + 7) % 7; $i > 0; $i--) {
                        $html .= '<div class="day_num ignore">' . ($num_days_last_month - $i + 1) . '</div>';
                    }

                    for ($i = 1; $i <= $num_days; $i++) {
                        $selected = '';
                        if ($i == $this->active_day) {
                            $selected = ' selected';
                        }
                        if ($i <= 9) {
                            $html .= '<div class="day_num' . $selected . '" id="' . $this->active_month . '-0' . $i . '-' . $this->active_year . '">';
                        } else {
                            $html .= '<div class="day_num' . $selected . '" id="' . $this->active_month . '-' . $i . '-' . $this->active_year . '">';
                        }
                        $html .= '<span>' . $i . '</span>';
                        foreach ($this->events as $event) {
                            for ($d = 0; $d <= ($event[2] - 1); $d++) {
                                if (date('Y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('Y-m-d', strtotime($event[1]))) {
                                    $html .= '<div class="calendarEvent' . $event[3] . '" data-religion="' . $event[3] . '" onclick="viewEvent(\'' . $event[0] . '\')">';
                                    $html .= $event[0];
                                    $html .= '</div>';
                                }
                            }
                        }
                        $html .= '</div>';
                    }

                    $last_day_of_week = ($first_day_of_week + $num_days) % 7;
                    for ($i = 1; $i <= (7 - $last_day_of_week) % 7; $i++) {
                        $html .= '<div class="day_num ignore">' . $i . '</div>';
                    }

                    $html .= '</div>';
                    $html .= '</div>';

                    return $html;
                }
            }

            $calendar = new Calendar($date);
            return $calendar;
        }

        echo generateCalendar($calendarDate);
    }
}

$createCalendar = new calendarAjax();
$createCalendar->calendarDate = $_POST["calendarDate"];
$createCalendar->ajaxCreateCalendar();

?>