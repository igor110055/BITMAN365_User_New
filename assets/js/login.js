$(function(){
    //login
    $("form[class='form_login']").validate({
        // Specify validation rules
        rules: {
            account_code: "required",
            password: "required",
        },
        // Specify validation error messages
        messages: {
            account_code: "아이디를 입력해 주세요.",
            password: "비밀번호를 입력해 주세요.",
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function() {
          let formData = $('.form_login').serialize();
            $.ajax({
                type: 'POST',
                url: './php/api/postLogin.php',
                data: {formData},
                success: function(request){
                    if(request == true){
                        window.location.href='./'
                    }else{
                        $('.display_error').text('아이디 또는 비밀번호가 일치하지 않습니다.');
                    }
                }
            })
        }
    });
    //login mobile
    $("form[class='form_login_mobile']").validate({
        // Specify validation rules
        rules: {
            account_code: "required",
            password: "required",
        },
        // Specify validation error messages
        messages: {
            account_code: "아이디를 입력해 주세요.",
            password: "비밀번호를 입력해 주세요.",
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function() {
          let formData = $('.form_login_mobile').serialize();
            $.ajax({
                type: 'POST',
                url: './php/api/postLogin.php',
                data: {formData},
                success: function(request){
                    if(request == true){
                        window.location.href='./'
                    }else{
                        $('.display_error').text('아이디 또는 비밀번호가 일치하지 않습니다.');
                    }
                }
            })
        }
    });
})