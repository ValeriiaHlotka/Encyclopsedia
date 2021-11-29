<?php

require_once "Database.php";
class Model_Post extends Model
{
    public function get_data()
    {}

    public function get_data_by_param($param)
    {
        $connection = new Database();
        $article = $connection->Query('SELECT a.`ID`, a.`tags`, a.`heading`, a.`subject`, a.`text`, a.`date`, m.`link`, m.`type` from article as a left join media as m on a.id=m.article where a.`ID`='.$param);
        if ($article) {
            $prev = $connection->Select('article', [0=>'ID', 1=>'Heading'], 1, '`ID`= (SELECT max(`ID`) from article where `ID`<'.$article[0][0][0].') ');
            $next = $connection->Select('article', [0=>'ID', 1=>'Heading'], 1, '`ID`= (SELECT min(`ID`) from article where `ID`>'.$article[0][0][0].') ');

            if (!$prev) {
                $prev = 'false';
            }
            if (!$next) {
                $next = 'false';
            }

            $article[0]['siblings'][] = $prev;
            $article[0]['siblings'][] = $next;

            $tests = $connection->Query('SELECT a.ID, a.Text, a.Question, b.Text from answer as a, question as b where b.ID=a.Question and b.Article='.$article[0][0][0]);
            if ($tests) {
                foreach ($tests[0] as $item) {
                    $article[0]['tests'][$item[2]]['question'] = $item[3];
                    $article[0]['tests'][$item[2]]['question_id'] = $item[2];
                    $article[0]['tests'][$item[2]]['answers'][$item[0]] = $item[1];
                }
            }

            return $article[0];
        }
        else return false;
    }
}