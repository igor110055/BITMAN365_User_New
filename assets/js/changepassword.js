$( document ).ready(function() {
 
  $.validator.addMethod("strong_password", function (value, element) {
      let password = value;
      if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{4,12}$)/.test(password))) {
          return false;
      }
      return true;
  }, function (value, element) {
      let password = $(element).val();
      if (!(/^(.{4,12}$)/.test(password))) {
          return '숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.';
      }
      else if (!(/^(?=.*[A-Z])/.test(password))) {
          return '숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.';
      }
      else if (!(/^(?=.*[a-z])/.test(password))) {
          return '숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.';
      }
      else if (!(/^(?=.*[0-9])/.test(password))) {
          return '숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.';
      }
      else if (!(/^(?=.*[@#$%&])/.test(password))) {
          return "숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.";
      }
      return false;
  });
  //register
  $("form[id='form_changepassword']").validate({
      // Specify validation rules
      ignore: "not:hidden",
      rules: {
          s_password: {
              required: true,
              strong_password: true
          },
          chk_password: {
              equalTo: "#s_password"
          },
      },
      // Specify validation error messages
      messages: {
          s_password: {
              required: "비밀번호를 입력해 주세요.(숫자, 영어대/소문자, 특수문자 포함 4~12자까지)"
          },
          chk_password: "입력하신 비밀번호가 일치하지 않습니다.",
        
      },
      // errorPlacement: function(error, element) {
      //     if (element.attr("name") == "s_account_code" ){
      //         error.insertAfter(".errorid");
      //     }
      //     else if  (element.attr("name") == "nickname" ){
      //         error.insertAfter(".errornickname");
      //     }
      //     else if  (element.attr("name") == "chk1" ){
      //         error.insertAfter(".errorchk1");
      //     }
      //     else if  (element.attr("name") == "chk2" ){
      //         error.insertAfter(".errorchk2");
      //     }
      //     else if  (element.attr("name") == "chk3" ){
      //         error.insertAfter(".errorchk3");
      //     }
      //     else{
      //         error.insertAfter(element);
      //     }
      // },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function() {
          let formData = $('#form_changepassword').serialize();
          console.log(formData)
          $.ajax({
              type: 'POST',
              url: './php/api/postRegistration.php',
              data: {formData},
              success: function(request){
                  if(request == true){
                      window.location.href='./?succ=1';
                  }else{
                      alert('error occured.')
                  }
              }
          })
      }
  });

  // function check_account_exists(){
  //     $('#accnt_id_dup_chk').click(function(){
  //         let code = $('#s_account_code').val();
  //         $.ajax({
  //             type: "POST",
  //             url: "./php/api/checkAccountIdifExists.php",
  //             "async": false,
  //             data: JSON.stringify(code),
  //             success: function(request){
  //                 if(request == 1){
  //                     $('.error_id_chk').text('중복')
  //                     $('#dummy_code').val('')
  //                 }
  //                 else{
  //                     $('.error_id_chk').text('가능')
  //                     $('#dummy_code').val(1)
  //                 }
  //             }
  //         });
  //     })
  // }
  // function check_nickname_exists(){
  //     $('#nickname_dup_chk').click(function(){
  //         let nick = $('#nickname').val();
  //         $.ajax({
  //             type: "POST",
  //             url: "./php/api/checknicknameifexists.php",
  //             "async": false,
  //             data: JSON.stringify(nick),
  //             success: function(request){
  //                 if(request == 1){
  //                     $('.error_nn_chk').text('중복')
  //                     $('#dummy_nickname').val('')
  //                 }
  //                 else{
  //                     $('.error_nn_chk').text('가능')
  //                     $('#dummy_nickname').val(1)
  //                 }
  //             }
  //         });
  //     })
  // }

  // function getBankList(){
  //     $.get('./php/api/getBankList.php', function(banklist){
  //         var html = '';
  //         html += '<option value="" disabled selected>--이용하실 은행을 선택해 주세요.-</option>';
  //         banklist.forEach(function(bank){
  //             html += '<option value="'+bank.m_BankId+'">'+bank.m_Bank_Name+'</option>';
  //         })
  //         $('#bank_code').html(html);
  //     })
  // }

  function showLoader(){
      $(".loader").fadeIn("slow");
      $(".loader").show();
  }
  function hideLoader(){
      $(".loader").fadeOut("slow");
  }

  // //load files
  // check_account_exists();
  // check_nickname_exists();
  // getBankList();
})
 
 
 $('.btn_changepassword').click(function(){
   
    $('#modal-change_password').modal('show')
  
   
  })
