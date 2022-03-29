    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/faq.js"
        );
    ?>
    <!-- header html -->
    <?php include __DIR__ . '/includes/head_html.php';?>
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
        .page-faq{
            padding: 20px 220px;
            width: 100%;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 680px;
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
        table.faq tr{
            cursor: pointer;
        }
        table.faq tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
            font-size: 14px;
            font-weight: 500;
        }
        .fixed-position {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
        @media only screen and (max-width : 360px){
            .page-faq{
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
            .card table.faq{
                height: 400px;
            }
            .body-header table tr th, .body-header table tr td{
                font-size: 12px;
            }
            .body-header table tr td{
                font-size: 2px;
            }
        }
        @media screen and (max-width : 992px){
            .page-faq{
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
        }
        @media only screen and (min-width: 480px) and (max-width: 768px){
            .page-faq{
                padding: 40px 10px;
                width: 100%;
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
    <!-- registration Section -->
    <div class="container page-faq">
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
