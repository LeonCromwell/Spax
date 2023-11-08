<?php
function Connect()
{
    //Connect db
    $servername = "localhost";
    $dbname = 'php';
    $username = 'mailyhai';
    $password = '992003hai';
    try {
        $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connect;
        // echo 'Connect successfully';
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
?>