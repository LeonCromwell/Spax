<?php
class NewQuizzController
{
    private $name;
    private $level;
    private $description;
    private $time;
    private $userId;
    private $connect;

    function setConnect($connect)
    {
        $this->connect = $connect;
    }
    function getConnect()
    {
        return $this->connect;
    }

    function __construct($name, $level, $description, $time, $userId)
    {
        $this->name = $name;
        $this->level = $level;
        $this->description = $description;
        $this->time = $time;
        $this->userId = $userId;
    }
    function NewQuizz()
    {
        $this->setConnect(Connect());
        $connect = $this->getConnect();
        $st = $connect->prepare("INSERT INTO quizz (name, level, `desc`, time, user_id) VALUES ('$this->name', '$this->level', ' $this->description', '$this->time', '$this->userId')");
        if ($st->execute()) {
            header("Location: ../../Home");
        } else {
            echo 'Thêm Quizz không thành công';
        }
    }

}

?>