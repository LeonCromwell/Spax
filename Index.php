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
    <script src="https://kit.fontawesome.com/772918bb67.js" crossorigin="anonymous"></script>
    <title>Index</title>
    <style>
        * {
            --primary: #d8d8d8;


            margin: 0;
            padding: 0;
        }



        a {
            text-decoration: none;
        }

        .header {
            width: 100%;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            border-bottom: 1px solid black;

            .header-content {
                width: 100%;
                height: 100%;
                max-width: 1300px;
                display: flex;
                justify-content: space-between;
                align-items: center;


            }

        }

        .nav {
            width: 100%;

            .container {
                width: 100%;
                display: flex;
                justify-content: space-between;
            }
        }

        .header-logo {
            object-fit: cover;
            overflow: hidden;
            width: 50px;
            height: 50px;
        }


        .nav-item>a {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="header-content">


            <nav class='navbar navbar-expand-lg nav'>
                <div class='container'>
                    <a class='navbar-brand' style="color: #fff" href='./Index.php'>
                        <img class="header-logo" src="./src/assets/Image/logo.png" alt="logo">

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
                                    Mai Lý Hải
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
                                    <li><a class='dropdown-item' href='#'>Đổi mật khẩu</a></li>
                                    <li>
                                        <hr class='dropdown-divider' />
                                    </li>
                                    <li><a class='dropdown-item' href='#'>Đăng xuất</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>

        </div>
    </header>
</body>

</html>