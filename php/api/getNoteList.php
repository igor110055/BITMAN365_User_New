<?php  
    include_once '../config/Database.php';
	include_once '../class/Pagination.class.php';
	include_once '../class/UserInfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new UserInfo($db);

	$sql = $query->getNoteList();
    $sql1 = $query->getNoteRowCount();
				
	$paginationlink = "php/api/getNoteList.php?page=";
					
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
    $output .= '쪽지'; 
    // <button class="inq_reg">문의등록</button><button class="inq_toggle" id="toggle-inquiry">문의등록</button>
    $output .= '</div>';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 620px;">';
    $output .= '<div class="body-header">';
	$output .= '<table class="table guide">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th>번호</th>';
	// $output .= '<th><input type="checkbox" name="selectThemAll"/></th>';
	$output .= '<th>제목</th>';
	$output .= '<th>상태</th>';
	$output .= '<th>수신시간</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
	if($sql1->rowCount() > 0){
		foreach($data as $key => $val){
			$output .= '<tr class="rowaccordion" data-id="'.$val["e_Id"].'">';
			$output .= '<td>'.$sNum.'</td>';
			// $output .= '<td><input type="checkbox" name="chk1" value="Yes"></td>';
			$output .= '<td style="text-align: left;">'.$val["e_Title"].'</td>';
        	// $output .= '<td style="color: #ff9300"><span class="unread"></span></td>';

			if($val["e_State"] == 0){
                $output .= '<td style="color: #ff9300">읽지 않음</td>';
            }
			else if($val["e_State"] == 1){
                $output .= '<td style="color: #78A6FF">읽음</td>';
            }
			$output .= '<td>'.$val["e_Registration_Time"].'</td>';
			$output .= '</tr>';
			$output .= '<tr class="rowContent">';
			$output .= '<td colspan="4" style="padding-left: 250px;">'.$val["e_Details"].'</td>';
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
	var previousTarget=null;
	$(".guide .rowaccordion").click(function(){
		
		$(".rowContent").not($(this).next()).hide();
		$(this).next(".rowContent").toggle();
			var id = ($(this).attr('data-id'));

			$.ajax({
				"type": "POST",
				"url": "php/api/postInformation.php?id="+id+"&category_title=note_update",
				cache: false,
				success: function(response) {
					console.log(id);
					}
				});

			if(this==previousTarget) {
				$.ajax({
				success: function(response) {
					console.log(id);
					getresult("php/api/getNoteList.php");
						}
					});
			}
			previousTarget=this;
  			return false;
			});

	$(function() {
    jQuery("[name=selectThemAll]").click(function(source) { 
        checkboxes = jQuery("[name=chk1]");
        for(var i in checkboxes){
            checkboxes[i].checked = source.target.checked;
        }
    });
})


</script>