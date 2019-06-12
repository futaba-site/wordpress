jQuery(document).ready(function($){

    var w_width = $(window).width();
    var w_height = $(window).height();
    var d_height = $(document).height();

    $(window).scroll(function(){
        var scroll_top = $(window).scrollTop();

        // top-scrollbar width
        var top_width = w_width*(scroll_top/(d_height-w_height));
        $('#top-scrollbar').width(top_width);

        if(scroll_top < 3) {
            $('header').css({
                'background-color': 'transparent',
            });
            $('#top-nav').css({
                'margin-top': '20px',
                'opacity': '0',
                'visibility': 'hidden'
            });
            $('#right-scrollbar').css('top', '-900px');
        }
        else {
            $('header').css({
                'background-color': 'rgba(255,255,255,.95)',
            });
            $('#top-nav').css({
                'margin-top': '0',
                'opacity': '1',
                'visibility': 'visible'
            });
            $('#right-scrollbar').css('top', '0');
        }
    });

    var top_nav = $('#top-nav');
    top_nav.css('left',(w_width - top_nav.width)/2);

    $('#right-scrollbar').click(function(){
        $('html,body').finish().animate({'scrollTop': "0"},500);
    });

    $('#cover-down').click(function(){
        $('html,body').finish().animate({'scrollTop': w_height - 76 }, 500);
    })

    // bottom time value
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth()+1;
    var day = date.getDate();
    function timeIn(y, m, d) {
        var days = 0;
        var month_days = new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
        for(var i = 2017;i < y;i++)
            if(i%4==0 && i%100!=0 || i%400==0)
                days += 366;
            else
                days += 365;
        if(y%4==0 && y%100!=0 || y%400==0)
            month_days[2] =29;
        for(var i=0;i < m;i++)
            days += month_days[i];
        days += d;
        return days;
    }
    $('#bottom-time').text(timeIn(year, month, day));


    $('#pagination a').on('click', function(){
        $(this).addClass('loading').text("LOADING...");
        $.ajax({
            type: "POST",
            url: $(this).attr("href"),
            success: function(data) {
                res = $(data).find('.section .post');
                nextHref = $(data).find('#pagination a').attr('href');
                $('.section').append(res.fadeIn(300));
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

    var wave = function(){

        var left_1 = $('#wave-1').css('left');
        var left_2 = $('#wave-2').css('left');
        left_1 = parseInt(left_1.substr(0, left_1.length - 2));
        left_2 = parseInt(left_2.substr(0, left_2.length - 2));
        var move_1 = $('#wave-1').attr('data-move');
        var move_2 = $('#wave-2').attr('data-move');
        if (move_1=='left') {
            left_1 = left_1 - 3;
            if(left_1+2*w_width < w_width) {
                $('#wave-1').attr('data-move', 'right');
            } else {
                $('#wave-1').css('left', left_1);
            }
        } else {
            left_1 = left_1 + 3;
            if(left_1 >= 0){
                $('#wave-1').attr('data-move', 'left');
            } else {
                $('#wave-1').css('left', left_1);
            }
        }
        if (move_2=='left') {
            console.log('left'+ left_2);
            left_2 = left_2 - 3;
            console.log('left'+ left_2);
            if(left_2+2*w_width < w_width) {
                console.log('left-if');
                $('#wave-2').attr('data-move', 'right');
            } else {
                $('#wave-2').css('left', left_2);
            }
        } else {
            console.log('right');
            left_2 = left_2 + 3;
            if(left_2 >= 0){
                console.log('right-if');
                $('#wave-2').attr('data-move', 'left');
            } else {
                $('#wave-2').css('left', left_2);
            }
        }
        return ;
    };
    $('#wave-1').css('left', '0');
    $('#wave-2').css('left', -w_width);
    var wave_move = self.setInterval(wave,150);
});