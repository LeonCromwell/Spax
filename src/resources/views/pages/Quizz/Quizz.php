<?php
include_once('../../layouts/partials/index.php');
include_once('../../../../app/controller/quizzController.php');
include_once('../../../../components/CountDown/index.php');
?>
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

</head>

<body>
    <?php
    //header
    $partial = new Partials();
    $quizzController = new QuizzController();
    $countDown = new CountDown();

    $partial->PartialHeader();

    ?>


    <div class="content">
        <div class='container py-4 py-xl-5'>
            <div class="card">
                <div class="card-body text-center">
                    <!-- Tên quizz -->
                    <?php
                    $quizzKey = $_SESSION['quizzkey'];

                    $quizz = $quizzController->getQuizzFromDb($quizzKey);
                    $quizzName = $quizz['name'];
                    echo "<h1 class='card-title'>" . $quizzName . "</h1>";


                    ?>
                    <p>Thời gian: &nbsp;
                    <div id="countdown"></div>
                    </p>
                    <form action="" method="post">
                        <input class="btn btn-primary" name="start" id="startCountDown" type="submit"
                            data-bs-toggle="collapse" data-bs-target="#question" value="Bắt đầu làm bài" />
                    </form>
                    <?php


                    // count down
                    $minutes = $quizz['time'];
                    $countDownBtnId = "startCountDown";
                    $countDownContainer = "countdown";

                    $countDown->setMinutes($minutes);
                    $countDown->setCountDownBtnId($countDownBtnId);
                    $countDown->setCountDownContainer($countDownContainer);

                    $countDown->CountDown();

                    // in ra câu hỏi và đáp án
                    // lấy danh sách các câu hỏi của quizz 
                    $questions = $quizzController->getQuestionsFromDb($quizzKey);
                    $numberQuestion = count($questions);

                    if ($numberQuestion == 0) {
                        echo "<div style='color: red'>Chưa có câu hỏi!</div>";
                    } else {
                        //lấy list đáp án của từng câu hỏi
                        foreach ($questions as $key => $question) {
                            $question_id = $question['id'];
                            $answers = $quizzController->getAnswersFromDb($question_id);
                            echo "
                            <div class='card collapse mt-5 item' id='question' style='text-align: left;'>
                            <div class='card-header'>Câu " . $key + 1 . "
                            </div>
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
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?php
    //footer
    $partial->PartialFooter();
    ?>
</body>

</html>