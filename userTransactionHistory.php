    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/transaction.js"
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
        .page-transactionlist{
            padding: 20px 0;
            width: 100%;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
            width: 104%;
            margin-left: -2%;
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
        table.usertransaction tr{
            cursor: pointer;
        }
        table.usertransaction tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
            font-size: 14px;
            font-weight: 500;
        }



        @media only screen and (min-width: 360px) and (max-width: 768px){
        
            .current_stocks_mobile{
                font-size: 16px;
                font-family: Tahoma, sans-serif;
                font-weight: 600;
                height: 46px;
            }
            .current_stocks_mobile .current_stocks{
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 20px;
                line-height: 23px;
                color: #FFFFFF;
            }
            .dollar_mint{
                width: 32px;
                height: 32px;
                margin: 2%;
                
            }
            .footer_brand .footer_logo{
                font-size: 30px;
                font-weight: 600;
                margin-top: -30%;
                font-family: Tahoma, sans-serif;
            }
            .display_log .btn_log_mobile{
                display: flex;
                flex-direction: row;
                align-items: center;
                padding: 8px 8px 8px 16px;
                position: absolute;
                width: 245px;
                height: 44px;
                left: 57px;
                top: 116px;
                background: #F7F7F7;
                border-radius: 10px;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                font-size: 16px;
                line-height: 19px;
                padding-left: 16px;
                font-width: 104px;
            }
            .display_log .layout_bg{
                position: absolute;
                width: 245px;
                height: 164px;
                left: 57px;
                top: 204px;
                background: #C4C4C4;
                border-radius: 10px;

            }
            .display_log .rec_point{
                font-size: 14px;
                height: 10px;
                margin-top: 33px;
                font-family: 'Roboto';
                
            }
            .layout_bg .btn_withdraw_deposit{
                align-items: center;
                padding: 8px 8px 8px 16px;
                width: 231px;
                height: 44px;
                left: 64px;
                background: #EEEEEE;
                border-radius: 10px;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                font-size: 16px;
                line-height: 19px;
                color: #333333;
                padding-top: 12.5px;
                padding-left: 16px;
                

            }
            .layout_bg .btn_transaction_history{
                align-items: center;
                padding: 8px 8px 8px 16px;
                width: 231px;
                height: 44px;
                left: 64px;
                margin-top: 3%;
                background: #EEEEEE;
                border-radius: 10px;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                font-size: 16px;
                line-height: 19px;
                color: #333333;
                padding-top: 12.5px;
                padding-left: 16px;
            }
            .layout_bg .btn_privacy_settings{
                align-items: center;
                padding: 8px 8px 8px 16px;
                width: 231px;
                height: 44px;
                left: 64px;
                margin-top: 3%;
                background: #EEEEEE;
                border-radius: 10px;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                font-size: 16px;
                line-height: 19px;
                color: #333333;
                padding-top: 12.5px;
                padding-left: 16px;
            }
        
            .logout_mobile .btn_logout_mobile{
                background: transparent;
                border-radius: 10px;
                border: 1px solid #FFFFFF;
                width: 98px;
                height: 36px;
                color: #888888;
                text-align: center;
                font-size: 16px;
                position: absolute;
                left: 131px;
                top: 392px;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
            }





        .body-header table tr th{
            text-align: center;
            background: #DDDDDE;
            font-size: 1px;
        }
        body::-webkit-scrollbar{
            display: none;
        }
        .page-history{
            padding: 10px 0;
            width: 100%;
        }
        .card{
            margin: 2.5%;
            width: 95%;
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 470px;
            padding-bottom: 10px;
        }
        .card-header{
            background: #393E46;
            text-align: center;
            color: #FFF200;
            font-size: 16px;
            line-height: 15px;
            font-family: 'Roboto';
            border-radius: 10px 10px 00px 0px !important;
        }
    
        .body-header table tr th{
            text-align: center;
            background: #DDDDDE;
            font-size: 8px;
            line-height: 5px;
        
        }
        .body-header table tr td{
            text-align: center;
            font-size: 8px;
            background: #FFFFFF;
        }
    
}
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>
    <!-- header -->
    <!-- registration Section -->
    <div class="container page-transactionlist">
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
