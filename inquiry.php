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
        table.inquiry tr{
            cursor: pointer;
        }
        table.inquiry tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
            padding-left: 40px;
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
        .inline_grp{
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 1rem;
            grid-template-columns: 20% 80%;
            padding: 10px 30px;
        }
        #modal-inquiry_submit{
            padding: 200px 100px;
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
        #modal-inquiry_submit .btn_title{
            background: #888888;
            border-radius: 10px;
            width: 100%;
            height: 44px;
            color: #FFFFFF;
        }
        #inquiry_title{
            background: #EEEEEE;
            box-sizing: border-box;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 100%;
            height: 44px;
        }
        #inquiry_details{
            background: #EEEEEE;
            box-sizing: border-box;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 100%;
            height: 210px;
        }
        #inquiry_details::placeholder,#inquiry_title::placeholder{
            text-align: left;
            color: #888888;
        }
        #modal-inquiry_submit .btn_inquiry_save{
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
                float: right;
                font-size: 14px; 
                padding: 0 10px;
            }
            #modal-inquiry_submit{
                padding: 200px 20px;
            }
            #modal-inquiry_submit .modal-notif-title{
                font-size: 20px;
            }
            #modal-inquiry_submit .modal-notif-body{
                font-size: 16px;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
            #modal-inquiry_submit .modal-body{
                padding: 5px 5px;
            }
            #modal-inquiry_submit .message{
                font-size: 16px;
            }
            #modal-inquiry_submit .btn_inquiry_save{
                padding: 10px 20px;
                font-size: 18px;
                width: 100px;
                height: 42px;
            }
        }
        @media screen and (max-width : 992px){
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
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
        }
        @media only screen and (min-width: 480px) and (max-width: 768px){
            .page-inquiry{
                padding: 40px 10px;
                width: 100%;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
        }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

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
