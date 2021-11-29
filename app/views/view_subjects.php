<div class="subjects">
    <h2>Subjects</h2>
    <div class="content_area">
        <?php
        if ($data !== false) {
            foreach ($data as $row) {
                //todo subjects hierarchy

                // if (strlen($row[2]) < 1) {
                echo '
                    <div class="subject_item" data-id="' . $row[0] . '">
                        <a href="/subject/item/' . $row[0] . '">
                            <div class="heading">
                                ' . $row[1] . '
                            </div>
                        </a>
                        <div class="subitems"></div>
                    </div>
                    ';
                // }
            }
        }
        ?>
    </div>
</div>
