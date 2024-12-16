<?php
include('configedb.php');
$sql = "SELECT productline , COUNT(quantityInStock) as stock , SUM(buyPrice) as price  FROM `products` GROUP BY productLine";
$result = mysqli_query($con, $sql);
$result2 = $con->query("SHOW TABLES");

echo ' <style>
.top-right {
    position: absolute;
    top: 25%;
    right: 100px;
}
</style>';

echo  '
<div style="max-width: 300px;max-height: 50px ; background: lightgrey "  >
    <a href="sales.php">Sales</a> <a href="customers.php">Customers</a> <a href="products.php">Product-catalogus</a>
</div>
<h1>Productcatalogus </h1> <br><br>
<div style="max-width: 100%; max-height: 5px; background-color: grey"><p style="color: white">g</p> </div><br>
';

echo '<div style="border: 5px solid black; max-width: 30%">';
echo "Overzicht van aantallen en totale voorraadwaarde per productLine";

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

echo '<div style="border: 5px solid black; max-width: 60%; "class="top-right">';
echo "<form action='products.php' method='post'>"; // Replace 'your_php_file.php' with the actual file to handle the form submission
echo "<select name='productline'>";
$uniqueProductLines = $con->query("SELECT DISTINCT productLine FROM products");
while($row = $uniqueProductLines->fetch_assoc()) {
    echo "<option value='" . $row['productLine'] . "'>" . $row['productLine'] . "</option>";
}
echo "</select>";
echo "<input type='submit' value='Toon productLine'>";
echo "</form>";

echo "<br><br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedProductLine = $_POST['productline'];
    $productLineResult = $con->query("SELECT productCode,productName,buyPrice  FROM products WHERE productLine = '" . $selectedProductLine . "'");

    echo "<table border='1'>";
    echo "<tr>";
    while ($fieldinfo = $productLineResult->fetch_field()) {
        echo "<th>" . $fieldinfo->name . "</th>";
    }
    echo "</tr>";

    while ($row = $productLineResult->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td width='200'>" . $value . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

echo '</div>';