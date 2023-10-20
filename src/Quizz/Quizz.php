<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
</head>

<body>
    <?php
    if (!isset($_COOKIE['email']) || empty($_COOKIE['email'])) {
        header('Location: ../Login/Login.php');
        exit;
    }

    $_COOKIE['quizzkey'];

    //Connect db
    $servername = "localhost";
    $dbname = 'php';
    $username = 'mailyhai';
    $password = '992003hai';
    try {
        $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connect successfully';
    } catch (PDOException $e) {
        echo "Connection falied: " . $e->getMessage();
    }

    ?>
    <h1>Quizz</h1>
</body>

</html>