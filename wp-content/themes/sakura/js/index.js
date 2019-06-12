jQuery(document).ready(function($){

    /**
     * 获取页面数值
     */
    let w_width = $(window).width();
    let w_height = $(window).height();
    $(window).resize(function(){
        w_width = $(window).width();
        w_height = $(window).height();
    });

    // 封面下拉按钮动作
    $('#cover-down').click(function(){
        $('html,body').finish().animate({'scrollTop': w_height - 76 }, 500);
    })

    // 动态文章拉取
    $('#pagination a').on('click', function(){
        $(this).addClass('loading').text("LOADING...");
        $.ajax({
            type: "POST",
            url: $(this).attr("href"),
            success: function(data) {
                let res = $(data).find('.section .post');
                let nextHref = $(data).find('#pagination a').attr('href');
                $('.post-list').append(res);
                $('#pagination a').removeClass('loading').text("LOAD MORE");
                if(nextHref != undefined){
                    $('#pagination a').attr('href' ,nextHref);
                }else {
                    $('#pagination').remove();
                }
            }
        })
        return false;
    });

    // 封面波浪动态
    let wave = function(){

        let left_1 = $('#cover-wave-1').css('left');
        let left_2 = $('#cover-wave-2').css('left');
        left_1 = parseInt(left_1.substr(0, left_1.length - 2));
        left_2 = parseInt(left_2.substr(0, left_2.length - 2));
        let move_1 = $('#cover-wave-1').attr('data-move');
        let move_2 = $('#cover-wave-2').attr('data-move');
        if (move_1=='left') {
            left_1 = left_1 - 3;
            if(left_1+2*w_width < w_width) {
                $('#cover-wave-1').attr('data-move', 'right');
            } else {
                $('#cover-wave-1').css('left', left_1);
            }
        } else {
            left_1 = left_1 + 3;
            if(left_1 >= 0){
                $('#cover-wave-1').attr('data-move', 'left');
            } else {
                $('#cover-wave-1').css('left', left_1);
            }
        }
        if (move_2=='left') {
            left_2 = left_2 - 3;
            if(left_2+2*w_width < w_width) {
                $('#cover-wave-2').attr('data-move', 'right');
            } else {
                $('#cover-wave-2').css('left', left_2);
            }
        } else {
            left_2 = left_2 + 3;
            if(left_2 >= 0){
                $('#cover-wave-2').attr('data-move', 'left');
            } else {
                $('#cover-wave-2').css('left', left_2);
            }
        }
        return ;
    };
    $('#cover-wave-1').css('left', '0');
    $('#cover-wave-2').css('left', -w_width);
    let wave_move = self.setInterval(wave,150);

    /**
     * hitokoto api
     */
    $.ajax({
        url: 'https://v1.hitokoto.cn/',
        method: 'GET',
        data: {c:'b'},
        dataType: 'json',
        success: function(data){
            if(data['id']) {
                $('#hitokoto').text(data['hitokoto']);
                $('#hitokoto-from').text('- 「'+data['from']+'」');
            } else {
                console.log('ajax for hitokoto failed');
            }
        },
        error: function(re, status) {
            console.log(re+' '+status);
        }
    })
});