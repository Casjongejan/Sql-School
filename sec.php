<?php
$conf["Username"]= 'PHP';
$conf["Password"]= 'Cas01Jongejan';
$conf["Host"]= '127.0.0.1';
$conf["Database"]= 'classicmodels';
$con = mysqli_connect($conf["Host"], $conf["Username"], $conf["Password"], $conf["Database"]);
if($con == false) {
    echo "Kan geen verbinding maken met de database";
}
echo '<div style="border: 5px solid black; max-width: 30%">';
echo '<form method="post" action="sec.php">
  <input type="text" name="name">
  <input type="submit" value="Submit">
</form>';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $sql3 = 'SELECT customerName, CONCAT(contactFristName, " ", contactLastName) as contactfullName, phone FROM `customers` WHERE customerName LIKE ?';
    $stmt = mysqli_prepare($con, $sql3);
    $param = "$name%";
    mysqli_stmt_bind_param($stmt, "s", $param);
    mysqli_stmt_execute($stmt);
    $result3 = mysqli_stmt_get_result($stmt);
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