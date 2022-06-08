<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Encyclopsedia</title>
    <link rel="shortcut icon" href="../../media/icons/favicon.ico" />
    <link rel="stylesheet" href="../../style.css">
    <script src="../../js/script.js"></script>
    <script src="../../js/behaviour.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<header>
    <div class="menu">
        <div class="tabs_group">
            <a href="/">
                <img src="../../media/icons/logo.png" alt="logo" width="80px">
            </a>
            <ul class="tabs">
                <li data-need-auth="true">
                    <a href="/profile">
                        <i class="fa fa-user"></i>
                        Profile
                    </a>
                </li>
                <li class="expanded">
                    <a href="/subject">
                        Subjects
                    </a>
                    <div class="sublis">
                        <ul>
                            <li><a href="/subject/item/1">Nature</a></li>
                            <li><a href="/subject/item/2">Mechanics</a></li>
                        </ul>
                    </div>
                </li>
                <li data-need-auth="true">
                    <a href="/unlocked" class="num_a">
                        Unlocked
                        <div class="num"></div>
                    </a>
                </li>
                <li data-need-auth="true">
                    <a href="/favourites">
                        Favourites
                    </a>
                </li>
                <li data-need-auth="true">
                    <a href="/rating">
                        Rating
                    </a>
                </li>
                <li>
                    <a href="/do_you_know">
                        Do you know?
                    </a>
                </li>
                <li>
                    <a href="/subscription">
                        Subscription
                    </a>
                </li>
                <li>
                    <a href="/contacts">
                        Contacts
                    </a>
                </li>
            </ul>
        </div>
        <div class="socials">
            <li>
                <a href="https://t.me/encyclopsedia" target="_blank">
                    <img src="../../media/icons/telegram.png" alt="telegram" width="20px">
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/groups/421934906276380/" target="_blank">
                    <img src="../../media/icons/facebook.png" alt="facebook" width="20px">
                </a>
            </li>
            <li>
                <a href="https://www.youtube.com/channel/UCTnelj2toTC2CNSjPMDcStw" target="_blank">
                    <img src="../../media/icons/youtube.png" alt="youtube" width="25px">
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/encyclopsedia/" target="_blank">
                    <img src="../../media/icons/instagram.png" alt="instagram" width="20px">
                </a>
            </li>
            <div class="search">
                <form action="" name="search">
                    <input id="search">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        </ul>
    </div>
    <div class="notifications">
        <div class="info">
            <div class="timer_label">Next test in:</div>
            <div class="timer"></div>
            <div class="text">
                <?php include_once 'app/views/view_tests.php'; ?>
            </div>
            <button class="close">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <button class="bell">
            <i class="fa fa-bell"></i>
        </button>
    </div>
</header>
<div class="wrapper">
    <h2>This page doesn`t exist. Return to <a href="/"><b>main page</b></a> and try again!</h2>
</div>
<footer>
</footer>
</body>
</html>