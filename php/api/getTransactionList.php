<?php  
    include_once '../config/Database.php';
	include_once '../class/Pagination.class.php';
	include_once '../class/UserInfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new UserInfo($db);

	$sql = $query->getUserTransactionList();
    $sql1 = $query->getUserTransactionRowCount();
				
	$paginationlink = "php/api/getTransactionList.php?page=";
					
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

    // print_r($data);

	$output = '';
    $output .= '<div class="card">';
    $output .= '<div class="card-header">';
    $output .= '거래내역';
    $output .= '</div>';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 620px;">';
    $output .= '<div class="body-header">';
	$output .= '<table class="table usertransaction">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th>번호</th>';
	$output .= '<th>투자종목</th>';
	$output .= '<th>계약시간</th>';
	$output .= '<th>구분</th>';
    $output .= '<th>체결대금</th>';
    $output .= '<th>상태</th>';
    $output .= '<th>계약신청시간</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			$output .= '<tr class="rowaccordion">';
			$output .= '<td>'.$sNum.'</td>';
			$output .= '<td style="text-align: left;">'.$val["b_Game_Type"].'</td>';
			$output .= '<td>'.$val["b_UpdatedDate"].'</td>';
			$output .= '<td>'.$val["b_Trend"].'</td>';
            $output .= '<td>'.$val["b_betAmount"].'</td>';
            if($val["b_Result"] == 0){
                $output .= '<td><font color = "#78A6FF">실현</font></td>';
            }
            else if($val["b_Result"] == 1){
                $output .= '<td><font color = "#ff9300">실격</font></td>';
            }
			else{
				$output .= '<td>-</td>';
			}
            $output .= '<td>'.$val["b_UpdatedDate"].'</td>';
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
    $output .= '</div>';
	
    print $output;

?>