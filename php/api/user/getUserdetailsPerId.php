<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $perPage = new PerPage();
    $query = new Admin($db);
    $auth = new Authentication($db);

    // $stmt = $query->getUsers();

    $sql = $stmt->rowCount();
    
    if($sql > 0){
        $sNum = 1;
        $cntstats = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $cntActive = $row["StatusCntActive"];
            $cntPending = $row["StatusCntPending"];
            // Action Button
            $actionButton = "
                <div class='form-inline'>
                <button class='btn btn-success customizeBtn editApi'><i class='fa fa-pencil'></i></button>
                    <button class='btn btn-danger customizeBtn deleteUser'><i class='fa fa-trash-o'></i></button>
                </div>";

            $array[] = array(
                "DT_RowId" => $row["u_Id"],
                "PhoneNumber" => $row["u_PhoneNumber"],
                "BankAccountHolder" => $row["u_BankAccountHolder"],
                "BankAccountNumber" => $row["u_BankAccountNumber"],
                "BankId" => $row["u_BankId"],
                "BankName" => $row["m_BankName"],
                "AccessName" => $row["m_AccessName"],
                "AccessId" => $row["u_AccessId"],
                "StatusId" => $row["u_StatusId"],
                "Password" => $auth->encrypt_decrypt('decrypt',$row["u_Password"]),
                "No" => '',
                "User" => '-',
                "Level" => $row["u_Level"],
                "Distributor" => $row["u_Distributor"],
                "Suggest" => $row["u_Suggest"],
                "LogupCode" => '-',
                "AcctId" => $row["u_AcctId"],
                "FName" => $row["u_FName"],
                "Nickname" => $row["u_Nickname"],
                "CurrencyMoney" => $row["h_StockMoney"],
                "Points" => $row["u_Point"],
                "TotalAmountofCashIn" => '-',
                "TotalAmountofWithdraw" => '-',
                "TotalProfit" => '-',
                "DomainName" => $row["u_DomainName"],
                "SignUpId" => $row["u_SignupCode"],
                "CurrentIp" => ($row["u_IpAddress"]) ? $row["u_IpAddress"] : $row["u_CurrentIp"],
                "RegisterDate" => $row["u_EntryDate"],
                "AccessDate" => '-',
                "LoginStatus" => $row["u_LoginStatus"],
                "State" => $row["u_State"],
                "Action" => $actionButton

            );
            $sNum++;
        }

        $dataset = array(
            "Echo" => 1,
            "iTotalRecords" => count($array),
            "iTotalDisplayRecords" => count($array),
            "cntActive" => ($cntActive) ? $cntActive : 0,
            "cntPending" => ($cntPending) ? $cntPending : 0,
            "aaData" => $array
        );
        echo json_encode($dataset);
    }else{
        http_response_code(404);
        echo json_encode('No Record Found.');
    }


    // $paginationlink = "../php/api/admin/getUserList.php?page=";

    // $page = 1;
    // if(!empty($_GET["page"])) {
    //     $page = $_GET["page"];
    // }

    // $start = ($page-1)*$perPage->perpage;
    // if($start < 0) $start = 0;

    // $query =  $sql . " limit " . $start . "," . $perPage->perpage; 
    // if(empty($_GET["rowcount"])) {
    //     $_GET["rowcount"] = $stmt->rowCount();
    // }
    // $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);

    // $output = '';
    // $output = '<div class="table-responsive">';
    // $output .= '<table class="table table-bordered" id="adminTable">';
    // $output .= '<thead>';
    // $output .= '<tr class="bg-dark">';
    // $output .= '<th>No.</th>';
    // $output .= '<th>User</th>';
    // $output .= '<th>Level</th>';
    // $output .= '<th>Distributor</th>';
    // $output .= '<th>Suggest</th>';
    // $output .= '<th>LogupCode</th>';
    // $output .= '<th>AccountId</th>';
    // $output .= '<th>Name</th>';
    // $output .= '<th>Nickname</th>';
    // $output .= '<th>CurrencyMoney</th>';
    // $output .= '<th>Points</th>';
    // $output .= '<th>TotalAmountofCashIn</th>';
    // $output .= '<th>TotalAmountofWithdraw</th>';
    // $output .= '<th>TotalProfit</th>';
    // $output .= '<th>Domain</th>';
    // $output .= '<th>SignUpId</th>';
    // $output .= '<th>CurrentIp</th>';
    // $output .= '<th>RegisterDate</th>';
    // $output .= '<th>AccessDate</th>';
    // $output .= '<th>LoginStatus</th>';
    // $output .= '<th>State</th>';
    // $output .= '<th style="width: 210px;">동작</th>';
    // $output .= '</tr>';
    // $output .= '</thead>';
    // $output .= '<tbody>';
    // if($stmt->rowCount() > 0){
    //     $sNum = 1;
    //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    //         extract($row);
    //         $output .= '<tr class="text-center">';
    //         $output .= '<td>'.$sNum.'</td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td></td>';
    //         $output .= '<td>
    //         <button class="btn btn-primary customizeBtn" id="btnDisplay"><i class="fa fa-eye"></i></button>
    //         <button class="btn btn-success customizeBtn" id="btnEdit"><i class="fa fa-edit"></i></button>
    //         <button class="btn btn-danger customizeBtn" id="btnDelete"><i class="fa fa-trash-o"></i></button>
    //         </td>';
    //         $output .= '</tr>';
    //         $sNum ++;
    //     }
    // }else{
    //     http_response_code(404);
    //     $output .= '<tr class="text-center">';
    //     $output .= '<td colspan="17">No record found.</td>';
    //     $output .= '</tr>';
    // }
    // $output .= '</tbody>';
    // $output .= '</table>';
    // $output .= '</div>';

    // if(!empty($perpageresult)) {
    //     $output .= '<span class="pull-right"><div id="pagination">' . $perpageresult . '</div></span>';
    // }
    // print $output;
	
    