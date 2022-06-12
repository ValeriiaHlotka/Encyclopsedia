<?php

require_once "Database.php";
class Model_Subject extends Model
{
    public function get_data()
    {
        $connection = new Database();
        $subjects = $connection->Select('subject', '*');
        if ($subjects)
            return $subjects;
        else
            return false;
    }

    public function get_data_by_param($param)
    {
        $connection = new Database();
        $articles = $connection->Query('SELECT a.`ID`, a.`tags`, a.`heading`, a.`subject`, a.`text`, a.`date`, m.`link`, m.`type` from article as a left join media as m on a.id=m.article where a.`subject` = '. $param);
        if ($articles) {
            $subject = $connection->Select('subject', 'Name', 1, '`ID`='.$param);
            if ($subject) {
                $articles[0]['subject'] = $subject[0];
                return $articles[0];
            }  else
                return false;
        } else
            return false;
    }
}