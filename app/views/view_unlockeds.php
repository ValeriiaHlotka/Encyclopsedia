<div class="unlockeds">
    <h2>Unlocked elements</h2>
    <div class="container">
        <?php foreach ($data as $datum): ?>
            <div class="item" data-id="<?php echo $datum[0]; ?>">
                <a href="/unlocked/show/<?php echo $datum[0]; ?>">
                    <div class="heading"><?php echo $datum[2]; ?></div>
                </a>
                <img height="150px" src="/<?php echo $datum[3]; ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>