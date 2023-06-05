<?php 
$dateOneYearAdded = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +1 year");
    $qt_date_e=date('Y-m-d', $dateOneYearAdded);
    echo $qt_date_e;
?>