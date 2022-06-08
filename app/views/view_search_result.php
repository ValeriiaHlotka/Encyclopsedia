<div class="search_result">
    <h2>Search result <?php echo (key_exists('search', $_GET) ? 'by query: '.$_GET['search'] : (key_exists('tag', $_GET) ? 'by tag: '.$_GET['tag'] : '')); ?> </h2>
<?php
if ($data !== false) {
    foreach ($data as $row) {
        //print_r($row);
        echo '<div class="post">
        ';
        if (key_exists("ID",$_SESSION))
            echo '<button class="like"><i class="fa fa-heart"></i></button>';
        echo '
              
                    <div class="heading" data-id="' . $row[0] . '">
                        <a href="#">
                            ' . $row[2] . '
                        </a>
                    </div>
                    <div class="text">
                    ' . (key_exists('6', $row) && $row['7'] === 'image' ? '<img src=' . $row['6'] . ' alt="" height="150px">' : ' ') . '
                        
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
} else {
    echo "No results found. Try another query";
}
?>

</div>