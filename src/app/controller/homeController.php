<?php
// vì đã gọi db trong header rồi nên không cần gọi lại
// include_once("../../../../util/db/index.php");

class HomeController
{
    private $connect;

    function setConnect($connect)
    {
        $this->connect = $connect;
    }

    function getConnect()
    {
        return $this->connect;
    }

    public function show()
    {
        $this->setConnect(Connect());
        $connect = $this->getConnect();
        $quizzs = $connect->prepare("SELECT * FROM quizz");
        $quizzs->execute();
        $list_quizz = $quizzs->fetchAll(PDO::FETCH_ASSOC);
        foreach ($list_quizz as $quizz) {
            echo "
            <div class='col-sm-6 col-lg-4 mt-4'>
            <form method='GET'>
            <input type='hidden' name='quizzkey' value='" . $quizz['id'] . "'>
            <button type='submit' name='btn' class='btn'>
                <div class='card' style='width: 18rem'>
                <div class='card-body'>
                        <h5 class='card-title'>" . $quizz['name'] . "</h5>
                    <p>Level: " . $quizz['level'] . "</p>
                    <p class='card-text card-desc'>" . $quizz['desc'] . "</p>
                    
                </div>
                </div>
                </button>

            </form>
            </div>
            ";
        }
    }

}


?>