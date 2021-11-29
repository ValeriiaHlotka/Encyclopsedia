<?php
include_once "app/models/model_tests.php";
if (!empty($tests)) {
    //print_r($tests);
    foreach ($tests as $test) {
        echo '
        <div class="test" data-id="'. $test['test_id'] .'" data-date="'. $test['date'] .'">
        '. $test['situation'] .'
            <div class="question">
            '. $test['question'] .'
            </div>
              <div class="answers">';
            foreach ($test['answers'] as $id=>$item) {
                echo '<div class="answer" data-id="'. $id .'">'. $item .'</div>';
            }
        echo '</div>
        <div class="timer"></div></div>
        ';
    }
} else {
    echo 'Nothing by now';
}
