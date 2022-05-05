    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/privacy.js"
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
        .page-deposit{
            width: 100%;
            padding: 20px 250px;
        }
        .div_layout .card,.div_layout_note .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 700px;
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
            grid-template-columns: 50% 5% 50%;
            padding-bottom: 30px;
        }
        .div_layout .arrow_icon{
            padding: 10px;
            margin-top: auto;
            margin-bottom: auto;
        }
        .div_layout_note .card-header{
            background: #DDDDDE;
            color: #333333;
        }
        .btn_id{
            background: #888888;
            border-radius: 10px;
            width: 154px;
            height: 44px;
            color: #FFFFFF;
            margin: 15% 5% 0%;

        }
        .btn_nickname{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 3% 4%;

        }
        .btn_currentpass{
            background: #888888;
            border-radius: 10px;
            width: 150px;
            height: 44px;
            color: #FFFFFF;
            margin: 0% 5%;
        }
        .btn_accountholder{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 3% 4%;
        }
        .btn_accountbank{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 0% 4%;
        }
        .btn_accountnumber{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 3% 4%;
        }
        .btn_recommendedpoint{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 0% 4%;
        }
       
       
        .accountid{
            width: 100%;
            height: 44px;
            border: none;
            margin: 15% 0% 0%;
            background: #EEEEEE;
        }
        
        .accountnickname{
            background: 
            width: 100%;
            height: 44px;
            border: none;
            margin: 3% 0% 0% 0%;
            background: #EEEEEE;
        }

        .accountholder{
            width: 100%;
            height: 44px;
            border: none;
            background: #EEEEEE;
            margin: 3% 0% 0% 0%;
        }
        .accountbank{
            width: 100%;
            height: 44px;
            border: none;
            margin: 0% 0% 0% 0%;
        }
        .accountno{
            width: 100%;
            height: 44px;
            border: none;
            margin: 3% 0% 0% 0%;
        }
        .recommendedpoint{
            width: 100%;
            height: 44px;
            border: none;
            margin: 0% 0% 0% 0%;
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
            font-weight: 700;
            font-size: 20px;
            color: #FF9300;
        }
        .input_amnt::placeholder{
            
        }
        .inline_grp{
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 1rem;
            grid-template-columns: 30% 67%;
            padding: 10px 30px;
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
        .arrow_left_orange{
            display: block;
        }
        .currentAcmount{
            color: #1F8FAE;
            font-weight: 700;
            font-size: 20px;
        }
     
       #modal-change_password .modal-footer{
            border-top: none;
        }
        #modal-change_password .btn_alert{
            background: #1072BA;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 150px;
            height: 44px;
            font-weight: 700;
            font-size: 24px;
            color: #FFFFFF;
        }
        
        #modal-change_password .message{
            color: #FFFFFF;
            font-size: 14px;
        }
        #modal-change_password .close{
            color: #FFFFFF;
            font-size: 25px;
        }
      

        @media only screen and (max-width : 360px){
            body{
                background: #393E46;
            }
           
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 100%;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 5%;
                font-size: 12px;
                letter-spacing: -3px;
            }
           
           
            #modal-change_password .modal-title{
                font-weight: 500;
                font-size: 2px;
                margin: -10%;
            }
            #modal-change_password .modal-content{
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                
            }
            #modal-change_password .modal-header{
                border-bottom: none;
            }
            #modal-change_password .btn_currpassword{
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 4% -20%;
            }
            #modal-change_password .btn_newpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 1% -20%;
                    letter-spacing: -2px
                
            }
            #modal-change_password .btn_reenterpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 4% -20%;
                    letter-spacing: -2px
            }
            #modal-change_password .textinput1{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% 30%;
                    text-align:left;
                    border-radius:10px;
            }
            #modal-change_password .textinput2{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 1% 30%;
                    text-align:left;
            }
            #modal-change_password .textinput3{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 4% 30%;
                    text-align:left;
            }
        
            #modal-change_password .message{
            color: #FFFFFF;
            font-size: 12px;
        }

        }
        @media screen and (max-width : 1000px){
            .page-deposit{
                padding: 20px 10%;
                width: 100%;
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                grid-gap: 5px;
                grid-template-columns: 100%;
                padding-bottom: 30px;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .btn_changepassword{
                background: #FF9300;
                border-radius: 10px;
                width: 50px;
                height: 44px;
                font-size: 14px;
                margin-top: 6px;
                font-weight: 500;
                margin: 0% 0% 0% 2%;
            }
            .btn-group{
                margin: 0 10%;
                width: 75%;
            }
            .btn_id{
                background: #888888;
                border-radius: 10px;
                width: 154px;
                height: 44px;
                color: #FFFFFF;
                margin: 15% 5% 0%;
            }
            .btn_nickname{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 0% 0% 0%;
               
            }
            .btn_accountholder{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_accountbank{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountnumber{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_recommendedpoint{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
        
            .accountid{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 15% 0% 0%;
            }
            
            .accountnickname{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 3% 0% 0% 0%;
            }

            .accountholder{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 3% 0% 0% 0%;
            }
            .accountbank{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 0% 0% 0% 0%;
            }
            .accountno{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 3% 0% 0% 0%;
            }
            .recommendedpoint{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 0% 0% 0% 0%;
            }


            .current_password{
                border-radius: 10px;
                width: 235px;
                height: 44px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px;
                font-weight: 700;
                font-size: 20px;
                margin: 0% 0% 0% 5%;
                color: #FF9300;
            }
            .input_amnt::placeholder{
                
            }

            #modal-change_password .modal-title{
                font-weight: 700;
                font-size: 30px;
                margin: -10%;
            }
            #modal-change_password .modal-content{
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                
            }
            #modal-change_password .modal-header{
                border-bottom: none;
            }
            #modal-change_password .btn_currpassword{
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 4% -20%;
            }
            #modal-change_password .btn_newpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 1% -20%;
                    letter-spacing: -2px
                
            }
            #modal-change_password .btn_reenterpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 4% -20%;
                    letter-spacing: -2px
            }
            #modal-change_password .textinput1{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% 30%;
                    text-align:left;
                    border-radius:10px;
            }
            #modal-change_password .textinput2{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 1% 30%;
                    text-align:left;
            }
            #modal-change_password .textinput3{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 4% 30%;
                    text-align:left;
            }
        
            #modal-change_password .message{
            color: #FFFFFF;
            font-size: 12px;
        }



        }
        @media screen and (min-width : 1001px){
            .page-deposit{
                padding: 20px 10%;
                width: 100%; 
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                grid-gap: 5px;
                grid-template-columns: 100%;
                padding-bottom: 30px;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
           
            .btn_changepassword{
                background: #FF9300;
                border-radius: 10px;
                width: 100px;
                height: 44px;
                font-size: 14px;
                margin-top: 2px;
                margin: 0% 0% 0% 2%;
                font-weight: 600;
            }
            .btn-group{
                margin: 0 20%;
                width: 60%;
            }

            .btn_id{
                background: #888888;
                border-radius: 10px;
                width: 164px;
                height: 44px;
                color: #FFFFFF;
                margin: 15% 4% 0%;
            }
            .btn_nickname{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountholder{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_accountbank{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountnumber{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_recommendedpoint{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
        
        
            .accountid{
                width: 100%;
                height: 44px;
                margin: 15% 0% 0%;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
            }
            
            .accountnickname{
                width: 100%;
                height: 44px;
                margin: 3% 0% 0% 0%;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
            }

            .accountholder{
                width: 100%;
                height: 44px;
                margin: 3% 0% 0% 0%;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
            }
            .accountbank{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 0% 0% 0% 0%;
            }
            .accountno{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 3% 0% 0% 0%;
            }
            .recommendedpoint{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 0% 0% 0% 0%;
            }


            .current_password{
                border-radius: 10px;
                width: 420px;
                height: 44px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px;
                font-weight: 700;
                font-size: 20px;
                color: #FF9300;
            }
            .input_amnt::placeholder{
                
            }

            #modal-change_password .modal-title{
                font-weight: 700;
            }
            #modal-change_password .modal-content{
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                
            }
            #modal-change_password .modal-header{
                border-bottom: none;
            }
            #modal-change_password .btn_currpassword{
                    width: 55%;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% -20%;
            }
            #modal-change_password .btn_newpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 20px;
                    height: 40px;
                    margin: 1% -20%;
                    letter-spacing: -2px
                
            }
            #modal-change_password .btn_reenterpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% -20%;
                    letter-spacing: -2px
            }
            #modal-change_password .textinput1{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% 30%;
                    text-align:left;
                    border-radius:10px;
            }
            #modal-change_password .textinput2{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 1% 30%;
                    text-align:left;
            }
            #modal-change_password .textinput3{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 4% 30%;
                    text-align:left;
            }
        


        }
        @media screen and (min-width : 1920px){
            .page-deposit{
                padding: 20px 20%;
                width: 100%; 
            }
            .div_layout{
                width: 100%;
                margin: 0 auto;
                grid-gap: 5px;
                grid-template-columns: 100%;
                padding-bottom: 30px;
            }
            .btn_changepassword{
                background: #FF9300;
                border-radius: 10px;
                width: 30%;
                height: 44px;
                font-size: 14px;
                margin-top: 2px;
                margin: 0% 0% 0% 2%;
                font-weight: 600;
            }
            .btn-group{
                margin: 0 20%;
                width: 60%;
            }
            .btn_id{
                background: #888888;
                border-radius: 10px;
                width: 154px;
                height: 44px;
                color: #FFFFFF;
                margin: 15% 4% 0%;
            }
            .btn_nickname{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 257px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountholder{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_accountbank{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountnumber{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_recommendedpoint{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
        
        
            .accountid{
                width: 100%;
                height: 44px;
                margin: 15% 0% 0%;
                border-radius: 8px;
                background: #EEEEEE;
                font-weight: 600;
            }
            
            .accountnickname{
                width: 100%;
                height: 44px;
                margin: 3% 0% 0% 0%;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
            }

            .accountholder{
                width: 100%;
                height: 44px;
                margin: 3% 0% 0% 0%;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
            }
            .accountbank{
                width: 100%;
                height: 44px;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
                margin: 0% 0% 0% 0%;
            }
            .accountno{
                width: 100%;
                height: 44px;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
                margin: 3% 0% 0% 0%;
            }
            .recommendedpoint{
                width: 100%;
                height: 44px;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
                margin: 0% 0% 0% 0%;
            }


            .current_password{
                border-radius: 10px;
                width: 900px;
                height: 44px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px;
                font-weight: 700;
                font-size: 20px;
                color: #FF9300;
            }
            .input_amnt::placeholder{
                
            }

            #modal-change_password .modal-title{
           font-weight: 700;
        }
        #modal-change_password .modal-content{
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            
        }
        #modal-change_password .modal-header{
            border-bottom: none;
        }
        #modal-change_password .btn_currpassword{
                width: 55%;
                font-size: 20px;
                height: 40px;
                margin: 4% -35%;
        }
        #modal-change_password .btn_newpassword{
                background: #888888;
                border-radius: 10px;
                color: #FFFFFF;
                width: 55%;
                font-size: 20px;
                height: 40px;
                margin: 1% -35%;
                letter-spacing: -2px
              
        }
        #modal-change_password .btn_reenterpassword{
                background: #888888;
                border-radius: 10px;
                color: #FFFFFF;
                width: 55%;
                font-size: 20px;
                height: 40px;
                margin: 4% -35%;
                letter-spacing: -2px
        }
        #modal-change_password .textinput1{
                width: 300px;
                font-size: 20px;
                height: 40px;
                margin: 4% 45%;
                text-align:left;
                border-radius:10px;
        }
        #modal-change_password .textinput2{
                width: 300px;
                font-size: 20px;
                height: 40px;
                border-radius:10px;
                margin: 1% 45%;
                text-align:left;
        }
        #modal-change_password .textinput3{
                width: 300px;
                font-size: 20px;
                height: 40px;
                border-radius:10px;
                margin: 4% 45%;
                text-align:left;
        }
       

        }
        @media only screen and (min-width: 360px) and (max-width: 767px){
            .page-deposit{
                padding: 22px;
                width: 100%; 
            }
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
            /* .current_stocks_mobile1{
                font-size: 16px;
                font-family: Tahoma, sans-serif;
                font-weight: 600;
                height: 46px;
            }
            .current_stocks_mobile1 .current_stocks1{
                font-size: 16px;
                font-family: Tahoma, sans-serif;
                font-weight: 600;

            }.dollar_mint1{
                width: 6%;
                height: 58%;
                margin: 2%;
                
            } */
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
            .div_layout .card{
                height: 110%;
                margin-top: 0%;
            }
            .btn_changepassword{
                background: #FF9300;
                border-radius: 10px;
                width: 50px;
                height: 34px;
                font-size: 12px;
                font-weight: 500;
                margin: 3% 3% 0%;
            }
            .btn-group{
                margin: 0% 3%;
                width: 90%;
            }
            .btn_id{
                font-size: 12px;
                background: #888888;
                border-radius: 10px;
                width: 82px;
                height: 34px;
                color: #FFFFFF;
                margin: 5% 5% 0;
            }
            .btn_nickname{
                background: #888888;
                font-size: 12px;
                border-radius: 10px;
                width: 84px;
                height: 34px;
                color: #FFFFFF;
                margin: 3% 5% 0;
            }
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 81px;
                font-size: 12px;
                height: 34px;
                color: #FFFFFF;
                margin: 3% 5%;
                font-align: center;
                letter-spacing: -2px;
            }
            .btn_accountholder{
                background: #888888;
                border-radius: 10px;
                font-size: 12px;
                width: 85px;
                height: 34px;
                color: #FFFFFF;
                margin: 0% 5%;
            }
            .btn_accountbank{
                background: #888888;
                border-radius: 10px;
                width: 85px;
                height: 34px;
                font-size: 12px;
                color: #FFFFFF;
                margin: 3% 5%;
            }
            .btn_accountnumber{
                background: #888888;
                border-radius: 10px;
                font-size: 12px;
                width: 81px;
                height: 34px;
                color: #FFFFFF;
                letter-spacing: -2px;
                margin: 0% 5%;
            }
            .btn_recommendedpoint{
                background: #888888;
                border-radius: 10px;
                width: 81px;
                height: 34px;
                color: #FFFFFF;
                font-size: 12px;
                letter-spacing: -2px;
                margin: 3% 5%;
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

            .accountid{
                width: 100%;
                height: 34px;
                font-size: 12px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 5% 0% 0%;
            }
            
            .accountnickname{
                width: 100%;
                font-size: 12px;
                height: 34px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
               
            }

            .accountholder{
                width: 100%;
                height: 34px;
                font-size: 12px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 0% 0% 0% 0%;
            }
            .accountbank{
                width: 100%;
                height: 34px;
                font-size: 12px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 3% 0% 0% 0%;
            }
            .accountno{
                width: 100%;
                font-size: 12px;
                height: 34px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 0% 0% 0% 0%;
            }
            .recommendedpoint{
                width: 100%;
                height: 34px;
                font-size: 12px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 3% 0% 0% 0%;
            }

            .current_password{
                border-radius: 10px;
                width: 115px;
                height: 34px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px;
                font-weight: 700;
                font-size: 12px;
                color: #FF9300;
                margin: 3% 0% 3% 0%;
            }
            .input_amnt::placeholder{
            
            }

            #modal-change_password .modal-title{
                font-weight: 700;
                font-size: 20px;
                margin: -10%;
            }
            #modal-change_password .modal-lg{
                width: 95%; 
            }
            #modal-change_password .modal-content{
                background: #393E46;
            }
            #modal-change_password .modal-header{
                border-bottom: none;
            }
            #modal-change_password .btn_currpassword{
                    width: 53%;
                    font-size: 12px;
                    height: 40px;
                    margin: 4% -25%;
                    border-radius: 5px;
            }
            #modal-change_password .btn_newpassword{
                    background: #888888;
                    border-radius: 5px;
                    color: #FFFFFF;
                    width: 85%;
                    font-size: 12px;
                    height: 40px;
                    margin: 1% -25%;
                    letter-spacing: -2px
                
            }
            #modal-change_password .btn_reenterpassword{
                    background: #888888;
                    border-radius: 5px;
                    color: #FFFFFF;
                    width: 85%;
                    font-size: 12px;
                    height: 40px;
                    margin: 4% -25%;
                    letter-spacing: -2px
            }
            #modal-change_password .textinput1{
                    width: 170px;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% 35%;
                    text-align:left;
                    border-radius:10px;
            }
            #modal-change_password .textinput2{
                    width: 170px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 1% 35%;
                    text-align:left;
            }
            #modal-change_password .textinput3{
                    width: 170px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 4% 35%;
                    text-align:left;
            }
        
            #modal-change_password .message{
            color: #FFFFFF;
            font-size: 10px;
            margin: 1%;
        }
        }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <!-- registration Section -->
    <div class="page-deposit">
        <div class="div_layout">
            <div class="card">
                <div class="card-header">
                    입금 신청하기
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <button class="btn btn_id" type="button">아이디</button>
                        <input type="text" class="accountid" id="accountid" placeholder="아이디" disabled>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn_nickname" type="button">닉네임</button>
                        <input type="text" class="accountnickname" id="accountnickname" placeholder="닉네임" disabled>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn_currentpass" type="button">비밀번호</button>
                        <input type="text" disabled id="" name="current_password" class="current_password form-control" placeholder="***********">
                        <!-- <input type="text" disabled id="current_password" name="current_password" class="current_password form-control" placeholder="***********"> -->
                        <button class="btn btn_changepassword" type="button">변경</button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn_accountholder" type="button">예금주</button>
                        <input type="text" class="accountholder" id="accountholder" placeholder="홍 X 동" disabled>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn_accountbank" type="button">은행</button>
                        <input type="text" class="accountbank" id="bank" placeholder="길동은행" disabled>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn_accountnumber" type="button">계좌번호</button>
                        <input type="text" class="accountno" id="accountno" placeholder="1234XX - XX - XX4567" disabled>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn_recommendedpoint" type="button">추천지점</button>
                        <input type="text" class="recommendedpoint" id="recommendedpoint" placeholder="강남점" disabled>
                    </div>
                   
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
