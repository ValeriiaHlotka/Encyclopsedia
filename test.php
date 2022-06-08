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
                            <li><a href="/subject/item/2">2</a></li>
                            <li><a href="/subject/item/3">3</a></li>
                        </ul>
                    </div>
                </li>
                <li data-need-auth="true">
                    <a href="/unlocked">
                        Unlocked
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
                Nothing by now            </div>
            <button class="close">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <button class="bell">
            <i class="fa fa-bell"></i>
        </button>
    </div>
    <div class="popup">
        <div class="popup_wrapper"></div>
        <div class="info">
            <div class="text"></div>
            <button class="close">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="authreg">
        <div class="popup_wrapper"></div>
        <div class="info">
            <div class="text">
                <div class="heading">
                    Sign in
                </div>
                <form action="" id="authreg" autocomplete="off">
                    <input type="text" name="auth_login" placeholder="Your login*">
                    <input type="password" name="auth_password" placeholder="Your password*">
                    <div class="forgot_authreg">
                        <a href="">Forgot password?</a>
                    </div>
                    <div class="error"></div>
                    <button id="send_authreg">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        Log in
                    </button>
                    <div class="switch_authreg auth">
                        <a href="">Sign up</a>
                    </div>
                </form>
            </div>
            <button class="close">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</header>
<div class="wrapper">
    <div class="post_item">
        <h2>The three forms of water</h2>
        <div class="post" data-id="2">
            <button class="like">
                <i class="fa fa-heart"></i>
            </button>
            <div class="text">
                <div class="info">
                    <img src=../../media/images/water.jpg alt="" height="200px">
                    Pure water is tasteless, odorless, and colorless. Water can occur in three states: solid (ice), liquid, or gas (vapor).
                    Solid water�ice is frozen water. When water freezes, its molecules move farther apart, making ice less dense than water. This means that ice will be lighter than the same volume of water, and so ice will float in water. Water freezes at 0� Celsius, 32� Fahrenheit.
                    <br>
                    Liquid water is wet and fluid. This is the form of water with which we are most familiar. We use liquid water in many ways, including washing and drinking.
                    Water as a gas�vapor is always present in the air around us. You cannot see it. When you boil water, the water changes from a liquid to a gas or water vapor. As some of the water vapor cools, we see it as a small cloud called steam. This cloud of steam is a miniversion of the clouds we see in the sky. At sea level, steam is formed at 100� Celsius, 212� Fahrenheit.
                    The water vapor attaches to small bits of dust in the air. It forms raindrops in warm temperatures. In cold temperatures, it freezes and forms snow or hail.
                </div>
            </div>
            <div class="details">
                <div class="date">
                    2021-11-11 20:11:18
                </div>
                <div class="tags"><div class="tag">nature, </div><div class="tag">water</div></div><button class="confirm">Got it!</button><div class="error"></div>
                <div class="ar_label">AR experience available!</div>
                <div class="ar_area"><div class="ar_area_text">
                        <img width="150px" src="/media/coverings/banana.jpg" alt="Sport Banana">
                        <br><br>How to use it? If you are watching this from phone, click the button below. Otherwise skan QR below. Than place <b>
                            <a href="/media/markers/skull.png" >this image</a>
                        </b> in the camera<br><br><br><img src="/testqr.png" alt="qr">
                    </div>
                    <button class="ar_button_"><a href="test1.php">Sport Banana</a></button>
                </div>
            </div>
        </div>
        <div class="siblings">
            <a id="prev_post" class="hidden" href="/post/item/f"><i class="fa fa-arrow-left"></i> a</a><a id="next_post" href="/post/item/3"><i class="fa fa-arrow-right"></i> Day and night on Earth</a></div></div></div>
<footer>
</footer>
</body>
</html>