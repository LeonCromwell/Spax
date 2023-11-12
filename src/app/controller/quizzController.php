<?php
class QuizzController
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

    //get quizz from db
    public function getQuizzFromDb($quizzKey)
    {
        $this->setConnect(Connect());
        $connect = $this->getConnect();
        $quizz = $connect->prepare("SELECT * FROM quizz WHERE id = '$quizzKey'");
        $quizz->execute();
        $quizz = $quizz->fetch(PDO::FETCH_ASSOC);
        // $this->setName($quizz['name']);
        return $quizz;
    }

    public function getQuestionsFromDb($quizzKey)
    {
        $this->setConnect(Connect());
        $connect = $this->getConnect();
        $ques = $connect->prepare("SELECT * FROM question WHERE quizz_id = '$quizzKey'");
        $ques->execute();
        $questions = $ques->fetchAll(PDO::FETCH_ASSOC);
        return $questions;
    }

    public function getAnswersFromDb($questionId)
    {
        $this->setConnect(Connect());
        $connect = $this->getConnect();
        $ans = $connect->prepare("SELECT * FROM answer WHERE question_id = '$questionId'");
        $ans->execute();
        $answers = $ans->fetchAll(PDO::FETCH_ASSOC);
        return $answers;
    }
}
?>