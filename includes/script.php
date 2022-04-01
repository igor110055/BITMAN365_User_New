<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="plugins/jquery-validate-1.19.1/jquery.validate.min.js"></script>
<script src="plugins/jquery-confirm-3.3.2/js/jquery-confirm.min.js"></script>
<script src="plugins/iziToast-master/dist/js/iziToast.min.js"></script>
<script src="assets/js/login.js"></script>
<script src="assets/js/index.js"></script>
<script src="assets/js/logout.js"></script>
<script src="assets/js/function_izitoast.js"></script>
<?php
    if (isset($scriptjs) || is_array(@$scriptjs)) {
        foreach ($scriptjs as $js) {
            echo "<script src='$js'></script>";
        }
    }
?>
<script>
    <?php
        if(isset($_GET["succ"])){
            if($_GET["succ"] == 1){
                ?>
                    $('#modal-notif').modal('show');
                <?php
            }else{
                ?>
                    $('#modal-notif').modal('hide');
                <?php
            }
        }
    ?>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function dropdown() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
            }
        }
    }
</script>
</body>
</html>