    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/notice.js"
        );
    ?>
    <!-- header html -->
    <?php include __DIR__ . '/includes/head_html.php';?>
    
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
        .page-notice{
            padding: 20px ;
            width: 100%;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
            width: 109%;
            margin-left: -4%;
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
        table.notice tr{
            cursor: pointer;
        }
        table.notice tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
            padding: 10px 70px;
            font-size: 14px;
            font-weight: 500;
        }
        @media only screen and (max-width : 360px){
            .page-noticeguide{
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
                padding: 3px;
            }
            .body-header table tr th, .body-header table tr td{
                font-size: 12px;
            }
        }
        @media screen and (max-width : 992px){
            .page-notice{
                padding: 20px 20px;
                width: 100%;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .body-header table tr th, .body-header table tr td{
                font-size: 12px;
            }
        }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <!-- registration Section -->
    <div class="container page-notice">
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
