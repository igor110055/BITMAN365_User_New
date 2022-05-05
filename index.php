<?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/privacy.js"
        );
    ?>
<!-- html head -->
<?php include __DIR__ . '/includes/head_html.php';?>

    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>
    <div class="div_container">
        <?php include __DIR__ . '/includes/header.php';?>
       <div class="jumbotron jumbotron-fluid trading_title_details">
            <p class="trading_title">디지털 자산 거래를 고려해야 하는 이유</p>
            <p class="trading_subtitle">
                디지털 자산은 무한한 잠재력과 높은 수익을
                창출할 수 있는 구조를 가지고 있습니다.
                디지털 자산의 투기적 특성으로 인해 가격의 변동성은 높아 전문가의 분석에 기반한 안정성 있는 거래가 함께 제공된다면 자산의 증가로 이어지게 됩니다.
            </p>
            <div class="tradings">
                <div>
                    <div class="mycheckbox">
                        <input type="checkbox" name="chk-trading1" id="chk-trading1">
                        <label for="chk-trading1"></label>
                    </div>
                    <span class="card-trading-title">높은 수익과 잠재력</span>
                    <p class="card-trading-subtitle">많은 잠재력과 높은 변동성을 기반으로 높은 수익을 창출 할 수 있기에 디지털 자산을 선택해야 합니다.</p>
                </div>
                <div>
                    <div class="mycheckbox">
                        <input type="checkbox" name="chk-trading1" id="chk-trading1">
                        <label for="chk-trading1"></label>
                    </div>
                    <span class="card-trading-title">꾸준한 성장과 인기</span>
                    <p class="card-trading-subtitle">디지털 자산은 다른 모든 금융자산들보다 꾸준히 성장하고 있습니다. 디지털 자산 거래는 높은 거래를 실행할 수 있는 지속적인 기회를 제공합니다.</p>
                </div>
                <div>
                    <div class="mycheckbox">
                        <input type="checkbox" name="chk-trading1" id="chk-trading1">
                        <label for="chk-trading1"></label>
                    </div>
                    <span class="card-trading-title">안전한 거래 및 간편한 접근</span>
                    <p class="card-trading-subtitle">거래자의 정보를 보호하고 편리한 서비스 이용을 위해 24시간 내내 고객서비스 팀을 운영하고 있습니다.</p>
                </div>
            </div>
        </div>
        <div class="jumbotron jumbotron-fluid graph">
            <div class="header_graph">
                <div class="header_graph_red header_graph_cl">
                    <div class="header_graph_img">
                        <center><img src="assets/icons/carbon_chart-candlestick.png"></center>
                    </div>
                    <p class="header_graph_title">전략적인 거래</p>
                    <p class="header_graph_subtitle">거래 전문가의 심도있는 분석에 기반한 전략적인 투자로 수익성 증대</p>
                </div>
                <div class="header_graph_mintgreen header_graph_cl">
                    <div class="header_graph_img">
                        <center><img src="assets/icons/ri_24-hours-fill.png"></center>
                    </div>
                    <p class="header_graph_title">365/24</p>
                    <p class="header_graph_subtitle">당사의 고객 서비스 팀은 365일, 24시간 내내 고객에게 탁월한 수준의 서비스 지원을 제공합니다.</p>
                </div>
                <div class="header_graph_yellow header_graph_cl">
                    <div class="header_graph_img">
                        <center><img src="assets/icons/flat-color-icons_combo-chart.png"></center>
                    </div>
                    <p class="header_graph_title">새로운 기회</p>
                    <p class="header_graph_subtitle">BITMAN365는 고객에게 가장 혁신적인 시장을 제공합니다.</p>
                </div>
                <div class="header_graph_blue header_graph_cl">
                    <div class="header_graph_img">
                        <center><img src="assets/icons/gala_secure.png"></center>
                    </div>
                    <p class="header_graph_title">실시간 위험 관리</p>
                    <p class="header_graph_subtitle">계속된 모니터링과 꾸준한 점검으로 모든 거래에 대한 위험을 방지합니다.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <?php include __DIR__ . '/includes/modal.php';?>

    <!-- footer -->
    <?php include __DIR__ . '/includes/footer.php';?>

    <!-- script js -->
    <?php include __DIR__ . '/includes/script.php';?>

    </body>
</html>