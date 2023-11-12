<?php
// include_once("../../../../../util/db/index.php");
include_once('../../layouts/partials/index.php');
include_once('../../../../app/controller/homeController.php');

//gọi hàm connect db
Connect();
?>
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
            /* background-color: #fff; */
            /* border-bottom: 1px solid black; */

            .header-content {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;


            }

        }

        .nav {
            width: 100%;
            height: 100%;


            .container {
                width: 100%;
                max-width: 1300px;

                display: flex;
                justify-content: space-between;


            }
        }

        .header-logo {
            object-fit: cover;
            overflow: hidden;
            /* width: 50px; */
            height: 50px;
        }

        .nav-item {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 15px;
            margin-right: 15px;
        }

        .nav-item>a {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
        }

        .card-title {
            height: 50px;
            white-space: normal;
            /* Allow text to wrap to the next line */
            overflow: hidden;
            /* Hide content that overflows the height */
            text-overflow: ellipsis;
            /* Show an ellipsis for overflow text */

        }

        .card-desc {
            height: 50px;
            overflow-y: hidden;
            overflow-wrap: break-word;
        }

        .card:hover {
            background-color: rgb(248, 249, 250);
            ;
        }
    </style>
</head>

<body>
    <?php
    // session_start();
    //handle detail when click quizz
    if (isset($_GET['btn'])) {
        $quizzkey = $_GET['quizzkey'];
        $_SESSION['quizzkey'] = $quizzkey;
        header('Location: ../Quizz/Quizz.php');

    }
    if (!isset($_SESSION['current_user_email']) || empty($_SESSION['current_user_email'])) {
        header('Location: ../Login/Login.php');
        exit;
    }

    // echo $_SESSION['quizzkey'];
    // echo $_SESSION['current_user_email'];
    




    //gọi component header
    $partial = new Partials();
    $homeController = new HomeController();


    $partial->PartialHeader();
    ?>


    <div class="content">


        <div class='container py-4 py-xl-5'>
            <div class='row mb-5'>
                <div class='col-md-8 col-xl-6 text-center mx-auto'>
                    <h2>Quizz</h2>

                    <a href='../Quizz/NewQuizz/NewQuizz.php' style='color: black;'><i class='fa-solid fa-plus'></i><span
                            style='margin-left: 10px'>Thêm Quizz</span></a>
                </div>
            </div>
            <div class='row '>
                <!-- get list quizz -->
                <?php
                $homeController->show();
                ?>

            </div>
        </div>
    </div>


    <?php
    //gọi component footer
    $partial->PartialFooter();
    ?>
</body>

</html>