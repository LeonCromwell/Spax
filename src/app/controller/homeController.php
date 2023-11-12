<?php
include_once("../../../../util/db/index.php");

class HomeController
{
    private $connect = Connect();

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
        $connect = Connect();
        $st = $connect->prepare("SELECT * FROM user");
        $st->execute();
        $users = $st->fetchAll(PDO::FETCH_ASSOC);
        include_once('../../layouts/partials/index.php');
        include_once('../../resources/views/pages/Home/Index.php');
    }
    
}


?>