<?php
$conf["Username"]= 'PHP';
$conf["Password"]= 'Cas01Jongejan';
$conf["Host"]= '127.0.0.1';
$conf["Database"]= 'classicmodels';
$con = mysqli_connect($conf["Host"], $conf["Username"],
    $conf["Password"], $conf["Database"]);
if($con == false) // Verbinding is mislukt!
{
    echo "Kan geen verbinding maken met de database";
}


?>