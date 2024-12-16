<?php
include('configedb.php');
$sql = "SELECT year( orderdate) AS orderyear, status, count(ordernumber) as ordernummer FROM orders group by orderyear, status";
$result = mysqli_query($con, $sql);
$sql2 = "SELECT year( paymentDate) AS jaar, count(`checkNumber`)as oders,SUM(amount)as bedrag  FROM payments group by jaar";
$result2 = mysqli_query($con, $sql2);
$sql3 = "SELECT orderNumber, DATE_FORMAT(orderDate, '%d %b %y') AS orderdate, status , comments FROM `orders` WHERE YEAR(orderDate) = 2005 AND comments IS NOT NULL;";
$result3 = mysqli_query($con, $sql3);

echo ' <style>
.top-right {
    position: absolute;
    top: 25%;
    right: 100px;
}
</style>';
echo ' <style>
.top-right2 {
    position: absolute;
    top: 45%;
    right: 100px;
}
</style>';

echo '
<div style="max-width: 300px;max-height: 50px ; background: lightgrey "  >
    <a href="sales.php">Sales</a> <a href="customers.php">Customers</a> <a href="products.php">Product-catalogus</a>
</div>
<h1>Sales </h1> <br><br>
<div style="max-width: 100%; max-height: 5px; background-color: grey"><p style="color: white">g</p> </div><br>
';

echo '<div style="border: 5px solid black; max-width: 30%">';
echo "Overzicht van het aantal orders per status en per jaar, voor de jaren 2004 en 2005, uit de tabel orders";

echo "<br><br>";
echo "<table border='1'>";

echo "<tr>";
while ($fieldinfo = mysqli_fetch_field($result)) {
    echo "<th>" . $fieldinfo->name . "</th>";
}
echo "</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td width='200'>" . $value . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
echo '</div>';
echo '<div style="border: 5px solid black; max-width: 30%; "class="top-right">';
echo "Overzicht van het totaal van alle ontvangen betalingen per jaar, uit de tabel payments";

echo "<br><br>";
echo "<table border='1'>";

echo "<tr>";
while ($fieldinfo = mysqli_fetch_field($result2)) {
    echo "<th>" . $fieldinfo->name . "</th>";
}
echo "</tr>";

while ($row = mysqli_fetch_assoc($result2)) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td width='200'>" . $value . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo '</div>';
echo '<div style="border: 5px solid black; max-width: 30%; "class="top-right2">';
echo "Overzicht van het totaal van alle ontvangen betalingen per jaar, uit de tabel payments";

echo "<br><br>";
echo "<table border='1'>";

echo "<tr>";
while ($fieldinfo = mysqli_fetch_field($result3)) {
    echo "<th>" . $fieldinfo->name . "</th>";
}
echo "</tr>";

while ($row = mysqli_fetch_assoc($result3)) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td width='200'>" . $value . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo '</div>';