<?php
include('configdb.php');
$sql = "select productnr,omschrijving ,concat( '€' ,(prijs))  from producten order by productnr";
/*$sql = "select count(productnr)  from producten order by productnr";*/
$sqlq = mysqli_query($con, $sql);
$test = mysqli_fetch_all($sqlq, MYSQLI_ASSOC);
foreach ($test as $row) {
    echo implode(", ", $row) . "<br>";
}
?>