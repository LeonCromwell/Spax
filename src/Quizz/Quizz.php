<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Quizz.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/772918bb67.js" crossorigin="anonymous"></script>
    <title>Quizz</title>
    <style>
        .item {
            text-align: left;
        }
    </style>
</head>

<body>
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

    ?>
    <header class="header">
        <div class="header-content">
            <nav class='navbar navbar-expand-lg nav bg-body-tertiary'>
                <div class='container'>
                    <a class='navbar-brand' style="color: #fff" href='../Home'>
                        <img class="header-logo" src="../assets/Image/logo.png" alt="logo">

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
                                    <li><a class='dropdown-item' href='../Quizz/NewQuizz/NewQuizz.php'>Thêm Quizz</a>
                                    </li>
                                    <li>
                                        <hr class='dropdown-divider' />
                                    </li>
                                    <li><a class='dropdown-item' href='#'>Đổi mật khẩu</a></li>
                                    <li>
                                        <hr class='dropdown-divider' />
                                    </li>
                                    <li><a class='dropdown-item' href='../Login/Login.php'>Đăng xuất</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>

        </div>
    </header>

    <div class="content">
        <div class='container py-4 py-xl-5'>

            <div class="card">

                <div class="card-body text-center">
                    <?php
                    $quizzKey = $_SESSION['quizzkey'];
                    $quizz = $connect->prepare("SELECT * FROM quizz WHERE id = '$quizzKey'");
                    $quizz->execute();
                    $quizz = $quizz->fetch(PDO::FETCH_ASSOC);
                    echo "<h1>" . $quizz['name'] . "</h1>";
                    ?>
                    <p>Thời gian: &nbsp;
                    <div id="countdown"></div>




                    </p>

                    <button class="btn btn-primary" id="startCountDown" type="submit" data-bs-toggle="collapse"
                        data-bs-target="#quizz">Bắt
                        đầu làm bài</button>

                    <?php
                    // khi ấn vào button startCountDown thì thời gian bắt đầu đếm ngược
                    //sử dụng js vì php phải refresh lại trang rất nhiều lần
                    $minutes = $quizz['time'];

                    echo <<<EOD
                        <script type="text/javascript">
                            var duration = $minutes * 60 * 1000; // 15 phút trong mili giây
                            var countDownBtn = document.getElementById("startCountDown");
                            var x;
                            countDownBtn.addEventListener("click", e => {
                            e.preventDefault();

                            var startTime = new Date().getTime();
                            if(x) clearInterval(x);
                            x = setInterval(function() {
                                var now = new Date().getTime();
                                var distance = startTime + duration - now;
                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                document.getElementById("countdown").innerHTML = minutes + "m " + seconds + "s ";
                                if (distance <= 0) {
                                    clearInterval(x);
                                    document.getElementById("countdown").innerHTML = "Hết thời gian!";
                                    document.getElementById("countdown").setAttribute("class", "text-danger");
                                }
                            }, 1000);
                        });
                        </script>
                        EOD;

                    ?>

                    <?php
                    if (isset($current_user['role']) && $current_user['role'] == 'admin') {
                        echo " <a href='#' class='btn btn-primary' data-bs-toggle='collapse' data-bs-target='#quizz'>Thêm Câu hỏi</a>";
                    }
                    ?>


                    <?php
                    // lấy danh sách các câu hỏi của quizz 
                    
                    $ques = $connect->prepare("SELECT * FROM question WHERE ma_khoa_hoc = '$quizzKey'");
                    $ques->execute();
                    $questions = $ques->fetchAll(PDO::FETCH_ASSOC);

                    //lấy list đáp án của từng câu hỏi
                    foreach ($questions as $key => $question) {
                        $question_id = $question['id'];
                        $ans = $connect->prepare("SELECT * FROM answer WHERE ma_cau_hoi = '$question_id'");
                        $ans->execute();
                        $answers = $ans->fetchAll(PDO::FETCH_ASSOC);

                        echo "
                            <div class='card collapse mt-5 item' id='quizz'>
                            <div class='card-header'>Câu " . $key + 1 . "</div>
                            <div class='card-body'>
                            ";
                        if (isset($question['image']) && !empty($question['image'])) {
                            echo "<img src='" . $question['image'] . "' class='card-img-top' alt='Câu " . $key + 1 . "'>";
                        }
                        echo "
                            <h5 class='card-title'>" . $question['ques'] . "</h5>
                            <p class='card-text'>";
                        foreach ($answers as $key => $answer) {
                            echo "
                            <div class='form-check'>
                            <input class='form-check-input' type='radio' name='flexRadioDefault' id='flexRadioDefault1'>
                            <label class='form-check-label' for='flexRadioDefault1'>
                              " . $answer['noi_dung'] . "
                            </label>
                          </div>
                            ";
                        }
                        echo "</p>
                           
                            </div>
                        </div>
                            ";
                    }

                    ?>

                </div>
            </div>



        </div>

    </div>



    <footer class='text-center py-4'>
        <div class='container'>
            <div class='row row-cols-1 row-cols-lg-3'>
                <div class='col'>
                    <p class='text-muted my-2'>Copyright © 2023 Spax Viet Nam</p>
                </div>
                <div class='col'>
                    <ul class='list-inline my-2'>
                        <li class='list-inline-item me-4'>
                            <div class='bs-icon-circle bs-icon-primary bs-icon'><svg class='bi bi-facebook'
                                    xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' fill='currentColor'
                                    viewBox='0 0 16 16'>
                                    <path
                                        d='M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z'>
                                    </path>
                                </svg></div>
                        </li>
                        <li class='list-inline-item me-4'>
                            <div class='bs-icon-circle bs-icon-primary bs-icon'><svg class='bi bi-twitter'
                                    xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' fill='currentColor'
                                    viewBox='0 0 16 16'>
                                    <path
                                        d='M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z'>
                                    </path>
                                </svg></div>
                        </li>
                        <li class='list-inline-item'>
                            <div class='bs-icon-circle bs-icon-primary bs-icon'><svg class='bi bi-instagram'
                                    xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' fill='currentColor'
                                    viewBox='0 0 16 16'>
                                    <path
                                        d='M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z'>
                                    </path>
                                </svg></div>
                        </li>
                    </ul>
                </div>
                <div class='col'>
                    <ul class='list-inline my-2'>
                        <li class='list-inline-item'><a class='link-secondary' href='#'>Privacy Policy</a></li>
                        <li class='list-inline-item'><a class='link-secondary' href='#'>Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>