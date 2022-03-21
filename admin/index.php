<?php
    include_once '../php/config/Database.php';
    include_once '../php/class/Users.php';
    include_once '../php/class/Admin.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $query = new Admin($db);

    if(!$user->is_logged_in()){
        $user->redirect('../');
    }

    $stmt = $query->getReserveGameResult();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Cache-control" content="no-cache">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../plugins/jquery-confirm-3.3.2/css/jquery-confirm.min.css">
        <link rel="stylesheet" href="../plugins/iziToast-master/dist/css/iziToast.min.css">
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
        
        <title>BITMAN365</title>
        <?php
            if (isset($linkcss) || is_array(@$linkcss)) {
                foreach ($linkcss as $css) {
                    echo "<link href='$css'  rel='stylesheet'>";
                }
            }
        ?>
        <style>
            body{
                background: #444444;
                padding-left: 240px;
                padding-right: 240px;
            }
            .container-fluid{
                background: #444444;
                border: 5px solid rgb(0,0,0,0.5);
                height: 1080px;
                padding: 10px;
            }
            .top_header {
                display: grid;
                grid-template-columns: 14.28% 14.28% 14.28% 14.28% 14.28% 14.28% 14.28%;
                grid-gap: 0;
                grid-auto-flow: row dense;
            }
            .header_data{
                display: grid;
                grid-template-columns: 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33% 8.33%;
                grid-gap: 0.3em 0.1em;
                grid-auto-flow: row dense;
            }
            .bcontent {
                display: grid;
                grid-template-columns: 35% 65%;
                grid-gap: 0;
                grid-auto-flow: row dense;
                text-align: center;
                font-size: 8px;
            }
            .data_content{
                display: grid;
                grid-template-columns: 20% 80%;
                grid-gap: 0.5em 0.5em;
                grid-auto-flow: row dense;
                padding-right: 8px;
            }
            .top_header{
                border: 1px solid rgb(0,0,0,0.5);
                box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.3);
                border-radius: 4px;
                width: 100%;
            }
            .content_title{
                text-align: center; 
                color: #FFFFFF; 
                border: 1px solid #333333; 
                background: #444444;
                font-size: 12px;
                height: 25px;
                padding: 3px;
            }
            .kcontent{
                background: #666666;
                border: 1px solid #333333;
                font-size: 12px; 
                color: #FFF200; 
                padding: 2px;
                height: 25px;
            }
            .kcontentp{
                background: #666666;
                border: 1px solid #333333; 
                font-size: 12px; 
                padding: 2px; 
                width: 100%; 
                color: #FFFFFF;
                text-align: right;
            }
            #admin{
                color: #FFFFFF;
                font-size: 18px;
                padding: 5px;
            }
            #display_date{
                color: #FFFFFF;
                font-size: 12px;
            }
            #display_time{
                color: #FFFFFF;
                font-size: 18px;
            }
            .body_content{
                padding: 0;
            }
            .header_list{
                color: #FFFFFF; 
                font-size: 14px; 
                text-align: center;
            }
            .btn_header{
                width: 100%;
                color: #FFFFFF;
                border: 1px solid #FFFFFF;
                border-radius: 6px;
            }
            .header_list{
                padding-top: 5px;
            }
            .header_details{
                padding: 10px; 
                background: #333333; 
                border-radius: 4px; 
                margin-bottom: 5px;
            }
            .data_list{
                background: #333333; 
                border-radius: 4px; 
                font-size: 12px;  
                color: #777777; 
                font-weight: 700; 
                height: 900px;
            }
            .data_list table, .data_list table th{
                border-top: 1px solid #222222;
                border-bottom: 1px solid #222222;
                border-left: 1px solid #222222;
                border-right: 1px solid #222222;
                text-align: center;
                color: #FFFFFF;
                font-size: 14px;
                background: #555555;
                font-weight: normal;
            }
            .data_list table, .data_list table td{
                border-top: 1px solid #222222;
                border-bottom: 1px solid #222222;
                border-left: 1px solid #222222;
                border-right: 1px solid #222222;
                text-align: center;
                color: #FFFFFF;
                font-size: 14px;
                background: #666666;
                font-weight: normal;
            }
            a.logoff,a.lsidebar{
                color: #666666;
            }
            a.logoff:hover { 
                color: #ED5459; 
            }
            a.lsidebar.active{
                color: #FFF200;
            }
            a.lsidebar:hover{
                text-decoration: none;
                color: #FFF200;
            }
            @media only screen  and (min-width : 1200px) {
                body{
                    background: #444444;
                    padding-left: 100px;
                    padding-right: 100px;
                }
                .kcontent,.kcontentp{
                    font-size: 9px;
                }
            }
            @media only screen  and (min-width : 1920px) {
                body{
                    background: #444444;
                    padding-left: 240px;
                    padding-right: 240px;
                }
                .kcontent,.kcontentp{
                    font-size: 12px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-1 text-center">
                    <span id="admin">ADMIN</span><br>
                    <span id="display_date" style="text-align: center;"></span><br>
                    <span id="display_time"></span>
                </div>
                <div class="col-md-11">
                    <div class="top_header">
                        <div class="body_content">
                            <div class="content_title">회원보유</div>
                            <div class="bcontent">
                                <div class="kcontent">전일보유</div>
                                <div class="kcontentp">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">전일보유</div>
                                <div class="kcontentp">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">차액</div>
                                <div class="kcontentp">100,000,000,000</div>
                            </div>
                        </div>
                        <div class="body_content">
                            <div class="content_title">입금/출금</div>
                            <div class="bcontent">
                                <div class="kcontent">당일입금</div>
                                <div class="kcontentp" style="color: #78A6FF;">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">당일출금</div>
                                <div class="kcontentp" style="color: #FF787B;">0</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">차액</div>
                                <div class="kcontentp" style="color: #78A6FF;">100,000,000,000</div>
                            </div>
                        </div>
                        <div class="body_content">
                            <div class="content_title">입금/출금</div>
                            <div class="bcontent">
                                <div class="kcontent">당일입금</div>
                                <div class="kcontentp" style="color: #FF787B;">0</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">당일회수</div>
                                <div class="kcontentp" style="color: #78A6FF;">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">차액</div>
                                <div class="kcontentp" style="color: #78A6FF;">100,000,000,000</div>
                            </div>
                        </div>
                        <div class="body_content">
                            <div class="bcontent">
                                <div class="kcontent" style="background: #444444;">BTC대기</div>
                                <div class="kcontentp" style="color: #FFFFFF">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent"  style="color: #FF787B;">실현</div>
                                <div class="kcontentp" style="color: #FF787B;">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent" style="color: #78A6FF;">실격</div>
                                <div class="kcontentp" style="color: #78A6FF;">0</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">차액</div>
                                <div class="kcontentp" style="color: #FF787B;">100,000,000,000</div>
                            </div>
                        </div>
                        <div class="body_content">
                            <div class="bcontent">
                                <div class="kcontent" style="background: #444444;">ETH대기</div>
                                <div class="kcontentp" style="color: #FFFFFF">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent"  style="color: #FF787B;">실현</div>
                                <div class="kcontentp" style="color: #FF787B;">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent" style="color: #78A6FF;">실격</div>
                                <div class="kcontentp" style="color: #78A6FF;">0</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">차액</div>
                                <div class="kcontentp" style="color: #FF787B;">100,000,000,000</div>
                            </div>
                        </div>
                        <div class="body_content">
                            <div class="bcontent">
                                <div class="kcontent" style="background: #444444;">XRP대기</div>
                                <div class="kcontentp" style="color: #FFFFFF">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent"  style="color: #FF787B;">실현</div>
                                <div class="kcontentp" style="color: #FF787B;">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent" style="color: #78A6FF;">실격</div>
                                <div class="kcontentp" style="color: #78A6FF;">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">차액</div>
                                <div class="kcontentp" style="color: #78A6FF;">0</div>
                            </div>
                        </div>
                        <div class="body_content">
                            <div class="bcontent">
                                <div class="kcontent" style="background: #444444;">총회원수</div>
                                <div class="kcontentp" style="color: #FFFFFF">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">접속회원</div>
                                <div class="kcontentp" style="color: #FFFFFF;">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">당일신규</div>
                                <div class="kcontentp" style="color: #FFFFFF;">100,000,000,000</div>
                            </div>
                            <div class="bcontent">
                                <div class="kcontent">당일이용</div>
                                <div class="kcontentp" style="color: #FFFFFF;">100,000,000,000</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_details">
                <div class="header_data">
                    <div class="header_list">회원관리</div>
                    <div class="header_list">배팅관리</div>
                    <div class="header_list" style="color: #FFF200;">마감관리</div>
                    <div class="header_list">입출금관리</div>
                    <div class="header_list">정산관리</div>
                    <div class="header_list">고객센터</div>
                    <div class="header_list">환경설정</div>
                    <div></div>
                    <div><button type="button" class="btn btn-sm btn_header" style="background: #3BDE42;">999+</button></div>
                    <div><button type="button" class="btn btn-sm btn_header" style="background: #0093FF;">999+</button></div>
                    <div><button type="button" class="btn btn-sm btn_header" style="background: #ED5659;">999+</button></div>
                    <div style="text-align: right; padding-right: 20px;"><a href="../logout.php" class="logoff"><i class="fa fa-power-off fa-2x"></i></a></div>
                </div>    
            </div>
            <div class="data_content">
                <div class="data_list">
                    <div style="padding: 7px; font-size: 16px;">마감관리</div>
                    <ul style="list-style: disc;" class="dashed">
                        <li style="color: #FFF200;"><a href="./" class="lsidebar active">마감예약</a></li>
                        <li><a href="./btcusd_history.php" class="lsidebar">BTC/USD 내역</a></li>
                        <li>ETH/USD 내역</li>
                        <li>XRP/USD 내역</li>
                    </ul>
                </div>
                <div class="data_list">
                    <div style="color: #FF9300; padding: 7px; font-size: 16px;">리스트</div>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="height: 10px;" rowspan="2">종목</th>
                                <th rowspan="2">계약시간</th>
                                <th rowspan="2">배당</th>
                                <th colspan="2">마감예약</th>
                                <th rowspan="2">마감예약결과</th>
                                <th rowspan="2">예약취소</th>
                            </tr>
                            <tr>
                                <th>매수</th>
                                <th>매도</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-timezone-with-data.min.js"></script>
    <script src="../plugins/jquery-confirm-3.3.2/js/jquery-confirm.min.js"></script>
    <script src="../plugins/iziToast-master/dist/js/iziToast.min.js"></script>
    <script src="../assets/js/admin/admin.js"></script>
    <?php
        if (isset($scriptjs) || is_array(@$scriptjs)) {
            foreach ($scriptjs as $js) {
                echo "<script src='$js'></script>";
            }
        }
    ?>
    </body>
</html>