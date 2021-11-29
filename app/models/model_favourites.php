<?php

require_once "Database.php";
class Model_Favourites extends Model
{
    public function get_data()
    {
        $connection = new Database();
        $articles = $connection->Query('SELECT a.`ID`, a.`tags`, a.`heading`, a.`subject`, a.`text`, a.`date`, m.`link`, m.`type` from article as a left join media as m on a.id=m.article where a.`ID` in (SELECT `Article` from favourites where `User`='. $_SESSION['ID'] . ')');
        if ($articles) {
            return $articles[0];
        } else
            return false;
    }
}