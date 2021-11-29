<?php
$tests = [];
if (array_key_exists('ID', $_SESSION)) {
    require_once 'Database.php';
    $connection = new Database();
    $array = $connection->Select('tests', '*', null, '`date` <= CURRENT_TIME and `user`=' . $_SESSION['ID']. ' and `result` IS NULL', [0 => 'date'], 'asc');
    if ($array !== false) {
        foreach ($array as $item) {
            $situation = '';
            $tests[$item[0]]['user'] = $item[1];
            $tests[$item[0]]['date'] = $item[2];
            $tests[$item[0]]['question'] = $item[3];
            $tests[$item[0]]['test_id'] = $item[0];
            //'correctness' => $item[6]]; result->[8]
            $tests[$item[0]]['answers'][$item[4]] = $item[5];
            if ($item[7] !== null) {
                $situation = $connection->Select('situation', [1 => 'Text'], 1, '`ID`=' . $item[7])[0];
            }
            $tests[$item[0]]['situation'] = $situation;
        }
    }
}