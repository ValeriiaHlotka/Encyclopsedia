<?php

require_once "Database.php";
class Model_Search_Results extends Model
{
    public function get_data()
    {
        $connection = new Database();
        if (array_key_exists('search', $_GET)) {
            $articles = $connection->Query('SELECT a.`ID`, a.`tags`, a.`heading`, a.`subject`, a.`text`, a.`date`, m.`link`, m.`type` from article as a left join media as m on a.id=m.article where a.text LIKE "%'. $_GET['search'] .'%" or a.heading LIKE "%'. $_GET['search'] .'%"');
            if ($articles) {
                foreach ($articles[0] as &$article) {
                    if (str_contains($article[4], $_GET['search']))
                        $article[4] = str_replace($_GET['search'], '<b>'.$_GET['search'].'</b>', $article[4]);
                    if (str_contains($article[2], $_GET['search']))
                        $article[2] = str_replace($_GET['search'], '<b>'.$_GET['search'].'</b>', $article[2]);
                }
                return $articles[0];
            }
            else return false;
        } else if (array_key_exists('tag', $_GET)) {
            $articles = $connection->Query('SELECT a.`ID`, a.`tags`, a.`heading`, a.`subject`, a.`text`, a.`date`, m.`link`, m.`type` from article as a left join media as m on a.id=m.article where a.tags LIKE "%'. $_GET['tag'] .'%"');
            if ($articles) {
                foreach ($articles[0] as &$article) {
                    if (str_contains($article[1], $_GET['tag']))
                        $article[1] = str_replace($_GET['tag'], '<b>'.$_GET['tag'].'</b>', $article[1]);
                }
                return $articles[0];
            }
            else return false;
        } else return false;
    }
}