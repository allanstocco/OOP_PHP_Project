<?php

class Calendar {

    private $conn;
    private $table_name = "agenda";
    public $dayLabels = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sabado", "Domingo"];
    public $currentYear = 0;
    public $currentMonth = 0;
    public $currentDay = 0;
    public $currentDate = NULL;
    public $daysInMonth = 0;
    public $naviHref = NULL;
    public $event = [];

    public function __construct($db) {
        $this->conn = $db;
    }

    function show() {
        $year = null;
        $month = null;
        $day = null;

        if (NULL == $day && isset($_GET['day'])) {
            $day = $_GET['day'];
        } else if (NULL == $day) {
            $day = date("d", time());
        }
        if (NULL == $year && isset($_GET['year'])) {
            $year = $_GET['year'];
        } else if (NULL == $year) {
            $year = date("Y", time());
        }

        if (NULL == $month && isset($_GET['month'])) {
            $month = $_GET['month'];
        } else if (NULL == $month) {
            $month = date("m", time());
        }

        $this->currentYear = $year;
        $this->currentMonth = $month;
        $this->daysInMonth = $this->_daysInMonth($day, $month, $year);

        $content = '<div id="calendar">' .
                '<div class="box">' .
                $this->_createNavi() .
                '</div>' .
                '<div class="box-content">' .
                '<ul class="label">' . $this->_createLabels() . '</ul>';
        $content .= '<div class="clear"></div>';
        $content .= '<ul class="dates"><a href="' . $this->_daysInMonth($day) . '">';

        $weeksInMonth = $this->_weeksInMonth($month, $year);
// Create weeks in a month
        for ($i = 0; $i < $weeksInMonth; $i++) {

//Create days in a week
            for ($j = 1; $j <= 7; $j++) {
                $content .= $this->_showDay($i * 7 + $j);
            }
        }

        $content .= '</a></ul>';

        $content .= '<div class="clear"></div>';

        $content .= '</div>';

        $content .= '</div>';
        return $content;
    }

    private function _showDay($cellNumber) {


        if ($this->currentDay == 0) {

            $firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));

            if (intval($cellNumber) == intval($firstDayOfTheWeek)) {

                $this->currentDay = 1;
            }
        }

        if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {

            $this->currentDate = date('d-m-Y', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));

            $cellContent = $this->currentDay;

            $this->currentDay++;
        } else {

            $this->currentDate = null;

            $cellContent = null;
        }



        return '<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
                ($cellContent == null ? 'mask' : '') . '">' . $cellContent . '</li>';
    }

    private function _createNavi() {

        $nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;

        $nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;

        $preMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;

        $preYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;

        return
                '<div class="header">' .
                '<a class="prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Prev</a>' .
                '<span class="title">' . date('Y M', strtotime($this->currentYear . '-' . $this->currentMonth . '-1')) . '</span>' .
                '<a class="next" href="' . $this->naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&year=' . $nextYear . '">Next</a>' .
                '</div>';
    }

    private function _createLabels() {

        $content = '';

        foreach ($this->dayLabels as $index => $label) {

            $content .= '<li class="' . ($label == 6 ? 'end title' : 'start title') . ' title">' . $label . '</li>';
        }

        return $content;
    }

    private function _weeksInMonth($day = null, $month = null, $year = null) {

        if (null == ($year)) {
            $year = date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }

        if (null == ($day)) {
            $day = date("d", time());
        }

// find number of days in this month
        $daysInMonths = $this->_daysInMonth($day, $month, $year);

        $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);

        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $day . '-' . $daysInMonths));

        $monthStartDay = date('N', strtotime($year . '-' . $month . '-' . $day . '-01'));

        if ($monthEndingDay < $monthStartDay) {

            $numOfweeks++;
        }

        return $numOfweeks;
    }

    private function _daysInMonth($day = null, $month = null, $year = null) {


        if (null == ($year))
            $year = date("Y", time());

        if (null == ($month))
            $month = date("m", time());

        if (null == ($day))
            $day = date("d", time());

        return date('t', strtotime($year . '-' . $month . '-' . $day . '-01'));
    }

    function selectAgen() {
        
    }

}

/* if ($stmt->execute()) {
  $result = $stmt->get_result();
  if ($this->_showDay == $result->num_rows > 0) {
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $bookings = $row['date'];
  echo "<table class='table table-hover table-responsive table-bordered' style='width: 650px;'>";
  echo "<tr>";
  echo "<th style='text-align: center;'>Nome</th>";
  echo "<th style='text-align: center;'>Sobrenome</th>";
  echo "<th style='text-align: center;'>CPF</th>";
  echo "</tr>";

  echo "<tr>";
  echo "<td>{$nome}</td>";
  echo "<td>{$sobrenome}</td>";
  echo "<td>{$cpf}</td>";
  echo "</td>";
  echo "</tr>";
  }
  $stmt->close();

 */
?>
