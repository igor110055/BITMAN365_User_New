function getresult(url) {
    $.ajax({
        url: url,
        type: "GET",
        data:  {rowcount:$("#rowcount").val()},
        //beforeSend: function(){$("#overlay").show();},
        success: function(data){
        $("#pagination-result").html(data);
        setInterval(function() {$("#overlay").hide(); },500);
        },
        error: function() 
        {} 	        
   });
}
getresult("php/api/getInquiryList.php");

$("form[class='formInquiry']").validate({
    rules: {
        inquiry_title: "required",
        inquiry_details: "required",
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "inquiry_title" ){
            error.insertAfter(".errortitle");
        }
        else if  (element.attr("name") == "inquiry_details" ){
            error.insertAfter(".errordetails");
        }
    },
    messages: {
        inquiry_title: "제목을 입력해 주세요.",
        inquiry_details: "문의내용을 입력해 주세요.",
    },
    submitHandler: function() {
        let formData = $('.formInquiry').serialize();
        $.ajax({
            type: 'POST',
            url: './php/api/user/postInquiry.php',
            data: {formData},
            success: function(request){
                $("#modal-inquiry_submit").modal('hide');
                if(request == true){
                    izitoast('성공적으로 제출되었습니다!','확인을 기다립니다.','fa fa-check-square-o','green','./inquiry.php');
                }else{
                    izitoast('실패!','문의 페이지로 돌아가기.','fa fa-times-circle-o','red','./inquiry.php');
                }
            }
        })
    }
});
$("form[class='formInquiryMobile']").validate({
    rules: {
        inquiry_title_i: "required",
        inquiry_details_i: "required",
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "inquiry_title_i" ){
            error.insertAfter(".errortitle_i");
        }
        else if  (element.attr("name") == "inquiry_details_i" ){
            error.insertAfter(".errordetails_i");
        }
    },
    messages: {
        inquiry_title_i: "제목을 입력해 주세요.",
        inquiry_details_i: "문의내용을 입력해 주세요.",
    },
    submitHandler: function() {
        let formData = $('.formInquiryMobile').serialize();
        $.ajax({
            type: 'POST',
            url: './php/api/user/postInquiry.php',
            data: {formData},
            success: function(request){
                $("#modal-inquiry_submit").modal('hide');
                if(request == true){
                    izitoast('성공적으로 제출되었습니다!','확인을 기다립니다.','fa fa-check-square-o','green','./inquiry.php');
                }else{
                    izitoast('실패!','문의 페이지로 돌아가기.','fa fa-times-circle-o','red','./inquiry.php');
                }
            }
        })
    }
});