    <!-- custom style/script -->

    <!-- header html -->
    <?php include __DIR__ . '/includes/head_html.php';?>
    <?php
        $linkcss = array();
        $scriptjs = array(
            "assets/js/register.js"
        );
    ?>
    <style>
        .custom-select-lg{
            padding-left: 20px;
        }
        select {
            -webkit-appearance: none;
            appearance: none;
        }
        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: "▼";
            font-size: 1rem;
            color: #444444;
            top: 12px;
            right: 16px;
            position: absolute;
        }
        .text_signup{
            padding: 20px;
        }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <!-- registration Section -->
    <div class="container page-signup">
        <h3 class="text-center font-weight-bold signup-title">BITMAN365 회원가입</h3>
        <form method="POST" id="form_register">
            <div class="row justify-content-center">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label><b>회원 정보</b> <span class="error_acct_dup"></span></label>
                        <div class="input-group">
                            <input type="text" id="s_account_code" name="s_account_code" class="form-control text_signup mr-2" placeholder="아이디를 입력해 주세요.(영어소문자+숫자 12자까지)">
                            <input type="hidden" name="dummy_code" id="dummy_code">
                            <button type="button" class="btn btn_signup_orange text-white btn-lg btn-shadow" id="accnt_id_dup_chk"><span class="error_id_chk">중복 확인</span></button>
                        </div>
                        <span class="errorid"></span>
                    </div>
                    <div class="form-group">
                        <label>닉네임 </label>
                        <div class="input-group">
                            <input type="text" id="nickname" name="nickname" class="form-control text_signup mr-2" placeholder="닉네임을 입력해 주세요.(한글 3~7자까지)">
                            <input type="hidden" name="dummy_nickname" id="dummy_nickname">
                            <button type="button" class="btn btn_signup_orange text-white btn-lg btn-shadow" id="nickname_dup_chk"><span class="error_nn_chk">중복 확인</span></button>
                        </div>
                        <span class="errornickname"></span>
                    </div>
                    <div class="form-group">
                        <label>비밀번호 </label>
                        <input type="password" id="s_password" name="s_password" class="form-control text_signup mr-2" placeholder="비밀번호를 입력해 주세요.(숫자, 영어대/소문자, 특수문자 포함 4~12자까지)">
                    </div>
                    <div class="form-group">
                        <label>비밀번호 확인 </label>
                        <input type="password" id="chk_password" name="chk_password" class="form-control text_signup mr-2" placeholder="비밀번호를 한번 더 입력해 주세요.">
                    </div>
                    <div class="form-group">
                        <label>휴대폰 번호 </label>
                        <input type="text" id="mobile_number" name="mobile_number" class="form-control text_signup mr-2" placeholder="휴대폰 번호를 입력해 주세요.">
                    </div>
                    <div class="form-group">
                        <label>예금주 </label>
                        <input type="text" id="account_holder" name="account_holder" class="form-control text_signup mr-2" placeholder="예금주를 입력해 주세요.">
                    </div>
                    <div class="form-group">
                        <label>은행 </label>
                        <div class="select-wrapper">
                            <select name="bank_code" id="bank_code" class="form-control custom-select-lg" style="height: 46px;">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>계좌번호 </label>
                        <input type="text" id="account_number" name="account_number" class="form-control text_signup mr-2" placeholder="계좌번호를 입력해 주세요.('-'표시없이 입력해주세요.)">
                    </div>
                    <div class="form-group">
                        <label>추천지점 </label>
                        <input type="text" id="rec_point" name="rec_point" class="form-control text_signup mr-2" placeholder="추천지점 또는 코드를 입력해 주세요.">
                    </div>
                </div>
                <div class="col-sm-10">
                    <h3 class="font-weight-bold signup-subtitle">회원 가입약관</h3>
                    <p>회원가입약관 및 개인정보처리방침의 내용에 동의하셔야 회원가입 하실 수 있습니다.</p>
                    <div class="form-group">
                        <input type="checkbox" id="chk1" name="chk1" value="Yes" class="custom-checkbox selectall mr-2">
                        <label for="checkbox" class="label-text">전체 동의</label>
                        <span class="errorchk1"></span>
                    </div>
                    <h4 class="font-weight-bold signup-subtitle">개인정보수집 및 이용동의서(필수)</h4>
                    <iframe src="assets/txtfile/개인정보수집_및_이용_동의서_필수" width="100%" height="200"></iframe>
                    <div class="form-group mt-3">
                        <input type="checkbox" id="chk2" name="chk2" value="Yes" class="custom-checkbox mr-2">
                        <label for="checkbox" class="label-text">회원가입약관에 동의합니다.</label>
                        <span class="onchk errorchk2"></span>
                    </div>
                    <h4 class="font-weight-bold signup-subtitle">개인정보수집 및 이용동의서(필수)</h4>
                    <iframe src="assets/txtfile/서비스_이용약관필수" width="100%" height="200"></iframe>
                    <div class="form-group mt-3">
                        <input type="checkbox" id="chk3" name="chk3" value="Yes" class="custom-checkbox mr-2">
                        <label for="checkbox" class="label-text">회원가입약관에 동의합니다.</label>
                        <span class="errorchk3"></span>
                    </div>
                </div>
                <div style="text-align:center" class="btn-action">
                    <button type="button" class="btn btn-signup_grp btn_signup_gray"><a href="./signup.php">취소</a></button>
                    <button type="submit" class="btn btn-signup_grp btn_signup_blue">회원가입</button>
                </div>
                <!-- <div class="col-sm-10 text-center btn-action">
                    <a href="./" button class="btn btn-lg btn-secondary mt-1 signup-btn">취소</button></a>
                    <button class="btn btn-lg btn-primary mt-1 signup-btn" type="submit">회원가입</button>
                </div> -->
            </div>
        </form>
    </div>

    <!-- modal -->
    <?php include __DIR__ . '/includes/modal.php';?>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php';?>

    <!-- script -->
    <?php include __DIR__ . '/includes/script.php';?>

    </body>
</html>
