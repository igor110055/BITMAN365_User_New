<?php  
    include_once '../config/Database.php';
	include_once '../class/Pagination.class.php';
	include_once '../class/UserInfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Userinfo($db);

	$sql = $query->getFAQList();
    $sql1 = $query->getFAQRowCount();
				
	$paginationlink = "php/api/getFAQList.php?page=";
					
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
    $output .= 'Frequently Asked Questions';
    $output .= '</div>';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 620px;">';
    $output .= '<div class="body-header">';
	$output .= '<table class="table faq">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th>번호</th>';
	$output .= '<th>질문/답변</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
    if($sql1->rowCount() > 0){
        foreach($data as $key => $val){
            $output .= '<tr class="rowaccordion">';
            $output .= '<td style="width: 120px;">'.$sNum.'</td>';
            $output .= '<td style="text-align: left;">'.$val["f_Title"].'</td>';
            $output .= '</tr>';
            $output .= '<tr class="rowContent">';
            $output .= '<td colspan="2" style="background: #EEEEEE; text-align: left; padding-left: 50px;">'.$val["f_Details"].'</td>';
            $output .= '</tr>';
            $sNum ++;
        }
    }else{
        $output .= '<tr style="text-align: center; height: 40px;">';
        $output .= '<td colspan="2">기록을 찾을 수 없습니다.</td>';
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
	$(".faq .rowaccordion").click(function(){
        $(".rowContent").not($(this).next()).hide();
		$(this).next(".rowContent").toggle();
	})
</script>