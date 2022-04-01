
<!-- header html -->
<?php
    $linkcss = array(
        "plugins/jquery-confirm-3.3.2/css/jquery-confirm.min.css",
    );
    $scriptjs = array(
        "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js",
        "https://momentjs.com/downloads/moment-timezone-with-data.min.js",
        "https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js",
        "plugins/jquery-confirm-3.3.2/js/jquery-confirm.min.js",
        "assets/js/admin/candle_chart.js",
        "assets/js/admin/betting.js",
        "assets/js/register.js",
    );

?>
<?php include __DIR__ . '/includes/head_html.php';?>
<?php
    if(!$user->is_logged_in()){
        $user->redirect('./');
    }
?>
    <style>
        
        .navbar-collapse-1-mobile{
            padding: 200px 20px 0 20px;
        }
        .display_log{
            padding: 200px 50px 0 50px;
            margin: 0;
        }
        .chr{
            width: 100% !important;
            height:600px !important;
        }
        .timeclock{
            color: #FF9300;
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            padding-left: 30px;
        }
        .container_chart {
            position: relative;
            text-align: center;
            border-radius: 0px 0px 10px 10px;
        }
        .cont_opacity{
            background: rgb(0,0,0,0.7);
        }
        /* .display_result{
            display: none;
        } */
        
        /* .text_result {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #FFFFFF;
            font-weight: 700;
            font-size: 32px;
            z-index: 2;
            display: block;
        } */
        
        .nav-pills { 
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 0rem;
            height: 40px;
            grid-template-columns: 52% 50%;
        }
        .nav-pills .nav-link{
            font-weight: bold;
            padding-top: 13px;
            text-align: center;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            height: 48px;
        }
        .nav-pills .result{
            background: #888888;
            color: #FFFFFF;
            font-size: 20px;
            
        }
        .nav-pills .result.active{
            background: #393E46;
            color: #FFF200;
            font-size: 20px;
            
        }
        .nav-pills .history{
            background: #888888;
            color: #FFFFFF;
            font-size: 20px;
            
        }
        .nav-pills .history.active{
            background: #393E46;
            color: #FFF200;
            font-size: 20px;
            
        }
        .btc_header_trade .nav-pills .nav-item .nav-link:hover::after {
            transform: scaleX(0);
        }
        .tab-content{
            width: 100%;
            height: auto;
        }
        .tab-pane{
            margin-top: -19px; 
            margin-left: -19px; 
            margin-right: -19px; 
            margin-bottom: -30px; 
        }
        .tab-pane table th,.tab-pane table td{
            height: 36px;
            text-align: center;
            font-weight: 700;
        }
        .tab-pane table th{
            background: #DDDDDE;
        }
        #result table {
            border-collapse: collapse;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .card-body{
            height: 576px;
            overflow: auto;
        }
        .container_data{
            height: 576px;
            overflow-x: auto;
            margin: 0;
            
        }
        .display_trade_group{
            
        }
        .trend_output{
            border-radius: 100px;
            color: #FFFFFF;
            width: 40px;
            height: 40px;
            margin: 3px;
            padding: 0;
            text-align: center;
            font-size: 12px;
        }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <!-- header -->
    <?php
        if(count($_SESSION)){
            echo '
                <div class="current_stocks_mobile">
                    <a href="#"><span class="current_stocks"><img src="assets/icons/dollar_mint.png" class="dollar_mint"><span class="cash_balance"></span> 원</span></a>
                </div>'
            ;
        }
    ?>
    <!-- btc Section -->
    <div class="page_btc">
        <div class="game_grid">
            <div class="game_details">
                <div class="game_title">
                    비트코인 BTC / USD 1분
                    <span class="game_title_timer">남은 거래 시간 : <span class="initializeTime"><span class="timeclock"></span></span></span>
                </div>
                <div class="game_field">
                    <div class="candle_chart_field">
                        <div id="candle_chart" style="width: 100%; height: 100%;"></div>
                    </div>
                    <div class="text_result">
                        <p class="result_title">거래 결과</p>
                        <div class="result_field">
                            <table class="result_table">
                                <tr>
                                    <td class="rfchild">결정시간</td>
                                    <td class="rmid"></td>
                                    <td class="rlchild time_result"></td>
                                </tr>
                                <tr style="height: 10px;"><td></td></tr>
                                <tr>
                                    <td class="rfchild">결정시간</td>
                                    <td class="rmid"></td>
                                    <td class="rlchild price_result"></td>
                                </tr>
                            </table>
                            <p id="text_title_result"></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div>남은 거래 시간 : <span class="initializeTime"><span class="mtimeclock"></span></span></div>
                </div>
            </div>
            <div class="betting_details">
                <div class="betting_title">
                    TRADING
                </div>
                <div class="betting_field">
                    <table class="betting_table">
                        <tr>
                            <td class="fchild">계약시간</td>
                            <td class="lchild" id="datetoday"></td>
                        </tr>
                        <tr>
                            <td class="fchild">투자종목</td>
                            <td class="lchild">BTC/USD 1분</td>
                        </tr>
                        <tr>
                            <td class="fchild">실현실격</td>
                            <td class="lchild"><img src="assets/icons/ic_baseline-plus-minus.png"> 1 USD</td>
                        </tr>
                        <tr>
                            <td class="fchild">실현실격</td>
                            <td class="lchild cblance"><span class="cash_balance"></span> 원</td>
                        </tr>
                        <tr style="background: #DDDDDE;">
                            <td class="fchild fchild1">예상실현금액</td>
                            <td class="lchild"><input type="text" placeholder="0 원" id="totalBetAmount" disabled></td>
                        </tr>
                        <tr style="background: #DDDDDE;">
                            <td colspan="2" class="lchild acomp">x 1.95</td>
                        </tr>
                        <tr style="background: #DDDDDE;">
                            <td class="fchild fchild1">체결거래금액</td>
                            <td class="ablchild">
                                <input type="text" placeholder="0 원" id="betAmount" class="betAmount">
                                <span class="bchild">최소거래금액 :</span>
                                <span class="bchild pull-right">5,000원</span><br>
                                <span class="bchild">최대거래금액 :</span>
                                <span class="bchild pull-right">5,000,000원</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="btn_child text-center">
                                <button type="button" id="bet5k" value="5000" class="btn bet_orange btn_dis">5,000원</button>
                                <button type="button" id="bet10k" value="10000" class="btn bet_orange btn_dis">10,000원</button>
                                <button type="button" id="bet50k" value="50000" class="btn bet_orange btn_dis">50,000원</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="btn_child text-center">
                                <button type="button" id="bet100k" value="100000" class="btn bet_orange btn_dis">100,000원</button>
                                <button type="button" id="bet500k" value="500000" class="btn bet_orange btn_dis">500,000원</button>
                                <button type="button" id="editField" class="btn bet_mint_green btn_dis">정정</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="btn_child text-center">
                                <button type="button" id="sellBtn" class="btn bet_red btn_dis">매수 신청</button>
                                <button type="button" id="buyBtn" class="btn bet_blue btn_dis">매도 신청</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="game_list" id="reloadPage">
            <div class="game_details">
                <div class="game_title">
                    비트코인 BTC / USD 출목표
                </div>
                <div class="user_field_group" id="container_data">
                    <table style="width: 100%;">
                        <span id="display_trade_group"></span>
                    </table>
                </div>
            </div>
            <div class="user_details">
                <div class="user_title">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link result active" data-toggle="pill" href="#result">거래 결과</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link history" data-toggle="pill" href="#history">나의 거래내역</a>
                        </li>
                    </ul>
                </div>
                <div class="user_field">
                    <div class="tab-content" style="overflow-y: scroll; height: 250px;">
                        <div id="result" class="tab-pane active">
                            <div class="table-responsive" style="padding: 28px 19px;">
                                <table class="table table-striped table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th>계약시간</th>
                                            <th>시가</th>
                                            <th>결과</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="history" class="tab-pane fade">
                            <div class="table-responsive" style="padding: 28px 19px;">
                                <table class="table table-striped table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th>계약시간</th>
                                            <th>구분</th>
                                            <th>체결대금</th>
                                            <th>결과</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_history">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card_item">
                <div class="card btc_header_trade">
                    <div class="c_header_trade" style="text-align: center; padding-top: 8px;">비트코인 BTC / USD 출목표</div>
                </div>
                <div class="container_data" id="container_data">
                    <table>
                        <span id="display_trade_group"></span>
                    </table>
                </div>
            </div>
            <div class="card_item">
                <div class="card btc_header_trade">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link result active" data-toggle="pill" href="#result">거래 결과</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link history" data-toggle="pill" href="#history">나의 거래내역</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div id="result" class="tab-pane active">
                            <table class="table table-striped table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>계약시간</th>
                                        <th>시가</th>
                                        <th>결과</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                        <div id="history" class="tab-pane fade">
                            <table class="table table-striped table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>계약시간</th>
                                        <th>구분</th>
                                        <th>체결대금</th>
                                        <th>결과</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_history">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    
    <!-- modal -->
    <?php include __DIR__ . '/includes/modal.php';?>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php';?>

    <!-- script -->
    <?php include __DIR__ . '/includes/script.php';?>
    <script>
        function display_time() {
            display_counter();
        }
        function display_counter(){
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('datetime_today()',refresh)
        }
        function datetime_today(){
            var date = new Date();
            var d = date.getDate().toString().substr(-2);
            var h = ("0" + date.getHours()).substr(-2);
            var m = ("0" + date.getMinutes()).substr(-2);
            var formattedTime = d + '일 ' + h + '시 '+ m + '분';

            $('#datetoday').text(formattedTime);
        }
        display_counter();
        datetime_today();
    </script>
    </body>
</html>
