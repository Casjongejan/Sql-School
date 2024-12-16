<?php
include('configdb.php');
$sql = "SELECT productnr, omschrijving, prijs FROM producten";
$result = mysqli_query($con, $sql);
$aantalr = mysqli_num_rows($result);
echo "Het aantal klanten = " . $aantalr;
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
?>