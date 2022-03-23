$(function(){
    $('.btnlogout').click(function(){
        var code = $(this).data('code');
        window.location.href="./logout.php?code="+code
    })
})