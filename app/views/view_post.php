<div class="post_item">
    <?php
        if ($data!==false) {
            //print_r($data['tests']);
            $row = $data[0];
            echo '<h2>'.$row[2].'</h2>';
            echo '
                <div class="post" data-id="' . $row[0] . '">
                <button class="like">
                <i class="fa fa-heart"></i>
                </button>
                    <div class="text">                      
                        <div class="info">
                        ' . (key_exists('6', $row) && $row['7'] === 'image' ? '<img src=' . $row['6'] . ' alt="" height="200px">' : ' ') . '
                            ' . $row[4] . '
                        </div>
                    </div>
                    <div class="details">
                        <div class="date">
                            ' . $row[5] . '
                        </div>
                        <div class="tags">';

            $str = '';
            foreach (explode(',', $row[1]) as $tag) {
                $str .= '<div class="tag">' . $tag . ", " . '</div>';
            }
            echo substr($str, 0, strlen($str) - 8) . '</div>';

            echo '</div><button class="confirm">Got it!</button><div class="error"></div>
';
            echo'</div>
                </div>
                <div class="siblings">
                <a id="prev_post" ';
            if ($data['siblings'][0] === 'false') {
                echo 'class="hidden"';
            }
            echo 'href="/post/item/' . $data['siblings'][0][0] . '"><i class="fa fa-arrow-left"></i> ' . $data['siblings'][0][1] . '</a><a id="next_post" ';
            if ($data['siblings'][1] === 'false') {
                echo 'class="hidden"';
            }
            echo 'href="/post/item/' . $data['siblings'][1][0] . '"><i class="fa fa-arrow-right"></i> ' . $data['siblings'][1][1] . '</a></div>';

            if (array_key_exists('ID', $_SESSION)) {
                echo '<div class="content_area"><div class="heading">Test yourself!</div>';
                foreach ($data['tests'] as $test) {
                    echo '
                    <div class="test">
                        <div class="question" data-id="' . $test['question_id'] . '">
                        ' . $test['question'] . '
                        </div>
                          <div class="answers">';
                    foreach ($test['answers'] as $id => $item) {
                        echo '<div class="answer" data-id="' . $id . '">' . $item . '</div>';
                    }
                    echo '</div><div class="error"></div>
                    </div>
                    ';
                }
                echo '</div>';
            }
        }
echo '</div>';
?>