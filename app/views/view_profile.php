<div class="profile">
    <h2>Profile</h2>
    <div class="content_area">
        <?php if ($data !== false) {
            echo '<div class="heading" data-id=' . $data[0] . '>' . $data[1] . ' <button class="change" id="change_login"><i class="fa fa-user"></i> Change nickname</button></div>
<button class="change" id="change_password"><i class="fa fa-key"></i> Change password</button>
<div class="item">Account: ' . $data[3] . '</div>
<div class="item">Active time: ' . $data[4] . '<button class="change" id="change_time"><i class="fa fa-business-time"></i> Change active time</button></div>
<div class="item">Email: ' . $data[5] . '<button class="change" id="change_email"><i class="fa fa-envelope"></i> Change email</button></div>
<button id="log_out"><i class="fa fa-sign-out"></i> Log out</button>
';


        } ?>

    </div>
</div>