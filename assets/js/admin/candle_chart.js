$(function(){
    function createChart(){
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
            upColor: '#1072BA',
            downColor: '#ED5659',
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
    let ws = new WebSocket('wss://stream.binance.com:9443/ws/btcusdt@trade');
    ws.onmessage = (event) => {
        var stock = JSON.parse(event.data); 
        var timesec = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss.SSS");
        var mytime = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var conunix = Math.floor(new Date(mytime).getTime());
        var mytimeunix = conunix / 1000;

        var start = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm"+":00.000");
        var end = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm"+":05.999");
        var wssdata = {"mytimeunix": mytimeunix,"currenttime": mytime, "currentprice": parseFloat(stock.p),"transid": stock.t,"secunixtime": stock.E,"kortime": timesec};
        if(timesec > end){
        }else{
            $.post("php/api/user/PostWssTrade.php", JSON.stringify(wssdata), function(jsondata) {})
        }
        
    }
    function initializeClock(cl, endtime) {
        var clock = document.querySelector(cl);
        var sTimeClock = clock.querySelector('.timeclock');
        function updateClock() {
            var t = getTimeRemaining(endtime);
            sTimeClock.innerHTML = ('0' + t.seconds).slice(-2) + '초';
            $('.mtimeclock').text(('0' + t.seconds).slice(-2) + '초');
            if(t.seconds < 20){
                betDisabled();
            }
            if(t.seconds == 2){
                var unixtime = convertUnixtoUnix(moment());
                $.post("php/api/user/getGameResservedMinUpdate.php", JSON.stringify(unixtime), function(jsondata) {
                    //console.log(jsondata)
                });
            }
            if(t.seconds == 0){
                $('.text_result').css('display','block');
                $('.game_field').addClass('game_field_opa');
                ///////update result
                var unixtime = convertUnixtoUnix(moment().subtract(1, 'minutes'));
                $.post("php/api/user/postGameResultUpdate.php", JSON.stringify(unixtime), function(jsondata) {
                    //console.log(jsondata)
                });
                ///////game result
                $.post("php/api/user/getGameResult.php", JSON.stringify(unixtime), function(jsondata) {
                    if(jsondata[0].r_Game_Result == '매수'){
                        $('.price_result').html('<span style="color: #c9bf0b;">'+jsondata[0].r_Price_Result+'</span>');
                    }else{
                        $('.price_result').html('<span style="color: #888888;">'+jsondata[0].r_Price_Result+'</span>');
                    }
                    $('.time_result').html('<span style="color: #FFFFFF;">'+jsondata[0].r_Time_Datetime+'</span>');
                    if(jsondata[0].r_Game_Result == '매수'){
                        $('#text_title_result').html('<span style="color: #ED5659">매수 실현되었습니다.</span>');
                    }else if(jsondata[0].r_Game_Result == '매도'){
                        $('#text_title_result').html('<span style="color: #1072BA">매도 실현되었습니다.</span>');
                    }else{
                        $('#text_title_result').html('<span style="color: #FFFFFF">무효처리 되었습니다.</span>');
                    }
                });
            }
            if(t.seconds == 59){
                betRemDisabled();
                var unixtime = convertUnixtoUnix(moment().subtract(1, 'minutes'));
                $.post("php/api/user/postbettingTransaction.php", JSON.stringify(unixtime), function(jsondata) {
                    //console.log(jsondata)
                });
            }
            if(t.seconds == 57){
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
                    $.post("php/api/user/PostWsskline.php", JSON.stringify(biApidata), function(jsondata) {})
                })
            }
            if(t.seconds == 56){
                location.reload(true);
            }
        }
        updateClock();
        setInterval(updateClock, 1000);
    }
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
