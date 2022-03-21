<?php
    class Admin {
        // DB stuff
        private $conn;
        private $tbl_bit_api = "tbl_bi_apis";
        private $tbl_bit_users = "tbl_bit_users";
        private $tbl_bit_bank = "tbl_bit_banklists";
        private $tbl_bit_betting = "tbl_bit_betting_details";
        private $tbl_bit_wss_result = "tbl_bit_wss_results";
        private $tbl_bit_wss = "tbl_bit_wss";
        private $tbl_bit_wss_tmp = "tbl_bit_wss_tmp";
        private $tbl_bit_transaction_header = "tbl_bit_transaction_headers";
        private $tbl_bit_reserved_result = "tbl_bit_reserved_results";
        
        //properties  
		public function __construct($db){
			$this->conn = $db;
		}

        //select query
        public function selectBettingAmount($unixtime){
            $query = "SELECT * FROM ".$this->tbl_bit_betting." WHERE b_time = '".$unixtime."' AND b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        public function selectCurrentBalance(){
            $query = "SELECT * FROM ".$this->tbl_bit_transaction_header." WHERE t_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_balance = $user["t_Amount_in_Total"];
            return $user_balance;
        }

        // public function postBinanceData($bidata){
        //     //(SELECT a_close FROM tbl_bi_apis WHERE a_StatusId IN(1) ORDER BY a_Id DESC LIMIT 1)
        //     $query = "INSERT INTO ".$this->tbl_bi_api." (a_Id,a_time,a_time_date, a_open, a_high, a_low, a_close, a_Trend) VALUES (:ai,:time, :date, :open, :high, :low, :close, :trend);
        //     UPDATE tbl_bit_betting_details SET b_Result = :result WHERE b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND b_time = :time AND b_Result IN(0);
        //     UPDATE ".$this->tbl_bi_api." SET a_close = :open WHERE a_time = :timeM";
        //     $stmt = $this->conn->prepare($query);

        //     $t = $bidata->time;
        //     $o = $bidata->open;
        //     $h = $bidata->high;
        //     $l = $bidata->low;
        //     $c = $bidata->close;
        //     $tr = ($bidata->close > $bidata->open) ? 'Buy' : 'Sell';
        //     $r = ($tr == '매수') ? 2 : 1;
        //     $ai = $this->getAutoIncrement();
        //     $tm = $bidata->timeminus1;
        //     $date = $bidata->datetime;
        //     $stmt->bindParam(':time', $t, PDO::PARAM_INT);
        //     $stmt->bindParam(':open', $o, PDO::PARAM_STR);
        //     $stmt->bindParam(':high', $h, PDO::PARAM_STR);
        //     $stmt->bindParam(':low', $l, PDO::PARAM_STR);
        //     $stmt->bindParam(':close', $c, PDO::PARAM_STR);
        //     $stmt->bindParam(':trend', $tr, PDO::PARAM_STR);
        //     $stmt->bindParam(':result', $r, PDO::PARAM_INT);
        //     $stmt->bindParam(':ai', $ai, PDO::PARAM_INT);
        //     $stmt->bindParam(':timeM', $tm, PDO::PARAM_STR);
        //     $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        //     if($stmt->execute()){
        //         return true;
        //     }
        //     return false;
        // }

        public function getBinanceApiData($sort,$limit){
            $query = "SELECT * FROM (SELECT * FROM ".$this->tbl_bit_api." ORDER BY a_Id $sort LIMIT $limit) AS sub ORDER BY a_Id"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        //post function
        public function postGameResultUpdate($unixtime){
            $query = "UPDATE ".$this->tbl_bit_wss_result." SET r_StatusId = :status WHERE r_Time_Unix = :time";
            $stmt = $this->conn->prepare($query);

            $t = $unixtime;
            $s = 1;

            $stmt->bindParam(':time', $t, PDO::PARAM_STR);
            $stmt->bindParam(':status', $s, PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postGameResultUser($unixtime){
            $query = "SELECT
            W.r_Game_Result AS WGameResult,
            B.b_Trend AS BGameResult
            FROM ".$this->tbl_bit_wss_result." W
            JOIN ".$this->tbl_bit_betting." B ON W.r_Time_Unix = B.b_time WHERE W.r_Time_Unix = :time_unix";
            $stmt = $this->conn->prepare($query);

            $unix = $unixtime;
            $stmt->bindParam(':time_unix', $unix, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rowCount = $stmt->rowCount();
            if($rowCount > 0){
                $query = "UPDATE ".$this->tbl_bit_betting." SET b_Result = :status WHERE b_time = :time";
                $stmt = $this->conn->prepare($query);

                $t = $unixtime;
                if($data[0]["WGameResult"] == $data[0]["BGameResult"]){
                        $s = 1;

                }else if($data[0]["WGameResult"] != $data[0]["BGameResult"]){
                        $s = 2;
                }else{
                        $s = 3;
                }

                $stmt->bindParam(':time', $t, PDO::PARAM_STR);
                $stmt->bindParam(':status', $s, PDO::PARAM_INT);
                if($stmt->execute()){
                    return true;
                }
                return false;
            }
        }

        public function postbettingTransaction($unixtime){
            ///balance
            $cur_balance = $this->selectCurrentBalance();
            ////transaction
            $betting_amount = $this->selectBettingAmount($unixtime);
            $amount = $betting_amount["b_betAmount"];
            $total_amount = $betting_amount["b_Total_BetAmount"];
            $result = $betting_amount["b_Result"];
            print_r($betting_amount);
            if($result == 1){
                //select amount win
                $user_trans = "UPDATE ".$this->tbl_bit_transaction_header." SET t_Amount_in_Total = :t_amount  WHERE t_Account_Code = :a_code";
                $stmt = $this->conn->prepare($user_trans);

                $amount = $cur_balance + $total_amount;
                $a_code = $_SESSION["user_session"]["u_Account_Code"];

                $stmt->bindParam(':a_code', $a_code, PDO::PARAM_STR);
                $stmt->bindParam(':t_amount', $amount, PDO::PARAM_STR);
                $stmt->execute();
            }else if($result == 3){
                $user_trans = "UPDATE ".$this->tbl_bit_transaction_header." SET t_Amount_in_Total = :t_amount  WHERE t_Account_Code = :a_code";
                $stmt = $this->conn->prepare($user_trans);

                $amount = $cur_balance + $amount;
                $a_code = $_SESSION["user_session"]["u_Account_Code"];
                
                $stmt->bindParam(':a_code', $a_code, PDO::PARAM_STR);
                $stmt->bindParam(':t_amount', $amount, PDO::PARAM_STR);
                $stmt->execute();
            }
        }

        public function postPurchaserequest($arr){
            $query = "INSERT INTO ".$this->tbl_bit_betting." (b_Account_Code,b_time,b_betAmount,b_Total_BetAmount,b_MultiplyBy,b_Trend) VALUES (:Account_Code,:time,:betAmount,:Total_BetAmount,:MultiplyBy,:Trend);
            UPDATE ".$this->tbl_bit_transaction_header." SET t_Amount_in_Total = :total_balance WHERE t_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);

            $cur_balance = $this->selectCurrentBalance();
            $accountcode = $_SESSION["user_session"]["u_Account_Code"];
            $time = $arr->time;
            $betamount = $arr->betAmount;
            $dbalance = $cur_balance - $arr->betAmount;
            $totalbetAmount = $arr->totalBetAmount;
            $multiplyby = $arr->multiplyby;
            $trend = ($arr->trend == 1) ? '매수' : '매도';

            $stmt->bindParam(':Account_Code', $accountcode, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            $stmt->bindParam(':betAmount', $betamount, PDO::PARAM_STR);
            $stmt->bindParam(':Total_BetAmount', $totalbetAmount, PDO::PARAM_STR);
            $stmt->bindParam(':MultiplyBy', $multiplyby, PDO::PARAM_STR);
            $stmt->bindParam(':Trend', $trend, PDO::PARAM_STR);
            $stmt->bindParam(':total_balance', $dbalance, PDO::PARAM_STR);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postWsskline($result,$reserved){
            $query = "INSERT INTO ".$this->tbl_bit_wss_result." (r_Game_Type,r_Time_Unix, r_Time_Datetime, r_Open, r_High, r_Low, r_Close,JsonDataResult, r_Price_Result, r_Game_Result) VALUES (:Game_Type, :Time_Unix, :Time_Datetime, :Open, :High, :Low, :Close,:Json, :Price_Result, :Game_Result)";
            $stmt = $this->conn->prepare($query);

            $time = (string)$result->time;
            $time_kr = (string)$result->time_kr;
            $open = (string)$result->open;
            $high = (string)$result->high;
            $low = (string)$result->low;
            $close = (string)$result->close;
            $gametype = (string)$result->gType;
            $rs = $this->getWssdata($time,$open);
            $json = json_encode($rs);
            $wss_trade = json_decode($json, true);
            $gr = ($rs["lastresult"]["w_Current_Price"] >= $open) ? '매수' : '매도';
            $pr = $rs["lastresult"]["w_Current_Price"];

            // $stmt->bindParam(':Id', $ai, PDO::PARAM_INT);
            $stmt->bindParam(':Time_Unix', $time, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Datetime', $time_kr, PDO::PARAM_STR);
            $stmt->bindParam(':Open', $open, PDO::PARAM_STR);
            $stmt->bindParam(':High', $high, PDO::PARAM_STR);
            $stmt->bindParam(':Low', $low, PDO::PARAM_STR);
            $stmt->bindParam(':Close', $close, PDO::PARAM_STR);
            $stmt->bindParam(':Json', $json, PDO::PARAM_STR);
            $stmt->bindParam(':Price_Result', $pr, PDO::PARAM_STR);
            $stmt->bindParam(':Game_Result', $gr, PDO::PARAM_STR);
            $stmt->bindParam(':Game_Type', $gametype, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postWssTrade($result){
            $query = "INSERT INTO ".$this->tbl_bit_wss_tmp." (w_Time_Min_unix,w_Time_Min,w_Time_Unix,w_Time_Kor,w_Current_Price,w_Transaction_Id) VALUES (:Time_Min_unix,:Time_Min,:Time_Unix,:Time_kor,:Cur_Price,:Trans_Id)";
            $stmt = $this->conn->prepare($query);

            
            $currenttime = $result->currenttime;
            $mytimeunix = $result->mytimeunix;
            $secunixtime = $result->secunixtime;
            $kortime = $result->kortime;
            $curprice = number_format((float)$result->currentprice, 2, '.', '');
            $transid = $result->transid;

            $stmt->bindParam(':Time_Min', $currenttime, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Min_unix', $mytimeunix, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Unix', $secunixtime, PDO::PARAM_STR);
            $stmt->bindParam(':Time_kor', $kortime, PDO::PARAM_STR);
            $stmt->bindParam(':Cur_Price', $curprice, PDO::PARAM_STR);
            $stmt->bindParam(':Trans_Id', $transid, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
        }

        public function postReservedGameResult($result){
            $query = "INSERT INTO ".$this->tbl_bit_reserved_result." (r_Gametype,r_Time_Unix,r_Date_Time,r_Game_Selected) VALUES (:type, :unix, :date, :selected)";
            $stmt = $this->conn->prepare($query);
            
            $unix = $result->unixseconds;
            $date = $result->datetime;
            $selected = $result->selected;
            $type = $result->type;

            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':unix', $unix, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':selected', $selected, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        ////get function
        public function getReservedResultPerMinute($rtime){
            $query = "SELECT * FROM ".$this->tbl_bit_reserved_result." WHERE r_Time_Unix = '".$rtime."'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBinanceHistory(){
            $query = "SELECT * FROM ".$this->tbl_bit_wss_result." ORDER BY r_Id DESC LIMIT 20"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBettingHistoryGroup(){
            $query = "SELECT r_Game_Result, r_Time_Unix FROM ".$this->tbl_bit_wss_result." WHERE r_StatusId IN(1) GROUP BY r_Game_Result, r_Time_Unix"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBinanceUserHistory(){
            $query = "SELECT * FROM ".$this->tbl_bit_betting." WHERE b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' ORDER BY b_Id DESC LIMIT 20"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBetPerMin(){
            $query = "SELECT * FROM ".$this->tbl_bit_betting." WHERE DATE(b_UpdatedDate) = '".date('Y-m-d')."' AND b_Result IN(0) AND b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getOpenprice($time){
            $query = "SELECT r_Open,r_Time_Unix,r_Time_Datetime FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '$time' LIMIT 1"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getWssdata($time,$openPrice){
            //AND w_Current_Price = '$openPrice'
            $max = $openPrice + rand(1,2);
            $min = $openPrice - rand(1,2);
            $openprice_ex = explode('.', $openPrice);
            $query = "SELECT w_Transaction_Id, w_Time_Min_Unix, w_Time_Kor, w_Current_Price
            FROM tbl_bit_wss_tmp 
            WHERE w_Time_Min_Unix = '$time'
            AND w_Current_Price >= '$min'
            AND w_Current_Price <= '$max'
            ORDER BY w_Transaction_Id ASC"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $resultArr = array();
            foreach($data as $key => $res){
                if($data[$key] == $data[0]){
                    $resultArr[] = array(
                        "w_Transaction_Id" => $res["w_Transaction_Id"],
                        "w_Time_Min_Unix" => $res["w_Time_Min_Unix"],
                        "w_Time_Kor" => $res["w_Time_Kor"],
                        "w_Current_Price" => $openPrice
                    );
                }else{
                    $resultArr[] = array(
                        "w_Transaction_Id" => $res["w_Transaction_Id"],
                        "w_Time_Min_Unix" => $res["w_Time_Min_Unix"],
                        "w_Time_Kor" => $res["w_Time_Kor"],
                        "w_Current_Price" => $res["w_Current_Price"]
                    );
                }
            }
            //$rowCount = $stmt->rowCount();
            $fresult = end($data);
            $newfresult = array(
                "w_Transaction_Id" => $fresult["w_Transaction_Id"],
                "w_Time_Min_Unix" => $fresult["w_Time_Min_Unix"],
                "w_Time_Kor" => $fresult["w_Time_Kor"],
                "w_Current_Price" => ($fresult["w_Current_Price"] >= $openPrice) ? $openprice_ex[0] + rand(1,2) . '.' . rand(0,99) : $openprice_ex[0] - rand(1,2) . '.' . rand(0,99)
            );
            $newarr = array(
                "result" => array_slice($resultArr, 0, count($resultArr)-1, true),
                "lastresult" => $newfresult
            );
            return $newarr;
        }

        public function getWssResultPerMin($time){
            $query = "SELECT JsonDataResult FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '$time' LIMIT 1"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getGameresult($time){
            $query = "SELECT r_Time_Datetime,r_Price_Result,r_Game_Result FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '".$time."' LIMIT 1"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getUserCashBalance(){
            $query = "SELECT * FROM ".$this->tbl_bit_transaction_header." WHERE t_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."' LIMIT 1"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getAutoIncrement(){
            $query = "SELECT MAX(a_Id) + 1 FROM tbl_bi_apis ORDER BY a_Id DESC LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
        }

        public function getReserveGameResult(){
            $query = "SELECT * FROM ".$this->tbl_bit_reserved_result;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getTotalBetPerMin(){
            $query = "SELECT 
            SUM(b_betAmount) AS Totalwin, b_time, b_Trend
            FROM ".$this->tbl_bit_betting."
            GROUP BY b_Time,b_Trend";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getGameResultHistory(){
            $query = "SELECT
            R.r_Time_Unix AS resTime,
            W.r_Time_Datetime AS Date_Time,
            W.r_Price_Result,
            W.r_Game_Result,
            W.JsonDataResult,
            W.r_Game_Type
            FROM ".$this->tbl_bit_wss_result." W
            LEFT JOIN ".$this->tbl_bit_reserved_result." R ON W.r_Time_Unix = R.r_Time_Unix WHERE W.r_StatusId IN(1) ORDER BY W.r_Time_Unix DESC LIMIT 5";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBetAtThisTime(){
            $query = "SELECT * FROM ".$this->tbl_bit_betting;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getGameResservedMinUpdate($unixtime){
            $query = "SELECT
            R.r_Game_Selected AS GameSelected,
            R.r_Time_Unix AS TimeUnix,
            W.r_Open AS OpenPrice,
            W.JsonDataResult AS JSONResult
            FROM ".$this->tbl_bit_reserved_result." R
            JOIN ".$this->tbl_bit_wss_result." W ON R.r_Time_Unix = W.r_Time_Unix
            WHERE R.r_Time_Unix = :time_unix AND R.r_IsCanceled IN(0)";
            $stmt = $this->conn->prepare($query);

            $unix = $unixtime;
            $stmt->bindParam(':time_unix', $unix, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rowCount = $stmt->rowCount();
            if($rowCount > 0){
                $update = "UPDATE ".$this->tbl_bit_wss_result." SET r_Price_Result = :price_res, r_Game_Result = :game_result, JsonDataResult = :json WHERE r_Time_Unix = :time_reserved";
                $stmt1 = $this->conn->prepare($update);

                $openprice_ex = explode('.', $data[0]["OpenPrice"]);
                $gs = $data[0]["GameSelected"];
                $tu = $data[0]["TimeUnix"];
                $pr = ($gs == '매수') ? $openprice_ex[0] + rand(1,2) . '.' . rand(0,99) : $openprice_ex[0] - rand(1,2) . '.' . rand(0,99);
                $jr = $data[0]["JSONResult"];
                $jsondecode = json_decode($jr, true);
                $rs = $jsondecode["result"];
                $lr = array(
                    "w_Time_Kor" => $jsondecode["lastresult"]["w_Time_Kor"],
                    "w_Current_Price" => $pr,
                    "w_Time_Min_Unix" => $jsondecode["lastresult"]["w_Time_Min_Unix"],
                    "w_Transaction_Id" => $jsondecode["lastresult"]["w_Transaction_Id"]
                );
                $newArrayJson = array(
                    "result" => $rs,
                    "lastresult" => $lr
                );
                $jsontype = json_encode($newArrayJson);

                // print_r($gs);
                // print_r($lr);
                // print_r(json_encode($newArrayJson));

                $stmt1->bindParam(':price_res', $pr, PDO::PARAM_STR);
                $stmt1->bindParam(':game_result', $gs, PDO::PARAM_STR);
                $stmt1->bindParam(':time_reserved', $tu, PDO::PARAM_STR);
                $stmt1->bindParam(':json', $jsontype, PDO::PARAM_STR);
                if($stmt1->execute()){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function checkTimeBetPerMin($timeunix){
            $query = "SELECT * FROM ".$this->tbl_bit_betting." WHERE b_time = '".$timeunix."' AND b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getUserBankInfo(){
            $query = "SELECT
            U.u_Account_Number,
            U.u_Bank_Holder_Name,
            B.m_Bank_Name
            FROM ".$this->tbl_bit_users." U
            JOIN ".$this->tbl_bit_bank." B ON U.u_Bank_Code = B.m_BankId
            WHERE U.u_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."' LIMIT 1"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }