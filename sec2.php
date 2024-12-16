<?php
$conf["Username"]= 'root';
$conf["Password"]= 'root';
$conf["Host"]= '127.0.0.1';
$conf["Database"]= 'sec2';
$con = mysqli_connect($conf["Host"], $conf["Username"], $conf["Password"], $conf["Database"]);

echo '<form method="post" action="sec.php">
  <input type="text" name="username" placeholder="username">
  <input type="text" name="password" placeholder="password">
  <input type="submit" value="Submit">
</form>';

if (isset($_POST['username'])) {
    $uname = $_POST["Username"];
    $unsecword = $_POST['Password'];
}
function  fg()
{
    $sql3 = 'insert into test1 (uname, pword) values(@uname, @pword) ';
    $stmt = mysqli_prepare($con, $sql3);

}
fg();


/*$sql3 = 'insert into test1 (uname, pword) values(@uname, @pword) ';
$stmt = mysqli_prepare($con, $sql3);*/
?>