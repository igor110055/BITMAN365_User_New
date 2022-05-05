$('.btn_changepassword').click(function(){
    $('#modal-change_password').modal('show')

    $( document ).ready(function() {
 
      // $.validator.addMethod("strong_password", function (value, element) {
      //     let password = value;
      //     if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{4,12}$)/.test(password))) {
      //         return false;
      //     }
      //     return true;
      // }, function (value, element) {
      //     let password = $(element).val();
      //     if (!(/^(.{4,12}$)/.test(password))) {
      //         return '숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.';
      //     }
      //     else if (!(/^(?=.*[A-Z])/.test(password))) {
      //         return '숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.';
      //     }
      //     else if (!(/^(?=.*[a-z])/.test(password))) {
      //         return '숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.';
      //     }
      //     else if (!(/^(?=.*[0-9])/.test(password))) {
      //         return '숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.';
      //     }
      //     else if (!(/^(?=.*[@#$%&])/.test(password))) {
      //         return "숫자, 영어대/소문자, 특수문자를 포함하여 4~12자까지 가능합니다.";
      //     }
      //     return false;
      // });
      //change password
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
    
    })
     
  })

//fetching user bank info
  $.ajax({
    "url": "./php/api/user/getUserPrivacyInfo.php",
    "type": "GET",
    "contentType": "application/json",
    "async": false,
    success: function(response) {
        $('#bank').val(response[0].m_Bank_Name);
        $('#accountno').val(response[0].u_Account_Number);
        $('#accountholder').val(response[0].u_Bank_Holder_Name);
        $('#recommendedpoint').val(response[0].u_Recommended_Point);
        $('#current_password').val(response[0].u_Password);
        $('#accountid').val(response[0].u_Id);
        // $('#account_currentpassword').val(response[0].u_Password);
        $('#accountnickname').val(response[0].u_Nickname);
    }
  })
  numberFormat();
  