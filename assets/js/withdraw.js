$('#withdrawamount').on('change click keyup input paste',(function (event) {
    var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));
    var newbal = Number($(this).val().replace(/[^0-9\.-]+/g,""));
    var formatter = new Intl.NumberFormat();
    $('.new_balance').text(formatter.format(current - newbal));
  }));
  function numberFormat(){
      $('input#withdrawamount').keyup(function(event) {
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
  $('.btn_withdraw').click(function(){
    var withdraw = Number($('#withdrawamount').val().replace(/[^0-9\.-]+/g,""));
    var new_balance = Number($('.new_balance').text().replace(/[^0-9\.-]+/g,""));
    var formatter = new Intl.NumberFormat();
    if(withdraw <= 0){
      $('#modal-withdraw_alert').modal('show');
      return false;
    }
    $('#modal-withdraw_submit').modal('show')
    $('#withdrawamount_s').val(formatter.format(withdraw) + '원');
    $('#new_balance_s').val(new_balance);
  })
  $('.btn_withdraw_save').click(function(){
    var withdrawtamount = Number($('#withdrawamount_s').val().replace(/[^0-9\.-]+/g,""));
    var arr = [{withdrawtamount : withdrawtamount}];
    $.post("./php/api/postWithdraw.php", JSON.stringify(arr), function( response ) {
      $('#modal-withdraw_submit').modal('hide')
      if(response == true){
        izitoast('성공적으로 제출되었습니다!','확인을 기다립니다.','fa fa-check-square-o','green','./withdraw.php')
      }else{
        izitoast('실패!','철수 페이지로 돌아가기.','fa fa-times-circle-o','red','./withdraw.php');
      }
    })
  })
  //fetching user bank info
  $.ajax({
    "url": "./php/api/user/getUserBankInfo.php",
    "type": "GET",
    "contentType": "application/json",
    "async": false,
    success: function(response) {
        $('#bank').val(response[0].m_Bank_Name);
        $('#accountno').val(response[0].u_Account_Number);
        $('#accountholder').val(response[0].u_Bank_Holder_Name);
    }
  })
  numberFormat();