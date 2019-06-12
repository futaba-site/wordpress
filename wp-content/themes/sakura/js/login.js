jQuery(function($){

    let webMSG = new WebMSG();
    webMSG.init();



    $(".login-input-element input").focus(function(){
        $(this).next().css({
            "top": "-24px",
            "font-size": "12px",
            "color": "#fd79a8",
            'line-height': '24px'
        })
    }).blur(function(){
        if(!$(this).val()) {
            $(this).next().css({
                "top": "1px",
                "font-size": "14px",
                "color": "#666",
                "line-height": "36px"
            });
        }
    });

    $(".login-radio").click(function(){
        let status = $(this).attr('data-value');
        let circle = $(this).children('.login-radio-circle');
        let input = $(this).children('.login-radio-input');
        if(status == '0') {
            circle.addClass('main-background-color-after');
            input.val('1');
            $(this).attr('data-value', '1');
        } else {
            circle.removeClass('main-background-color-after');
            input.val('0');
            $(this).attr('data-value', '0');
        }
    });

    $('#login-submit').click(() => {
        $(this).attr('disabled', 'disabled');
        if($('#robot-click').val()=='0') {
            webMSG.show('阁下该不是是机器人八！');
            return false;
        }
        $.ajax({
            url: 'https://www.sometimesnaive.com.cn/login',
            method: 'POST',
            dataType: 'json',
            data: {
                user: $('#user').val(),
                password: $('#password').val(),
                remember: $('#remember').val()
            },
            success: function(data) {
                if(data.hasOwnProperty('error')) {
                    webMSG.show('口令不对哦！');
                } else if(data.hasOwnProperty('success')) {
                    window.location.href="https://www.sometimesnaive.com.cn/wp-admin/";
                }
            },
            error: function(err, status) {
                console.log(err + status);
                webMSG.show('接口完全坏掉了呢（确信）');
            }
        });
        return false;
    });

});