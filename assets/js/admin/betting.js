$(document).ready(function() { 
    var formatter = new Intl.NumberFormat();
    var times = 1.95;
    var priceWon;
    var bet = 0;
    var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));
    $('#bet10k').click(function(){
        //var formatter = new Intl.NumberFormat();
        bet += 10000;
        priceWon = bet * current;
        betting(times,bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet50k').click(function(){
        // formatter = new Intl.NumberFormat();
        bet += 50000;
        priceWon = bet * current;
        betting(times,bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet100k').click(function(){
        //var formatter = new Intl.NumberFormat();
        bet += 100000;
        priceWon = bet * current;
        betting(times,bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet500k').click(function(){
        //var formatter = new Intl.NumberFormat();
        bet += 500000;
        priceWon = bet * current;
        betting(times,bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet1m').click(function(){
        //var formatter = new Intl.NumberFormat();
        bet += 1000000;
        priceWon = bet * current;
        betting(times,bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet5m').click(function(){
        //var formatter = new Intl.NumberFormat();
        bet += 5000000;
        priceWon = bet * current;
        betting(times,bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#reset').click(function(){
        //var formatter = new Intl.NumberFormat();
        document.getElementById("betAmount").value="";
        document.getElementById("totalBetAmount").value="";
        document.getElementById("betAmount").disabled = false;
        bet = 0;
    })
    $('#max').click(function(){
        //var formatter = new Intl.NumberFormat();
        bet = current;
        document.getElementById("betAmount").disabled = true;
        document.getElementById('totalBetAmount').disabled = true;
        $("#betAmount").val(formatter.format(current));
        priceWon = Math.round(times * current);
        $('#totalBetAmount').val(formatter.format(priceWon));
    })
    $('input#betAmount').keyup(function(event) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
        
    });
    $('#betAmount').on('change click keyup input paste',(function (event) {
        var formatter = new Intl.NumberFormat();
        var inputValue = Number($(this).val().replace(/[^0-9\.-]+/g,""));
        document.getElementById('totalBetAmount').disabled = true;
        priceWon = Math.round(times * inputValue);
        var input = ($(this).val() == '') ? 0 : $(this).val();
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
        });
        $('#totalBetAmount').val(formatter.format(priceWon));
    }));
    $('#sellBtn').click(function(){
        //1 - sell , 2 - buy

        var bet = $('#betAmount').val();
        if(bet < 10000){
            function showPopUp(){
                minimum_transaction.style.display="block";
            }
            showPopUp();
            function ClosePopUp(){
                minimum_transaction.style.display="none";
                document.getElementById("betAmount").value="";
                document.getElementById("totalBetAmount").value="";
            }
            setTimeout(ClosePopUp, 2000)
        }
        else{
           
            var mytime = moment.tz(moment(),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var conunix = Math.floor(new Date(mytime).getTime() + 1000 * 60);
            var mytimeunix = conunix / 1000;
            var betAmount = Number($('#betAmount').val().replace(/[^0-9\.-]+/g,""));
            var totalBetAmount = priceWon;
            var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));
            var arr = [{time: mytimeunix, betAmount : betAmount, totalBetAmount : totalBetAmount, multiplyby : 1.95, trend: 2}];

            if(betAmount > current){
                function showPopUp(){
                    my_popup_failed.style.display="block";
                }
                showPopUp();
                function ClosePopUp(){
                    my_popup_failed.style.display="none";
                    document.getElementById("betAmount").value="";
                    document.getElementById("totalBetAmount").value="";
                }
                setTimeout(ClosePopUp, 2000)
            }
            else{
                function showPopUp(){
                    my_popup.style.display="block";
                }
                showPopUp();
                function ClosePopUp(){
                    my_popup.style.display="none";
                    document.getElementById("betAmount").value="";
                    document.getElementById("totalBetAmount").value="";
                }
                setTimeout(ClosePopUp, 2000)
                
                $.post( "php/api/user/postPurchaserequest.php", JSON.stringify(arr), function( res ) {
                    bet = 0;
                    var time = [{time: mytimeunix}];
                    $.post( "php/api/user/checkTimeBetPerMin.php", JSON.stringify(time), function( res ) {
                        if(res.length > 0){
                            betDisabled();
                            // getBettinguserhistory();
                        }
                    })
                })
            }
        }
               
  
    })
    $('#buyBtn').click(function(){
        //1 - sell , 2 - buy
        
        var bet = $('#betAmount').val();
        if(bet < 10000){
            function showPopUp(){
                minimum_transaction.style.display="block";
            }
            showPopUp();
            function ClosePopUp(){
                minimum_transaction.style.display="none";
                document.getElementById("betAmount").value="";
                document.getElementById("totalBetAmount").value="";
            }
            setTimeout(ClosePopUp, 2000)
        }
        else{

            var mytime = moment.tz(moment(),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var conunix = Math.floor(new Date(mytime).getTime() + 1000 * 60);
            var mytimeunix = conunix / 1000;
            var betAmount = Number($('#betAmount').val().replace(/[^0-9\.-]+/g,""));
            var totalBetAmount = priceWon;
            var arr = [{time: mytimeunix, betAmount : betAmount, totalBetAmount : totalBetAmount, multiplyby : 1.95, trend: 1}];
            var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));

            if(betAmount > current){
                function showPopUp(){
                    my_popup_failed.style.display="block";
                }
                showPopUp();
                function ClosePopUp(){
                    my_popup_failed.style.display="none";
                    document.getElementById("betAmount").value="";
                    document.getElementById("totalBetAmount").value="";
                }
                setTimeout(ClosePopUp, 2000)
            }
            else{
            function showPopUp(){
                my_popup.style.display="block";
            }
            showPopUp();
            function ClosePopUp(){
                my_popup.style.display="none";
                document.getElementById("betAmount").value="";
                    document.getElementById("totalBetAmount").value="";
            }
            setTimeout(ClosePopUp, 2000)
            
            $.post( "php/api/user/postPurchaserequest.php", JSON.stringify(arr), function( response ) {
                bet = 0;
                var time = [{time: mytimeunix}];
                $.post( "php/api/user/checkTimeBetPerMin.php", JSON.stringify(time), function( res ) {
                    if(res.length > 0){
                        betDisabled();
                        // getBettinguserhistory();
                    }
                })
            }) 
        }
    }
    })
    window.setInterval(function() {
        $('#container_data').scrollLeft($('#container_data').scrollLeft() + 904);
      }, 1);
    //load files
})  

function display_time() {
    display_counter();

}


function display_counter(){
    var refresh = 6000; // Refresh rate in milliseconds
    disbtn = setTimeout('disabledBtnOnBet()',refresh)
}

function betting(times,bet,current,priceWon){
    var formatter = new Intl.NumberFormat();

    document.getElementById('betAmount').disabled = true;
    document.getElementById('totalBetAmount').disabled = true;
    if(bet > current){
        function showPopUp(){
            my_popup_failed.style.display="block";
        }
        showPopUp();
        function ClosePopUp(){
            my_popup_failed.style.display="none";
            document.getElementById("betAmount").value="";
            document.getElementById("totalBetAmount").value="";
        }
        setTimeout(ClosePopUp, 2000)
    }else{
        $('#betAmount').val(formatter.format(bet));
        priceWon = times * bet;
        $('#totalBetAmount').val(formatter.format(priceWon));
    }
}

function disabledBtnOnBet(){
    var mytime = moment.tz(moment().add('1','minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
    var conunix = Math.floor(new Date(mytime).getTime());
    var mytimeunix = conunix / 1000;
    var time = [{time: mytimeunix}];
    $.post( "php/api/user/checkTimeBetPerMin.php", JSON.stringify(time), function( res ) {
        if(res.length > 0){
            $('.btn_bet').attr('disabled',true);
            betDisabled();
        }
    })
}

function unlockField(){
    $('#editField').click(function(){
        document.getElementById('betAmount').disabled = false;
    })
}
function disabledSellbuy(){
    $('#sellBtn').attr('disabled',true);
    $('#buyBtn').attr('disabled',true);
}
function remDisabledSellbuy(){
    $('#sellBtn').attr('disabled',false);
    $('#buyBtn').attr('disabled',false);
}
//Trading Button
function betDisabled(){
    $('#betAmount').attr('disabled',true);
    $('#totalBetAmount').attr('disabled',true);
    $('.btn_dis').attr('disabled',true);
    $('#totalBetAmount').val('');
    $('#betAmount').val('');
}

//display user bet history
function getBettinguserhistory(){
    var html = '';
    var formatter = new Intl.NumberFormat();
    $.ajax({
        "url": "php/api/user/getBinanceUserHistory.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            response.forEach(function(element){
                html += '<tr>';
                html += '<td>'+convertUnixtoTime(element.time)+'</td>';
                html += '<td>'+element.trend+'</td>';
                html += '<td>'+formatter.format(element.betamount)+'</td>';
                if(element.result == 0){
                    html += '<td style="color: #000000;">진행중</td>';
                }else if(element.result == 1){
                    html += '<td style="color: #1072BA;">실현</td>';
                }else if(element.result == 2){
                    html += '<td style="color: #ED5659;">실격</td>';
                }else{
                    html += '<td style="color: #888888;">무효</td>';
                }
                html += '</tr>';
            })
            $('#tbody_history').html(html);
        }
    })
}
// function getbetAtThisTime(){
//     $.ajax({
//         "url": "php/api/admin/getBetAtThisTime.php",
//         "type": "GET",
//         "contentType": "application/json",
//         "async": false,
//         success: function(response) {
//             var unix = moment.unix(response.b_time).format('YYYY-MM-DD HH:mm');
//             var und = Math.floor(new Date(unix).getTime());
//             var mytime = moment.tz(moment(),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
//             var conunix = Math.floor(new Date(mytime).getTime());
//             var mytimeunix = conunix / 1000;
//             var html = '';
//             html += '<div style="text-align: center; margin-top: 10px;">';
//             html += '<button type="button" id="bet5k" value="5000" class="btn btn_trading_orange btn_bet">5,000원</button>&nbsp;';
//             html += '<button type="button" id="bet10k" value="10000" class="btn btn_trading_orange btn_bet">10,000원</button>&nbsp;';
//             html += '<button type="button" id="bet50k" value="50000" class="btn btn_trading_orange btn_bet">50,000원</button>';
//             html += '</div>';
//             html += '<div style="text-align: center;">';
//             html += '<button type="button" id="bet100k" value="100000" class="btn btn_trading_orange btn_bet">100,000원</button>&nbsp;';
//             html += '<button type="button" id="bet500k" value="500000" class="btn btn_trading_orange btn_bet">500,000원</button>&nbsp;';
//             html += '<button type="button" id="editField" class="btn btn_trading_bg btn_bet">정정</button>';
//             html += '</div>';
//             html += '<div style="text-align: center; margin: 10px;">';
//             html += '<button type="button" id="sellBtn" class="btn btn_trading_red btn_bet">매수 신청</button>&nbsp;';
//             html += '<button type="button" id="buyBtn" class="btn btn_trading_blue btn_bet">매도 신청</button>';
//             html += '</div>';
//             $('#displayBetBtn').html(html);
//         }
//     })
// }
unlockField();
display_counter();
disabledBtnOnBet();
//getbetAtThisTime();