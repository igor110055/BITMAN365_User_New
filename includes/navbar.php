<nav class="navbar navbar-expand-lg navbar-custom" role="navigation">
    <a class="navbar-brand ml-4" href="./">BITMAN365</a>
    <button class="navbar-toggler" type="button" id="navbar-collapse-1">
        <span class="navbar-toggler-icon"></span>
        <a class="navbar-brand-mobile" href="./">BITMAN365</a>
    </button>
    <?php
        if(count(@$_SESSION)){
            echo '
                <a href="#"><img src="assets/icons/ic_round-local-post-office.png" class="ic_round_1"></a>
                <button class="navbar-toggler dropdown-toggle" type="button" id="navbar-collapse-3">
                    <img src="assets/icons/user_orange.png">
                </button>
            ';
        }else{
            echo '
                <button class="navbar-toggler" type="button" id="navbar-collapse-2">
                    <img src="assets/icons/user_white.png">
                </button>
            ';
        }
    ?>
    <!-- 1920 pixels -->
    <div class="collapse navbar-collapse">
        <?php
            if(count(@$_SESSION)){
            echo '
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./btc_usd.php">BTC/USD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ETH/USD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">XRP/USD</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-noticeguide" style="text-decoration: none;" href="#" id="drnoticeguide" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        공지 및 이용
                    </a>
                    <div class="dropdown-menu notgui" aria-labelledby="drnoticeguide">
                        <a class="dropdown-item" href="./notice.php">공지사항</a>
                        <a class="dropdown-item" href="./guide.php">이용안내</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-depositwithdraw" style="text-decoration: none;" href="#" id="withdrawdeposit" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        입출금 신청
                    </a>
                    <div class="dropdown-menu depwid" aria-labelledby="withdrawdeposit">
                        <a class="dropdown-item" href="./deposit.php">입금신청</a>
                        <a class="dropdown-item" href="./withdraw.php">출금신청</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-inqfaq" style="text-decoration: none;" href="#" id="inqfaq" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        고객센터
                    </a>
                    <div class="dropdown-menu inquiryfaq" aria-labelledby="inqfaq">
                        <a class="dropdown-item" href="./inquiry.php">1:1문의</a>
                        <a class="dropdown-item" href="./faq.php">FAQ</a>
                    </div>
                </li>
            </ul>';
            }else{
                echo '
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item modal-popup-login">
                        <a class="nav-link" href="#">BTC/USD</a>
                    </li>
                    <li class="nav-item modal-popup-login">
                        <a class="nav-link" href="#">ETH/USD</a>
                    </li>
                    <li class="nav-item modal-popup-login">
                        <a class="nav-link" href="#">XRP/USD</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-5">
                    <li class="nav-item dropdown modal-popup-login">
                        <a class="nav-link dropdown-noticeguide" style="text-decoration: none;" href="#" id="drnoticeguide" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            공지 및 이용
                        </a>
                        <div class="dropdown-menu notgui" aria-labelledby="drnoticeguide">
                            <a class="dropdown-item" href="#">공지사항</a>
                            <a class="dropdown-item" href="#">이용안내</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown modal-popup-login">
                        <a class="nav-link dropdown-depositwithdraw" style="text-decoration: none;" href="#" id="withdrawdeposit" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            입출금 신청
                        </a>
                        <div class="dropdown-menu depwid" aria-labelledby="withdrawdeposit">
                            <a class="dropdown-item" href="#">입금신청</a>
                            <a class="dropdown-item" href="#">출금신청</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown modal-popup-login">
                        <a class="nav-link dropdown-inqfaq" style="text-decoration: none;" href="#" id="inqfaq" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            고객센터
                        </a>
                        <div class="dropdown-menu inquiryfaq" aria-labelledby="inqfaq">
                            <a class="dropdown-item" href="#">1:1문의</a>
                            <a class="dropdown-item" href="#">FAQ</a>
                        </div>
                    </li>
                </ul>';
            }
        ?>
        <span class="nav_layout_btn">
            <ul class="navbar-nav mr-auto">
                <?php
                    if(count($_SESSION)){
                        echo '<li class="nav-item">
                                <a href="#" style="text-decoration: none;"><span class="current_stocks"><img src="assets/icons/dollar_mint.png" class="dollar_mint"><span class="cash_balance"></span>원</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#"><span class="ic_rounds"><img src="assets/icons/ic_round-local-post-office.png" class="ic_round"></span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <span class="user_oranges" onclick="dropdown()"><img src="assets/icons/user_orange.png" class="user_orange dropbtn"></span>
                                    <div id="myDropdown" class="dropdown-content" style="padding: 15px;">
                                        <div style="background: #FFFFFF; border-radius: 10px; font-size: 16px; height: 44px; font-weight: 700; padding: 10px;">
                                            닉네임닉네임닉
                                            <img src="assets/icons/akar-icons_sound-on.png" style="padding: 0 0 0 80px;">
                                        </div>
                                        <p style="margin-top: 10px; color: #888888; font-size: 14px;">추천지점 : &nbsp;&nbsp;강남점</p>
                                        <div style="background: #C4C4C4; border-radius: 10px; height: 157px; width: 100%; padding: 10px; margin-bottom: 5px;">
                                            <button type="button" class="btn" style="width: 100%; margin-bottom: 10px; text-align: left; font-weight: 700;">입출금 내역</button>
                                            <button type="button" class="btn" style="width: 100%; margin-bottom: 10px; text-align: left; font-weight: 700;">거래내역</button>
                                            <button type="button" class="btn" style="width: 100%; margin-bottom: 10px; text-align: left; font-weight: 700;">개인정보 설정</button>
                                        </div>
                                            <center>
                                                <a href="./logout.php" button type="button" class="btn" style="border-radius: 10px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25); box-sizing: border-box; border: 0.5px solid #FFFFFF; background: #f1f1f1; padding: 10px; height: 40px; width: 120px;">
                                                    로그아웃</a>
                                                </button>
                                            </center>
                                    </div>
                                </div>
                            </li>
                            ';
                    }else{
                        echo '
                            <div class="form-inline my-2 my-lg-0 btn_group_nav">
                                    <button type="button" class="btn btn-primary modal-popup-login">로그인</button>
                                    <button type="button" class="btn btn-primary text-white"><a href="./signup.php" class="btn-signup">회원가입</a></button>
                                </div>
                            </div>';
                    }
                ?>
            </ul>
            
        </span>
    </div>
    
</nav>
<div class="navbar-collapse-1-mobile">
    <div class="container-fluid mobile_nav_collapse">
        <!-- next line -->
        <div class="form-inline">
            <a href="./btc_usd.php" button type="button" class="btn-mob text-yellow">BTC/USD</a></button>
            <button type="button" class="btn-mob text-yellow">ETH/USD</button>
            <button type="button" class="btn-mob text-yellow">XRP/USD</button>
        </div>
        <!-- next line -->
        <div class="form-inline">
            <button type="button" class="btn-mob text-white"><a href="./notice.php" style="text-decoration: none; color: #FFFFFF;">공지사항</a></button>
            <button type="button" class="btn-mob text-white"><a href="./guide.php" style="text-decoration: none; color: #FFFFFF;">이용안내</a></button>
            <button type="button" class="btn-mob text-white"><a href="./inquiry.php" style="text-decoration: none; color: #FFFFFF;">1:1문의</a></button>
        </div>
        <!-- next line -->
        <div class="form-inline">
            <button type="button" class="btn-mob text-orange"><a href="./faq.php" style="text-decoration: none; color: #FFFFFF;">FAQ</a></button>
            <button type="button" class="btn-mob text-orange"><a href="./deposit.php" style="text-decoration: none; color: #FF9300;">입금신청</a></button>
            <button type="button" class="btn-mob text-orange">출금신청</button>
        </div>
    </div>
</div>
<div class="display_nonlog">
    <form method="POST" class="form_login_mobile">
        <div class="form-group text-left mt-4">
            <label for="accountid"><h5 class="text-yellow">아이디</h5></label>
            <input type="text" class="form-control textinput" id="m_account_code" name="account_code" placeholder="아이디를 입력해 주세요." autofocus>
        </div>
        <div class="form-group text-left mt-3">
            <label for="password"><h5 class="text-yellow">비밀번호</h5></label>
            <input type="password" class="form-control textinput" id="m_password" name="password" placeholder="비밀번호를 입력해 주세요.">
        </div>
        <div class="display_error text-center"></div>
        <div style="text-align:center">
            <button type="button" class="btn btn-user-blue btn-log text-white"><a href="./signup.php" class="text-white">로그인</a></button>
            <button type="submit" class="btn btn-user-orange btn-log text-white">회원가입</button>
        </div>
    </form>
</div>
<div class="display_log">
    <div style="text-align:center">
        <button type="button" class="btn btn-gray btn_log_mobile">닉네임닉네임닉 <img src="assets/icons/akar-icons_sound-on.png"></button>
        <p class="rec_point">추천지점 : 강남점</p>
        <div class="layout_bg">
            <button type="button" class="btn btn_log_mobile">입출금 내역</button>
            <button type="button" class="btn btn_log_mobile">거래내역</button>
            <button type="button" class="btn btn_log_mobile">개인정보 설정</button>
        </div>
        <a href="./logout.php" class="btn btn_log_mobile btn_logout">입출금 내역</a>
    </div>
</div>