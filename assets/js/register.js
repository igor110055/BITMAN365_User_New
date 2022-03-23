$( document ).ready(function() {
    $('.selectall').click(function() {
        if ($(this).is(':checked')) {
            $('#chk2').prop('checked', true);
            $('#chk3').prop('checked', true);
            $('#chk2-error').css('display','none');
            $('#chk3-error').css('display','none');
        } else {
            $('#chk2').prop('checked', false);
            $('#chk3').prop('checked', false);
            $('#chk2-error').removeAttr("style");
            $('#chk3-error').removeAttr("style");
        }
    });
    $.validator.addMethod("accountcodeRegex", function (value, element) {
        let acctcode = value;
        if (!(/^(?=.*[a-z])(?=.*[A-Z])(.{4,12}$)/.test(acctcode))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let acctcode = $(element).val();
        if (!(/^(.{4,12}$)/.test(acctcode))) {
            return '영어소문자+숫자로 4~12자까지 가능합니다. / 이미 존재하는 아이디입니다.';
        }
        else if (!(/^(?=.*[a-z])/.test(acctcode))) {
            return '영어소문자+숫자로 4~12자까지 가능합니다. / 이미 존재하는 아이디입니다.';
        }
        else if (!(/^(?=.*[0-9])/.test(acctcode))) {
            return '영어소문자+숫자로 4~12자까지 가능합니다. / 이미 존재하는 아이디입니다.';
        }
        return false;
    });
    $.validator.addMethod("nicknameRegex", function (value, element) {
        let nname = value;
        if (!(/^(.{3,7}$)/.test(nname))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let nname = $(element).val();
        if (!(/^(.{3,7}$)/.test(nname))) {
            return '한글 3~7자까지 가능합니다. / 이미 존재하는 닉네임입니다.';
        }
        return false;
    });
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
    $("form[id='form_register']").validate({
        // Specify validation rules
        ignore: "not:hidden",
        rules: {
            dummy_code: "required",
            s_account_code:{
            required: true,
            accountcodeRegex: true,
            //   remote: {
            //     type: "POST",
            //     url: "./php/api/checkAccountIdifExists.php",
            //     "async": false,
            //     data: {
            //         accountcode: function() {
            //             return $("#account_code").val();
            //         }
            //       }
            //   }
            },
            dummy_nickname: "required",
            nickname: {
                required: true,
                nicknameRegex: true,
            },
            s_password: {
                required: true,
                strong_password: true
            },
            chk_password: {
                equalTo: "#s_password"
            },
            mobile_number: {
                required: true
            },
            account_holder: "required",
            bank_code: "required",
            account_number: {
                required: true
            },
            chk1: "required",
            chk2: "required",
            chk3: "required",
            rec_point: "required"
        },
        // Specify validation error messages
        messages: {
            dummy_code: "",
            s_account_code: {
                required: "아이디를 입력해 주세요.(영어소문자+숫자 12자까지)",
              //remote: "This username is already taken! Try another."
            },
            dummy_nickname: "",
            nickname: "닉네임을 입력해 주세요.(한글 3~7자까지)",
            nickname_dup_chk: "Click button to check duplicate.",
            s_password: {
                required: "비밀번호를 입력해 주세요.(숫자, 영어대/소문자, 특수문자 포함 4~12자까지)"
            },
            chk_password: "입력하신 비밀번호가 일치하지 않습니다.",
            mobile_number: {
                required: "휴대폰 번호를 입력해 주세요."
            },
            account_holder: "예금주를 입력해 주세요.",
            bank_code: "--이용하실 은행을 선택해 주세요.--",
            account_number: "계좌번호를 입력해 주세요.('-'표시없이 입력해주세요.)",
            chk1: "( 가입하려면 모든 회원 이용약관에 동의해야 합니다. )",
            chk2: "( 가입하려면 모든 회원 이용약관에 동의해야 합니다. )",
            chk3: "( 가입하려면 모든 회원 이용약관에 동의해야 합니다. )",
            rec_point: "추천지점 또는 코드를 입력해 주세요."
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "s_account_code" ){
                error.insertAfter(".errorid");
            }
            else if  (element.attr("name") == "nickname" ){
                error.insertAfter(".errornickname");
            }
            else if  (element.attr("name") == "chk1" ){
                error.insertAfter(".errorchk1");
            }
            else if  (element.attr("name") == "chk2" ){
                error.insertAfter(".errorchk2");
            }
            else if  (element.attr("name") == "chk3" ){
                error.insertAfter(".errorchk3");
            }
            else{
                error.insertAfter(element);
            }
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function() {
            let formData = $('#form_register').serialize();
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

    function check_account_exists(){
        $('#accnt_id_dup_chk').click(function(){
            let code = $('#s_account_code').val();
            $.ajax({
                type: "POST",
                url: "./php/api/checkAccountIdifExists.php",
                "async": false,
                data: JSON.stringify(code),
                success: function(request){
                    if(request == 1){
                        $('.error_id_chk').text('중복')
                        $('#dummy_code').val('')
                    }
                    else{
                        $('.error_id_chk').text('가능')
                        $('#dummy_code').val(1)
                    }
                }
            });
        })
    }
    function check_nickname_exists(){
        $('#nickname_dup_chk').click(function(){
            let nick = $('#nickname').val();
            $.ajax({
                type: "POST",
                url: "./php/api/checknicknameifexists.php",
                "async": false,
                data: JSON.stringify(nick),
                success: function(request){
                    if(request == 1){
                        $('.error_nn_chk').text('중복')
                        $('#dummy_nickname').val('')
                    }
                    else{
                        $('.error_nn_chk').text('가능')
                        $('#dummy_nickname').val(1)
                    }
                }
            });
        })
    }

    function getBankList(){
        $.get('./php/api/getBankList.php', function(banklist){
            var html = '';
            html += '<option value="" disabled selected>--이용하실 은행을 선택해 주세요.-</option>';
            banklist.forEach(function(bank){
                html += '<option value="'+bank.m_BankId+'">'+bank.m_Bank_Name+'</option>';
            })
            $('#bank_code').html(html);
        })
    }

    function showLoader(){
        $(".loader").fadeIn("slow");
        $(".loader").show();
    }
    function hideLoader(){
        $(".loader").fadeOut("slow");
    }

    //load files
    check_account_exists();
    check_nickname_exists();
    getBankList();
})