<div class="unlocked">
    <h2><?php echo $data[0][3]; ?></h2>
    <div class="container">
        <?php foreach ($data as $datum): ?>
            <div class="item" data-id="<?php echo $datum[0]; ?>">
                <div>
                <a href="/unlocked/show/<?php echo $datum[0]; ?>">
                    <div class="heading"><?php echo $datum[3]; ?></div>
                </a>
                <img height="300px" src="/<?php echo $datum[5]; ?>">
                </div>
                <div class="ar_area opened"><div class="ar_area_text">
                        <br><br>How to use it? If you are watching this from phone, click the QR below. Otherwise skan QR below. Than place <b>
                            <a href="<?php echo $datum[6]; ?>" >this image</a>
                        </b> in the camera<br><br><br>
                        <a href="<?php echo $datum[7]; ?>"><img height="300px" src="<?php echo $datum[8]; ?>" alt="qr"></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>