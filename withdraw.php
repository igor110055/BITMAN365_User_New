    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/withdraw.js"
        );
    ?>
    <!-- header html -->
    <?php include __DIR__ . '/includes/head_html.php';?>
    <?php
        if(!$user->is_logged_in()){
            $user->redirect('./');
        }
    ?>
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
        .page-withdraw{
            padding: 20px 220px;
            width: 100%;
        }
        .div_layout .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 390px;
        }
        .div_layout_note .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 287px;
        }
        .card-header{
            background: #393E46;
            text-align: center;
            color: #FFF200;
            font-size: 32px;
            line-height: 38px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            border-radius: 10px 10px 0px 0px !important;
        }
        .div_layout, .div_layout_note{
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 5px;
            grid-template-columns: 48% 4% 48%;
            padding-bottom: 25px;
        }
        .div_layout .arrow_icon{
            padding: 10px;
            margin-top: auto;
            margin-bottom: auto;
        }
        .arrow_down_blue{
            display: none;
        }
        .arrow_left_blue{
            display: block;
        }
        .div_layout_note .card-header{
            background: #DDDDDE;
            color: #333333;
        }
        .btn_accountno,.btn_accountholder,.btn_amount{
            background: #888888;
            border-radius: 10px;
            width: 140px;
            height: 44px;
            color: #FFFFFF;
        }
        .bank,.accountno,.accountholder{
            background: #EEEEEE;
            border-radius: 10px;
            width: 100%;
            height: 44px;
            border: none;
            padding: 5px 10px;
        }
        .input_amnt{
            border-radius: 10px;
            width: 100%;
            height: 44px;
            background: #EEEEEE;
            border: 0.5px solid #888888;
            box-sizing: border-box;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            text-align: right;
            font-weight: 700;
            font-size: 20px;
            color: #1072BA;
        }
        .input_amnt::placeholder{
            text-align: right;
            color: #1072BA;
        }
        .inline_grp{
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 1rem;
            grid-template-columns: 30% 67%;
            padding: 10px 30px;
        }
        .btn_withdraw{
            background: #1072BA;
            border-radius: 10px;
            width: 140px;
            height: 50px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 8px 16px;
            margin-top: 5px;
            font-weight: 700;
            color: #FFFFFF;
        }
        .currentAcmount{
            float: right;
            width: 80%;
            background: #EEEEEE;
            border-radius: 10px;
            height: 44px;
            border: none;
            color: #888888;
            font-size: 20px;
            text-align: right;
            padding: 7px 15px;
        }
        .ntitle{
            width: 100%; 
            font-weight: 700;
            font-size: 20px;
        }
        .ntitleacc{
            width: 100%; 
            padding-top: 20px; 
            color: #1F8FAE; 
            font-weight: 700;
            font-size: 20px;
        }
        ol {
            padding: 5px 15px;
            counter-reset: item;
            list-style-type: none;
        }
        ol li:before {
            content: counter(item, decimal) '. ';
            counter-increment: item;
        }
        ol li{
            margin-bottom: 10px;
            color: #545454;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-size: 20px;
            line-height: 28px;
        }
        .arrow_down_orange{
            display: none;
        }
        .currentAcmount{
            color: #1F8FAE;
            font-weight: 700;
            font-size: 20px;
        }
        #modal-withdraw_alert,#modal-withdraw_submit{
            padding: 200px 100px;
        }
        #modal-withdraw_alert .modal-content,#modal-withdraw_submit .modal-content{
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            text-align: center;
        }
        #modal-withdraw_alert .modal-header,#modal-withdraw_submit .modal-header{
            border-bottom: none;
        }
        #modal-withdraw_alert .modal-footer,#modal-withdraw_submit .modal-footer{
            border-top: none;
        }
        #modal-withdraw_alert .btn_alert{
            background: #1072BA;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 150px;
            height: 44px;
            font-weight: 700;
            font-size: 24px;
            color: #FFFFFF;
        }
        #modal-withdraw_submit .btn_withdraw_save{
            background: #FF9300;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            font-weight: 700;
            font-size: 24px;
            padding: 10px 20px;
            width: 150px;
            color: #FFFFFF;
        }
        #modal-withdraw_submit .message{
            color: #FFFFFF;
            font-size: 28px;
        }
        #modal-withdraw_alert .close,#modal-withdraw_submit .close{
            color: #FFFFFF;
            font-size: 25px;
        }
        #modal-withdraw_submit .btn_amount{
            width: 120px;
        }
        .btn_title{
            border: none;
        }
        @media only screen and (max-width : 360px){
            body{
                background: #393E46;
            }
            .page-noticeguide{
                padding: 20px 20px;
                width: 100%;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .div_layout, .div_layout_note{
                grid-template-columns: 100%;
            }
            .div_layout .card{
                height: 100%;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
            .btn_accountno,.btn_accountholder,.btn_amount{
                width: 80px;
                padding: 5px 5px;
            }
            .div_layout .arrow_icon{
                padding: 10px;
                margin-left: auto;
                margin-right: auto;
            }
            .div_layout .arrow_down_blue{
                display: block;
            }
            .div_layout .arrow_left_blue{
                display: none;
            }
            ol li{
                font-size: 14px;
                line-height: 20px;
            }
            #modal-withdraw_alert,#modal-withdraw_submit{
                padding: 200px 20px;
            }
            #modal-withdraw_alert .modal-notif-title,#modal-withdraw_submit .modal-notif-title{
                font-size: 20px;
            }
            #modal-withdraw_alert .modal-notif-body,#modal-withdraw_submit .modal-notif-body{
                font-size: 16px;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
            #modal-withdraw_submit .modal-body{
                padding: 5px 5px;
            }
            #modal-withdraw_submit .btn_amount{
                width: 80px;
            }
            #modal-withdraw_submit .message{
                font-size: 16px;
            }
            #modal-withdraw_submit .btn_withdraw_save{
                padding: 10px 20px;
                font-size: 18px;
                width: 100px;
                height: 42px;
            }
        }
        @media screen and (max-width : 992px){
            .page-withdraw{
                padding: 20px 20px;
                width: 100%;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
        }
        @media screen and (min-width : 1200px){
            .page-withdraw{
                padding: 30px 30px;
                width: 100%;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
            .btn_accountno,.btn_accountholder,.btn_amount{
                width: 140px;
                padding: 5px 5px;
            }
            ol li{
                font-size: 16px;
                line-height: 20px;
            }
            .div_layout .card{
                height: 400px;
            }
            .div_layout_note .card{
                height: 420px;
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                display: grid;
                grid-gap: 5px;
                grid-template-columns: 46% 4% 49%;
                padding-bottom: 25px;
            }
            ol li{
                font-size: 18px;
                line-height: 20px;
            }
        }
        @media screen and (min-width : 1920px){
            .page-withdraw{
                padding: 30px 350px;
                width: 100%;
            }
            ol li{
                font-size: 12px;
                line-height: 15px;
            }
            .div_layout_note .card{
                height: 277px;
            }
        }
        @media only screen and (min-width: 480px) and (max-width: 768px){
            .page-withdraw{
                padding: 40px 10px;
                width: 100%;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
            .btn_accountno,.btn_accountholder,.btn_amount{
                width: 90px;
                padding: 5px 5px;
            }
            ol li{
                font-size: 16px;
                line-height: 20px;
            }
        }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <?php
        if(count($_SESSION)){
            echo '
                <div class="current_stocks_mobile">
                    <a href="#"><span class="current_stocks"><img src="assets/icons/dollar_mint.png" class="dollar_mint"><span class="cash_balance"></span> 원</span></a>
                </div>'
            ;
        }
    ?>

    <!-- registration Section -->
    <div class="page-withdraw">
        <div class="div_layout">
            <div class="card">
                <div class="card-header">
                    출금 신청하기
                </div>
                <div class="card-body">
                    <div class="inline_grp">
                        <button class="btn_title btn_accountno" type="button">은행</button>
                        <input type="text" class="bank" id="bank" disabled>
                    </div>
                    <div class="inline_grp">
                        <button class="btn_title btn_accountholder" type="button">출금 계좌</button>
                        <input type="text" class="accountno form-control" id="accountno" disabled>
                    </div>
                    <div class="inline_grp">
                        <button class="btn_title btn_accountholder" type="button">예금주</button>
                        <input type="text" class="accountholder form-control" id="accountholder" disabled>
                    </div>
                    <div class="inline_grp">
                        <button class="btn_title btn_amount" type="button">출금금액</button>
                        <input type="text" id="withdrawamount" name="withdrawamount" class="input_amnt form-control" placeholder="원">
                    </div>
                    <center><button class="btn btn_withdraw" type="button">입금 신청하기</button></center>
                </div>
            </div>
            <div class="arrow_icon">
                <img src="assets/icons/arrow_down_blue.png" alt="arrow" class="arrow_down_blue">
                <img src="assets/icons/arrow_left_blue.png" alt="arrow" class="arrow_left_blue">
            </div>
            <div class="card">
                <div class="card-header">
                    보유 금액
                </div>
                <div class="card-body">
                    <label class="ntitle">현재 보유 금액</label>
                    <div class="currentAcmount" style="color: #888888;"><span class="cash_balance" id="cashb"></span> 원</div>
                    <label class="ntitleacc">입금 후 예상 보유 금액</label>
                    <div class="currentAcmount"><span class="new_balance"></span> 원</div>
                </div>
            </div>
        </div>
        <div class="div_layout_note">
            <div class="card">
                <div class="card-header">
                    입금신청 이용방법
                </div>
                <div class="card-body">
                    <ol>
                        <li>출금 신청 전, 출금은행 및 계좌번호 확인</li>
                        <li>우측 상단의 “보유 금액"에서 출금 가능한 금액 확인</li>
                        <li>좌측 상단의 “입금 신청하기”에서 출금금액란에 원하시는 출금금액을 입력</li>
                        <li>출금 신청하기 버튼을 클릭</li>
                    </ol>
                </div>
            </div>
            <div class="arrow_icon"></div>
            <div class="card">
                <div class="card-header">
                    주의사항
                </div>
                <div class="card-body">
                    <ol>
                        <li>출금 신청 대상자(예금주)는 가입 시 본인인증을 통해 입력한 고객명을 기준으로 표시됩니다.</li>
                        <li>본인의 보유액을 다른 회원에게 양도 및 양수 할 수 없습니다.</li>
                        <li>입금액의 300% 거래 후에 출금이 가능합니다.</li>
                        <li>입금 후 10회 이상 거래가 이루어져야 출금이 가능합니다.</li>
                        <li>1회 출금 시, 2시간 후에 출금신청이 가능합니다.</li>
                        <li>1회 출금시 최대 5,000만원까지 가능하며, 1일 최대 1억원까지 출금이 가능합니다.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <?php include __DIR__ . '/includes/modal.php';?>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php';?>

    <!-- script -->
    <?php include __DIR__ . '/includes/script.php';?>

    </body>
</html>
