$(function(){
    function createChart(){
        datetime_today();
        getBettinghistory();
        getBettinguserhistory();
        getBettingHistoryGroup();
        //time scale formatter - data
        var tickMarkFormatter = (timestamp, tickMarkType, locale) => { 
            const date = new Date(timestamp * 1000);					

            switch (tickMarkType) {
                case LightweightCharts.TickMarkType.Year:
                    return date.getFullYear();   

                case LightweightCharts.TickMarkType.Month:
                    const monthFormatter = new Intl.DateTimeFormat(locale, { month: 'short' });
                    
                    return monthFormatter.format(date);

                case LightweightCharts.TickMarkType.DayOfMonth:
                    return date.getDate();

                case LightweightCharts.TickMarkType.Time:
                    const timeFormatter = new Intl.DateTimeFormat(locale, { hour: "numeric", minute: "numeric" });
                    
                    return timeFormatter.format(date);

                case LightweightCharts.TickMarkType.TimeWithSeconds:
                    const timeWithSecondsFormatter = new Intl.DateTimeFormat(locale, { hour: "numeric", minute: "numeric", second: "numeric"});

                    return timeWithSecondsFormatter.format(date);
            }

            throw new Error('Unhandled tick mark type ' + tickMarkType);
        }
        var timeFormatter = (timestamp) => {
            const date = new Date(timestamp * 1000);
            const dateFormatter = new Intl.DateTimeFormat(navigator.language, {
                hourCycle: 'h23',
                hour: 'numeric',
                minute: 'numeric', 
                month: 'short', 
                day: 'numeric', 
                year: 'numeric'
            });

            return dateFormatter.format(date);
        }
        var chart = LightweightCharts.createChart(document.getElementById('candle_chart'), {
            responsive: true,
            maintainAspectRatio: true,
            layout: {
                backgroundColor: 'transparent',
                textColor: '#000000',
                fontFamily: 'Roboto',
                fontSize: 9,
            },
            crosshair: {
                vertLine: {
                    visible: true,
                    labelVisible: true,
                },
                horzLine: {
                    visible: true,
                    labelVisible: true,
                },
            },
            timeScale: {
                timeVisible: true,
                secondsVisible: false,
                //tickMarkFormatter: tickMarkFormatter,
                tickMarkFormatter: (time, tickMarkType, locale) => {
                    const date = new Date(time * 1000);
                    const dateFormatter = new Intl.DateTimeFormat(navigator.language, {
                        hourCycle: 'h23',
                        hour: 'numeric',
                        minute: 'numeric'
                    });
    
                    return dateFormatter.format(date);
                }
            },
            localization: {
                timeFormatter: timeFormatter,
            },
            grid: {
                vertLines: {
                    color: '#DDDDDE',
                },
                horzLines: {
                    color: '#DDDDDE',
                },
            },
            handleScroll: { mouseWheel: true, pressedMouseMove: true, horzTouchDrag: true, vertTouchDrag: true },
            handleScale: { axisPressedMouseMove: true, mouseWheel: true, pinch: true, },
        });
        var candleSeries = chart.addCandlestickSeries({
            upColor: '#ED5659',
            downColor: '#1072BA',
            borderDownColor: '#000000',
            borderUpColor: '#000000',
            wickDownColor: '#000000',
            wickUpColor: '#000000',
            lastValueVisible: true
        });
        var biApi = [];
        $.getJSON("https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=1m&limit=200", function(jsondata) {
            for(var i = 0; i < jsondata.length; i++){
                var myDate = moment.tz(moment(jsondata[i][0]),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                var unixconvert = Math.floor(new Date(myDate).getTime())
                var unixtime = unixconvert / 1000;
                biApi.push({time: unixtime, open: jsondata[i][1], high: jsondata[i][2], low: jsondata[i][3], close: jsondata[i][4]});
            }
            candleSeries.setData(biApi);
        })
        ///websocket
        //wss://stream.binance.com:9443/ws/btcusdt@aggTrade
        //wss://stream.binance.com:9443/ws/btcusdt@trade
        var socket = new WebSocket('wss://stream.binance.com:9443/ws/btcusdt@kline_1m');
        socket.onmessage = function(e){
            var wsdata = JSON.parse(e.data);
            var candlestick = wsdata.k;
            var timekr = moment.tz(moment(candlestick.t),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var unixkrcon = Math.floor(new Date(timekr).getTime())
            var unixkr = unixkrcon / 1000;
            //console.log(candlestick)
            candleSeries.update({
                time: unixkr, 
                open: candlestick.o, 
                high: candlestick.h, 
                low: candlestick.l, 
                close: candlestick.c
            })
        }
    }
    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((new Date() / 1000 / 60) % 60);
        // var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        // var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
          'total': t,
        //'days': days,
        //'hours': hours,
          //'minutes': minutes,
          'seconds': seconds
        };
    }
    //@trade
    var openPrice;
    var end;
    var show;
    var done = false;
    let ws = new WebSocket('wss://stream.binance.com:9443/ws/btcusdt@trade');
    ws.onmessage = (event) => {
        var stock = JSON.parse(event.data); 
        var timesec = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss.SSS");
        var mytime = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var conunix = Math.floor(new Date(mytime).getTime());
        var mytimeunix = conunix / 1000;

        var start = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm"+":01.000");
        var wssdata = {"mytimeunix": mytimeunix,"currenttime": mytime, "currentprice": parseFloat(stock.p),"transid": stock.t,"secunixtime": stock.E,"kortime": timesec};
       
        // if(timesec > end){
        // }else{
        //     $.post("php/api/user/PostWssTrade.php", JSON.stringify(wssdata), function(jsondata) {})
        // }   

        if(timesec < start){
            $.post("php/api/user/PostWssTrade.php", JSON.stringify(wssdata), function(jsondata) {})
            openPrice = wssdata.currentprice;
            done = false;
        } else if(timesec > end){
            console.log('open:' + openPrice);

            if(wssdata.currentprice < (openPrice + 1) && wssdata.currentprice > (openPrice - 1)){
                $.post("php/api/user/PostWssTrade.php", JSON.stringify(wssdata), function(jsondata) {})
                end = moment.tz(moment(stock.E).add(1, 'millisecond'),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss.SSS");
                console.log('current:' + wssdata.currentprice);
            }else{
                if(openPrice == undefined){
                    var unixtime = moment.tz(moment(),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                    $.post("php/api/user/getOpeningBet.php", JSON.stringify(unixtime), function(jsondata) {
                        //openPrice = jsondata[0].w_Current_Price;
                    });

                    done = true;
                    show = false;
                }
                else {
                    $.post("php/api/user/PostWssTrade.php", JSON.stringify(wssdata), function(jsondata) {})
                    end = moment.tz(moment(stock.E).add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss.SSS");
                    console.log('Time' + timesec + ' / close:' + wssdata.currentprice);

                    done = true;
                    show = true;

                    var biApi = [];
                    //php/api/admin/getBinanceApiData.php?sort=DESC&limit=200
                    //binanceAPI = https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=1m&limit=200
                    $.getJSON("https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=1m&limit=200", function(jsondata) {
                    for(var i = 0; i < jsondata.length; i++){
                        var myDate = moment.tz(moment(jsondata[i][0]),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                        var unixconvert = Math.floor(new Date(myDate).getTime())
                        var unixtime = unixconvert / 1000;
                        biApi.push({time: unixtime, open: jsondata[i][1], high: jsondata[i][2], low: jsondata[i][3], close: jsondata[i][4]});
                    }
                    var lastArr = biApi[biApi.length - 1];
                    var gtype = 'BTCUSDT';
                    var biApidata = [{time: lastArr.time, time_kr: myDate, open: parseFloat(lastArr.open), high: parseFloat(lastArr.high), low: parseFloat(lastArr.low), close: parseFloat(lastArr.close),gType: gtype}];
                    $.post("php/api/user/PostWsskline.php", JSON.stringify(biApidata), function(jsondata) {
                        
                    })
                })
                }
            }

        }else{
            if(!done){
                end = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm"+":00.000");

            }
        }

        
        
    }

    
    function initializeClock(cl, endtime) {

        var clock = document.querySelector(cl);
        var sTimeClock = clock.querySelector('.timeclock');
        var randomTime;
        var timeShow;
        var checkReserved;

        function updateClock() {
            var t = getTimeRemaining(endtime);
            sTimeClock.innerHTML = ('0' + t.seconds).slice(-2) + '초';
            $('.mtimeclock').text(('0' + t.seconds).slice(-2) + '초');

            if(show){
                timeShow = t.seconds - 5;
                checkReserved = t.seconds - 2;
                console.log(timeShow);
                show = false;
            }

            if(t.seconds == timeShow){
                $('.text_result').css('display','block');
                $('.game_field').addClass('game_field_opa');
                ///////update result
                var unixtime = convertUnixtoUnix(moment());
                ///////game result
                $.post("php/api/user/getGameResult.php", JSON.stringify(unixtime), function(jsondata) {
                    if(jsondata[0].r_Game_Result == '매수'){
                        $('.price_result').html('<span style="color: #c9bf0b;">'+jsondata[0].r_Price_Result+'</span>');
                    }else{
                        $('.price_result').html('<span style="color: #888888;">'+jsondata[0].r_Price_Result+'</span>');
                    }
                    $('.time_result').html('<span style="color: #FFFFFF;">'+jsondata[0].r_Time_Datetime+'</span>');
                    if(jsondata[0].r_Game_Result == '매수'){
                        $('#text_title_result').html('<span style="color: #1072BA">매수 실현되었습니다.</span>');
                    }else if(jsondata[0].r_Game_Result == '매도'){
                        $('#text_title_result').html('<span style="color: #ED5659">매도 실현되었습니다.</span>');
                    }else{
                        $('#text_title_result').html('<span style="color: #FFFFFF">무효처리 되었습니다.</span>');
                    }
                });


                setTimeout(closeResult, 3000)
            }

            if(t.seconds < 5){
                betDisabled();
            }

            if(t.seconds == checkReserved){
                var unixtime = convertUnixtoUnix(moment());
                $.post("php/api/user/getGameResservedMinUpdate.php", JSON.stringify(unixtime), function(jsondata) {
                    //console.log(jsondata)
                });
            }

            if(t.seconds == (randomTime + 1)){
                // ///////update result
                // var unixtime = convertUnixtoUnix(moment());
                // $.post("php/api/user/postGameResultUpdate.php", JSON.stringify(unixtime), function(jsondata) {
                //     //console.log(jsondata)
                // });
            }
            if(t.seconds == 0){
                datetime_today();
                
                var temp = getRandomInt(10,55);
                randomTime = Math.round(temp);

            }
            if(t.seconds == randomTime){
               
            }
            if(t.seconds == 59){
                betRemDisabled();
                var unixtime = convertUnixtoUnix(moment().add(1, 'minutes'));
                $.post("php/api/user/postbettingTransaction.php", JSON.stringify(unixtime), function(jsondata) {
                    //console.log(jsondata)
                });
            }
            
            if(t.seconds < 0){
                updateClock();
            }
        }
        updateClock();
        setInterval(updateClock, 1000);
    }


    function closeResult(){
        getBettinghistory();
        getBettinguserhistory();
        getBettingHistoryGroup();
        // location.reload(true);
        $('.game_field').removeClass('game_field_opa');
        $('.text_result').css('display','none');
    }

    function getRandomInt(min, max) {
        return Math.random() * (max - min) + min;
      }
    function datetime_today(){
        var date = new Date(moment.tz(moment().add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm"));
        var d = date.getDate().toString().substr(-2);
        var h = ("0" + date.getHours()).substr(-2);
        var m = ("0" + date.getMinutes()).substr(-2);
        var formattedTime = d + '일 ' + h + '시 '+ m + '분';
    
        $('#datetoday').text(formattedTime);
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
                var nextprocessTime =  convertUnixtoTimeplus1(response[0].time);
                var onprocessTime = (response[0].status != 0) ? convertUnixtoTimeplus1(response[0].time) : convertUnixtoTime(response[0].time);
                var open = parseFloat(response[0].open);
                
                html += '<tr>';
                html += '<td>'+onprocessTime+'</td>';
                html += '<td>-</td>';
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

    //Trading Button
    function betDisabled(){
        $('#betAmount').attr('disabled',true);
        $('#totalBetAmount').attr('disabled',true);
        $('.btn_dis').attr('disabled',true);
        $('#totalBetAmount').val('');
        $('#betAmount').val('');
    }
    function betRemDisabled(){
        $('#betAmount').attr('disabled',false);
        $('#totalBetAmount').attr('disabled',false);
        $('.btn_dis').attr('disabled',false);
    }

    //Convertion
    function convertUnixtoUnix(format){
        var mytime = moment.tz(format,'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var conunix = Math.floor(new Date(mytime).getTime());
        var mytimeunix = conunix / 1000;

        return mytimeunix;
    }

    createChart();
      
    var now = Date.parse(new Date());
    var seconds = Math.floor((now / 1000) % 60);
    var minutes = Math.floor((now / 1000 / 60) % 60);
    var left_to_min = 60 * 60 * 1000 - (minutes * 60 + seconds) * 1000;
    var timeclock = new Date(now + left_to_min);
    
    initializeClock('.initializeTime', timeclock);
})


