<?php
    class Userinfo {
        // DB stuff
        private $conn;
        private $tbl_bit_notice = "tbl_bit_notice";
        private $tbl_bit_guide = "tbl_bit_guide";
        private $tbl_bit_inquiry = "tbl_bit_inquiries";
        
        //properties  
		public function __construct($db){
			$this->conn = $db;
		}
        
        ///rowcount
        public function getGuideRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_IsPublic IN(1)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getNoticeRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_IsPublic IN(1)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getInquiryRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_inquiry;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        //execute datarow
        public function getNoticeList(){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_IsPublic IN(1) ORDER BY n_Registration_Time DESC";
            return $query;
        }
        public function getGuideList(){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_IsPublic IN(1) ORDER BY g_Registration_Time DESC";
            return $query;
        }
        public function getInquiryList(){
            $query = "SELECT * FROM ".$this->tbl_bit_inquiry." ORDER BY t_Inquiry_Date DESC";
            return $query;
        }
    }
?>