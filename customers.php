<?php
include('configedb.php');
$sql = "SELECT customerName, country, creditLimit FROM `customers` WHERE country = 'usa' and creditLimit > 100000 OR country = 'japan' and creditLimit > 100000 or country = 'Australia' and creditLimit > 100000";
$result = mysqli_query($con, $sql);
$sql2 = "SELECT country, COUNT(customerNumber) AS amc FROM customers  GROUP BY country HAVING COUNT(customerNumber) > 10";
$result2 = mysqli_query($con, $sql2);
$sql3 = "SELECT country, COUNT(customerNumber) AS amc FROM customers  GROUP BY country HAVING COUNT(customerNumber) > 10";
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

echo  '
<div style="max-width: 300px;max-height: 50px ; background: lightgrey "  >
    <a href="sales.php">Sales</a> <a href="customers.php">Customers</a> <a href="products.php">Product-catalogus</a>
</div>
<h1>Customers </h1> <br><br>
<div style="max-width: 100%; max-height: 5px; background-color: grey"><p style="color: white">g</p> </div><br>
';

echo '<div style="border: 5px solid black; max-width: 30%">';
echo "Klanten in de USA, Australie en Japan met een kredietlimiet van meer dan 100.000";

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
echo "Overzicht van landen met meer dan 10 klanten in dat land";

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
echo '<div style="border: 5px solid black; max-width: 30%"class="top-right2">';
echo '<form method="post" action="customers.php">
  <input type="text" name="name">
  <input type="submit" value="Submit">
</form>';
//^ voor de Text box
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $sql3 = 'SELECT customerName, CONCAT(contactFirstName, " ", contactLastName) as contactfullName, phone FROM `customers` WHERE customerName LIKE ?';
    $stmt = mysqli_prepare($con, $sql3);
    $param = "$name%";
    mysqli_stmt_bind_param($stmt, "s", $param);
    mysqli_stmt_execute($stmt);
    $result3 = mysqli_stmt_get_result($stmt);
//^ neemt variable Name uit de box en gebruikt de variable in de query
    if ($result3) {
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
    } else {
        echo "Error executing the query: " . mysqli_error($con);
    }
}
echo '</div>';
//^echo"s de table
?>