<?php
require_once 'Database.php';
$connection = new Database();

if (isset($_POST['fb_name']) && isset($_POST['fb_mail']) && isset($_POST['fb_message'])) {
    //mail('valeriia.hlotka@nure.ua', 'Feedback', $_POST['name'] . ' (' . $_POST['mail'] . ') writes: ' . $_POST['message']);

    $log = fopen('../../log/feedback.txt', 'a');
    $data = date('d.m.Y H:i:s').', name: '.$_POST['fb_name'].', email: '.$_POST['fb_mail'].', message: '.$_POST['fb_message'].', subject: '.(strlen($_POST['fb_subject']) > 0 ? $_POST['fb_subject'] : '-').PHP_EOL;
    fwrite($log, $data);
    fclose($log);
    echo json_encode(['status'=>'success']);
}

/*
 * 0 - unauthed
 * 1 - authed, without subscr plan
 * 2 - authed, subscr plan 1
 * 3 - authed, subscr plan 2
 * 4 - authed, subscr plan 3
*/

//auth
if (isset($_POST['auth_login']) && isset($_POST['auth_password'])) {
    //todo users` rights
    $user = $connection->Select('user', [0=>'ID', 1=>'Password'], 1, '`Nickname`="'.$_POST['auth_login'].'"');
    if ($user) {
        if (password_verify($_POST['auth_password'], $user[1])) {
            $subscription = $connection->Select('subscriptions', [0=>'id'], 1, '`user`='.$user[0].' and `end`>CURRENT_TIME');
            if ($subscription) {
                $result['plan'] = $subscription[0];
                $_SESSION['rights'] = (int)$result['plan'];
            } else {
                $result['plan'] = false;
                $_SESSION['rights'] = 0;
            }
            $result['status'] = 'auth success';
            $_SESSION['ID'] = $user[0];
        } else {
            $result['status'] = 'wrong password';
        }
    } else {
        $result['status'] = 'no login';
    }
    echo json_encode($result);
}

//register
if (isset($_POST['reg_login']) && isset($_POST['reg_password'])) {
    $user = $connection->Select('user', [0=>'Password'], 1, '`Nickname`="'.$_POST['reg_login'].'"');
    if ($user)
        $result['status'] = 'login exists';
    else {
        $insert = $connection->Insert('user', [0=>$_POST['reg_login'],1=>password_hash($_POST['reg_password'], PASSWORD_DEFAULT )]
            ,[0=>'Nickname', 1=>'Password']);
        if ($insert) {
            $result['status'] = 'reg success';
            $_SESSION['ID'] = $connection->getConection()->insert_id;
            $_SESSION['rights'] = 0;
            if (isset($_POST['inviter'])) {
                $add_points = $connection->Update('user', '`Account` + 200', '`ID`='.$_POST['inviter'], [0=>'Account']);
                if ($add_points) {
                    $result['account'] = 200;
                } else {
                    $result['account'] = 'update failure';
                }
            }
        }
        else
            $result['status'] = 'reg failure';
    }
    echo json_encode($result);
}

//forgot
if (isset($_POST['forgot_login'])) {
    $user = $connection->Select('user', [0=>'ID', 1=>'Email'], 1, '`Nickname`="'.$_POST['forgot_login'].'"');
    if ($user) {
        $sent = mail($user[1], 'Restore password', 'Link to restore password: http://'.$_SERVER['HTTP_HOST'].'/main?restore='.$user[0]);
        if ($sent) {
            $result['status'] = 'sent';
            $result['mail'] = $user[1];
        } else
            $result['status'] = 'sending failure';

    } else {
        $result['status'] = 'no login';
    }
    echo json_encode($result);
}

//restore
if (isset($_POST['new_password']) && isset($_POST['param'])) {
    $user = $connection->Select('user', [0=>'ID'], 1, '`ID`="'.$_POST['param'].'"');
    if ($user) {
        $updated = $connection->Update('user', password_hash($_POST['new_password'],PASSWORD_DEFAULT), '`ID`='.$user[0], [0=>'Password']);
        if ($updated) {
            $result['status'] = 'renew success';
            $_SESSION['ID'] = $user[0];
        } else {
            $result['status'] = 'renew error';
        }
    } else {
        $result['status'] = 'no user';
    }
    echo json_encode($result);
}

//profile
if (isset($_POST['change_login']) || isset($_POST['change_password']) || isset($_POST['change_time']) || isset($_POST['change_email'])) {
    $subject = '';
    $column = '';
    if (isset($_POST['change_login'])) {
        $subject = $_POST['change_login'];
        $column = 'Nickname';
    } else if (isset($_POST['change_password'])) {
        $subject = $_POST['change_password'];
        $column = 'Password';
    } else if (isset($_POST['change_time'])) {
        $subject = $_POST['change_time'];
        $column = 'ActiveTime';
    } else if (isset($_POST['change_email'])) {
        $subject = $_POST['change_email'];
        $column = 'Email';
    }
    $changed = $connection->Update('user', $subject, '`ID`='.$_SESSION['ID'], [0=>$column]);
    if ($changed) {
        $result['status'] = 'success';
    } else {
        $result['status'] = 'failure';
    }
    echo json_encode($result);
}

//logout
if (isset($_POST['action']) && $_POST['action'] === 'log_out') {
    unset($_SESSION['rights'], $_SESSION['ID']);
    $result['status'] = 'success';
    echo json_encode($result);
}

//load tests
if (isset($_POST['action']) && $_POST['action'] === 'get_tests') {
    $tests = $connection->Select('tests', '*', null, '`date` < CURRENT_TIME and `user`='.$_SESSION['ID'], [0=>'date'], 'asc');
    echo json_encode($tests);
}

/*
 * register invited friend - 200
 * test under post - 10
 * test in notifications firstly - 20
 * secondly - 15
 * thirdly - 5
 * */

//test in notifications
if (isset($_POST['test']) && isset($_POST['answer'])) {
    $correct_answer = $connection->Select('tests', [0=>'answer_id', 1=>'date', 2=>'question_id'], 1, '`id`='.$_POST['test'].' and `correctness`=1');
    if ($correct_answer) {
        if ($correct_answer[0] !== $_POST['answer']) {
            $result['status'] = 'false';
            $result['correct'] = $correct_answer[0];
            $value = 0;

            try {
                $hours = random_int(12, 50);
            } catch (Exception $e) {
                $hours = 15;
            }
            $date = "DATE_ADD('" . $correct_answer[1] . "', INTERVAL " . $hours . " HOUR)";
            $situations = $connection->Select('situation', [0 => 'ID']);

            $query = 'insert into test (`User`,`Date`,`Question`,`Situation`) values ';
            $query .= '(' . $_SESSION['ID'] . ',' . $date . ',' . $correct_answer[2] . ',' . $situations[array_rand($situations)][0] . ')';
            $inserted = $connection->Query($query);
            if ($inserted) {
                $result['insert status'] = 'true';
            } else {
                $result['insert status'] = 'false';
            }
        } else {
            $result['status'] = 'true';
            $value = 100;
            $repeat = $connection->Query('SELECT count(`ID`) from test where `Question`= (select `Question` from test where `ID`='.$_POST['test'].') and 
            `Situation` is not null and `Date`<CURRENT_TIME');
            if ($repeat) {
//shows for $repeat[0][0][0]-th time
                $points = match ($repeat[0][0][0]) {
                    '1' => 20,
                    '2' => 15,
                    '3' => 5,
                    default => 1
                };
                $add_points = $connection->Update('user', '`Account` + '.$points, '`ID`='.$_SESSION['ID'], [0=>'Account']);
                if ($add_points) {
                    $result['account'] = $points;
                } else {
                    $result['account'] = 'failure';
                }
            }
        }
        $update = $connection->Update('test', 'now(),'.$value, '`ID`='.$_POST['test'], [0=>'Date', 1=>'Result']);
        if (!$update) {
            $result['status'] = 'update error';
        }
    } else {
        $result['status'] = 'error';
    }
    echo json_encode($result);
}

//test under post
if (isset($_POST['question']) && isset($_POST['answer'])) {
    $correct_answer = $connection->Select('answer', [0=>'ID'], 1, '`Question`='.$_POST['question'].' and `IsCorrect`=1');
    if ($correct_answer) {
        if ($correct_answer[0] !== $_POST['answer']) {
            $result['status'] = 'false';
            $result['correct'] = $correct_answer[0];
            $value = 0;
        } else {
            $result['status'] = 'true';
            $value = 100;
        }
        $earlier_pass = $connection->Select('test', [0=>'ID'], 1, '`Question`='.$_POST['question'].' and `Result` is not null');
        if ($earlier_pass) {
            $result['status'] = 'you already';
            unset($result['correct']);
        }
        else {
            $addition = $connection->Insert('test', [0 => $_SESSION['ID'], 1 => 'now()', 2 => $_POST['question'], 3 => $value], [0 => 'User', 1 => 'Date', 2 => 'Question', 3 => 'Result']);
            if (!$addition) {
                $result['status'] = 'addition error';
            }
        }
        $add_points = $connection->Update('user', '`Account` + '.$value/10, '`ID`='.$_SESSION['ID'], [0=>'Account']);
        if ($add_points) {
            $result['account'] = $value/10;
        } else {
            $result['account'] = 'update failure';
        }
    } else {
        $result['status'] = 'error';
    }
    echo json_encode($result);
}

//add to favourites
if (isset($_POST['action']) && isset($_POST['post']) && ($_POST['action']==='add_favourite' || $_POST['action']==='remove_favourite')) {
    if ($_POST['action']==='add_favourite') {
        $added = $connection->Insert('favourites', [0 => $_POST['post'], 1 => $_SESSION['ID'], 2 => 'now()']);
        if ($added) {
            $result['status'] = 'add success';
        } else {
            $result['status'] = 'add failure';
        }
    } else if ($_POST['action']==='remove_favourite') {
        $removed = $connection->Delete('favourites', '`Article`='.$_POST['post'].' and `User`='.$_SESSION['ID']);
        if ($removed) {
            $result['status'] = 'remove success';
        } else {
            $result['status'] = 'remove failure';
        }
    }
    echo json_encode($result);
}

//add view to statistics
if (isset($_POST['action']) && isset($_POST['post']) && ($_POST['action']==='add_viewing')) {
    if (array_key_exists('ID', $_SESSION)) {
        $viewing = $connection->Select('viewing', [0=>'ID'], 1, '`User`='.$_SESSION['ID'].' and `Article`='.$_POST['post'].' and `GotIt`=1');
        if ($viewing) {
            $result['is_got'] = true;
        }
        $added = $connection->Insert('viewing', [0 => $_SESSION['ID'], 1 => $_POST['post'], 2 => 'now()', 3=>0]);
    } else
        $added = $connection->Insert('viewing', [0 => $_POST['post'], 1 => 'now()'], [0=>'Article', 1=>'Date']);

    if ($added) {
        $result['status'] = 'success';
        $result['id'] = $connection->getConection()->insert_id;
    } else {
        $result['status'] = 'failure';
    }
    echo json_encode($result);
}

//got it! click
if (isset($_POST['action']) && isset($_POST['id']) && ($_POST['action']==='edit_viewing')) {
    /*$viewing = $connection->Select('viewing', [0=>'ID'], 1, '`ID`='.$_POST['id'].' and `GotIt`=1');*/

        $edited = $connection->Update('viewing', 1, '`ID`=' . $_POST['id'], [0 => 'GotIt']);
        if ($edited) {
            $result['status'] = 'success';
        } else {
            $result['status'] = 'failure';
        }

        if (array_key_exists("ID", $_SESSION)) {
            $last_got = $connection->Query('select max(`Date`) from unlocked where `User`='.$_SESSION['ID']);
            if ($last_got && $last_got[0][0][0] != null) {
                $query = 'Select count(`ID`) from viewing where `User`='.$_SESSION['ID'].' and `GotIt`=1 and `Date`>'.$last_got[0][0][0];
            } else {
                $query = 'Select count(`ID`) from viewing where `User`='.$_SESSION['ID'].' and `GotIt`=1';
            }
            $count = $connection->Query($query);

            if ($count) {
                if ($count[0][0][0] >= 25) {
                    //todo logics to unlock games
                    $id = $connection->Select('entertainment', [0=>'ID'], 1, '`Subject` is null and `Type` != "game"');
                    if ($id) {
                        $inserted = $connection->Insert('unlocked', [0 => 'now()', 1 => $_SESSION['ID'], 2 => $id[0][0]], [0 => 'Date', 1 => 'User', 2 => 'Entertainment']);
                        if ($inserted)
                            $result['unlock_status'] = 'success';
                        else
                            $result['unlock_status'] = 'insert failure';
                    } else $result['unlock_status'] = 'no ar to unlock';
                }
            }
        }


        $article_id = $connection->Select('viewing', [0 => 'Article', 1 => 'Date', 2 => 'User'], 1, '`ID`=' . $_POST['id'] . ' and `User` is not null and `GotIt`=1');
        if ($article_id && array_key_exists('ID', $_SESSION) && $_SESSION['ID'] === $article_id[2]) {
            $questions = $connection->Select('question', [0 => 'ID'], null, '`Article`=' . $article_id[0]);
            //$result['$questions'] = $questions;
            //todo get only those situations which fits age
            $situations = $connection->Select('situation', [0 => 'ID']);
            //$result['$situations'] = $situations;
            if ($questions && $situations) {
                $tests = [];
                foreach ($questions as $question) {
                    $test['situation'] = $situations[array_rand($situations)][0];
                    $test['question'] = $question[0];
                    try {
                        $hours = random_int(8, 48);
                    } catch (Exception $e) {
                        $hours = 10;
                    }
                    $test['date'] = 'DATE_ADD("' . $article_id[1] . '", INTERVAL ' . $hours . ' HOUR)';
                    $tests[] = $test;
                }
                //$result['array'] = $tests;

                $query = 'insert into test (`User`,`Date`,`Question`,`Situation`) values ';
                foreach ($tests as $row) {
                    $query .= '(' . $_SESSION['ID'] . ',' . $row['date'] . ',' . $row['question'] . ',' . $row['situation'] . '),';
                }
                $query = substr($query, 0, strlen($query) - 1);
                //$result['$query'] = $query;
                $addition = $connection->Query($query);

                if ($addition) {
                    $result['status1'] = 'add success';
                } else {
                    $result['status1'] = 'add failure';
                }

            }
        }

    echo json_encode($result);
}

//expired test db update
if (isset($_POST['action']) && isset($_POST['test']) && ($_POST['action']==='edit_test')) {
    $updated = $connection->Update('test', -1, '`ID`='.$_POST['test'], [0=>'Result']);
    if ($updated) {
        $result['status'] = 'success';
    } else {
        $result['status'] = 'failure';
    }
    echo json_encode($result);
}

//send date of next test to realtime timer start and current test appearance when timer became 0
if (isset($_POST['action']) && ($_POST['action']==='get_next_test')) {
    if (array_key_exists('ID', $_SESSION)) {
        $next = $connection->Select('test', [0 => 'Date'], 1, '`User`=' . $_SESSION['ID'] . ' and `Date` = (SELECT min(`Date`) from test where `Date` > CURRENT_TIME)');
        if ($next) {
            $result['status'] = 'success';
            $result['next'] = $next[0];
        } else {
            $result['status'] = 'failure';
        }

        $array = $connection->Select('tests', '*', null, '`date` <= CURRENT_TIME and `user`=' . $_SESSION['ID'] . ' and `result` IS NULL');
        if ($array !== false) {
            foreach ($array as $item) {
                $situation = '';
                $tests[$item[0]]['user'] = $item[1];
                $tests[$item[0]]['date'] = $item[2];
                $tests[$item[0]]['question'] = $item[3];
                $tests[$item[0]]['test_id'] = $item[0];
                $tests[$item[0]]['answers'][$item[4]] = $item[5];
                if ($item[7] !== null) {
                    $situation = $connection->Select('situation', [1 => 'Text'], 1, '`ID`=' . $item[7])[0];
                }
                $tests[$item[0]]['situation'] = $situation;
            }
            if (!empty($tests)) {
                $str = '';
                foreach ($tests as $test) {
                    $str .= '
        <div class="test" data-id="' . $test['test_id'] . '" data-date="' . $test['date'] . '">
        ' . $test['situation'] . '
            <div class="question">
            ' . $test['question'] . '
            </div>
              <div class="answers">';
                    foreach ($test['answers'] as $id => $item) {
                        $str .= '<div class="answer" data-id="' . $id . '">' . $item . '</div>';
                    }
                    $str .= '</div>
        <div class="timer"></div></div>
        ';
                }
            }
            $result['test'] = $str;
        } else {
            $result['test'] = '';
        }
    } else {
        $result['status'] = 'unauthed';
    }
    echo json_encode($result);
}