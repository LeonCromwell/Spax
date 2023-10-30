<?php
session_start();
if (!isset($_SESSION['current_user_email']) || empty($_SESSION['current_user_email'])) {
    header('Location: ../Login/Login.php');
    exit;
}
// get quizzkey
// echo $_SESSION['quizzkey'];

//Connect db
$servername = "localhost";
$dbname = 'php';
$username = 'mailyhai';
$password = '992003hai';
try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connect successfully';
} catch (PDOException $e) {
    echo "Connection falied: " . $e->getMessage();
}


//get current user
$current_user_email = $_SESSION['current_user_email'];
$st = $connect->prepare("SELECT * FROM user WHERE email = '$current_user_email'");
$st->execute();
$current_user = $st->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $level = $_POST['level'];
    $description = $_POST['description'];
    $time = $_POST['time'];
    $userId = $current_user['id_user'];


    // $sql = "INSERT INTO quizz (name, level, desc) VALUES ('$name', '$level', '$description')";
    $st = $connect->prepare("INSERT INTO quizz (name, level, `desc`, time, user_id) VALUES ('$name', '$level', '$description', '$time', '$userId')");
    if ($st->execute()) {
        // echo "<p style='color: green'>Đăng kí thành công</p>";
        header("Location: ../../Home");
    } else {
        echo 'Đăng kí thất bại';
    }



}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Quizz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/772918bb67.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./NewQuizz.css">
</head>

<body>

    <header class="header">
        <div class="header-content">
            <nav class='navbar navbar-expand-lg nav bg-body-tertiary'>
                <div class='container'>
                    <a class='navbar-brand' style="color: #fff" href='../../Home/Index.php'>
                        <img class="header-logo" src="../..//assets/Image/logo.png" alt="logo">

                    </a>


                    <div id='navbarSupportedContent'>
                        <ul class='navbar-nav ml-auto nav-item'>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/Congngheweb/Courses">
                                    <i class="fa-brands fa-discourse"></i>
                                    Khóa học</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    <i class="fa-solid fa-scroll"></i>
                                    Kì thi</a>
                            </li>

                            <li class='nav-item dropdown'>

                                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown'
                                    aria-expanded='false'>
                                    <i class="fa-solid fa-user"></i>
                                    <?php echo $current_user['fullname'] ?>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li>

                                        <a class='dropdown-item' href='#'>Thêm Khóa Học</a>
                                    </li>
                                    <li>
                                        <hr class='dropdown-divider' />
                                    </li>
                                    <li><a class='dropdown-item' href='#'>Khóa học của tôi</a></li>
                                    <li>
                                        <hr class='dropdown-divider' />
                                    </li>
                                    <li><a class='dropdown-item' href='#'>Thêm Quizz</a></li>
                                    <li>
                                        <hr class='dropdown-divider' />
                                    </li>
                                    <li><a class='dropdown-item' href='#'>Đổi mật khẩu</a></li>
                                    <li>
                                        <hr class='dropdown-divider' />
                                    </li>
                                    <li><a class='dropdown-item' href='../../Login/Login.php'>Đăng xuất</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>

        </div>
    </header>

    <div class="content">
        <?php
        if (isset($_POST['retype'])) {

            header("Location: NewQuizz.php");
        }
        ?>

        <div class='mt-4 create-form'>
            <h3>Thêm Quizz</h3>
            <form method='POST'>

                <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>Name</label>
                    <input type='text' name='name' class='form-control' id='exampleFormControlInput1'
                        placeholder='Enter name' value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" />
                </div>

                <div class='mb-3'>
                    <label for='exampleFormControlInput3' class='form-label'>Level</label>
                    <input type='text' name='level' class='form-control' id='exampleFormControlInput3'
                        placeholder='Enter Level' value="<?php echo isset($_POST['level']) ? $_POST['level'] : '' ?>" />
                </div>
                <div class='mb-3'>
                    <label for='exampleFormControlInput4' class='form-label'>Thời gian (phút)</label>
                    <input type='text' name='time' class='form-control' id='exampleFormControlInput4'
                        placeholder='Enter Time' value="<?php echo isset($_POST['time']) ? $_POST['time'] : '' ?>" />
                </div>
                <div class='mb-3'>
                    <label for='exampleFormControlTextarea4' class='form-label'>Description</label>
                    <textarea class='form-control' name='description' id='exampleFormControlTextarea4'
                        rows='3'><?php echo isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                </div>

                <button type='submit' name="submit" class='btn btn-primary'>Thêm Quizz</button>
                <button type='submit' name="retype" class='btn btn-primary'>Đặt lại</button>
            </form>
        </div>
    </div>

</body>

</html>