<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        body {

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .content {
            width: 100%;
            max-width: 500px;
            margin: auto;

            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            padding: 10px;
        }

        .btn-action {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class='card content py-4 py-xl-5 '>
        <h1>Đăng Nhập</h1>
        <form method="post">

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                    value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name='password'
                    value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
            </div>





            <div class="btn-action">
                <button type="submit" class="btn btn-primary" name='dn'>Đăng nhập</button>
                <p>Chưa có tài khoản? <a href="../Register/Register.php">Đăng kí</a></p>

            </div>
        </form>

        <?php
        if (isset($_COOKIE['email'])) {
            setcookie('email', '', time() - 3600, '/');
        }

        //connect to db
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


        function ValidateEmail($email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        }

        function CheckPassword($password, $connect)
        {
            $pass = md5($password);
            $st = $connect->prepare("SELECT * FROM user WHERE password = '$pass'");
            $st->execute();
            $result = $st->fetch(PDO::FETCH_ASSOC);
            // echo $result;
            if ($result) {
                return true;
            } else {
                return false;
            }
        }


        if (isset($_POST['dn'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!empty($email) && !empty($password)) {
                if (ValidateEmail($email)) {
                    if (CheckPassword($password, $connect)) {
                        echo 'Đăng nhập thành công';
                        setcookie('email', $email, time() + 3600, '/');
                        header('Location: ../Home');
                    } else {
                        echo 'Sai mật khẩu';
                    }
                } else {
                    echo 'Email không hợp lệ';
                }
            } else {
                echo "<p style='color: red'>Vui lòng nhập đầy đủ thông tin</p>";
            }
        }

        ?>
    </div>
</body>

</html>