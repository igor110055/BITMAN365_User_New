<?php  
    include_once '../config/Database.php';
	include_once '../class/Pagination.class.php';
	include_once '../class/UserInfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Userinfo($db);

	$sql = $query->getInquiryList();
    $sql1 = $query->getInquiryRowCount();
				
	$paginationlink = "php/api/getInquiryList.php?page=";
					
	$page = 1;
	if(!empty($_GET["page"])) {
	$page = $_GET["page"];
	}

	$start = ($page-1)*$perPage->perpage;
	if($start < 0) $start = 0;

	$query =  $sql . " limit " . $start . "," . $perPage->perpage; 
	$faq = $db->prepare($query);
    $faq->execute();

	if(empty($_GET["rowcount"])) {
	    $_GET["rowcount"] = $sql1->rowCount();
	}

	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);

    $data = $faq->fetchAll(PDO::FETCH_ASSOC);
	$counter = ($_GET["page"] > 1) ? ($_GET["page"] * COUNT($data)) - COUNT($data) : 0;
	$sNum = $counter + 1;

	$output = '';
    $output .= '<div class="card">';
    $output .= '<div class="card-header">';
    $output .= '1 : 1 문의하기 <button class="inq_reg">문의등록</button>';
    $output .= '</div>';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 550px;">';
    $output .= '<div class="body-header">';
	$output .= '<table class="table inquiry">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th>번호</th>';
	$output .= '<th>제목/답변</th>';
	$output .= '<th>상태</th>';
	$output .= '<th>등록시간/답변시간</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
    if($sql1->rowCount() > 0){
        foreach($data as $key => $val){
            $output .= '<tr class="rowaccordion">';
            $output .= '<td>'.$sNum.'</td>';
            $output .= '<td style="text-align: left;">'.$val["t_Inquiry_Title"].'</td>';
            ($val["t_Inquiry_Status_Id"] == 0) ? $output .= '<td style="color: #FF9300; font-size: 16px;">답변 대기</td>' : $output .= '<td style="color: #1072BA; font-size: 16px;">답변 완료</td>';
            $output .= '<td>'.$val["t_Inquiry_Date"].'/'.$val["t_Response_Time"].'</td>';
            $output .= '</tr>';
            $output .= '<tr class="rowContent">';
            $output .= '<td colspan="4">'.$val["t_Inquiry_Details"].'</td>';
            $output .= '</tr>';
            $sNum ++;
        }
    }else{
        $output .= '<tr style="text-align: center; height: 40px;">';
        $output .= '<td colspan="4">기록을 찾을 수 없습니다.</td>';
        $output .= '</tr>';
    }
	$output .= '</tbody>';
	$output .= '</table>';
	$output .= '</div>';
    $output .= '</div>';
	if(!empty($perpageresult)) {
		$output .= '<span style="text-align: center !important;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
    $output .= '</div>';
    $output .= '</div>';
    print $output;
?>
<script>
	$('.rowContent').hide();
	$(".inquiry .rowaccordion").click(function(){
	$(".rowContent").not($(this).next()).hide();
		$(this).next(".rowContent").toggle();
	})
    $('.inq_reg').click(function(){
        $("#modal-inquiry_submit").modal('show');
    })
</script>