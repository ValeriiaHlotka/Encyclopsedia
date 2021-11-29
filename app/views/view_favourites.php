<div class="favourites">
    <h2>Your favourites</h2>
        <?php
        if ($data !== false) {
            echo '<div class="container">';
            foreach ($data as $row) {
                echo '
                <div class="post">
                <button class="like chosen">
                <i class="fa fa-heart"></i>
                </button>
                    <div class="heading" data-id="' . $row[0] . '">
                        <a href="/post/item/' . $row[0] . '">
                            ' . $row[2] . '
                        </a>
                    </div>
                    <div class="text">
                    ' . (key_exists('6', $row) && $row['7'] === 'image' ? '<img src=' . $row['6'] . ' alt="" height="100px">' : ' ') . '
                        
                        <div class="info">
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

                echo '
                        </div>
                    </div>
                </div>
        ';
            }
            echo '</div>';
        }
        ?>
    </div>
</div>