<?php
include_once('../../../layouts/partials/index.php');
include_once('../../../../../app/controller/newQuizzController.php');

$partial = new Partials();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $level = $_POST['level'];
    $description = $_POST['description'];
    $time = $_POST['time'];
    $userId = $partial->get_current_user()['id_user'];

    $newQuizz = new NewQuizzController($name, $level, $description, $time, $userId);

    $newQuizz->NewQuizz();

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

    <?php
    $partial->PartialHeader();
    ?>

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