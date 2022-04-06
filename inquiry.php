    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/inquiry.js"
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
        .page-inquiry{
            padding: 20px 220px;
            width: 100%;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
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
            border-radius: 10px 10px 00px 0px !important;
        }
        .body-header{
            padding: 5px;
        }
        .body-header table tr th{
            text-align: center;
            background: #DDDDDE;
            font-size: 20px;
        }
        .body-header table tr td{
            text-align: center;
            font-size: 16px;
            background: #FFFFFF;
        }
        table.inquiry tr{
            cursor: pointer;
        }
        table.inquiry tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
            font-size: 14px;
            font-weight: 500;
        }
        .inq_reg{
            float: right; 
            background: #0093FF; 
            border-radius: 5px; 
            font-size: 16px; 
            padding: 2px 20px; 
            border: none; 
            cursor: pointer; 
            color: #FFFFFF;
        }
        .inq_toggle{
            display: none;
        }
        .inline_grp{
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 1rem;
            grid-template-columns: 20% 75%;
            padding: 10px 30px;
        }
        #modal-inquiry_submit .modal-content{
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            text-align: center;
        }
        #modal-inquiry_submit .modal-header{
            border-bottom: none;
        }
        #modal-inquiry_submit .modal-footer{
            border-top: none;
        }
        #modal-inquiry_submit .btn_title,.display_inquiry .btn_title{
            background: #888888;
            border-radius: 10px;
            width: 100%;
            height: 44px;
            color: #FFFFFF;
            cursor: default;
            padding: 5px 5px;
        }
        #inquiry_title,#inquiry_title_i{
            background: #EEEEEE;
            box-sizing: border-box;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 100%;
            height: 44px;
        }
        #inquiry_details,#inquiry_details_i{
            background: #EEEEEE;
            box-sizing: border-box;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 100%;
            height: 210px;
        }
        #inquiry_details::placeholder,#inquiry_title::placeholder,#inquiry_title_i::placeholder,#inquiry_details_i::placeholder{
            text-align: left;
            color: #888888;
        }
        #modal-inquiry_submit .modal-notif-title{
            color: #FFFFFF;
        }
        #modal-inquiry_submit .btn_inquiry_save,.display_inquiry .btn_inquiry_save{
            background: #1072BA;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            font-weight: 700;
            font-size: 24px;
            padding: 10px 20px;
            width: 150px;
            color: #FFFFFF;
        }
        #modal-inquiry_submit .close{
            color: #FFFFFF;
            font-size: 25px;
        }
        .display_inquiry{
            display: none;
            background: #393E46;
            z-index: 1;
            width: 100%;
            height:500px;
            padding: 40px 20px 0 20px;
        }
        .display_inquiry .toggle-close{
            margin-top: -30px;
            color: #FFFFFF;
            font-size: 30px;
            float: right;
        }
        .fixed-position {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
        .errortitle,.errordetails,.errortitle_i,.errordetails_i{
            color: #ED5659;
            text-align: left;
        }
        @media only screen and (max-width : 360px){
            .page-inquiry{
                padding: 20px 20px;
                width: 100%;
            }
            .card-header{
                font-size: 22px;
                padding: 5px 20px;
            }
            .body-header table tr th, .body-header table tr td{
                font-size: 12px;
            }
            .inq_reg{
                display: none;
                float: right;
                font-size: 14px; 
                padding: 0 10px;
            }
            .display_inquiry .btn_inquiry_save{
                padding: 10px 20px;
                font-size: 18px;
                width: 100px;
                height: 42px;
            }
            .display_inquiry{
                padding: 25px 5px;
            }
            .inq_toggle{
                display: block;
                float: right; 
                background: #0093FF; 
                border-radius: 5px; 
                font-size: 16px; 
                padding: 2px 20px; 
                border: none; 
                cursor: pointer; 
                color: #FFFFFF;
            }
            .display_inquiry .modal-notif-title,#modal-inquiry_submit .modal-notif-title{
                color: #FFF200;
                text-align: center;
            }
            .display_inquiry .btn_title{
                font-size: 14px;
                width: 70px;
                padding: 2px 2px;
            }
            .display_inquiry .toggle-close{
                padding-top: 22px;
                padding-right: 15px;
            }
            .inline_grp{
                grid-template-columns: 20% 75%;
            }
            .body-header table tr td{
                font-size: 2px;
            }
        }
        @media screen and (max-width : 992px){
            .page-inquiry{
                padding: 20px 20px;
                width: 100%;
            }
            .card{
                height: 451px;
            }
            .card #pagination{
                padding-bottom: 10px;
            }
            .card-header{
                font-size: 22px;
                padding: 5px 20px;
            }
            .body-header table tr th, .body-header table tr td{
                font-size: 12px;
            }
            .inline_grp{
                grid-template-columns: 20% 75%;
                padding: 5px 10px;
            }
            #modal-inquiry_submit .modal-notif-title{
                color: #FFFFFF;
            }
        }
        @media only screen and (min-width: 480px) and (max-width: 768px){
            .page-inquiry{
                padding: 40px 10px;
                width: 100%;
            }
            .inline_grp{
                grid-template-columns: 20% 75%;
                padding: 20px 10px;
            }
            #modal-inquiry_submit .modal-notif-title{
                color: #FFFFFF;
            }
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
    <div class="display_inquiry">
        <span class="toggle-close">&times;</span>
        <div class="container">
            <h4 class="modal-title mt-n4 mb-2 modal-notif-title mb-3">1:1 문의하기</h4>
            <form class="formInquiryMobile" method="POST">
                <div class="inline_grp">
                    <button class="btn btn_title" type="button">제목</button>
                    <input type="text" id="inquiry_title_i" name="inquiry_title" placeholder="제목을 입력해 주세요." class="form-control">
                    <div class="errortitle_i"></div>
                </div>
                <div class="inline_grp">
                    <button class="btn btn_title" type="button">문의내용</button>
                    <textarea type="text" id="inquiry_details_i" name="inquiry_details" placeholder="문의내용을 입력해 주세요." class="form-control"></textarea>
                    <div class="errordetails_i"></div>
                </div>
                <center><button class="btn btn_inquiry_save" type="submit">확인</button></center>
            </form>
        </div>
    </div>
    <!-- registration Section -->
    <div class="container page-inquiry">
        <div id="pagination-result">
            <input type="hidden" name="rowcount" id="rowcount" />
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
