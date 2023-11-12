<?php
include_once("../../../../../util/db/index.php");

$connect = Connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Register.css" />
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

        .sex {
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- <div class="content"> -->
    <div class='card content py-4 py-xl-5 '>
        <h1>Đăng Kí </h1>
        <form method="post">
            <div class="mb-3">
                <label for="fullname" class="form-label">Fullname</label>
                <input type="text" class="form-control" id="fullname" name="name"
                    value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
            </div>
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
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword" name='confirmpassword'
                    value="<?php echo isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '' ?>">
            </div>

            <div class="mb-3 sex">
                <label class="form-label">Giới Tính</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="0" <?php if (isset($_POST['sex']) && $_POST['sex'] == '0') {
                            echo "checked";
                        } ?>>
                        <label class="form-check-label" for="inlineRadio1">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="1" <?php if (isset($_POST['sex']) && $_POST['sex'] == '1') {
                            echo "checked";
                        } ?>>
                        <label class="form-check-label" for="inlineRadio2">Nữ</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" name="birth" id="date"
                    value="<?php echo isset($_POST['birth']) ? $_POST['birth'] : '' ?>">
            </div>
            <div class="btn-action">
                <button type="submit" class="btn btn-primary" name='dk'>Đăng kí</button>
                <p>Đã có tài khoản? <a href="../Login/Login.php">Đăng nhập</a></p>

            </div>
        </form>
        <?php
    
        //validate email
        function ValidateEmail($email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        }

        //CheckEmail in db
        function CheckEmail($email, $connect)
        {
            $st = $connect->prepare("SELECT * FROM user WHERE email = '$email'");
            $st->execute();
            $result = $st->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        //validate password
        function ValidatePass($password)
        {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                return false;
            } else {
                return true;
            }
        }
        //Check password
        function CheckPass($password, $confirmpassword)
        {
            if ($password == $confirmpassword) {
                return true;
            } else {
                return false;
            }
        }


        if (isset($_POST['dk'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];
            $name = $_POST['name'];
            $birth = $_POST['birth'];

            if (isset($_POST['sex'])) {
                $sex = $_POST['sex'];
            }
            // echo $sex;
        
            if (empty($name) || empty($email) || empty($password) || empty($confirmpassword) || empty($birth) || !isset($sex)) {
                echo '<p style="color: red">Vui lòng nhập đầy đủ thông tin</p>';
            } else {

                if (!ValidateEmail($email)) {
                    echo "<p style='color: red'>Email không hợp lệ</p>";
                } else {
                    if (!ValidatePass($password)) {
                        echo "<p style='color: red'>Password phải có ít nhất 8 kí tự, 1 kí tự đặc biệt, 1 kí tự hoa, 1 kí tự thường và 1 số</p>";
                    } else {
                        if (CheckPass($password, $confirmpassword)) {
                            if (CheckEmail($email, $connect)) {
                                echo "<p style='color: red'>Email đã tồn tại</p>";
                            } else {
                                $pass = md5($password);
                                $st = $connect->prepare("INSERT INTO user (fullname, email, birth, sex, password) VALUES ('$name', '$email', '$birth', '$sex', '$pass')");
                                if ($st->execute()) {
                                    echo "<p style='color: green'>Đăng kí thành công</p>";
                                } else {
                                    echo 'Đăng kí thất bại';
                                }
                            }


                        }
                    }
                }
            }


        }
        ?>
    </div>
    <!-- </div> -->


</body>

</html>