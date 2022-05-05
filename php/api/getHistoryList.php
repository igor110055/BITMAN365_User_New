<?php  
    include_once '../config/Database.php';
	include_once '../class/Pagination.class.php';
	include_once '../class/UserInfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new UserInfo($db);

	$sql = $query->getUserHistoryList();
    $sql1 = $query->getUserHistoryRowCount();
				
	$paginationlink = "php/api/getHistoryList.php?page=";
					
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

    //  print_r($data);

	$output = '';
    $output .= '<div class="page-deposit">';
    $output .= '<div class="div_layout">';
    $output .= '<div class="card">';
    $output .= '<div class="card-header">';
    $output .= '입출금 내역';
    $output .= '</div>';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 620px;">';
    $output .= '<div class="body-header">';
	$output .= '<table class="table userhistory">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th>번호</th>';
	$output .= '<th>은행</th>';
	$output .= '<th>계좌번호</th>';
	$output .= '<th>예금주</th>';
    $output .= '<th>입금/출금</th>';
    $output .= '<th>금액</th>';
    $output .= '<th>상태</th>';
    $output .= '<th>신청시간</th>';
    $output .= '<th>처리시간</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody align="center">';
	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			$output .= '<tr>';
			$output .= '<td>'.$sNum.'</td>';

            // Bank Code
			if($val["u_Bank_Code"] == 1){
                $output .= '<td >KEB하나은행 </td>';
            }
            else if($val["u_Bank_Code"] == 2){
                $output .= '<td> SC제일은행 </td>';
            }
			else if($val["u_Bank_Code"] == 3){
                $output .= '<td> 국민은행 </td>';
            }
			else if($val["u_Bank_Code"] == 4){
                $output .= '<td> 신한은행 </td>';
            }
			else if($val["u_Bank_Code"] == 5){
                $output .= '<td> 우리은행 </td>';
            }
			else if($val["u_Bank_Code"] == 6){
                $output .= '<td> 한국시티은행 </td>';
            }
			else if($val["u_Bank_Code"] == 7){
                $output .= '<td> 경남은행 </td>';
            }
			else if($val["u_Bank_Code"] == 8){
                $output .= '<td> 광주은행 </td>';
            }
			else if($val["u_Bank_Code"] == 9){
                $output .= '<td> 대구은행 </td>';
            }
			else if($val["u_Bank_Code"] == 10){
                $output .= '<td> 부산은행 </td>';
            }
			else if($val["u_Bank_Code"] == 11){
                $output .= '<td> 전북은행 </td>';
            }
			else if($val["u_Bank_Code"] == 12){
                $output .= '<td> 제주은행 </td>';
            }
			else if($val["u_Bank_Code"] == 13){
                $output .= '<td> 기업은행 </td>';
            }
			else if($val["u_Bank_Code"] == 14){
                $output .= '<td> 농협은행 </td>';
            }
			else if($val["u_Bank_Code"] == 15){
                $output .= '<td> 수협은행 </td>';
            }
			else if($val["u_Bank_Code"] == 16){
                $output .= '<td> 신협은행 </td>';
            }
			else if($val["u_Bank_Code"] == 17){
                $output .= '<td> 새마을금고 </td>';
            }
			else if($val["u_Bank_Code"] == 18){
                $output .= '<td> KDB산업은행 </td>';
            }
			else if($val["u_Bank_Code"] == 19){
                $output .= '<td> 우체국 </td>';
            }
			else if($val["u_Bank_Code"] == 20){
                $output .= '<td> 카카오뱅크 </td>';
            }
			else if($val["u_Bank_Code"] == 21){
                $output .= '<td> 토스뱅크 </td>';
            }

			$output .= '<td>'.$val["u_Account_Number"].'</td>';
			$output .= '<td>'.$val["u_Bank_Holder_Name"].'</td>';
			
            //Deposit or Withdraw
            if($val["h_Event"] == "입금"){
                $output .= '<td><p><font color = "#ff9300">'.$val["h_Event"].'</p></td>';
            }
            else if($val["h_Event"] == "출금"){
                $output .= '<td><p><font color="#78A6FF">'.$val["h_Event"].'</p></td>';
            }
           
            //Price
            if($val["h_Plus"] == 0){
                $output .= '<td><p><font color = "#78A6FF">'.$val["h_Minus"].'</p></td>';
            }
            else if($val["h_Minus"] == 0){
                $output .= '<td><p><font color = "#ff9300">'.$val["h_Plus"].'</p></td>';
            }

            //Status
			if($val["h_Status"] == 0){
                $output .= '<td>진행중</td>';
            }
            else if ($val["h_Status"] == 1){
                $output .= '<td>완료</td>';
            }
            else if ($val["h_Status"] == 2){
                $output .= '<td>취소</td>';
            }



            //IF withdraw
            // if($val["h_Event"] == "증금"){
            //     if($val["t_Cashin_Status"] == 0){
            //         $output .= '<td>진행중</td>';
            //     }
            //     else if($val["t_Cashin_Status"] == 1){
            //         $output .= '<td>완료</td>';
            //     }
            //     else if($val["t_Cashin_Status"] == 2){
            //         $output .= '<td>취소</td>';
            //     }
            // }
           
            // else if($val["h_Event"] == "출금"){
			// 	if($val["t_Cashout_Status"] == 0){
			// 		$output .= '<td>진행중</td>';
			// 	}
			// 	else if($val["t_Cashout_Status"] == 1){
			// 		$output .= '<td>완료</td>';
			// 	}
			// 	else if($val["t_Cashout_Status"] == 2){
			// 		$output .= '<td>취소</td>';
			// 	}
            // }

            $output .= '<td>'.$val["h_Contract_Time"].'</td>';
			$output .= '<td>'.$val["h_Processing_Time"].'</td>';

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
    $output .= '</div>';
    $output .= '</div>';
	
    print $output;
?>