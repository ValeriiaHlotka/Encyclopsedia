<div class="rating">
    <h2>Rating</h2>
    <div class="content_area">
        <div class="tabs">
            <a href="/rating/read"> <div class="tab <?php echo ($_SERVER['REQUEST_URI'] === "/rating/read" || $_SERVER['REQUEST_URI'] === "/rating") ? "chosen" : "" ?>" id="read">Rating by read</div></a>
            <a href="/rating/unlocked"> <div class="tab <?php echo $_SERVER['REQUEST_URI'] === "/rating/unlocked" ? "chosen" : "" ?>" id="unlocked">Rating by unlocked</div></a>
            <a href="/rating/account"> <div class="tab <?php echo $_SERVER['REQUEST_URI'] === "/rating/account" ? "chosen" : "" ?>" id="account">Rating by account</div></a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Result</th>
                <th>User</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data[0] as $datum): ?>
            <tr>
                <?php foreach ($datum as $field): ?>
                    <td><?php echo $field; ?></td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>