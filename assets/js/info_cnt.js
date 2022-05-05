function display_time() {
    var myDate = moment.tz(moment(),'Asia/Seoul').format("M월 DD일");
    var time = moment.tz(moment(),'Asia/Seoul').format("HH:mm:ss");
    document.getElementById('display_date').innerHTML = myDate;
    document.getElementById('display_time').innerHTML = time;
    display_counter();
}
function display_counter(){
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_time()',refresh)
    info = setTimeout('getInfoCnt()',refresh)
    req = setTimeout('checkCategoryReq()',refresh)
    soundoff = setTimeout('OnOff()',refresh)
}
var userSound = new Audio('../assets/audio/signup.mp3');
// var depSound = new Audio('../assets/audio/cashin.mp3');
// var widSound = new Audio('../assets/audio/cashout.mp3');
// var inqSound = new Audio('../assets/audio/query.mp3');
// function pausesoundEffect(){
//     rollSound.pause();
//     rollSound.loop = false;
// }

function getInfoCnt(){
    $.ajax({
        "url": "../php/api/admin/getInfoCnt.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            var result = response.Notif;
            // $('.user_application').text(response.UserApplication);
            // $('.deposit_application').text(response.DepositApplication);
            // $('.withdraw_application').text(response.WithdrawApplication);
            $('.note_notification').text(response.InquiryApplication);
            result.forEach(function(el){
                // if(el.s_Notif_Type == "UserApplication"){
                //     if(el.s_TypeName == 'on'){
                //         userSound.play();
                //         userSound.loop = true;
                //     }else{
                //         userSound.pause();
                //     }
                // }
                // if(el.s_Notif_Type == "DepositApplication"){
                //     if(el.s_TypeName == 'on'){
                //         depSound.play();
                //         depSound.loop = true;
                //     }else{
                //         depSound.pause();
                //     }
                // }
                // if(el.s_Notif_Type == "WithdrawApplication"){
                //     if(el.s_TypeName == 'on'){
                //         widSound.play();
                //         widSound.loop = true;
                //     }else{
                //         widSound.pause();
                //     }

                // }
                if(el.s_Notif_Type == "InquiryApplication"){
                    if(el.s_TypeName == 'on'){
                        inqSound.play();
                        inqSound.loop = true;
                    }else{
                        inqSound.pause();
                    }
                }
            })
        }
    })
}
// function OnOff() {
//     var img = document.querySelector('.mutesound');
//     $('.mutesound').click(function(){
//         if (img.getAttribute('src') === "../assets/icons/akar-icons_sound-on.png") {
//             img.setAttribute('src', "../assets/icons/akar-icons_sound-off.png");
//         }else {
//             img.setAttribute('src', "../assets/icons/akar-icons_sound-on.png");
//         }
//     })
// }

function checkCategoryReq(){
    $.ajax({
        "url": "../php/api/admin/getInfoCnt.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            var notif = response["Notif"];
            // (notif[0].s_Notif_Type == 'UserApplication' && notif[0].s_TypeName == 'on') ? $('.user_application').addClass('pulsestate') : $('.user_application').removeClass('pulsestate');
            // (notif[1].s_Notif_Type == 'DepositApplication' && notif[1].s_TypeName == 'on') ? $('.deposit_application').addClass('pulsestate') : $('.deposit_application').removeClass('pulsestate');
            // (notif[2].s_Notif_Type == 'WithdrawApplication' && notif[2].s_TypeName == 'on') ? $('.withdraw_application').addClass('pulsestate') : $('.withdraw_application').removeClass('pulsestate');
            (notif[3].s_Notif_Type == 'InquiryApplication' && notif[3].s_TypeName == 'on') ? $('.inquiry_application').addClass('pulsestate') : $('.inquiry_application').removeClass('pulsestate');
        }
    })
}
$('.mutesound').click(function(){
    $.post('../php/api/admin/setToMute.php?setMute=1', function(req){})
})

function getResult(url) {
    $.ajax({
        url: url,
        type: "GET",
        data: {rowcount:$("#rowcount").val()},
        //beforeSend: function(){$("#overlay").show();},
        success: function(data){
        $("#pagination-result").html(data);
        setInterval(function() {$("#overlay").hide(); },500);
        },
        error: function() 
        {} 	        
   });
}

display_counter();
getInfoCnt();