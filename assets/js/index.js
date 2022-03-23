$(function(){
    // modal
    $(".modal-popup-login").click(function(){
        $("#modal-login").modal('show');
    });
    //toggle noticeguide
    $('.dropdown-noticeguide').mouseover(function() {
        $('.notgui').show();
    })

    $('.dropdown-noticeguide').mouseout(function() {
        t = setTimeout(function() {
            $('.notgui').hide();
        }, 100);

        $('.notgui').on('mouseenter', function() {
            $('.notgui').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('.notgui').hide();
        })
    })
    //toggle depositwithdraw
    $('.dropdown-depositwithdraw').mouseover(function() {
        $('.depwid').show();
    })

    $('.dropdown-depositwithdraw').mouseout(function() {
        t = setTimeout(function() {
            $('.depwid').hide();
        }, 100);

        $('.depwid').on('mouseenter', function() {
            $('.depwid').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('.depwid').hide();
        })
    })
    //toggle inqfaq
    $('.dropdown-inquiryfaq').mouseover(function() {
        $('.inqfaq').show();
    })

    $('.dropdown-inquiryfaq').mouseout(function() {
        t = setTimeout(function() {
            $('.inqfaq').hide();
        }, 100);

        $('.inqfaq').on('mouseenter', function() {
            $('.inqfaq').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('.inqfaq').hide();
        })
    })
    
    $('#navbar-collapse-1').click(function(){
        $('.navbar-collapse-1-mobile').toggle();
    });
    $('#navbar-collapse-2').click(function(){
        $('.display_nonlog').toggle();
    });
    $('#navbar-collapse-3').click(function(){
        $('.display_log').toggle();
    });
    //fetching cash balance
    $.ajax({
        "url": "php/api/user/getUserCashBalance.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            var formatter = new Intl.NumberFormat();
            var balance = response[0].t_Amount_in_Total;
            $('.cash_balance').text(formatter.format(balance));
        }
    })
})