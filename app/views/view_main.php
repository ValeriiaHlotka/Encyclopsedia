<div class="recommended">
    <h2>Recommendations for you</h2>
    <?php

   /* echo '******';
    $to_email = "valeri.anka469@gmail.com";
    $subject = "Simple Email Test via PHP";
    $body = "Hi,nn This is test email send by PHP Script";
    $headers = "From: valeriia.hlotka@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }
    echo '******';*/

    if ($data !== false) {
        //echo '<a href="entertainment/AR/templates/marker.php"></a>';

        /*$str = file_get_contents("entertainment/AR/templates/marker.php");
        file_put_contents("app/views/view_entertainments.php", str_replace("burger", "banana", $str));
        echo '<a href="app/views/view_entertainments.php"></a>';*/
        foreach ($data as $row) {
            echo '
                <div class="post">';
            if (key_exists("ID",$_SESSION))
                echo '<button class="like"><i class="fa fa-heart"></i></button>';
            echo '<div class="heading" data-id="' . $row[0] . '">
                        <a href="/post/item/' . $row[0] . '">
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
    }
    else
        echo "There is no available data, come later";
    ?>

</div>