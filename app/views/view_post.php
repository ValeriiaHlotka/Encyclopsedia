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

            echo '</div><button class="confirm">Got it!</button><div class="error"></div>';

            if (key_exists("ar",$data)) {
                $type = "";
                $marker = "";
                $model = "";
                echo '<div class="ar_label">AR experience available!</div>';
                $tipped = false;
                foreach ($data["ar"] as $ar) {
                    $type = $ar["type"];
                    $marker = $ar["marker"];
                    $model = $ar["model"];
                    if (!$tipped) {
                        echo '<div class="ar_area"><div class="ar_area_text"><img width="150px" src="/'.$ar["cover_link"].'" alt="'.$ar["name"].'"><br><br>How to use it? If you are watching this from phone, click the button below. Otherwise skan QR below. Than place <b><a href="/'.$ar["marker_link"].'" >this image</a></b> in the camera<br><br><br><img src="/qr.png" alt="qr"></div>';
                        $str = file_get_contents("entertainment/AR/templates/model-viewer.php");
                        $str = str_replace("#MODEL", $model, $str);
                        echo $str;
                        $tipped = true;
                    }

                    echo '<button class="ar_button">'.$ar["name"].'</button>';
                }
                echo '</div>';

                if ($type == "marker" || $type == "image") {
                    $str = file_get_contents("entertainment/AR/templates/" . $type . ".php");
                    $str = str_replace("#MARKER", $marker, $str);
                    $str = str_replace("#MODEL", $model, $str);
                    file_put_contents("app/views/view_entertainments.php", $str);
                }
            }

            echo'</div>
                </div>
                <div class="siblings">
                <a id="prev_post" ';
            if ($data['siblings'][0] === 'false') {
                echo 'class="hidden "';
            }
            echo 'href="/post/item/' . $data['siblings'][0][0] . '"><i class="fa fa-arrow-left"></i> ' . $data['siblings'][0][1] . '</a><a id="next_post" ';
            if ($data['siblings'][1] === 'false') {
                echo 'class="hidden "';
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