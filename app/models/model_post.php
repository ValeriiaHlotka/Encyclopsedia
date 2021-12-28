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

            $ar = $connection->Query('SELECT * from entertainment where `Subject`='.$article[0][0][3]);
            if ($ar) {
                foreach ($ar[0] as $item) {
                    $article[0]['ar'][$item[0]]['type'] = $item[1];
                    $article[0]['ar'][$item[0]]['marker'] = $item[2];
                    $article[0]['ar'][$item[0]]['model'] = $item[3];
                    $article[0]['ar'][$item[0]]['name'] = $item[4];

                    $path = "media/coverings/";
                    $cover = substr($item[3], strrpos($item[3], "/") + 1);
                    $cover = substr($cover, 0, strrpos($cover, "."));
                    $files = glob($path . $cover . ".*", GLOB_ERR);
                    $cover_link = ($files ? $files[0] : "#");
                    $article[0]['ar'][$item[0]]['cover_link'] = $cover_link;

                    $path = "media/markers/";
                    $marker = substr($item[2], strrpos($item[2], "/") + 1);
                    $marker = substr($marker, 0, strrpos($marker, "."));
                    $files = glob($path . $marker . ".png", GLOB_ERR);
                    $marker_link = ($files ? $files[0] : "#");
                    $article[0]['ar'][$item[0]]['marker_link'] = $marker_link;
                }
            }

            return $article[0];
        }
        else return false;
    }
}