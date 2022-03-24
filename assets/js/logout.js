$(function(){
    $('.btnlogout').click(function(){
        var code = $(this).data('code');
        window.location.href="./logout.php?code="+code
    })
    ///mobile
    $('.btn_logout').click(function(){
        var code = $(this).data('code');
        window.location.href="./logout.php?code="+code
    })
})