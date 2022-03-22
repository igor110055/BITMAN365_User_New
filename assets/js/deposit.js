$('#depositamount').on('change click keyup input paste',(function (event) {
  var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));
  var newbal = Number($(this).val().replace(/[^0-9\.-]+/g,""));
  var formatter = new Intl.NumberFormat();
  $('.new_balance').text(formatter.format(current + newbal));
}));
function numberFormat(){
    $('input#depositamount').keyup(function(event) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;
      
        // format number
        $(this).val(function(index, value) {
          return value
          .replace(/\D/g, "")
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '원';
        });
    });
}
$('.btn_deposit').click(function(){
  var deposit = Number($('#depositamount').val().replace(/[^0-9\.-]+/g,""));
  var new_balance = Number($('.new_balance').text().replace(/[^0-9\.-]+/g,""));
  var formatter = new Intl.NumberFormat();
  if(deposit < 10000){
    $('#modal-deposit_alert').modal('show');
    return false;
  }
  $('#modal-deposit_submit').modal('show')
  $('#depositamount_s').val(formatter.format(deposit) + '원');
  $('#new_balance_s').val(new_balance);
})
$('.btn_deposit_save').click(function(){
  var depositamount = Number($('#depositamount_s').val().replace(/[^0-9\.-]+/g,""));
  var arr = [{depositamount : depositamount}];
  $.post("./php/api/postDeposit.php", JSON.stringify(arr), function( response ) {
    $('#modal-deposit_submit').modal('hide')
    if(response == true){
      izitoast('성공적으로 제출되었습니다!','확인을 기다립니다.','fa fa-check-square-o','green','./deposit.php')
    }else{
      izitoast('실패!','입금 페이지로 돌아가기.','fa fa-times-circle-o','red','./deposit.php');
    }
  })
})
numberFormat();