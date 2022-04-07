$(document).ready(function() { 
    var formatter = new Intl.NumberFormat();
    $('#bet5k').click(function(){
        //var formatter = new Intl.NumberFormat();
        document.getElementById('betAmount').disabled = true;
        $('#betAmount').val(formatter.format(5000) + '원');
        $('#totalBetAmount').val(formatter.format(1.95 * 5000) + '원');
    })
    $('#bet10k').click(function(){
        // formatter = new Intl.NumberFormat();
        document.getElementById('betAmount').disabled = true;
        $('#betAmount').val(formatter.format(10000) + '원');
        $('#totalBetAmount').val(formatter.format(1.95 * 10000) + '원');
    })
    $('#bet50k').click(function(){
        //var formatter = new Intl.NumberFormat();
        document.getElementById('betAmount').disabled = true;
        $('#betAmount').val(formatter.format(50000) + '원');
        $('#totalBetAmount').val(formatter.format(1.95 * 50000) + '원');
    })
    $('#bet100k').click(function(){
        //var formatter = new Intl.NumberFormat();
        document.getElementById('betAmount').disabled = true;
        $('#betAmount').val(formatter.format(100000) + '원');
        $('#totalBetAmount').val(formatter.format(1.95 * 100000) + '원');
    })
    $('#bet500k').click(function(){
        //var formatter = new Intl.NumberFormat();
        document.getElementById('betAmount').disabled = true;
        $('#betAmount').val(formatter.format(500000) + '원');
        $('#totalBetAmount').val(formatter.format(1.95 * 500000) + '원');
    })
    $('#sellBtn').click(function(){
        //1 - sell , 2 - buy
        var bet = $('#betAmount').val();
        $.confirm({
            title: 'You bet for ' + bet+'원',
            content: 'Click 베팅 to submit.',
            type: 'red',
            typeAnimated: true,
            buttons: {
                bet: {
                    text: '베팅',
                    btnClass: 'btn-red',
                    action: function(){
                        var mytime = moment.tz(moment(),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                        var conunix = Math.floor(new Date(mytime).getTime() + 1000 * 60);
                        var mytimeunix = conunix / 1000;
                        var betAmount = Number($('#betAmount').val().replace(/[^0-9\.-]+/g,""));
                        var totalBetAmount = Number($('#totalBetAmount').val().replace(/[^0-9\.-]+/g,""));
                        var arr = [{time: mytimeunix, betAmount : betAmount, totalBetAmount : totalBetAmount, multiplyby : 1.95, trend: 1}];
                        $.post( "php/api/user/postPurchaserequest.php", JSON.stringify(arr), function( res ) {
                            var time = [{time: mytimeunix}];
                            $.post( "php/api/user/checkTimeBetPerMin.php", JSON.stringify(time), function( res ) {
                                if(res.length > 0){
                                    location.reload(true);
                                }
                            })
                        })
                    }
                },
                close: function () {
                    location.reload(true);
                }
            }
        });
    })
    $('#buyBtn').click(function(){
        //1 - sell , 2 - buy
        
        var bet = $('#betAmount').val();
        $.confirm({
            title: 'You bet for ' + bet+'원',
            content: 'Click 베팅 to submit.',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                bet: {
                    text: '베팅',
                    btnClass: 'btn-blue',
                    action: function(){
                        var mytime = moment.tz(moment(),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                        var conunix = Math.floor(new Date(mytime).getTime() + 1000 * 60);
                        var mytimeunix = conunix / 1000;
                        var betAmount = Number($('#betAmount').val().replace(/[^0-9\.-]+/g,""));
                        var totalBetAmount = Number($('#totalBetAmount').val().replace(/[^0-9\.-]+/g,""));
                        var arr = [{time: mytimeunix, betAmount : betAmount, totalBetAmount : totalBetAmount, multiplyby : 1.95, trend: 2}];
                        $.post( "php/api/user/postPurchaserequest.php", JSON.stringify(arr), function( response ) {
                            var time = [{time: mytimeunix}];
                            $.post( "php/api/user/checkTimeBetPerMin.php", JSON.stringify(time), function( res ) {
                                if(res.length > 0){
                                    location.reload(true);
                                }
                            })
                        })
                    }
                },
                close: function () {
                    location.reload(true);
                }
            }
        });
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
    var refresh = 1000; // Refresh rate in milliseconds
    reshistory = setTimeout('getBettinghistory()',refresh)
    disbtn = setTimeout('disabledBtnOnBet()',refresh)
}
function disabledBtnOnBet(){
    var mytime = moment.tz(moment().add('1','minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
    var conunix = Math.floor(new Date(mytime).getTime());
    var mytimeunix = conunix / 1000;
    var time = [{time: mytimeunix}];
    $.post( "php/api/user/checkTimeBetPerMin.php", JSON.stringify(time), function( res ) {
        if(res.length > 0){
            $('.btn_bet').attr('disabled',true);
        }
    })
}
function bettingExecution(){
    $('#betAmount').blur(function(){
        var inputValue = Number($(this).val().replace(/[^0-9\.-]+/g,""));
        if(inputValue < 5000){
            alert('최소거래금액 ! 5000.')
            return false;
        }
        remDisabledSellbuy();
    })
    $('input#betAmount').keyup(function(event) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '원';
        });
        
    });
    $('#betAmount').on('change click keyup input paste',(function (event) {
        var formatter = new Intl.NumberFormat();
        var inputValue = Number($(this).val().replace(/[^0-9\.-]+/g,""));
        var input = ($(this).val() == '') ? 0 : $(this).val();
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '원';
        });
        $('#totalBetAmount').val(formatter.format(1.95 * inputValue) + '원');
    }));
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
//display user all bet history
function getBettinghistory(){
    var html = '';
    $.ajax({
        "url": "php/api/user/getBinanceHistory.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            var onprocessTime = (response[0].status != 0) ? convertUnixtoTimeplus1(response[0].time) : convertUnixtoTime(response[0].time);
            var open = parseFloat(response[0].open);
            html += '<tr>';
            html += '<td>'+onprocessTime+'</td>';
            html += '<td>'+open+'</td>';
            html += '<td>진행중</td>';
            html += '</tr>';
            response.forEach(function(element){
                var open = parseFloat(element.open);
                if(element.status > 0){
                    html += '<tr>';
                    html += '<td>'+convertUnixtoTime(element.time)+'</td>';
                    html += '<td>'+open.toFixed(2)+'</td>';
                    html += '<td>'+element.result+'</td>';
                    html += '</tr>';
                }
            })
            $('#tbody').html(html);
        }
    })
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
                    html += '<td style="color: #ED5659;">실현</td>';
                }else if(element.result == 2){
                    html += '<td style="color: #1072BA;">실격</td>';
                }else{
                    html += '<td style="color: #888888;">무효</td>';
                }
                html += '</tr>';
            })
            $('#tbody_history').html(html);
        }
    })
}
function getBettingHistoryGroup(){
    $.ajax({
        "url": "php/api/user/getBettingHistoryGroup.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            result = [];
            response.reduce(function (r, a) {
                if (a.r_Game_Result !== r) {
                    result.push([]);
                }
                result[result.length - 1].push(a);
                return a.r_Game_Result;
            }, undefined);
            var d = JSON.stringify(result, 0, 4);
            var jsonParse = JSON.parse(d);
            var html = '';
            html += '<tr>';
            jsonParse.forEach(function(el){
                html += '<td>';
                if(el[0].r_Game_Result == '매수'){
                    html += '<p style="background: #EEEEEE; color: #ED5659; padding: 3px 0 0 8px; font-weight: 700; height: 30px;">매수</p>';
                }else{
                    html += '<p style="background: #EEEEEE; color: #1072BA; padding: 3px 0 0 8px; font-weight: 700; height: 30px;">매도</p>';
                }
                el.forEach(function(ele){
                    if(ele.r_Game_Result == '매수'){
                        html += '<button type="button" class="btn trend_output btn_result" style="background: #ED5659;" data-time="'+ele.r_Time_Unix+'">'+convertUnixtoTimeTrade(ele.r_Time_Unix)+'</button><br>';
                    }else{
                        html += '<button type="button" class="btn trend_output btn_result" style="background: #1072BA;" data-time="'+ele.r_Time_Unix+'">'+convertUnixtoTimeTrade(ele.r_Time_Unix)+'</button><br>';
                    }
                })
                html += '</td>';
            })
            html += '<tr>';
            $('#display_trade_group').html(html);
            $(".btn_result").click(function(){
                var time = $(this).data('time');
                $.ajax({
                    "url": "php/api/user/getWssResultPerMin.php",
                    "type": "POST",
                    "contentType": "application/json",
                    "async": false,
                    "data": JSON.stringify(time),
                    success: function(response) {
                        var json = JSON.parse(response);
                        var result = json.result;
                        var lastresult = json.lastresult;
                        var dresult = '';
                        dresult += '<div class="continer-fluid" style="overflow-y: scroll; height: 800px;">';
                        dresult += '<table class="table table-bordered table-striped">';
                        dresult += '<thead>';
                        dresult += '<tr style="background: #545454; color: #FFFFFF; text-align: center;">';
                        dresult += '<th>바이낸스 거래 ID</th>';
                        dresult += '<th>UTC Time</th>';
                        dresult += '<th>Korea Time</th>';
                        dresult += '<th>Price</th>';
                        dresult += '</tr>';
                        dresult += '</thead>';
                        result.forEach(function(element){
                            dresult += '<tr style="text-align: center;">';
                            dresult += '<td>'+element.w_Transaction_Id+'</td>';
                            dresult += '<td>'+element.w_Time_Min_Unix+'</td>';
                            dresult += '<td>'+element.w_Time_Kor+'</td>';
                            dresult += '<td style="font-weight: 700;">'+element.w_Current_Price+'</td>';
                            dresult += '</tr>';
                        })
                        dresult += '<tr style="text-align: center;">';
                        dresult += '<td>'+lastresult.w_Transaction_Id+'</td>';
                        dresult += '<td>'+lastresult.w_Time_Min_Unix+'</td>';
                        dresult += '<td>'+lastresult.w_Time_Kor+'</td>';
                        dresult += '<td style="background: #FF9300; color: #FFFFFF;">'+lastresult.w_Current_Price+'</td>';
                        dresult += '</tr>';
                        dresult += '</tbody>';
                        dresult += '</table>';
                        dresult += '<tbody>';
                        dresult += '</div>';
                        $('.modal-body').html(dresult);
                    }
                })
                $("#modal-bi_1m_result").modal('show');
            });
        },error: function (request, status, error) {
            var html = '';
            if(status == 'error'){
                html += '<p style="text-align: center; color: #888888; padding: 10px;">No records found</p>';
            }
            $('#display_trade_group').html(html);
        }
    })
}

function convertUnixtoTime(unix){
    let unix_timestamp = unix
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.
    var date = new Date(unix_timestamp * 1000);
    var days = ("0" + date.getDate()).substr(-2);
    var hours = ("0" + date.getHours()).substr(-2);
    var minutes = ("0" + date.getMinutes()).substr(-2);

    var formattedTime = days + '일 ' + hours + '시 '+ minutes + '분';

    return formattedTime;
}
function convertUnixtoTimeplus1(unix){
    let unix_timestamp = unix
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.
    var date = new Date(unix_timestamp * 1000 + 1000 * 60);
    var days = ("0" + date.getDate()).substr(-2);
    var hours = ("0" + date.getHours()).substr(-2);
    var minutes = ("0" + date.getMinutes()).substr(-2);

    var formattedTime = days + '일 ' + hours + '시 '+ minutes + '분';

    return formattedTime;
}
function convertUnixtoTimeTrade(unix){
    let unix_timestamp = unix
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.
    var date = new Date(unix_timestamp * 1000);
    var hours = ("0" + date.getHours()).substr(-2);
    var minutes = ("0" + date.getMinutes()).substr(-2);

    var formattedTime = hours + ':'+ minutes;

    return formattedTime;
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
bettingExecution();
unlockField();
getBettinghistory();
getBettinguserhistory();
getBettingHistoryGroup();
display_counter();
//getbetAtThisTime();